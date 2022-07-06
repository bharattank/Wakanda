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
        Assets::get_instance();
        Menus::get_instance();

        $this->setup_hooks();
    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action( 'after_setup_theme', [ $this, 'wakanda_theme_setup' ] );
    }

    public function wakanda_theme_setup() {
        /** Site Title **/
        add_theme_support( 'title-tag' );

        /** custom logo **/
        add_theme_support( 'custom-logo', [
            'header-text' => [ 'site-title', 'site-description' ],
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ] );

        /** custom Background **/
        add_theme_support( 'custom-background', [
            'default-color'      => '#fff',
            'default-image'      => '',
            'default-repeat'     => 'no-repeat',
        ] );

        /** Enable support for Post Thumbnails on posts and pages. **/
        add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

        /** Add theme support for selective refresh for widgets. **/
        add_theme_support( 'customize-selective-refresh-widgets' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

        add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

        /**
		 * Some blocks in Gutenberg like tables, quotes, separator benefit from structural styles (margin, padding, border etc…)*/
        add_theme_support( 'wp-block-styles' );

        /**
		 * Some blocks such as the image block have the possibility to define*/
        add_theme_support( 'align-wide' );

        /**
		 * Loads the editor styles in the Gutenberg editor.*/
        add_theme_support( 'editor-styles' );
    }
}