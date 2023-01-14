## Simple CMS task
***

A basic CMS that allow users to create posts from an admin dashboard and display it on the public facing side of the app/website.

<br />
<br />

***
## Site explanation:
***

HOME (/index.php):

* Overview of summary of every posts with image thumbnail if available.

PAGE (/page/index.php):

* Login and registration for this page with different validations. 

DASHBOARD (/dashboard/index.php):

* User only page for posts content CRUD management.

<br />
<br />

***
## SQL DB Concept
***


| Tables in simplecms      | Content                                                                                           |
| ------------------------ | --------------------------------------------------------------------------------------------------|
| users                    | Contains all user DB with hashed passwords, user privilege, and date creation                     |
| posts                    | Information storage for post including ID of web contributor                                      |
| posts_image              | Includes all images path uploaded for posts with post ID                                          |

***
## PHP Concept
***


| Items in /               | Content                                                                                           |
| ------------------------ | --------------------------------------------------------------------------------------------------|
| index.php                | Main page                                                                                         |
| header.php               | Includes dynamic navigation bar for both public and registered user                               |
| simplecms.sql            | Contains initial code to setup database for this app                                              |
| js/main.js               | Jquery and Ajax implementation for infinite scrolling and viewing of post                         |
| includes/dbh.inc.php     | Main DB connection file also used by other components                                             |
| includes/post.inc.php    | Api handler used by `js/main.js` for infinite scrolling                                           |

| Items in /page           | Content                                                                                           |
| ------------------------ | --------------------------------------------------------------------------------------------------|
| index.php                | Detailed view page of post requiring an id URL parameter                                          |
| edit.php                 | Post editor integrated with tinyMCE for users only                                                |
| js/main.js               | Jquery and Ajax implementation for obtaining and viewing existing post data                       |
| js/tinymce.js            | Includes tinyMCE configuration and image handling functions                                       |
| includes/upload.inc.php  | Api handler used by `js/tinymce.js` for tinyMCE image uploads                                     | 
| includes/post.inc.php    | Api handler for post editor data view and submission                                              |

| Items in /dashboard      | Content                                                                                           |
| ------------------------ | --------------------------------------------------------------------------------------------------|
| index.php                | Dashboard page of post for users with CRUD options                                                |
| js/main.js               | Jquery and Ajax implementation for obtaining and viewing existing post data                       |
| includes/post.inc.php    | Api handler for post dashboard data view and deletion of post                                     |

