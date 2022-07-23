<?php
/**
 * Theme Functions
 * 
 * @package Wakanda
 */

 if ( ! defined( 'WAKANDA_DIR_PATH' ) ) {
	define( 'WAKANDA_DIR_PATH', untrailingslashit( get_template_directory() ) );
 }

 if ( ! defined( 'WAKANDA_DIR_URI' ) ) {
	define( 'WAKANDA_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
 }

 require_once WAKANDA_DIR_PATH . '/inc/helpers/autoloader.php';
 require_once WAKANDA_DIR_PATH . '/inc/helpers/template-tags.php';

function wakanda_get_theme_instance() {
    \WAKANDA_THEME\Inc\WAKANDA_THEME::get_instance();
}
wakanda_get_theme_instance();