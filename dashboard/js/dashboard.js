$( document ).ready(() => {
  let publishedResults = ""
  let draftResults = ""

  $.ajax(
    {
      type: "GET",
      url: 'includes/post.inc.php',
      dataType: 'json',
      success: function(response){
        function formatPost({id, title, description, author, date_created}) {
          const date = new Date(date_created); 
          const formattedDate = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear()

          return `<tr>` +
                    `<td>` +
                      `<div class="d-flex">` +
                        `<div>` +
                          `<p class="fw-bold text-break mb-0">${title}</p>` +
                          `<p class="mb-1"><small>By ${author} &nbsp;·&nbsp; ${formattedDate}</small></p>` +
                          `<p class="text-muted text-break mb-0">${description}</p>` +
                        `</div>` +
                      `</div>` +
                    `</td>` +
                    `<td width="1%" style="white-space: nowrap">` +
                        `<form action="includes/post.inc.php?id=${id}" method="post">` +
                      `<div class="d-flex d-md-none flex-column">` +
                          `<a href="../../page?id=${id}">` +
                            `<button type="button" class="btn btn-primary rounded-pill mx-1">View</button>` +
                          `</a>` +
                          `<a href="../../../page/edit.php?id=${id}">` +
                            `<button type="button" class="btn btn-warning rounded-pill my-1">Edit</button>` +
                          `</a>` +
                          `<button type="button" class="btn btn-danger rounded-pill my-1">Delete</button>` + 
                      `</div>` +
                      `<div class="d-none d-md-block">` +
                          `<a href="../../page?id=${id}">` +
                            `<button type="button" class="btn btn-primary rounded-pill mx-1">View</button>` +
                          `</a>` +
                          `<a href="../../page/edit.php?id=${id}">` +
                            `<button type="button" class="btn btn-warning rounded-pill mx-1">Edit</button>` +
                          `</a>` +
                          `<button type="submit" name="submit-delete" class="btn btn-danger rounded-pill mx-1">Delete</button>` +
                      `</div>` +
                        `</form>` +
                    `</td>` +
                 `</tr>`
          }

        response.forEach(post => post?.published ? publishedResults += formatPost(post) : draftResults += formatPost(post))

        $("#published-post-list").html(publishedResults);
        $("#draft-post-list").html(draftResults);
      }
    }
  );


});

