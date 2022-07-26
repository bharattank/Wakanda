<?php
/**
 * Register Meta Boxes
 * 
 * @package Wakanda
 */

namespace WAKANDA_THEME\inc;

use WAKANDA_THEME\Inc\Traits\Singleton;

class Meta_boxes {
    use Singleton;

    protected function __construct() {
        //Load class
        $this->setup_hooks();

    }

    protected function setup_hooks() {
        /**
         * Actions
         */
        add_action( 'add_meta_boxes', [ $this, 'add_custom_meta_box' ] );
        add_action( 'save_post', [ $this, 'save_post_meta_data' ] );
    }

    public function add_custom_meta_box() {
        $screens = [ 'post' ];
        foreach( $screens as $screen ) {
            add_meta_box(
                'hide-page-title',
                __( 'Hide Page Title', 'wakanda' ),
                [ $this, 'custom_meta_box_html' ],
                $screen,
                'side'
            );
        }
    }

    public function custom_meta_box_html( $post ) {
        $value = get_post_meta( $post->ID, 'hide_page_title', true );

        /**
         * Use nonce for verification
         */
        wp_nonce_field( plugin_basename( __FILE__ ), 'hide_title_meta_box_nonce_name' )
        ?>
        <label for="page-title-hide"><?php esc_html_e( 'Hide the Page Title', 'wakanda' ); ?></label>
        <select name="wakanda_title_hide_field" id="page-title-hide" class="postbox">
            <option value=""><?php esc_html_e( 'Select', 'wakanda' ); ?></option>
            <option value="yes" <?php selected( $value, 'yes' ) ?>>
                <?php esc_html_e( 'Yes', 'wakanda' ); ?>
            </option>
            <option value="no" <?php selected( $value, 'no' ) ?>>
                <?php esc_html_e( 'No', 'wakanda' ); ?>
            </option>
        </select>
        <?php
    }

    public function save_post_meta_data( $post_id ) {

        /**
         * When the post is  saved or updated we get $_POST availabel
         * Check if  the current user is authorized
         */
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        /**
         * Check if the  nonce  value we receive  is the same we created
         */
        if( ! isset ( $_POST[ 'hide_title_meta_box_nonce_name' ] ) ||
            ! wp_verify_nonce( $_POST[ 'hide_title_meta_box_nonce_name' ], plugin_basename( __FILE__ ) )
        ) {
            return;
        }

        if ( array_key_exists( 'wakanda_title_hide_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                'hide_page_title',
                $_POST['wakanda_title_hide_field']
            );
        }
    }

}