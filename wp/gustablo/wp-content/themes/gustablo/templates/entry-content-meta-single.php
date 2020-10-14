<?php
/**
 * Entry Content / Meta
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! wprt_get_mod( 'blog_single_meta', true ) )
	return;

?>
<div class="post-meta style-1">
	<div class="post-meta-content">
		<div class="post-meta-content-inner">
		<?php
		$meta_item = array( 'date', 'author', 'comments', 'categories' );

		// Loop through items
		foreach ( $meta_item as $item ) :
			if ( 'author' == $item ) { 
				printf( '<span class="post-by-author item"><span class="inner">%4$s <a href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( esc_html__( 'View all posts by %s', 'gustablo' ), get_the_author() ) ),
					get_the_author(),
					esc_html__('By', 'gustablo')
					);
			}
			elseif ( 'date' == $item ) {
				printf( '<span class="post-date item"><span class="inner"><span class="entry-date">%1$s</span></span></span>',
					get_the_date()
				);
			}
			elseif ( 'comments' == $item ) {
				if ( comments_open() || get_comments_number() ) {
					echo '<span class="post-comment item"><span class="inner">';
					comments_popup_link( esc_html__( '0 comment', 'gustablo' ), esc_html__( '1 Comment', 'gustablo' ), esc_html__( '% Comments', 'gustablo' ) );
					echo '</span></span>';
				}
			}
			elseif ( 'categories' == $item ) {
				echo '<span class="post-meta-categories item"><span class="inner">';
				the_category( ', ', get_the_ID() );
				echo '</span></span>';
			}
		endforeach;
		?>
		</div>
	</div>
</div>


