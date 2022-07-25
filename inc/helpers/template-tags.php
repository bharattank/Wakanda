<?php
/**
 * Some Functions
 * 
 * @package wakanda
 */


 /**
  * Return post thumbnail
  */
 function get_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attribute = [] ) {
    $custom_thumbnail = '';

    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }

    if ( has_post_thumbnail( $post_id ) ) {
        $default_attributes = [
            'loading'   =>  'lazy'
        ];

        $attributes = array_merge( $additional_attribute, $default_attributes );

        $custom_thumbnail = wp_get_attachment_image (
            get_post_thumbnail_id( $post_id ),
            $size,
            false,
            $additional_attribute
        );
    }

    return $custom_thumbnail;
}

/**
  * Print post thumbnail
  */
function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attribute = [] ) {
    echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attribute );
}