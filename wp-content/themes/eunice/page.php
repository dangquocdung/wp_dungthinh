<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: https://victorthemes.com
 */

// Metabox
global $post;
$eunice_id    = ( isset( $post ) ) ? $post->ID : 0;
$eunice_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $eunice_id;
$eunice_id    = ( eunice_is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $eunice_id;
$eunice_meta  = get_post_meta( $eunice_id, 'page_type_metabox', true );
$page_name = $post->post_name;
// Banner Type - Meta Box
if($eunice_meta){
	$eunice_banner_type = $eunice_meta['banner_type'];
	$page_title_align = $eunice_meta['page_title_align'];
	$space_top = str_replace('px', '', $eunice_meta['page_top_space']) ;
	$space_top = $space_top;

	$inner_space = str_replace('px', '', $eunice_meta['banner_content_space']) ;
	$inner_space = $inner_space;
} else {
	$page_title_align = '';
	$eunice_banner_type = '';
	$space_top = '';
	$inner_space = '';
}

// Page Layout Options
$eunice_page_layout_meta = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ($eunice_meta && $eunice_page_layout_meta) {
	$eunice_page_layout = $eunice_page_layout_meta['page_layout'];
	if ($eunice_page_layout === 'extra-width') {
		$fullwidth_class = 'fullwidth_page';
		$container_class = 'container-width-1130 entry-content';
	} elseif($eunice_page_layout === 'left-sidebar') {
		$fullwidth_class = 'fullwidth_page';
		$container_class = 'entry-content';
	} elseif ($eunice_page_layout === 'right-sidebar') {
		$fullwidth_class = 'fullwidth_page';
		$container_class = 'entry-content';
	} else {
		$fullwidth_class = 'container container-width-1170';
		$container_class = 'container-width-750 entry-content';
	}
} else {
	$eunice_page_layout = '';
	$fullwidth_class = 'container container-width-1170';
	$container_class = 'container-width-750 entry-content';
}
get_header(); ?>
<div class="main-content-area">
	<div class="content-warp">
<?php while ( have_posts() ) : the_post();
if ( ! post_password_required() ) { ?>
	<div <?php echo esc_attr(post_class()); ?>>
	<div class="single-page single-page-two-warp">
		<div class="<?php echo esc_attr($fullwidth_class); ?> no-padding" style="padding-top:<?php echo esc_attr($space_top); ?>;">
			<?php if( $eunice_banner_type === 'revolution-slider') { ?>
				<div class="full-width-banner" style="padding-bottom:<?php echo esc_attr($inner_space); ?>;">
				<?php echo esc_attr(do_shortcode($eunice_meta['page_revslider'])); ?>
				</div>
			<?php } else { ?>
			<?php if( has_post_thumbnail() &&  $eunice_banner_type != 'hide-title-area' ){ ?>
				<div class="full-width-banner" style="padding-bottom:<?php echo esc_attr($inner_space); ?>;">
					<?php the_post_thumbnail('full'); ?>
				</div>
			<?php }
		}

		// Div Open
		if ($eunice_meta && $eunice_page_layout) {
			$eunice_page_layout = $eunice_page_layout_meta['page_layout'];
			if ($eunice_page_layout === 'extra-width') {
				echo '';
			} elseif($eunice_page_layout === 'left-sidebar') {
				echo '<div class="fix container with-left-sidebar page-template">';
			} elseif ($eunice_page_layout === 'right-sidebar') {
				echo '<div class="fix container with-right-sidebar page-template">';
			} else {
				echo '';
			}
		} else {
			echo '';
		}
		// Div Open End

		if ($eunice_page_layout == 'left-sidebar') {
			get_sidebar();
		}
		?>
		<div class="entry-content-warp entry-content-text <?php echo esc_attr($page_name); ?>">
			<div class="<?php echo esc_attr($container_class); ?>">
				<div class="single-post-page-strandard single-post-page  entry-content">
					<?php if( $eunice_banner_type != 'hide-title-area' ) { ?>
						<h2 class="<?php echo esc_attr($page_title_align); ?>"><?php echo eunice_title_area(); ?></h2>
					<?php }
						the_content();
					?>
				</div>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			$eunice_theme_page_comments = cs_get_option('theme_page_comments');
			if ( $eunice_theme_page_comments && (comments_open() || get_comments_number()) ) : ?>
				<div class="page-comment">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>

			</div>
		</div>
		<?php
		if ($eunice_page_layout == 'right-sidebar') {
			get_sidebar();
		}

		// Div Close
		if ($eunice_meta && $eunice_page_layout) {
			if ($eunice_page_layout === 'extra-width') {
				echo '';
			} elseif($eunice_page_layout === 'left-sidebar') {
				echo '</div>';
			} elseif ($eunice_page_layout === 'right-sidebar') {
				echo '</div>';
			} else {
				echo '';
			}
		} else {
			echo '';
		}
		// Div Close End

		?>
		</div><!-- Content Area -->
	</div><!-- Content Area -->
	</div> <!-- Post Class -->

	<?php } else { the_content(); } endwhile; // End of the loop. ?>

	</div>
</div>

<?php
get_footer();
