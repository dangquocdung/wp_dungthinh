<?php
function crown_comment_form_args() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$html_req = ($req ? " required='required'" : '');

	$fields = array(
		'author'  => '<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'crown' ) . ($req ? '*' : '') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' /></p>',
		'email'   => '<p class="comment-form-email">' . '<input id="email" name="email" placeholder="' . esc_attr__( 'Email', 'crown' ) . ($req ? '*' : '') . '" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' /></p>',
		'url'     => '<p class="comment-form-url">' . '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'crown' ) . '" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',
	);

	$defaults = array(
		'format'               => 'html5',
		'fields'             => $fields,
		'comment_field'      => '<p class="comment-form-comment"><textarea placeholder="' . esc_attr__('Comment', 'crown') . ($req ? '*' : '') . '" id="comment" name="comment" cols="45" rows="3" maxlength="65525" required="required"></textarea></p>',
		'title_reply'        => esc_html__('Leave a comment', 'crown'),
		'label_submit'       => esc_html__('Post Comment', 'crown'),
		'class_submit'       => 'btn btn-rounded btn-dark'
	);

	return $defaults;
}


add_filter('widget_categories_args', 'crown_widget_categories_args');
function crown_widget_categories_args($cat_args)
{
    $cat_args['taxonomy'] = 'category';
    return $cat_args;
}

function crown_cat_count_span($links, $args)
{
    if (isset($args['taxonomy']) && ($args['taxonomy'] == 'category')) {
        $links = str_replace('(', '<span class="cat-count">', $links);
        $links = str_replace(')', '</span>', $links);
    }

	return $links;
}
add_filter('wp_list_categories', 'crown_cat_count_span',15,2);

function crown_archive_count_span($links, $url, $text, $format)
{
	if ($format === 'option') {
		return $links;
	}
	$links = str_replace( '</a>&nbsp;(', ' <span class="cat-count">', $links );
	$links = str_replace( ')', '</span></a>', $links );
	return $links;
}
add_filter('get_archives_link', 'crown_archive_count_span', 10, 4);