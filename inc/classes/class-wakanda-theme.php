<?php
/**
 * Bootstrap the Theme
 * 
 * @package Wakanda
 */

namespace WAKANDA_THEME\inc;

use WAKANDA_THEME\Inc\Traits\Singleton;

class WAKANDA_THEME {
    use Singleton;

    protected function __construct() {
        //Load class
        $this->setup_hooks();

    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );

    }

    public function register_styles() {
        // Register Styles
        wp_register_style( 'stylesheet', get_stylesheet_uri(), [], filemtime( WAKANDA_DIR_PATH . '/style.css' ), 'all' );
        wp_register_style( 'bootstrap-css', WAKANDA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all' );

        // Enqueue Styles
        wp_enqueue_style( 'stylesheet' );
        wp_enqueue_style( 'bootstrap-css' );
    }

    public function register_scripts() {
         // Register Scripts
        wp_register_script( 'main-js', WAKANDA_DIR_URI . '/assets/main.js', [], filemtime( WAKANDA_DIR_PATH . '/assets/main.js' ), true );
        wp_register_script( 'bootstrap-js', WAKANDA_DIR_URI . '/assets/src/library/js/bootstrap.bundle.min.js', ['jquery'], false, true );

        // Enqueue Scripts
        wp_enqueue_script( 'main-js' );
        wp_enqueue_script( 'bootstrap-js' );
    }
}