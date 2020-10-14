<?php
// Get Categories for posts.
$categories_list = get_the_category_list( ', ' );

if ( empty( $categories_list ) ) {
	return;
}
?>
<ul class="entry-meta">
	<li class="meta-author">
		<i class="far fa-user"></i>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
			<?php the_author() ?>
		</a>
	</li>
	<li class="meta-date">
		<i class="far fa-calendar"></i>
		<a href="<?php echo esc_url( get_permalink() ) ?>"><?php echo get_the_time( get_option( 'date_format' ) ) ?></a>
	</li>
	<?php if (is_singular() && (comments_open() || get_comments_number())): ?>
		<li class="meta-comment">
			<i class="far fa-comment"></i>
			<?php comments_popup_link(esc_html__('0 Comments','crown'), esc_html__('1 Comment','crown'), esc_html__('% Comments','crown')) ?>
		</li>
	<?php endif; ?>
	<li class="meta-cate">
		<i class="far fa-folder"></i>
		<?php echo wp_kses_post( $categories_list ) ?>
	</li>
</ul>