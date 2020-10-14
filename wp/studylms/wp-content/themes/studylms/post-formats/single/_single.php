<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if ( $post_format == 'gallery' ) {
        $gallery = studylms_post_gallery( get_the_content(), array( 'size' => 'full' ) );
    ?>
        <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
            <?php echo trim($gallery); ?>
        </div>
    <?php } elseif( $post_format == 'link' ) {
            $studylms_format = studylms_post_format_link_helper( get_the_content(), get_the_title() );
            $studylms_title = $studylms_format['title'];
            $studylms_link = studylms_get_link_attributes( $studylms_title );
            $thumb = studylms_post_thumbnail('', $studylms_link);
            echo trim($thumb);
        } else { ?>
    	<div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
    		<?php
                $thumb = studylms_post_thumbnail();
                echo trim($thumb);
            ?>
    	</div>
    <?php } ?>
    <div class="info">
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <?php the_title(); ?>
            </h4>
        <?php } ?>
        <div class="entry-meta">
            <a href="<?php the_permalink(); ?>"><i class="mn-icon-1102"></i>  <?php the_time( get_option('date_format', 'd M, Y') ); ?> </a>
            <span class="author"><i class="fa fa-user-o" aria-hidden="true"></i><?php echo esc_html__('By: ','studylms'); the_author_posts_link(); ?></span>
            <span> <i class="fa fa-folder-o" aria-hidden="true"></i> <?php studylms_post_categories($post); ?></span> 
            <span class="comments"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></span>      
        </div>
    </div>
	<div class="detail-content">

    	<div class="single-info info-bottom">
    		<?php
                if ( $post_format == 'gallery' ) {
                    $gallery_filter = studylms_gallery_from_content( get_the_content() );
                    echo trim($gallery_filter['filtered_content']);
                } else {
            ?>
                    <div class="entry-description"><?php the_content(); ?></div><!-- /entry-content -->
            <?php } ?>
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'studylms' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'studylms' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social clearfix ">
                <div class="pull-left">
                    <?php studylms_post_tags(); ?>
                </div>
    			
    			<div class="pull-right social-share">
                    
                   <?php if( studylms_get_config('show_blog_social_share', false) ) {
                        get_template_part( 'page-templates/parts/sharebox' );
                    } ?>         
                </div>
    		</div>
    	</div>
    </div>
</article>