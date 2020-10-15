<?php

if ( post_password_required() ) {
    return;
}
if( !function_exists('onetheme_custom_comment_item') ):
function onetheme_custom_comment_item($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
    } else {
        $tag = 'li';
    }
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <<?php echo esc_attr($tag); ?>  class="post pingback">
        <p><?php esc_html_e('Pingback:', 'onetheme'); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__('Edit', 'onetheme'), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default:
    ?>

    <<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <article>
        <div class="comment-avatar">
            <?php echo get_avatar( $comment, 60 ); ?>
        </div>
        <div class="comment-body">
            <div class="meta-data">
                <a href="javascript:;" class="comment-author"><?php echo get_comment_author(); ?></a>
                <span class="comment-date"><?php esc_html_e('Posted on', 'onetheme'); ?> <?php printf( '%1$s', get_comment_date() ); ?> <?php esc_html_e('at', 'onetheme'); ?> <?php printf( '%1$s', get_comment_time() ); ?></span>
                <span class="comment-reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </span>
            </div>
        </div>
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
    </article>
<?php
    break;
    endswitch;
}
endif;
// Comment Navigation
if ( ! function_exists( 'onetheme_theme_comment_nav' ) ) :
    function onetheme_theme_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'onetheme'); ?></h2>
            <div class="nav-links">
                <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__('Older Comments', 'onetheme') ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;
                    if ( $next_link = get_next_comments_link( esc_html__('Newer Comments', 'onetheme') ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
endif;
?>
<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
    <div class="comments-wrapper">
        <h2 class="comments-title">
            <?php
                printf( _nx( 'One comment', 'Comments (%1$s)', get_comments_number(), 'comment', 'onetheme' ),
                    number_format_i18n( get_comments_number() ), get_the_title() );
            ?>
        </h2>
        <?php onetheme_theme_comment_nav(); ?>
        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'avatar_size' => 56,
                    'callback'    => 'onetheme_custom_comment_item'
                ) );
            ?>
        </ul><!-- .comment-list -->
        <?php onetheme_theme_comment_nav(); ?>
    </div>
    <?php endif; // have_comments() ?>
    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'onetheme'); ?></p>
    <?php endif; ?>
    <?php
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        comment_form(
            array(
                  
                'comment_notes_after' => '',
                'comment_notes_before' => '',   
                'class_form'      => 'comment-form',
                'class_submit'      => 'wpc-btn size-1 marg-lg-t30',
                'title_reply'       => esc_html__('Add Comments', 'onetheme'),
                'label_submit' => esc_html__('Send Now', 'onetheme'), 
                'fields' => array(
                    'author' => '<div class="col-md-12 contact-form-fieldset">
                       <input type="text" id="inp1" class="contact-inp" placeholder="'.esc_attr__('Name', 'onetheme').'"><label for="inp1" class="contact-form-label fa fa-user"></label>
                       </div>',
                    'email' => '<div class="col-md-12 contact-form-fieldset">
                         <input class="contact-inp" id="inp2" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                    '" size="30" placeholder="'.esc_attr__('Email ID', 'onetheme').'" ' . $aria_req . ' /><label for="inp2" class="contact-form-label fa fa-at"></label></div>',
                ),
                'comment_field' => '<div class="col-sm-12 contact-form-fieldset">
                         <textarea  class="contact-inp contact-message" id="inp3" name="comment" placeholder="'.esc_attr__('Comment', 'onetheme').'"></textarea><label for="inp3" class="contact-form-label fa fa-pencil"></label></div>'
            )
        );
    ?>
</div>