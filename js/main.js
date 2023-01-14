import {getUrlVars} from "./functions.js"

$(document).ready(() => preparePage())

function preparePage() {
  const keyword = getUrlVars()?.keyword || ""
  $("#search-keyword").val(keyword)

  let page_num = 1
  load_page(page_num, keyword, false)

  function scrollHandler() {
    const triggerOffset = 100

    if($(window).scrollTop() + $(window).height() > $(document).height() - triggerOffset) {
      page_num++ 
      load_page(page_num, keyword, false)
    }
  }

  $(window).off("scroll", scrollHandler)
  $(window).scroll(scrollHandler)
}

function load_page(page_num, keyword = "", loading) {
  if(loading == false) {
    loading = true
    $.ajax({
      type: "POST",
      url: "includes/post.inc.php",
      data: {
        page_num: page_num, 
        keyword: keyword
      },
      beforeSend: () => {
        $("#ajax-loader").show()
        return
      }
    }).done(response => {
      $("#ajax-loader").hide()
      loading = false

      const data = JSON.parse(response)

      if(data?.length) {

        if(page_num === 1) {
          const featured = data.shift()
          loadFeatured(featured)
        }

        data.forEach(post => loadPost(post))
      }

      if ($('#featured-post').is(':empty')) {
        $("#featured-post").html("It seems empty here...")
      }
    }).fail(() => {
      $("#ajax-loader").hide()
    })
  }
}

function loadFeatured(post) {
  $("#featured-post").html(formatFeaturedPost(post))
}

function loadPost(post) {
  $("#post-list").append(formatPost(post))
}

function clearPage() {
  $("#featured-post").empty()
  $("#post-list").empty()
}

function randomBootstrapColor() {
  const colors = ['primary', 'success', 'danger', 'warning', 'info']
  return colors[Math.floor(Math.random() * colors.length)]
}

function getMinuteRead(str) {
  const minute = Math.ceil(str.length / 1645)
  return minute + " min read"
}

function formatPost({id, title, author, description, content, thumbnail, date_created}) {
  const date = new Date(date_created); 
  const formattedDate = ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear()

  return  `<div class="col-md-6">` +
            `<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">` +
              `<div class="col p-4 d-flex flex-column position-static text-break">` +
                `<h3 class="mb-0">${title}</h3>` +
                `<div class="mb-1 text-muted">` +
                  `${formattedDate}` +
                  `&nbsp;·&nbsp;<strong class="d-inline-block mb-2">${author}</strong>` +
                  `&nbsp;·&nbsp;${getMinuteRead(title + author + description + content)}` +
                `</div>` +
                `<p class="mb-auto">${description}</p>` +
                `<a href="page?id=${id}" class="stretched-link">Continue reading</a>` +
              `</div>` +
              `<div style="${thumbnail ? "background-image: url('page/includes/" + thumbnail + "');" : ""} background-size: cover; background-position: center; background-color: var(--bs-body-color); width: 200px; height: 250px;" class="col-auto d-none d-lg-block">` +
              `</div>` +
            `</div>` +
          `</div>`
}

function formatFeaturedPost({id, title, description, thumbnail}) {
  return  `<div class="p-4 p-md-5 mb-4 rounded text-white">` +
            `<div class="col-md-6 px-0 text-break">` +
              `<h1 class="display-4 fst-italic">${title}</h1>` +
              `<p class="lead my-3">${description}</p>` +
              `<p id="post-${id}-actions" class="lead mb-0">` +
                `<a href="page?id=${id}" class="text-white fw-bold">Continue reading...</a>` +
              `</p>` +
            `</div>` +
          `</div>` +
          `<style>` +
            `#featured-post {` +
              `position: relative;` +
            `}` +
            `#featured-post::before {` +
              `content: "";` +
              `position: absolute;` +
              `left: 0;` +
              `right: 0;` +
              `top: 0;` +
              `z-index: -1;` +
              `display: block;` +
              `background-color: RGBA(33,37,41,var(--bs-bg-opacity,1)) !important;` +
              (thumbnail ? `background-image: url('page/includes/${thumbnail}');` : "") +
              `background-size: cover;` +
              `background-position: center` +
              `width: 100%;` +
              `height: 100%;` +
              `filter: brightness(0.4);` +
            `}` +
          `</style>`
}
