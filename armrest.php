<?php

/**
 * @package Arm Rest
 * @version 0.1
 */
/*
Plugin Name: Arm Rest
Description: ปลั๊กอินสำหรับจัดการบทความผ่าน Shortcode
Author: อาร์มซ่าาา
Version: 0.1
*/

/**
 * Enqueue script and style
 */
function armrest_enqueue_script() {
	wp_register_script( 'angularjs', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js', array(), false, true );
	wp_register_script( 'angularjs-ui-router', 'http://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js', array(), false, true );
	wp_register_script( 'armrest-script', plugins_url('script.js', __FILE__), array('angularjs', 'angularjs-ui-router'), false, true );
		
	wp_localize_script('armrest-script', 'restApiPostPluginLocalize', array(
		'template_url' => plugins_url('', __FILE__) . '/template/',
		'root' => esc_url_raw( rest_url() ),
		'wprest_nonce' => wp_create_nonce( 'wp_rest' )
	));
}
add_action( 'wp_enqueue_scripts', 'armrest_enqueue_script' );


/**
 * Register Shortcode
 */
function armrest_shortcode() {
	add_shortcode('arm-rest', 'armrest_shortcode_func');
}
add_action('init', 'armrest_shortcode');


/**
 * Handle Shortcode
 */
function armrest_shortcode_func() {	
	wp_enqueue_script('armrest-script');
	ob_start();
	require_once __DIR__ . '/template/main.php';
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}