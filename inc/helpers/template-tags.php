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

/**
 * Posted on date
 */
function wakanda_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    // Post is modified ( When post published time is not equal to post modified time )
    if( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_attr( get_the_date() ),
        esc_attr( get_the_modified_date( DATE_W3C ) ),
        esc_attr( get_the_modified_date() )
    );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'wakanda' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel"bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}

/**
 * Posted By
 */
function wakanda_posted_by() {
    $byline = sprintf(
        esc_html_x( ' by %s', 'post author', 'wakanda' ),
        '<span class="author vcard"><a href="' . esc_url( get_permalink( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );

    echo '<span class="byline text-secondary">' . $byline . '</span>';
}