<ul id="comments" class="commentlist clearfix"><?php wp_list_comments('avatar_size=88&callback=cordon_comment'); ?></ul>
<div class="pagination-comment clearfix"><?php paginate_comments_links(); ?> </div>
<?php comment_form(array('title_reply'=> esc_html__('Leave Your Comment Here','cordon'), 'comment_notes_before'=>'', 'comment_notes_after'=>'')); ?> 

