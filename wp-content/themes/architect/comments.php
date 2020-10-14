<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package architect
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
    	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		$aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                'id_form' => 'reply-form',                                
                'title_reply'=> '<h3 class="text-cap ">Leave a Reply</h3>',
                'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<div class="row"><div class="form-group col-sm-12 col-md-6 padding-right-10"><label class="sr-only" for="inputName">Password</label><input id="inputName" class="form-control" name="author" type="text" value="" placeholder="'. esc_html__( 'Your Name', 'architect' ) .'" /></div>',
                    'email' => '<div class="form-group col-sm-12 col-md-6 padding-left-10"><input value="" class="form-control" id="inputEmail" name="email" type="email" placeholder="'. esc_html__( 'Your Email', 'architect' ) .'" /></div></div>', 
                    //'url' => '<div class="column3"><div class="column_inner"><input name="url" placeholder="'.esc_html__('WebSite', 'architect').'" id="url" type="text" /></div></div></div>',
                ) ),                                
                 'comment_field' => '<div class="form-group"><textarea rows="5" cols="45" name="comment" '.$aria_req.' id="textarea" class="form-control" placeholder="'. esc_html__( 'Your Comments', 'architect' ) .'" ></textarea></div>',                                                   
                 'label_submit' => esc_html__( 'Comment', 'architect' ),
                 'comment_notes_before' => '',
                 'comment_notes_after' => '',   
                 'class_submit'      => 'ot-btn btn-submit text-cap',            
	        )
	    ?>
	    <?php comment_form($comment_args); ?>
	<?php if ( have_comments() ) : ?>
		<h3 class="text-cap"><?php comments_number( '0 comments', '1 comments', '% comments' ); ?></h3>
	    <ol class="comment-list ">
				<?php wp_list_comments('callback=architect_theme_comment'); ?>
			<?php
				// Are there comments to navigate through?
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
				<nav class="navigation comment-navigation" role="navigation">		   
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'architect' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'architect' ) ); ?></div>
	                <div class="clearfix"></div>
				</nav><!-- .comment-navigation -->
			<?php endif; // Check for comment navigation ?>

			<?php if ( ! comments_open() && get_comments_number() ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'architect' ); ?></p>
			<?php endif; ?>	
	    </ol>		
	<?php endif; ?>	


</div><!-- #comments -->
