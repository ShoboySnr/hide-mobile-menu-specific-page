<?php 
require_once('../../../../../wp-load.php');

global $wpdb;

$prefix = $wpdb->prefix;

$getData = $wpdb->get_results( 
  "SELECT post_id
  FROM ".$prefix.HMMSP_DATABASE_TABLE." WHERE post_id != ''"
);