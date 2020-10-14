<?php
/* team */
if ( !function_exists('ence_team_function')) {
  function ence_team_function( $atts, $content = NULL ) {
    extract(shortcode_atts(array(
      'class'  => '',
      'team_column'  => '',
      'perticular_team_member'  => '',
      // Listing
      'team_limit'  => '',
      'team_order'  => '',
      'team_orderby'  => '',
      // Color & Style
      'name_color'  => '',
      'profession_color'  => '',
      'content_color'  => '',
      'content_size'  => '',
      'social_color'  => '',
      'social_hover_color'  => '',
      // Size
      'name_size'  => '',
      'profession_size'  => '',
      'social_size'  => '',
    ), $atts));
    ob_start();

    // Shortcode Style CSS
    $e_uniqid        = uniqid();
    $inline_style  = '';
    // Name Color
    if ( $name_color || $name_size ) {
      $inline_style .= '.ence-team-'. $e_uniqid .' .single-member-info .membar-name {';
      $inline_style .= ( $name_color ) ? 'color:'. $name_color .';' : '';
      $inline_style .= ( $name_size ) ? 'font-size:'. eunice_core_check_px($name_size) .';' : '';
      $inline_style .= '}';
    }
    if ( $profession_color || $profession_size ) {
      $inline_style .= '.ence-team-'. $e_uniqid .' .member-info-text h3{';
      $inline_style .= ( $profession_color ) ? 'color:'. $profession_color .';' : '';
      $inline_style .= ( $profession_size ) ? 'font-size:'. eunice_core_check_px($profession_size) .';' : '';
      $inline_style .= '}';
    }
    if ( $content_color || $content_size ) {
      $inline_style .= '.ence-team-'. $e_uniqid .' .member-info-text p{';
      $inline_style .= ( $content_color ) ? 'color:'. $content_color .';' : '';
      $inline_style .= ( $content_size ) ? 'font-size:'. eunice_core_check_px($content_size) .';' : '';
      $inline_style .= '}';
    }
    if ( $social_color || $social_size ) {
      $inline_style .= '.ence-team-'. $e_uniqid .' .member-info-text .member-social-link ul li a {';
      $inline_style .= ( $social_color ) ? 'color:'. $social_color .';' : '';
      $inline_style .= ( $social_size ) ? 'font-size:'. eunice_core_check_px($social_size) .';' : '';
      $inline_style .= '}';
    }
    if ( $social_hover_color) {
      $inline_style .= '.ence-team-'. $e_uniqid .' .member-info-text .member-social-link ul li a:hover {';
      $inline_style .= ( $social_color ) ? 'color:'. $social_color .';' : '';
      $inline_style .= '}';
    }
    // add inline style
    add_inline_style( $inline_style );
    $styled_class  = ' ence-team-'. $e_uniqid;
    $posts = explode(',', $perticular_team_member);

    $args = array(
      'post_type'           => 'teams',
      'posts_per_page'      => (int) $team_limit,
      'order'               => $team_order,
      'orderby'             => $team_orderby,
      'post__in'            => $perticular_team_member,
    );

    $query = new WP_Query( $args );
?>
    <div class="fix team-member-info <?php echo $class.$styled_class; ?>">
      <div class="row">
      <?php
      if( $query->have_posts() ):
        while( $query->have_posts() ): $query->the_post();
          $c = '';
          $c++;
          $team_options = get_post_meta( get_the_ID(), 'team_options', true );
          $team_social  = $team_options['member_socials'];
          if ($team_social) {
            $team_social = $team_social;
          } else {
            $team_social = array();
          }
          if( $team_column == 'col-four' ) {
            $column_class = 'col-md-3 col-sm-6';
          } else {
              if($c == 3){
                $ofset =  ' col-sm-offset-3 col-md-offset-0 col-lg-offset-0';
              } else {
                $ofset = '';
              }
            $column_class = 'col-md-4 col-sm-6 '.$ofset;
          } ?>
          <!--single member info start\-->
          <div class="text-center single-member-info <?php echo $column_class; ?>">
            <div class="member-info">
              <div class="member-img">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail(array(324, 356), true );
                } else {
                 echo '<img src="'.EUNICE_PLUGIN_IMGS.'/member.jpg" alt="'.esc_attr( get_the_title() ).'">';
                }
                ?>
              </div>
              <div class="member-info-text">
                <div class="member-t-call">
                  <h3 class="animated"><?php echo $team_options['worker_title']; ?></h3>
                 <p class="animated"><?php the_content(); ?></p>
                  <div class="animated member-social-link">
                    <ul class="list-inline">
                    <?php foreach($team_social as $icon){ ?>
                      <li><a href="<?php echo $icon['social_link']; ?>"><?php echo strtolower($icon['title']); ?></a></li>
                    <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <a href="" class="membar-name"><?php the_title(); ?></a>
          </div>
          <!--/single member info end-->
        <?php
          endwhile;
        else:
          echo "<p>".esc_html__( "There is no team member","eunice-core" )."</p>";
        endif; ?>
        <!--/single member info end-->
      </div>
    </div>

  <?php
  $result = ob_get_clean();
  return $result;
  }
}
add_shortcode( 'ence_team', 'ence_team_function' );