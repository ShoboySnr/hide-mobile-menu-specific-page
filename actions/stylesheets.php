<?php

function hmmsp_admin_styles() {
  wp_enqueue_style( 'hmmsp-admin-css', plugins_url('hide-mobile-menu-specific-page/assets/css/admin.css'));
}

function hmmsp_frontend_scripts() {
  wp_enqueue_style( 'hmmsp-stylesheets', plugins_url('hide-mobile-menu-specific-page/assets/css/styles.php'));
}

add_action( 'wp_enqueue_scripts', 'hmmsp_frontend_scripts' );
add_action( 'admin_enqueue_scripts',  'hmmsp_admin_styles');

