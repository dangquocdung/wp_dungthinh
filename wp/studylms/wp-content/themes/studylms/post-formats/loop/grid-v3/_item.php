<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : studylms_get_blog_thumbsize();
?>
<article <?php post_class('post post-grid-v3'); ?>>
    <span class="date">
       <div class="day"><?php the_time( 'd' ); ?></div>
       <div class="month"><?php the_time( 'M' ); ?></div>
       <div class="year"><?php the_time( 'Y' ); ?></div>
    </span>
    <div class="content-inner">
        <div class="inner-border">
        <?php
        $thumb = studylms_display_post_thumb($thumbsize);
        if(!empty($thumb)){
            ?>
            <div class="top-image">
                <?php  echo trim($thumb); ?>
            </div>
            <?php 
        }
        ?>
        <div class="clearfix entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <div class="entry-meta">
                <span class="author"><i class="fa fa-user-o" aria-hidden="true"></i><?php echo esc_html__('By: ','studylms'); the_author_posts_link(); ?></span>
                <span> <i class="fa fa-folder-o" aria-hidden="true"></i> <?php studylms_post_categories($post); ?></span> 
                <span class="comments"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></span>
            </div>
            <?php if (has_excerpt()) { ?>
                <div class="entry-description"><?php the_excerpt(); ?></div>
            <?php } ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-default btn-border2x btn-sm"><?php echo esc_html__('Read More','studylms'); ?></a>
        </div>
        </div>
    </div>
</article>