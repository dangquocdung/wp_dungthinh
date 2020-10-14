<?php
	$author_id = $lecturer->ID;
	$author_info = get_the_author_meta( 'apus_edr_info', $author_id );
?>
<div class="apus-teacher-inner text-center style2">
	<div class="author-avatar">
		<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
			<?php echo get_avatar( $author_id, 390); ?>
		</a>
	</div>
	<div class="infor">
		<h3 class="name">
			<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
				<?php echo get_the_author_meta('display_name', $author_id ); ?>
			</a>
		</h3>
		<div class="socials">
			<?php if ( isset($author_info['facebook']) ): ?>
				<a href="<?php echo esc_url($author_info['facebook']); ?>" class="facebook"><i class="mn-icon-1405"></i></a>
			<?php endif; ?>
			<?php if ( isset($author_info['twitter']) ): ?>
				<a href="<?php echo esc_url($author_info['twitter']); ?>" class="fatwittercebook"><i class="mn-icon-1406"></i></a>
			<?php endif; ?>
			<?php if ( isset($author_info['google']) ): ?>
				<a href="<?php echo esc_url($author_info['google']); ?>" class="google"><i class="mn-icon-1409"></i></a>
			<?php endif; ?>
			<?php if ( isset($author_info['linkedin']) ): ?>
				<a href="<?php echo esc_url($author_info['linkedin']); ?>" class="linkedin"><i class="mn-icon-1408"></i></a>
			<?php endif; ?>
			<?php if ( isset($author_info['instagram']) ): ?>
				<a href="<?php echo esc_url($author_info['instagram']); ?>" class="instagram"><i class="mn-icon-1416"></i></a>
			<?php endif; ?>
			<?php if ( isset($author_info['youtube']) ): ?>
				<a href="<?php echo esc_url($author_info['youtube']); ?>" class="youtube"><i class="mn-icon-1407"></i></a>
			<?php endif; ?>
		</div>
	</div>
</div>