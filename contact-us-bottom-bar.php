<?php
/**
 * Plugin Name: Contact Us Bottom Bar
 * Plugin URI: https://dangminhhai.net
 * Description: Plugin hiển thị số hotline, facebook messenger, zalo và google map
 * Version: 1.0.2
 * Author: HaiDM
 * Author URI: https://www.facebook.com/minhhai0106
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

add_action( 'wp_enqueue_scripts', 'contact_us_scripts_and_styles' );
function contact_us_scripts_and_styles() {
    wp_enqueue_style( 'contact-us-css', plugin_dir_url( __FILE__ ) . '/css/contact-us.css', array(), '2.0.0' );
}

require_once( plugin_dir_path( __FILE__ ) . 'settings.php' );
