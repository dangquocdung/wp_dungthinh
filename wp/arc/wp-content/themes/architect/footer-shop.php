<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package architect
 */
global $architect_option; ?>
    <!-- Footer --> 
    <footer class="footer-v4 shop bg-dark">
        <?php if(isset($architect_option['footer-select-pages-2']) and $architect_option['footer-select-pages-2'] != "" ){              
            $about_id = $architect_option['footer-select-pages-2'];
            $about_page = get_post($about_id);
            echo do_shortcode( $about_page->post_content ); 
        } ?>
    </footer>
</div>
    <!-- End Footer -->

    <section class="copyright">
        <?php echo wp_kses( $architect_option['footer_text'], wp_kses_allowed_html('post') ); ?>
    </section>
<!-- End page -->
<a id="to-the-top"><i class="fa fa-angle-up"></i></a> 
<?php wp_footer(); ?>

</body>
</html>
