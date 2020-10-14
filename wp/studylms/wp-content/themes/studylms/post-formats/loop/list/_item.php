<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : studylms_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 20;
?>
<article <?php post_class('post post-list'); ?>>

    <div class="row">
        <?php
        $thumb = studylms_display_post_thumb($thumbsize);
        if (!empty($thumb)) {
            ?>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <?php echo trim($thumb); ?>
            </div>
            <?php
        }
        ?>
        <div class="infor-content col-md-<?php echo !empty($thumb) ? '7' : '12'; ?> col-sm-<?php echo !empty($thumb) ? '7' : '12'; ?> col-xs-12">
          <div class="info-content">
            <?php
            if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
            <div class="meta">
                <?php
                    printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a> - </span>',
                        _x( 'By ', 'Used before post author name.', 'studylms' ),
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        get_the_author()
                    );
                ?>
                <span class="entry-date"><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
            </div>
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo trim(studylms_substring( get_the_content(), $nb_word, '...' )); ?></div>
            <?php } else { ?>
                <div class="description"><?php echo trim(studylms_substring( get_the_excerpt(), $nb_word, '...' )); ?></div>
            <?php } ?>

            <a class="btn btn-default btn-border2x btn-sm" href="<?php the_permalink(); ?>"><?php esc_html_e('VIEW MORE','studylms') ?></a>
          </div>
        </div>
    </div>
</article>