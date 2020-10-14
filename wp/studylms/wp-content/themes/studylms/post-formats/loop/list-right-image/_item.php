<?php
    $post_format = get_post_format();
    $thumbsize = isset($thumbsize) ? $thumbsize : studylms_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 50;
?>

<article <?php post_class('post post-list'); ?>>
    <div class="no-margin row">
        <?php
        $thumb = studylms_display_post_thumb($thumbsize);
        ?>
        <div class="no-padding col-md-<?php echo !empty($thumb) ? '6' : '12'; ?>">
            <div class="entry-content">
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <div class="meta">
                    <span class="entry-date"><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
                </div>
               <?php if (has_excerpt()) { ?>
                    <div class="entry-description">
                        <?php echo trim(studylms_substring( get_the_excerpt(), 20, '...' )); ?>
                    </div>
                <?php } ?>
                <a class="btn btn-default btn-border2x btn-sm" href="<?php the_permalink(); ?>"><?php esc_html_e('VIEW MORE','studylms') ?></a>
            </div>
        </div>
        <?php
        if (!empty($thumb)) {
            ?>
            <div class="no-padding col-md-6">
                <?php echo trim($thumb); ?>
            </div>
            <?php
        }
        ?>
    </div>
</article>