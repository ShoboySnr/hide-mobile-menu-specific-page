<?php

header('Content-type: text/css');

include('style-data.php');

foreach ($getData as $data) {
  $page_id = $data->post_id;
  
  if ($page_id !== null) {
?>

.page-id-<?= $page_id ?> #header #mainnav-mobi,
.postid-<?= $page_id ?> #header #mainnav-mobi,
.page-id-<?= $page_id ?> .header-wrap .btn-menu,
.postid-<?= $page_id ?> .header-wrap .btn-menu,
.page-id-<?= $page_id ?> .header-titles-wrapper .mobile-nav-toggle,
.postid-<?= $page_id ?> .header-titles-wrapper .mobile-nav-toggle {
  display: none !important;
}

<?php 
  }
}