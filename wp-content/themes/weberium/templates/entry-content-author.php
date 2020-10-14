<?php
/**
 * Entry Content / Author
 *
 * @package weberium
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! get_the_author_meta( 'description' ) )
	return;
?>

<div class="post-author cleafix">
    <div class="author-avatar">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'weberium_author_bio_avatar_size', 100 ) ); ?>
        </a>
    </div>
    <div class="author-desc">
        <h4 class="name"><span><?php the_author_meta( 'nickname' ); ?></span></h4>
        <div class="author-socials">
            <?php if ( $url = get_the_author_meta( 'rt_facebook' ) ) : ?>
                <a class="facebook" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Facebook', 'weberium'); ?>">
                    <span class="nz-facebook"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_twitter' ) ) : ?>
                <a class="twitter" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Twitter', 'weberium'); ?>">
                    <span class="nz-twitter"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_google_plus' ) ) : ?>
                <a class="google-plus" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Google Plus', 'weberium'); ?>">
                    <span class="nz-google-plus"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_linkedin' ) ) : ?>
                <a class="linkedin" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Linkedin', 'weberium'); ?>">
                    <span class="nz-linkedin"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_pinterest' ) ) : ?>
                <a class="pinterest" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Pinterest', 'weberium'); ?>">
                    <span class="nz-pinterest"></span>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_instagram' ) ) : ?>
                <a class="instagram" href="<?php echo esc_url( $url ); ?>" title="<?php esc_attr_e('Instagram', 'weberium'); ?>">
                    <span class="nz-instagram"></span>
                </a>
            <?php endif; ?>
        </div>
        <p><?php the_author_meta( 'description' ); ?></p>
    </div>
</div>




