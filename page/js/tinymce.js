import {getUrlParameter, initial_function} from './function.js'

const page_id = getUrlParameter("id");

const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', 'includes/upload.inc.php' + "?id=" + page_id);
    
    xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
    };
    
    xhr.onload = () => {
        if (xhr.status === 403) {
            reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
            return;
        }
      
        if (xhr.status < 200 || xhr.status >= 300) {
            reject('HTTP Error: ' + xhr.status);
            return;
        }
      
        // Uploaded Image
        const json = JSON.parse(xhr.responseText);
      
        if (!json || typeof json.location != 'string') {
            reject('Invalid JSON: ' + xhr.responseText);
            return;
        }
      
        const currVal = $("#form-image-log").val();    
        $("#form-image-log").val((currVal || "") + " " + json.db_path);

        resolve(json.location);
    };
    
    xhr.onerror = () => {
      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };
    
    const formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());
    
    xhr.send(formData);
});

tinymce.init({
    selector: '#form-content',
    plugins: 'image',
    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
    
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'includes/upload.inc.php',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: image_upload_handler_callback,

    // callback

    init_instance_callback: initial_function
});
