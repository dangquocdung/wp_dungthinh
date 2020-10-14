<?php
/**
 * Entry Content / Author
 *
 * @package gustablo
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! get_the_author_meta( 'description' ) )
	return;
?>

<h3 class="author-title"><span><?php esc_html_e( 'About Author', 'gustablo' ); ?></span></h3>
<div class="post-author cleafix">
    <div class="author-avatar">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wprt_author_bio_avatar_size', 106 ) ); ?>
        </a>
    </div>
    <div class="author-desc">
        <h4 class="name"><?php the_author_meta( 'nickname' ); ?></h4>
        <p><?php the_author_meta( 'description' ); ?></p>
        <div class="author-socials">
            <?php if ( $url = get_the_author_meta( 'rt_facebook' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Facebook', 'gustablo'); ?>">
                    <span class="gustablo-facebook"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_twitter' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Twitter', 'gustablo'); ?>">
                    <span class="gustablo-twitter"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_google_plus' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Google Plus', 'gustablo'); ?>">
                    <span class="gustablo-google-plus"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_linkedin' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Linkedin', 'gustablo'); ?>">
                    <span class="gustablo-linkedin"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_pinterest' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Pinterest', 'gustablo'); ?>">
                    <span class="gustablo-pinterest"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_instagram' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Instagram', 'gustablo'); ?>">
                    <span class="gustablo-instagram"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>




