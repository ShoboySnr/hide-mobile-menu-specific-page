<?php 
include_once('insert.php');

function add_mobile_menu_specific_pages_meta_box() {
  add_meta_box(
    'hide_mobile_menu_specific_pages',
    'Hide Mobile Menu',
    'show_mobile_menu_meta_box',
    ['page', 'post'],
    'normal',
    'high'
  );
}
add_action( 'add_meta_boxes', 'add_mobile_menu_specific_pages_meta_box' );

function show_mobile_menu_meta_box() {
  global $post;
  $meta = get_post_meta( $post->ID, 'mobile_menu_specific_fields', true );
  ?>
  <div id="hmmsp-mobile_menu">
    <input type="hidden" name="mobile_menu_specific_pages_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
    <div class="field">
      <label for="mobile_menu_specific_fields[show_mobile_menu]">Hide Mobile Menu for this Page?</label>
        <input id="mobile_menu_specific_fields[show_mobile_menu]" type="checkbox" name="mobile_menu_specific_fields[show_mobile_menu]" value="checked" <?php if (isset($meta['show_mobile_menu']) && $meta['show_mobile_menu'] === 'checked' ) echo 'checked'; ?>>
    </div>
  </div>
  <?php
}

function save_mobile_menu_specific_pages_meta( $post_id ) {
  if (isset($_POST['mobile_menu_specific_pages_nonce']) && !wp_verify_nonce( $_POST['mobile_menu_specific_pages_nonce'], basename(__FILE__) ) ) {
    return $post_id;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }

  if (isset($_POST['post_type']) && 'page' === $_POST['post_type']) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
      return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
    }
  }

  $new = '';
  $old = get_post_meta( $post_id, 'mobile_menu_specific_fields', true );
  if (isset($_POST['mobile_menu_specific_fields'])) {
    $new = $_POST['mobile_menu_specific_fields'];
  }

  if ($new && $new !== $old ) {
    saveData($post_id);
    update_post_meta( $post_id, 'mobile_menu_specific_fields', $new );
  } elseif ( '' === $new && $old ) {
    deleteData($post_id);
    delete_post_meta( $post_id, 'mobile_menu_specific_fields', $old );
  }
}

add_action( 'save_post', 'save_mobile_menu_specific_pages_meta' );