<?php


function getData() {
  global $wpdb;
  $prefix = $wpdb->prefix;

  $getData = $wpdb->get_results( 
    "SELECT id, post_id FROM ".$prefix.HMMSP_DATABASE_TABLE." WHERE post_id != ''"
  );

  return $getData;
}
?>