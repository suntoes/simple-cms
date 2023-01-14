export function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

export async function fetchPost(id, success = () => {}, error = () => {}) {
  await $.ajax(
    {
      type: "GET",
      url: "includes/post.inc.php?id="+id,
      dataType: "json",
      success: success,
      error: error
    }
  )
}

export function formatDate(date_created) {
  const date = new Date(date_created); 
  const result = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear()
  return result
}

export function initial_function(txtarea) {
  const url_id = getUrlParameter("id")
  if(url_id === "new") {
    $('#form-submit-publish').removeAttr("type").attr("type", "submit");
    $('#form-submit-draft').removeAttr("type").attr("type", "submit");
    return
  }

  let result;

  function success(response) {
    const {title, description, author, content} = response

    $("#form-header").html("Edit Post")
    $("#form-title").val(title)
    $("#form-description").val(description)
    $("#form-author").val(author)
    txtarea.setContent(content)
    $('#form-submit-publish').removeAttr("type").attr("type", "submit");
    $('#form-submit-draft').removeAttr("type").attr("type", "submit");
  }

  fetchPost(url_id, success)
}
