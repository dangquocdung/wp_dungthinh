<?php
/* add_ons_php */


$listing_bookmarks = get_user_meta( get_current_user_id(), ESB_META_PREFIX.'listing_bookmarks', true );

townhub_addons_reset_user_notification_type('bookmarked');
?>
<div class="col-md-9 dashboard-content-col">
    <table class="cth-table table-bookmarks">
        <thead>
            <tr>
                <th colspan="5"><?php _e( 'Listing', 'townhub-add-ons' ); ?></th>
                <th colspan="2"><?php _e( 'Author', 'townhub-add-ons' ); ?></th>
                <th colspan="2"><?php _e( 'Categories', 'townhub-add-ons' ); ?></th>
                <th class="text-center" colspan="1"><?php _e( 'Delete', 'townhub-add-ons' ); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if(!empty($listing_bookmarks) && is_array($listing_bookmarks)){
            foreach ($listing_bookmarks as $lid) {
                $listing_post = get_post($lid);
                if(empty($listing_post)) continue;
                ?>
                <tr id="bookmark-<?php echo $listing_post->ID; ?>" class="cth-table-list">
                    <td colspan="5"><a href="<?php echo esc_url(get_the_permalink($listing_post->ID));?>"><?php echo esc_html( $listing_post->post_title ); ?></a></td>
                    <td colspan="2"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $listing_post->post_author ), get_the_author_meta( 'user_nicename', $listing_post->post_author ) ); ?>"><?php echo get_the_author_meta('display_name', $listing_post->post_author); ?></a></td>
                    
                    <td colspan="2">
                    <?php 
                        $cats = get_the_terms($listing_post->ID, 'listing_cat');
                        if ( $cats && ! is_wp_error( $cats ) ){
                            foreach( $cats as $key => $cat){

                                echo sprintf( '<a href="%1$s" class="dashboard-listing-cat">%2$s</a> ',
                                    townhub_addons_get_term_link( $cat->term_id, 'listing_cat' ),
                                    esc_html( $cat->name )
                                );
                            }
                        }
                    ?>
                    </td>
                    
                    <td class="text-center" colspan="1"><a href="#" class="btn delete-bookmark-btn" data-id="<?php echo $listing_post->ID; ?>"><i class="fa fa-trash"></i></a></td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr id="bookmark-no" class="cth-table-list">
                <td colspan="10"><p><?php echo _e( 'You have no bookmark.', 'townhub-add-ons' ); ?></p></td>
            </tr>
            
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

    