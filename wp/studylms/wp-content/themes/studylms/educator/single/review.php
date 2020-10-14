<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, '_apus_rating', true ) );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container media">
		<div class="apus-avatar pull-left">
			<div class="apus-image">
				<?php echo get_avatar( $comment, '50', '' ); ?>
			</div>
			
		</div>
		<div class="comment-text media-body">
			<div class="clearfix">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="meta pull-left"><span class="apus-author clear" itemprop="author"><?php comment_author(); ?></span> <em><?php esc_html_e( 'Your comment is awaiting approval', 'studylms' ); ?></em></p>
				<?php else : ?>
					<p class="meta pull-left">
						<span class="apus-author clear" itemprop="author"><?php comment_author(); ?></span>
						<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"> - <?php echo get_comment_date( 'M d,Y' ); ?></time>
					</p>
				<?php endif; ?>
				
					<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating pull-right" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'studylms' ), $rating ) ?>">
						<?php studylms_print_single_review($rating); ?>
					</div>
			</div>
			<div itemprop="description" class="description clear"><?php comment_text(); ?></div>
		</div>
	</div>
