<div class="wpc-navigation">
    <nav>
       <?php
            wp_nav_menu( array(
                'menu_class'        => 'main-menu',
                'theme_location'    => 'primary',
                'container'         => '',
                'fallback_cb'       => 'onetheme_primary_callback'
            ) );
        ?>
        <?php if(TT::get_mod('search_btn') == 1) { ?>
            <a href="#search" class="search-btn fa fa-search"></a>
        <?php } ?>
        <div class="nav-menu-icon"><i>&nbsp;</i></div>
    </nav>
</div>
