<?php

/*
Plugin Name: MP Subscribe Form 
Plugin URI:  https://petrov.net.ua/
Description: Subscribe Form
Author:      Mykhaylo Petrov
Author URI:  https://petrov.net.ua/
Version:     1.0
Text Domain: mp-subscribe-form
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MP_SUBSCRIBE_FORM', plugin_dir_path( __FILE__ ) );
define( 'MP_SUBSCRIBE_FORM_URL', plugin_dir_url( __FILE__ ) );


/**
 * Include CSS, JS
 */
if ( ! function_exists( 'mp_subscribe_form_scripts_styles' ) ) {
	function mp_subscribe_form_scripts_styles() {
		// Scripts
		wp_enqueue_script( 'mp-subscribe-form-script', MP_SUBSCRIBE_FORM_URL . 'assets/js/script.js', array( 'jquery' ), false, true );

		// Styles
		wp_enqueue_style( 'mp-subscribe-form-style', MP_SUBSCRIBE_FORM_URL . 'assets/css/style.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'mp_subscribe_form_scripts_styles' );

/**
 * Add translating possibility
 */
add_action( 'plugins_loaded', function() {
	load_plugin_textdomain( 'mp-subscribe-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});

require_once MP_SUBSCRIBE_FORM . '/includes/form.php';
require_once MP_SUBSCRIBE_FORM . '/includes/functions.php';