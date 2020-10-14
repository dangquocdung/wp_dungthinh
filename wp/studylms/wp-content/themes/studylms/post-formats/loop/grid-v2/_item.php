<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : studylms_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 35;
?>

<article <?php post_class('post post-grid post-grid-v2'); ?>>
    <?php
    $thumb = studylms_display_post_thumb($thumbsize);
    ?>
    <?php if(!empty($thumb )){ ?>
        <div class="post-img">
            <?php 
            echo trim($thumb);
            ?>
        </div>
    <?php } ?>
    <div class="clearfix entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>
        <?php if (has_excerpt()) { ?>
            <div class="entry-description">
                <?php echo trim(studylms_substring( get_the_excerpt(), 16, '...' )); ?>
            </div>
        <?php } ?>
        <div class="entry-meta">
            <span class="date"><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
            <span class="author"><?php echo esc_html__('By: ','studylms'); the_author_posts_link(); ?></span>
        </div>
    </div>
</article>