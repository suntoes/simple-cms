import {getUrlParameter, fetchPost, formatDate} from './function.js'

function getMinuteRead(str) {
  const minute = Math.ceil(str.length / 1645)
  return minute + " min read"
}

function success(response) {
    const {title, description, author, content, date_created} = response

    const result = `<h2 class="post-title">${title}</h2>` +
                   `<p class="post-meta">${formatDate(date_created)} &nbsp;·&nbsp; ${author} &nbsp;·&nbsp; ${getMinuteRead(title+description+content)}</p>` +
                   `<p>${description}</p>` +
                   `<hr>` +
                   `${content}`

    $("#post-container").html(result);
}

const id = getUrlParameter("id");
fetchPost(id, success)
