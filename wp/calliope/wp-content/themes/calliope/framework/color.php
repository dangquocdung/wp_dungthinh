<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $theme_option; 
?>
/* Color Theme - Amethyst /Violet/

color - <?php echo esc_attr( $theme_option['main-color'] ); ?>

/* 01 MAIN STYLES
****************************************************************************************************/

/**** Custom logo ****/
<?php if($theme_option['logo_width']) { ?>
.logo{        
  width: <?php echo esc_attr($theme_option['logo_width']); ?>;
  height: <?php echo esc_attr($theme_option['logo_height']); ?>;
  margin: auto;    
}
<?php } ?>

/**** Main Color ****/

a, .blog-wrap h6 a:hover, .blog-tag a:hover, .pagination li a:hover, .pagination li span,
.blog-post-sublinks a, .sidebar-wrapper li a:hover, .sidebar-wrapper .link-tag:hover,
.blog-wrap .sticky p, .widget_calendar td a, .logged-in-as a,
.con-info .con-icon, .small-text, .effect-btn a, .services-offer .services-icon,
.icon-left1, .team-social li.icon-team a, .team-social1 li.icon-team1 a,
.testi-wrap h6 small, .link-blog a:hover, #filter li .current, ul.slimmenu li.selected > a,
.content-404 h1, ul.slimmenu li.current-menu-item a{
	color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

.blog-tag a:hover, .pagination li a:hover, .pagination li span,
li.selected{
  border-color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

ul.dot-nav-wrap li, .bar-prc4, .cl-effect-10 a::before {
	background-color: <?php echo esc_attr( $theme_option['main-color'] ); ?>;
}

.footer{
  background-color: <?php echo esc_attr( $theme_option['background_footer'] ); ?>;
  color: <?php echo esc_attr( $theme_option['color_footer'] ); ?>;
}
.footer p{
  color: <?php echo esc_attr( $theme_option['color_footer'] ); ?>;
}
.background-blog-head{
  background-image: url(<?php echo esc_attr( $theme_option['bg_blog']['url'] ); ?>);
}
