<?php global $architect_option; ?>
<footer class="footer-v2 bg-dark">
    <?php if(isset($architect_option['footer-select-pages']) and $architect_option['footer-select-pages'] != "" ){              
        $about_id = $architect_option['footer-select-pages'];
        $about_page = get_post($about_id);
        echo do_shortcode( $about_page->post_content ); 
    } ?>
</footer>