<?php 
/**
 * Plugin Name: Hide Mobile Menu on Specific Pages
 * Plugin URI: https://www.gigalagosdigital.com
 * Description: This plugin hides the mobile menu on specific pages the admin choose to.
 * Version: 1.0.0
 * Author:  Giga Lagos Digital
 * Author URI: https://www.gigalagosdigital.com
 * License: GPL2
 */

if ( !defined( 'WP_CONTENT_URL' ) ) {
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
}
if ( !defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}
if ( !defined( 'WP_PLUGIN_URL' ) ) {
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
}
if ( !defined( 'WP_PLUGIN_DIR' ) ) {
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}
if ( !defined( 'HMMSP_NAME' ) ) {
	define( 'HMMSP_NAME', 'hide-mobile-menu-specific-page' );
}
if ( !defined( 'HMMSP_PLUGIN_DIR' ) ) {
	define( 'HMMSP_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . HMMSP_NAME );
}
if ( !defined( 'HMMSP_PLUGIN_URL' ) ) {
	define( 'HMMSP_PLUGIN_URL', WP_PLUGIN_URL . '/' . HMMSP_NAME );
}
if ( !defined( 'HMMSP_MAIN_FILE_PATH' ) ) {
	define( 'HMMSP_MAIN_FILE_PATH', __FILE__ );
}
if ( !defined( 'HMMSP_DATABASE_TABLE' ) ) {
	define( 'HMMSP_DATABASE_TABLE', 'hide_mobile_menu_pages' );
}

require_once(ABSPATH.'/wp-load.php');
include_once(HMMSP_PLUGIN_DIR . '/actions/fields.php');
include_once(HMMSP_PLUGIN_DIR . '/actions/stylesheets.php');

global $hide_mobile_menu_db_version;
$hide_mobile_menu_db_version = '1.0';

function hide_mobile_menu_install() {
	global $wpdb;
	global $hide_mobile_menu_db_version;

	$table_name = $wpdb->prefix . HMMSP_DATABASE_TABLE;
	
  $charset_collate = $wpdb->get_charset_collate();
  
  if ( $wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name) {
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
      post_id text NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'hide_mobile_menu_db_version', $hide_mobile_menu_db_version );
  }
}

register_activation_hook( __FILE__, 'hide_mobile_menu_install' );

