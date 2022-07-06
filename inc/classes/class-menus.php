<?php
/**
 * Register Menus
 * 
 * @package Wakanda
 */

namespace WAKANDA_THEME\inc;

use WAKANDA_THEME\Inc\Traits\Singleton;

class Menus {
    use Singleton;

    protected function __construct() {
        //Load class
        $this->setup_hooks();

    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action( 'init', [ $this, 'wakanda_register_menus' ] );
    }

    public function wakanda_register_menus() {
        register_nav_menus([
            'wakanda-header_menu' => esc_html__( 'Header Menu', 'wakanda' ),
            'wakanda-footer_menu'  => esc_html__( 'Footer Menu', 'wakanda' ),
        ]);
    }

    public function get_menu_id( $location ) {
        /** Get all the locations. */
        $locations = get_nav_menu_locations();

        /** Get object id by location. */
        $menu_id = $locations[ $location ];

        return ! empty( $menu_id ) ? $menu_id : '';
    }

    public function get_child_menu_items( $menu_array, $parent_id ) {
        $child_menus = [];

        if ( !empty( $menu_array ) && is_array( $menu_array ) ) {
            foreach( $menu_array as $menu ) {
                if ( intval( $menu->menu_item_parent ) === $parent_id ) {
                    array_push( $child_menus, $menu );  
                }
            }
        }

        return $child_menus;
    }
}