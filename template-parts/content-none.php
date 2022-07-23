<?php
/**
 * The template part for displaying  a message that posts cannot be found.
 * 
 * @package wakanda
 */
?>
<section class="no-result no-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'wakanda' ); ?></h1>
    </header>

    <div class="page-content">
        <?php
            if ( is_home() && current_user_can('publish') ) {
                ?>
                    <p>
                        <?php
                            printf( 
                                wp_kses(
                                    __( 'Ready to publish your first post? <a href="%s">Get started here</a>', 'wakanda' ),
                                    [
                                        'a' =>  [
                                            'href'  =>  []
                                        ]
                                    ]
                                ),
                                esc_url( admin_url( 'post-new.php' ) )
                            )
                        ?>
                    </p>
                <?php
            } elseif ( is_search() ) {
                ?>
                <p><?php esc_html_e( 'Sorry but nothing matched search item. Please try again some different keywords', 'wakanda' ) ?></p>
                <?php
                get_search_form();
            } else {
                ?>
                <p><?php esc_html_e( 'Its seem that we can not find what you are looking for. Perhaps search can help.', 'wakanda' ) ?></p>
                <?php
                get_search_form();
            }
        ?>
    </div>
</section>