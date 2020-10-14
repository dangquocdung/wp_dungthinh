<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Digitech_Theme
 * @since Digitech 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $digitech_opt = get_option( 'digitech_opt' ); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper <?php if($digitech_opt['page_layout']=='box'){echo 'box-layout';}?>">
	<div class="page-wrapper">
		<?php if(isset($digitech_opt['header_layout']) && $digitech_opt['header_layout']!=''){
			$header_class = str_replace(' ', '-', strtolower($digitech_opt['header_layout']));
		} else {
			$header_class = '';
		} 
		if( (class_exists('RevSliderFront')) && is_front_page() && has_shortcode( $post->post_content, 'rev_slider_vc') ) {
			$hasSlider_class = 'rs-active';
		} else {
			$hasSlider_class = '';
		}
		?>
		<div class="header-container <?php echo esc_html($header_class)." ".esc_html($hasSlider_class) ?> <?php if(isset($digitech_opt['page_banner']['url']) && ($digitech_opt['page_banner']['url'])!=''){ echo 'has-page-banner'; } ?>">
			<div class="header">
				<div class="header-content">
					<?php
					if ( isset($digitech_opt['header_layout']) && $digitech_opt['header_layout']!="") {
						$jscomposer_templates_args = array(
							'orderby'          => 'title',
							'order'            => 'ASC',
							'post_type'        => 'templatera',
							'post_status'      => 'publish',
							'posts_per_page'   => 30,
						);
						$jscomposer_templates = get_posts( $jscomposer_templates_args );

						if(count($jscomposer_templates) > 0) {
							foreach($jscomposer_templates as $jscomposer_template){
								if($jscomposer_template->post_title == $digitech_opt['header_layout']){
									echo do_shortcode($jscomposer_template->post_content);
								}
							}
						}
					} else {
						?>
						<div class="header-default">
							<div class="container">
								<div class="logo-wrapper">
									<div class="row">
										<div class="col-12 col-xl-4">
											<?php if( isset($digitech_opt['logo_main']['url']) && $digitech_opt['logo_main']['url']!=''){ ?>
												<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url($digitech_opt['logo_main']['url']); ?>" alt=" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?> " /></a></div>
											<?php
											} else { ?>
												<h1 class="logo site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php
											} ?>
										</div>
										<div class="col-12 col-xl-8">
											<div class="nav-container">
												<?php if ( has_nav_menu( 'primary' ) ) : ?>
													<div class="horizontal-menu visible-large">
														<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
													</div>
												<?php endif; ?>
											</div> 
										</div>
									</div>
									<?php if ( has_nav_menu( 'mobilemenu' ) ) : ?>
										<div class="visible-small mobile-menu"> 
											<div class="mbmenu-toggler"><?php echo esc_html($digitech_opt['mobile_menu_label']);?><span class="mbmenu-icon"><i class="fa fa-bars"></i></span></div>
											<div class="clearfix"></div>
											<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
										</div>
									<?php endif; ?>
									
								</div>
								<div class="row">
									<div class="col-xl-3 d-none d-xl-block">
										<div class="categories-menu-wrapper">
											<div class="categories-menu-inner">
												<div class="categories-menu visible-large">
													<div class="catemenu-toggler"><span><?php if(isset($digitech_opt['categories_menu_label'])) { echo esc_html($digitech_opt['categories_menu_label']); } else { esc_html_e('ALL CATEGORIES', 'digitech'); } ?></span></div>
													<div class="catemenu">
														<div class="catemenu-inner">
															<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'categories-menu' ) ); ?>
															<div class="morelesscate">
																<span class="morecate"><i class="fa fa-plus"></i><?php if ( isset($digitech_opt['categories_more_label']) && $digitech_opt['categories_more_label']!='' ) { echo esc_html($digitech_opt['categories_more_label']); } else { esc_html_e('More Categories', 'digitech'); } ?></span>
																<span class="lesscate"><i class="fa fa-minus"></i><?php if ( isset($digitech_opt['categories_less_label']) && $digitech_opt['categories_less_label']!='' ) { echo esc_html($digitech_opt['categories_less_label']); } else { esc_html_e('Close Menu', 'digitech'); } ?></span>
															</div>
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-12 col-xl-9">
										<div class="header-search">
											<?php get_search_form(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					} 
					?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>