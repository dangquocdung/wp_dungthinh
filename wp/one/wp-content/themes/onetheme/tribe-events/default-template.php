<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>
    
    <?php get_template_part("tpl", "page-title"); ?>

    <!--======= CONTENT =========-->
    <div class="content">
        
        <!--======= RECENT CASES =========-->
        <section class="blog event-pages">
            <div class="container">
                <div class="row">
                    
                    <!--======= BLOG SECTION =========-->
                    <div class="col-md-9">
                        
                        <div class="tribe-content-wrapper">
                        	<?php tribe_events_before_html(); ?>
							<?php tribe_get_view(); ?>
							<?php tribe_events_after_html(); ?>
                        </div>

                    </div>

                    <?php
                    if( is_singular() ){?>
                    <div class="col-md-3 side-bar">
                        <div class="right-map">
                            <h5><?php esc_attr_e('Get Direction', 'onetheme'); ?></h5>
                            <?php
                                tribe_get_template_part( 'modules/meta/map' );
                                ?>
                        </div>
                        <div class="event-detail">
                            <div class="event-details">
                                <?php
                                    tribe_get_template_part( 'modules/meta/details' );
                                    tribe_get_template_part( 'modules/meta/venue' );
                                    tribe_get_template_part( 'modules/meta/organizer' );
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                        get_sidebar();
                    }
                    ?>

                </div>
            </div>
        </section>
    </div>
    <!--======= CONTENT END =========-->


<?php get_footer(); ?>