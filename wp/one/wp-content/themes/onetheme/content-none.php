<div class="row marg-xs-b0 marg-lg-b40">
    <div class="col-xs-12">
        <section class="wpc-search-box">
            <h3 class="search-box-title"><?php esc_html_e('Nothing Found', 'onetheme'); ?></h3>
            <p class="search-box-text"></p>
             <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf('%1$s <a href="%2$s">%3$s</a>.', esc_html__('Ready to publish your first post?', 'onetheme'), esc_url(admin_url('post-new.php')), esc_html__('Get started here', 'onetheme')); ?></p>

            <?php elseif ( is_search() ) : ?>
                <p><?php esc_html_e('No results found. Please adjust your search term and try again.', 'onetheme'); ?></p>
                <?php get_search_form(); ?>
                <?php else : ?>
                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'onetheme'); ?></p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </section>
    </div>
</div>
