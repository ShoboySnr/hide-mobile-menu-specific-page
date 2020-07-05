<?php

function saveData($post_id) {
  global $wpdb;

  $prefix = $wpdb->prefix;
  //check if the post, pages or categories has been added before
  $getData = $wpdb->get_row( 
    "SELECT post_id FROM ".$prefix.HMMSP_DATABASE_TABLE." WHERE post_id = $post_id LIMIT 1"
  );

  if ($getData) {
    if($wpdb->update(
      $prefix.HMMSP_DATABASE_TABLE, 
      array( 
        'post_id' => $post_id,
      ),
      array(
        'post_id' => $post_id
      )) === FALSE) {
        return false;
      }
      else {
       return true;
      }
  }
  else {
    $wpdb->insert( 
      $prefix.HMMSP_DATABASE_TABLE, 
      array( 
        'post_id' => $post_id,
      )
    );
  
    if ($wpdb->insert_id > 0) {
     return true;
    }
    else {
      return false;
    }
  }
}

function deleteData($post_id) {
  global $wpdb;

  $prefix = $wpdb->prefix;

  $delete = $wpdb->delete(
    $prefix.HMMSP_DATABASE_TABLE, 
    array( 'post_id' => $post_id ), 
    array( '%d' ) 
  );

  if ($delete > 0) {
    return true;
  }
  else {
   return false;
  }
}
?>