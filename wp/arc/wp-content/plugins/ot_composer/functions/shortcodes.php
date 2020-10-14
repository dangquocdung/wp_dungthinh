<?php

// Custom Heading
add_shortcode('heading','heading_func');
function heading_func($atts, $content = null){
  extract(shortcode_atts(array(
    'text'    =>  '',
    'tag'     =>  '',
    'size'    =>  '',
    'color'   =>  '',
    'align'   =>  '', 
    'weight'   =>  '',
    'top'     =>  '', 
    'bot'     =>  '',
    'class'   =>  '',
  ), $atts));

  $size1 = (!empty($size) ? 'font-size: '.$size.'px;' : '');
  $color1 = (!empty($color) ? 'color: '.$color.';' : '');
  $align1 = (!empty($align) ? 'text-align: '.$align.';' : '');  
  $weight1 = (!empty($weight) ? 'font-weight: '.$weight.';' : '');  
  $top = (!empty($top) ? 'margin-top: '.esc_attr($top).';' : '');
  $bot = (!empty($bot) ? 'margin-bottom: '.esc_attr($bot).';' : '');
  $cl = (!empty($class) ? ' class= "'.$class.'"' : '');
  ob_start(); ?>

  <?php echo htmlspecialchars_decode('<'. $tag . $cl .' style="' . $size1 . $align1 .$weight1 . $color1 . $top . $bot .'" > '. $text .'</'.$tag.'>'); ?> 

<?php

    return ob_get_clean();

}

// Buttons

add_shortcode('button', 'button_func');

function button_func($atts, $content = null){

  extract(shortcode_atts(array(

    'btntext'   => '',
    'btnlink'   => '',
    'icon'      => '',
    'iconpos'   => '',
    'position'  => '',
    'color'     => '',
    'size'      => '',
    'radius'    => '',

  ), $atts));
  ob_start(); ?>

  <?php 

    $color2 = '';
    $size2 = '';
    $rad   = '';
    $positioni = '';

    if($iconpos == 'right'){
      $positioni = ' icon-btn-right';
    }elseif($iconpos == 'left'){
      $positioni = ' icon-btn-left';
    }else{ $positioni = ' ';}

    if($color == 'green'){
      $color2 = ' btn-green-color';
    }elseif($color == 'teal'){
      $color2 = ' btn-teal-color';
    }elseif($color == 'blue'){
      $color2 = ' btn-blue-color';
    }elseif($color == 'maroon'){
      $color2 = ' btn-maroon-color';
    }elseif($color == 'brown'){
      $color2 = ' btn-brown-color';
    }elseif($color == 'dark'){
      $color2 = ' btn-dark-color';
    }elseif($color == 'light'){
      $color2 = ' btn-sub-color';
    }elseif($color == 'dark2'){
      $color2 = ' btn-border-dark';
    }elseif($color == 'transparent'){
      $color2 = ' btn-border';
    }else{ $color2 =' btn-main-color';}

    if($size == 'small'){
      $size2 = ' small-btn';
    }elseif($size == 'large'){
      $size2 = ' large-btn';
    }elseif($size == 'long'){
      $size2 = ' btn-long';
    }else{
      $size2 = ' default-size-btn';
    }

    if($radius == 'radius50'){
      $rad = ' btn-pill';
    }elseif($radius == 'rounded'){$rad = ' btn-rounded';}
    else{'';}
  ?>
  <?php if($position == 'center'){echo '<div class="text-center">';}elseif($position =='right'){echo '<div class="text-right">';}else{echo '';} ?>
  <a href="<?php echo esc_url($btnlink); ?>" class="ot-btn<?php echo esc_attr($rad.$size2.$color2.$positioni); ?>"><?php if($icon != ''){ ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?><?php echo esc_attr($btntext); ?></a>
  <?php if($position == 'center'){echo '</div>';}elseif($position=='right'){echo '</div>';} ?>
  <?php return ob_get_clean();

}


// Divider (use)
add_shortcode('divider', 'divider_func');
function divider_func($atts, $content = null){
  extract(shortcode_atts(array(
    'bg_color'   => '',
  ), $atts));
  ob_start(); ?>
    <div class="divider divider-1" <?php if($bg_color != ''){ ?> style="background: <?php echo esc_attr($bg_color); ?>" <?php } ?>>
      <svg class="svg-triangle-icon-container">
        <polygon class="svg-triangle-icon" points="6 11,12 0,0 0"></polygon>
      </svg>
    </div>
<?php
    return ob_get_clean();
}

// Miscellaneous Box (use)
add_shortcode('mulbox', 'mulbox_func');
function mulbox_func($atts, $content = null){
  extract(shortcode_atts(array(
    'image'   => '',
    'title'   => '', 
    'align'   => '',
    'linkimg' => '',
    'linkbox' => '',
    'aligns2' => '',
    'style'   => 'style1',
  ), $atts));
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    $url = vc_build_link( $linkbox );
  ob_start(); ?>
  <?php 
  if($align == 'left'){
      $align2 = 'left';
    }elseif($align == 'right'){
      $align2 = 'right';
    }elseif($align == 'full'){
      $align2 = 'full';
    }else{ $align2 = '';}
   ?>
   <?php if($style == 'style1'){ ?>
    <div class="block-img-<?php echo esc_attr($align2); ?> mgb0">
      <?php if($linkimg != ''){ ?><a class="img-block" href="<?php echo esc_url($linkimg); ?>"><?php }else{ ?><div class="img-block"><?php } ?><img src="<?php echo esc_url($img) ?>" class="img-responsive" alt="Image"><?php if($linkimg != ''){ ?></a><?php }else{ ?></div><?php } ?>
      <div class="text-box">
        <h4 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h4>
        <p>
          <?php echo htmlspecialchars_decode($content); ?>
        </p>
      </div>
    </div>
    <?php }else { ?>
    <div class="block-img-full-width">
       <div class="block-img-<?php echo esc_attr($aligns2); ?> ">
          <div class="text-box">
             <h4 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h4>
             <p><?php echo htmlspecialchars_decode($content); ?></p>
             <?php if ( strlen( $linkbox ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="text-cap view-more" data-gal="m_PageScroll2id" data-ps2id-offset="78" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) . '</a>';
            } ?>
          </div>
          <div class="img-block"><img src="<?php echo esc_url($img) ?>" class="img-responsive" alt="Image"></div>
       </div>
    </div>
    <?php } ?>
<?php
    return ob_get_clean();
}

// Icon Box (use)
add_shortcode('iconb', 'iconb_func');
function iconb_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   => '', 
    'icon'    => '',
  ), $atts));
  ob_start(); ?>
    <article class="media-style left-icon-item">
        <div class="media">
           <div class="media-left">
              <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
           </div>
           <div class="media-body">
              <h4 class=""><?php echo htmlspecialchars_decode($title); ?></h4>
              <p><?php echo htmlspecialchars_decode($content); ?></p>
           </div>
        </div>
    </article>
<?php
    return ob_get_clean();
}

// Question Box (use)
add_shortcode('quesb', 'quesb_func');
function quesb_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'   => '', 
    'linkbox'    => '',
  ), $atts));
    $url = vc_build_link( $linkbox );
  ob_start(); ?>
    <div class="box-question-sidebar text-center">
       <p><?php echo htmlspecialchars_decode($title); ?></p>
        <?php if ( strlen( $linkbox ) > 0 && strlen( $url['url'] ) > 0 ) {
          echo '<a class="ot-btn btn-main-color text-cap" data-gal="m_PageScroll2id" data-ps2id-offset="78" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) . '</a>';
        } ?>
    </div>
<?php
    return ob_get_clean();
}

// Gallery (use)

add_shortcode('galler', 'galler_func');
function galler_func($atts, $content = null){
  extract(shortcode_atts(array(
    'gallery'   =>  '',
    'style'     => 'style1',
  ), $atts));
  ob_start(); ?>
  <?php if($style == 'style1'){ ?>
    <div class="slide-services">
      <div class="customNavigation">
          <a class="btn prev-detail-services"><i class="fa fa-angle-left"></i></a>
          <a class="btn next-detail-services"><i class="fa fa-angle-right"></i></a>
      </div>

      <div id="sync3" class="owl-carousel owl-detail-services clearfix">
          <?php 
          $img_ids = explode(",",$gallery);
          foreach( $img_ids AS $img_id ){
          $meta = wp_prepare_attachment_for_js($img_id);
          $image_src = wp_get_attachment_image_src($img_id,''); ?>
              <div class="item">
                  <img src="<?php echo esc_url( $image_src[0] ); ?>"  class="img-responsive">
              </div>
          <?php } ?>
      </div> 
      <div id="sync4" class="owl-carousel thumb-service-slide">
      <?php 
          $img_ids = explode(",",$gallery);
          foreach( $img_ids AS $img_id ){
          $meta = wp_prepare_attachment_for_js($img_id);
          $image_src = wp_get_attachment_image_src($img_id,''); ?>
              <div class="item">
                  <img src="<?php echo esc_url( $image_src[0] ); ?>"  class="img-responsive">
              </div>
          <?php } ?>
      </div>
    </div>
  <?php }else{ ?>
    <div class="gallery-warp">
      <?php 
        $img_ids = explode(",",$gallery);
        foreach( $img_ids AS $img_id ){
        $meta = wp_prepare_attachment_for_js($img_id);
        $caption = $meta['caption'];
        $title = $meta['title'];  
        $description = $meta['description'];  
        $image_src = wp_get_attachment_image_src($img_id,''); ?>
          <?php if(!empty($caption)){ ?> 
            
              <a target="_blank" href="<?php echo esc_attr($caption); ?>">
                <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive">
              </a>
          
          <?php }else{ ?>           
            <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive">
          <?php } ?>
      <?php } ?>
    </div>
  <?php } ?>
  <?php

    return ob_get_clean();

}

// Feature Box (use)
add_shortcode('feature', 'feature_func');
function feature_func($atts, $content = null){
  extract(shortcode_atts(array(
    'image'   => '',
    'title'   => '', 
    'type'    => '', 
    'style'   => '',
    'style2'  => 'style1',
  ), $atts));
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
  ob_start(); ?>
  <?php if($style2 == 'style1'){ ?>
    <div class="chooseus-item">
      <h4 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h4>
      <div class="chooseus-canvas-item">
       <svg class="svg-hexagon">
            <polygon class="hexagon" points="285 100,285 250,155 325,25 250,25 100,155 25"></polygon>
        </svg>
                  <!-- End Hexagon -->
        <svg class="svg-triangle-dotted <?php if($style == 'style2'){echo 'svg-tri-2';} elseif($style == 'style3'){echo 'svg-tri-3';} elseif($style =='style4'){echo 'svg-tri-4';} else{} ?>"  >
          <polygon class="triangle-div" points="2 220,254 220,128 0"></polygon>
        </svg>
        <!-- End Triangle Dotted -->
        <div class="triangle-img-warp tri<?php if($style == 'style2'){echo '2';} elseif($style == 'style3'){echo '3';} elseif($style =='style4'){echo '4';} else{} ?>">
          <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="Image">
        </div>
      </div>
    </div>  
    <?php }else{ ?>
    <div class="chooseus-item mgb0">          
        <div class="chooseus-canvas-item">
          <svg class="svg-hexagon">
              <polygon class="hexagon" points="285 100,285 250,155 325,25 250,25 100,155 25"></polygon>
          </svg>
          <!-- End Hexagon -->
          <svg class="svg-triangle-dotted <?php if($style == 'style2'){echo 'svg-tri-2';} elseif($style == 'style3'){echo 'svg-tri-3';} elseif($style =='style4'){echo 'svg-tri-4';} else{} ?>"  >
            <polygon class="triangle-div" points="2 220,254 220,128 0"></polygon>
          </svg>
          <!-- End Triangle Dotted -->
          <div class="triangle-img-warp tri<?php if($style == 'style2'){echo '2';} elseif($style == 'style3'){echo '3';} elseif($style =='style4'){echo '4';} else{} ?>">
            <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="Image">
          </div>
        </div>
        <h4 class="text-cap <?php if($type=='white'){echo 'white-text';}else{'';} ?> "><?php echo htmlspecialchars_decode($title); ?></h4>
    </div>  
    <?php } ?>
<?php
    return ob_get_clean();
}

// promotion 
add_shortcode('promotion', 'promotion_func');
function promotion_func($atts, $content = null){
  extract(shortcode_atts(array(
    'image'   => '',
    'title'   => '',
    'linkbox' => '',
    'bg_color' => '',
    'icon'    => '',
    'style'   => 'style1',
  ), $atts));
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
    $url = vc_build_link( $linkbox );
  ob_start(); ?>
    <?php if($style == 'style1'){ ?>
    <div class="promotion-box">
      <figure class="effect-layla">
        <img src="<?php echo esc_url($img); ?>" alt="img06"/>
        <figcaption>
          <h3 class="text-cap white-text"><?php echo htmlspecialchars_decode($title); ?></h3>
          <p><?php echo htmlspecialchars_decode($content); ?></p>
          <?php if ( strlen( $linkbox ) > 0 && strlen( $url['url'] ) > 0 ) {
              echo '<a data-gal="m_PageScroll2id" data-ps2id-offset="78" class="ot-btn btn-main-color text-cap" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) . '</a>';
          } ?>
        </figcaption>     
      </figure>
    </div>
    <?php }elseif($style == 'style2'){ ?>
    <div class="promotion-box-2">
      <figure class="promotion-box-dark box-pro-1" <?php if($bg_color != ''){ ?>style="background:<?php echo esc_attr($bg_color); ?>"<?php } ?>>
         <div class="box-dark-content">
            <span class="lnr <?php echo esc_attr($icon); ?> icon-promotion"></span>
            <h3 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h3>
            <p><?php echo htmlspecialchars_decode($content); ?></p>
         </div>
      </figure>
    </div>
    <?php }else{ ?>
      <div class="item-promotion-h5">
         <div class="img-promotion-h5">
            <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="Image">
         </div>
         <div class="promotion-h5-text-box">
            <h3 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h3>
            <?php if ( strlen( $linkbox ) > 0 && strlen( $url['url'] ) > 0 ) {
              echo '<a class="text-cap" data-gal="m_PageScroll2id" data-ps2id-offset="78" class="ot-btn btn-main-color text-cap" href="' . esc_attr( $url['url'] ) . '" title="' . esc_attr( $url['title'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) . '</a>';
            } ?>
         </div>
      </div>
    <?php } ?>
<?php
    return ob_get_clean();
}

// Blog (use)
add_shortcode('blog', 'blog_func');
function blog_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'    => '',
        'excerpt'   => '',
        'style'     => 'style1',
    ), $atts));
    ob_start();
    $excerpt1 = (!empty($excerpt)) ? $excerpt : 15;
    ?>
    <div class="row">
    <div class="lastest-blog-container">
      <?php 
          $args = array(   
              'post_type' => 'post',   
              'posts_per_page' => $number,
          );  
          $wp_query = new WP_Query($args);
          while($wp_query->have_posts()) : $wp_query->the_post(); 
      ?>
      <?php if($style == 'style1'){ ?>
      <?php $format = get_post_format();?>

      <div class="col-md-6">
        <article class="lastest-blog-item">
          <figure class="latest-blog-post-img effect-zoe">
            <a href="<?php the_permalink(); ?>">
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                <?php if($images){ ?>
                  <?php foreach ( $images as $image ) { ?>
                    <?php $img = $image['full_url']; ?>
                    <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                  <?php } ?>
                <?php }else{ 
                  if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                  } 
                  } ?>
              <?php } ?>
            </a>
            <div class="latest-blog-post-date text-cap">
                  <span class="day"><?php the_time('d'); ?></span>
                  <span class="month"><?php the_time('M'); ?></span>
            </div>
          </figure>
          <div class="latest-blog-post-description">
              <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
              <p><?php echo architect_excerpt($excerpt1); ?></p>
              <a href="<?php the_permalink(); ?>" class="ot-btn btn-main-color text-cap mgb0">
                <?php esc_html_e('Continue Reading...','architect'); ?>
              </a>
          </div>
        </article>
      </div>
      <?php }else{ ?>
      <div class="col-md-4">
        <article class="lastest-blog-item">
          <figure class="latest-blog-post-img effect-zoe">
            <a href="<?php the_permalink(); ?>">
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                <?php if($images){ ?>
                  <?php foreach ( $images as $image ) { ?>
                    <?php $img = $image['full_url']; ?>
                    <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                  <?php } ?>
                <?php }else{ 
                  if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                  } 
                  } ?>
              <?php } ?>
            </a>
            <div class="latest-blog-post-date text-cap">
                  <span class="day"><?php the_time('d'); ?></span>
                  <span class="month"><?php the_time('M'); ?></span>
            </div>
                          
          </figure>
            <div class="latest-blog-post-description">
                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                <p><?php echo architect_excerpt($excerpt1); ?></p>
            </div>
        </article>
      </div>
      <?php } ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    </div>
<?php 
  return ob_get_clean();
}

// Blog Slide(use)
add_shortcode('blogslide', 'blogslide_func');
function blogslide_func($atts, $content = null){
    extract(shortcode_atts(array(
        'number'    => '',
        'excerpt'   => '',
        'style'     => 'style1',
    ), $atts));
    ob_start();
    $excerpt1 = (!empty($excerpt)) ? $excerpt : 15;
    ?>
    <div class="owl-lastestnew-warp">
    <div class="customNavigation">
        <a class="btn prev-lastestnew"><i class="fa fa-angle-left"></i></a>
        <a class="btn next-lastestnew"><i class="fa fa-angle-right"></i></a>
     </div>
    <div id="owl-lastestnew" class="owl-carousel-blog lastest-blog-container">
      <?php 
          $args = array(   
              'post_type' => 'post',   
              'posts_per_page' => $number,
          );  
          $wp_query = new WP_Query($args);
          while($wp_query->have_posts()) : $wp_query->the_post(); 
      ?>
      <?php $format = get_post_format();?>
      <div class="item mgr">
        <article class="lastest-blog-item">
          <figure class="latest-blog-post-img effect-zoe">
            <a href="<?php the_permalink(); ?>">
              <?php if( function_exists( 'rwmb_meta' ) ) { ?>  
                <?php $images = rwmb_meta( '_cmb_image', "type=image" ); ?>
                <?php if($images){ ?>
                  <?php foreach ( $images as $image ) { ?>
                    <?php $img = $image['full_url']; ?>
                    <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="">
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </a>
            <div class="latest-blog-post-date text-cap">
                  <span class="day"><?php the_time('d'); ?></span>
                  <span class="month"><?php the_time('M'); ?></span>
            </div>
          </figure>
          <div class="latest-blog-post-description">
              <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
              <p><?php echo architect_excerpt($excerpt1); ?></p>
              <a href="<?php the_permalink(); ?>" class="ot-btn btn-main-color text-cap mgb0">
                <?php esc_html_e('Continue Reading...','architect'); ?>
              </a>
          </div>
        </article>
      </div>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    </div>
<?php 
  return ob_get_clean();
}

// OT Team (new)
add_shortcode('ot_teamn', 'ot_teamn_func');
function ot_teamn_func($atts, $content = null){
  extract(shortcode_atts(array(
    'body' => '',
    'style' => '',
  ), $atts));
  $body = (array) vc_param_group_parse_atts( $body );
  ob_start(); 
?>
<?php if($style=='style1'){ ?>
  <div class="ourteam-warp ourteam-3-col">
    <div class="customNavigation">
      <a class="btn prev-team"><i class="fa fa-angle-left"></i></a>
      <a class="btn next-team"><i class="fa fa-angle-right"></i></a>
    </div>  
    <div id="owl-team-3-columns" class="owl-carousel owl-theme clearfix">
<?php 
  foreach ( $body as $data ) {
    $data['name'] = isset( $data['name'] ) ? $data['name'] : '';
    $data['job'] = isset( $data['job'] ) ? $data['job'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
    $data['photo'] = isset( $data['photo'] ) ? $data['photo'] : '';
    $team_img = wp_get_attachment_image_src($data['photo'],'full');
    $team_img = $team_img[0];
    $data['icon1'] = isset( $data['icon1'] ) ? $data['icon1'] : '';
    $data['link1'] = isset( $data['link1'] ) ? $data['link1'] : '';
    $data['icon2'] = isset( $data['icon2'] ) ? $data['icon2'] : '';
    $data['link2'] = isset( $data['link2'] ) ? $data['link2'] : '';
    $data['icon3'] = isset( $data['icon3'] ) ? $data['icon3'] : '';
    $data['link3'] = isset( $data['link3'] ) ? $data['link3'] : '';
?>
     <div class="item">
      <div class="item-team">
        <div class="portrait-member">
         <img src="<?php echo $team_img; ?>" class="img-responsive" alt="Image">
        </div>
       <div class="member-info text-center hvr-float-shadow">
          <h5 class="text-cap"><?php echo $data['name']; ?></h5>
          <p class="member-job"><?php echo $data['job']; ?></p>
          <div class="social-member">
              <a href="<?php echo esc_url( $data['link1']); ?>">
                <i class="<?php echo $data['icon1']; ?>" aria-hidden="true"></i>
              </a>
              <a href="<?php echo esc_url( $data['link2']); ?>">
                <i class="<?php echo $data['icon2']; ?>" aria-hidden="true"></i>
              </a>
              <a href="<?php echo esc_url( $data['link3']); ?>">
                <i class="<?php echo $data['icon3']; ?>" aria-hidden="true"></i>
              </a>
          </div>
       </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php }else{ ?>
  <div class="ourteamGrid-warp">
    
<?php 
  foreach ( $body as $data ) {
    $data['name'] = isset( $data['name'] ) ? $data['name'] : '';
    $data['job'] = isset( $data['job'] ) ? $data['job'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
    $data['photo'] = isset( $data['photo'] ) ? $data['photo'] : '';
    $team_img = wp_get_attachment_image_src($data['photo'],'full');
    $team_img = $team_img[0];
    $data['icon1'] = isset( $data['icon1'] ) ? $data['icon1'] : '';
    $data['link1'] = isset( $data['link1'] ) ? $data['link1'] : '';
    $data['icon2'] = isset( $data['icon2'] ) ? $data['icon2'] : '';
    $data['link2'] = isset( $data['link2'] ) ? $data['link2'] : '';
    $data['icon3'] = isset( $data['icon3'] ) ? $data['icon3'] : '';
    $data['link3'] = isset( $data['link3'] ) ? $data['link3'] : '';
?>
     <div class="team-grid-item">
       <img src="<?php echo $team_img; ?>" class="img-responsive" alt="Image">
       <div class="grid-team-overlay">
          <h5 class="text-cap"><?php echo $data['name']; ?></h5>
          <p class="member-job"><?php echo $data['job']; ?></p>
          <p class="description-member">
             <?php echo $data['desc']; ?>
          </p>
          <div class="social-member">
              <a href="<?php echo esc_url( $data['link1']); ?>">
                <i class="<?php echo $data['icon1']; ?>" aria-hidden="true"></i>
              </a>
              <a href="<?php echo esc_url( $data['link2']); ?>">
                <i class="<?php echo $data['icon2']; ?>" aria-hidden="true"></i>
              </a>
              <a href="<?php echo esc_url( $data['link3']); ?>">
                <i class="<?php echo $data['icon3']; ?>" aria-hidden="true"></i>
              </a>
          </div>
       </div>
    </div>
    <?php } ?>
</div>
<?php } ?>
<?php
  
    return ob_get_clean();
}

// Logos Client (use)

add_shortcode('logos', 'logos_func');
function logos_func($atts, $content = null){
  extract(shortcode_atts(array(
    'gallery'   =>  '',
  ), $atts));
  ob_start(); ?>
    <div class="owl-partner-warp" >
      <div class="customNavigation">
        <a class="btn prev-partners"><i class="fa fa-angle-left"></i></a>
        <a class="btn next-partners"><i class="fa fa-angle-right"></i></a>
      </div><!-- End owl button -->

      <div id="owl-partners" class="owl-carousel owl-theme owl-partners clearfix">
          <?php 
          $img_ids = explode(",",$gallery);
          foreach( $img_ids AS $img_id ){
          $meta = wp_prepare_attachment_for_js($img_id);
          $caption = $meta['caption'];
          $title = $meta['title'];  
          $description = $meta['description'];  
          $image_src = wp_get_attachment_image_src($img_id,''); ?>
            <?php if(!empty($caption)){ ?> 
              <div class="item">
                <a target="_blank" href="<?php echo esc_attr($caption); ?>">
                  <img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive">
                </a>
              </div>
            <?php }else{ ?>           
              <div class="item"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive"></div>
            <?php } ?>
          <?php } ?>
      </div> 
    </div>

  <?php

    return ob_get_clean();

}

// Portfolio filter (use)
add_shortcode('portfoliofil','portfoliofil_func');
function portfoliofil_func($atts, $content = null){
    extract( shortcode_atts( array(   
      'all'        => '',
      'hover'      => '',
      'number'     => '',
      'style'      => 'style1',
   ), $atts ) );
    ob_start(); ?>
    <div class="lastest-project-warp clearfix">
        <div class="projectFilter project-terms <?php if($style == 'style2'){echo 'project-terms-2';} ?> <?php if($hover=='hover2'){echo 'line-effect-2';}else{'';} ?>">
            <a href="#" class="current text-cap" data-filter="*" title=""> <h4><?php echo esc_attr($all); ?></h4></a>
            <?php 
             $categories = get_terms('categories');   
             foreach( (array)$categories as $categorie){
              $cat_name = $categorie->name;
              $cat_slug = $categorie->slug;
             ?>
             <a href="#" class="text-cap" data-filter=".<?php echo esc_attr($cat_slug); ?>"><h4><?php echo esc_attr($cat_name); ?></h4></a>
            <?php } ?>
        </div>     
      <div class="clearfix projectContainer">
        <?php 
            $number1 = (!empty($number)) ? $number : 9;
            $args = array(   
                'post_type' => 'portfolio',
                'posts_per_page' => $number1,   
            );  
            $wp_query = new WP_Query($args);    
            if($wp_query->have_posts()):        
            while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
            $cates = get_the_terms(get_the_ID(),'categories');
               $cate_name ='';
               $cate_slug = '';
                  foreach((array)$cates as $cate){
                 if(count($cates)>0){
                  $cate_name .= $cate->name.' ' ;
                  $cate_slug .= $cate->slug .' ';     
                 } 
               }
        ?>                 
            <div class="element-item  <?php echo esc_attr($cate_slug); ?>">    
                <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
                <a href="<?php the_permalink(); ?>">  
                <div class="project-info">
                    <h4 class="title-project text-cap text-cap"><?php the_title(); ?></h4>
                    
                    <p class="cateProject"><?php echo esc_attr($cate_name); ?></p>
                </div>
                </a>
            </div>         
        <?php endwhile;?> 
      </div>
  </div>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>         

<?php
    return ob_get_clean();
}

// Portfolio filter grid (use)
add_shortcode('portfoliofil2','portfoliofil2_func');
function portfoliofil2_func($atts, $content = null){
    extract( shortcode_atts( array(   
      'all'        => '',
      'number'     => '',
      'style'      => 'style1',
   ), $atts ) );
    ob_start(); ?>

    <div class="lastest-project-warp <?php if($style == 'style1'){echo 'portfolio-grid-1-warp';}elseif($style=='style2'){echo 'portfolio-grid-2-warp';}else{echo'portfolio-grid-3-warp';} ?> clearfix">
      <div class="projectFilter project-terms line-effect-2">
          <a href="#" class="text-cap current" data-filter="*" title=""> <h4><?php echo esc_attr($all); ?></h4></a>
          <?php 
           $categories = get_terms('categories');   
           foreach( (array)$categories as $categorie){
            $cat_name = $categorie->name;
            $cat_slug = $categorie->slug;
           ?>
           <a class="text-cap" href="#" data-filter=".<?php echo esc_attr($cat_slug); ?>"><h4><?php echo esc_attr($cat_name); ?></h4></a>
          <?php } ?>
      </div>     
      <div class="clearfix projectContainer <?php if($style == 'style1'){echo 'portfolio-grid-1-container';}elseif($style=='style2'){echo 'portfolio-grid-2-container';}else{echo 'portfolio-grid-3-container';} ?> ">
        <?php 
            $number1 = (!empty($number)) ? $number : 9;
            $args = array(   
                'post_type' => 'portfolio',
                'posts_per_page' => $number1,   
            );  
            $wp_query = new WP_Query($args);    
            if($wp_query->have_posts()):        
            while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
            $cates = get_the_terms(get_the_ID(),'categories');
               $cate_name ='';
               $cate_slug = '';
                  foreach((array)$cates as $cate){
                 if(count($cates)>0){
                  $cate_name .= $cate->name.' ' ;
                  $cate_slug .= $cate->slug .' ';     
                 } 
               }
        ?>              
            <div class="element-item  <?php echo esc_attr($cate_slug); ?>">
                <a class="portfolio-img-demo" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
                <div class="project-info">
                   <a href="<?php the_permalink(); ?>">
                      <h4 class="title-project text-cap text-cap"><?php the_title(); ?></h4>
                   </a>
                   <?php       
                        $terms = get_the_terms(get_the_ID(),'categories');
                        //echo '<ul>';
                        foreach ( $terms as $term ) { 
                         $i++;
                            // The $term is an object, so we don't need to specify the $taxonomy.
                            $term_link = get_term_link( $term );
                           
                            // If there was an error, continue to the next term.
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }

                            // We successfully got a link. Print it out.          
                            echo '<a class="cateProject" href="' . esc_url( $term_link ) . '">' . $term->name . '</a> ';
                        }

                        //echo '</ul>';
                       ?>
                </div>
            </div>       
        <?php endwhile;?> 
      </div>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>    
  </div>     

<?php
    return ob_get_clean();
}

// Portfolio filter grid v2 (use)
add_shortcode('portfoliofil2v2','portfoliofil2v2_func');
function portfoliofil2v2_func($atts, $content = null){
    extract( shortcode_atts( array(   
      'all'           => '',
      'number'        => '',
      'style'         => 'style1',
   ), $atts ) );
    ob_start(); ?>

    <div class="lastest-project-warp portfolio-grid-v2-<?php if($style =='style1'){echo '2';}elseif($style=='style2'){echo '3';}else{echo '4';} ?>-col-warp clearfix">
      <div class="projectFilter project-terms line-effect-2">
          <a href="#" class="text-cap current" data-filter="*" title=""> <h4><?php echo esc_attr($all); ?></h4></a>
          <?php 
           $categories = get_terms('categories');   
           foreach( (array)$categories as $categorie){
            $cat_name = $categorie->name;
            $cat_slug = $categorie->slug;
           ?>
           <a class="text-cap" href="#" data-filter=".<?php echo esc_attr($cat_slug); ?>"><h4><?php echo esc_attr($cat_name); ?></h4></a>
          <?php } ?>
      </div>     
      <div class="clearfix projectContainer portfolio-grid-v2-<?php if($style =='style1'){echo '2';}elseif($style=='style2'){echo '3';}else{echo '4';} ?>-col-container">
        <?php 
            $number1 = (!empty($number)) ? $number : 9;
            $args = array(   
                'post_type' => 'portfolio',
                'posts_per_page' => $number1,   
            );  
            $wp_query = new WP_Query($args);    
            if($wp_query->have_posts()):        
            while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
            $cates = get_the_terms(get_the_ID(),'categories');
               $cate_name ='';
               $cate_slug = '';
                  foreach((array)$cates as $cate){
                 if(count($cates)>0){
                  $cate_name .= $cate->name.' ' ;
                  $cate_slug .= $cate->slug .' ';     
                 } 
               }
        ?>              
            <div class="element-item  <?php echo esc_attr($cate_slug); ?>">
                <a class="portfolio-img-demo" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
                <a href="<?php the_permalink(); ?>">  
                <div class="project-info">
                    <h4 class="title-project text-cap text-cap"><?php the_title(); ?></h4>
                    
                    <p class="cateProject"><?php echo esc_attr($cate_name); ?></p>
                </div>
                </a>
            </div>     
        <?php endwhile;?> 
      </div>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>    
  </div>     

<?php
    return ob_get_clean();
}

// Counter  (use)
add_shortcode('counterup','counterup_func');
function counterup_func($atts, $content = null){
  extract(shortcode_atts(array(
    'number'  => '',
    'icon'   => '',
    'image'   => '',
    'title'   => '',
    'style'   => 'style1',
  ), $atts));
    $img = wp_get_attachment_image_src($image,'full');
    $img = $img[0];
  ob_start(); ?>
    <?php if($style == 'style1'){ ?>
      <div class="about-info-item">
        <span class="counter"><?php echo esc_attr($number); ?></span>
        <h5 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h5>
        <p><?php echo htmlspecialchars_decode($content); ?></p>
      </div>
    <?php }elseif($style == 'style2'){ ?>
      <div class="ourStatis-item-2">
        <div class="circle-statis">
            <span class="lnr <?php echo esc_attr($icon); ?>"></span>
            <h6 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h6>
            <span class="counter"><?php echo esc_attr($number); ?></span>
        </div>
        
      </div>
    <?php }else{ ?>
      <div class="ourStatis-item">
         <div class="circle-statis">
            <img src="<?php echo esc_url($img); ?>" class="img-responsive" alt="Image">
         </div>
         <h6 class="text-cap"><?php echo htmlspecialchars_decode($title); ?></h6>
         <span class="counter"><?php echo esc_attr($number); ?></span>
      </div>
    <?php } ?>
  <?php
    return ob_get_clean();
}

// Contact Info (use)
add_shortcode('ctinfo','ctinfo_func');
function ctinfo_func($atts, $content = null){
  extract(shortcode_atts(array(
    'icon'   => '',
    'title'  => '',
    'style'  => '',
  ), $atts));
  ob_start(); ?>
    <div class="item-block-contact">
      <span class="lnr <?php echo esc_attr($icon); ?>"></span>
      <p><?php echo htmlspecialchars_decode($title); ?></p>
   </div>
  <?php
    return ob_get_clean();
}

// Project Info (use)
add_shortcode('pjinfo','pjinfo_func');
function pjinfo_func($atts, $content = null){
  extract(shortcode_atts(array(
    'titles'  => '',
  ), $atts));
  $titles = (array) vc_param_group_parse_atts( $titles );
  ob_start(); ?>
    <div class="pj-info">
      <?php 
      foreach ( $titles as $data ) {
        $data['title'] = isset( $data['title'] ) ? $data['title'] : '';
        $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
      ?>
        <div><h5><?php echo $data['title']; ?></h5><?php echo $data['desc']; ?></div>
      
      <?php } ?> 
    </div>
  <?php
    return ob_get_clean();
}

// Social (use)
add_shortcode('social','social_func');
function social_func($atts, $content = null){
  extract(shortcode_atts(array(
      'titles'  => '',
  ), $atts));

  $titles = (array) vc_param_group_parse_atts( $titles );

  ob_start(); ?>
  <ul class="social">
  <?php 
  foreach ( $titles as $data ) {
    $data['icon'] = isset( $data['icon'] ) ? $data['icon'] : '';
    $data['link'] = isset( $data['link'] ) ? $data['link'] : '';
  ?>
    <li><a href="<?php echo $data['link']; ?>"><i class="<?php echo $data['icon']; ?>"></i></a></li>
  
   <?php } ?> 
   </ul>
<?php
  
    return ob_get_clean();
}


// Share (waitng)
add_shortcode('share','share_func');
function share_func($atts, $content = null){
  extract(shortcode_atts(array(
    'title'  => '',
    'faceb'  => '',
    'twitter'  => '',
    'google'  => '',
    'linkedin'  => '',
    'pinterest'  => '',
  ), $atts));
  ob_start(); ?>
    <div class="social-share">
      <p><?php echo htmlspecialchars_decode($title); ?>:</p>
        
        <?php if($faceb == true){ ?>
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
        <?php } ?>
        <?php if($twitter == true){ ?>
        <a target="_blank" href="https://twitter.com/home?status=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
        <?php } ?>
        <?php if($google == true){ ?>
        <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
        <?php } ?>
        <?php if($pinterest == true){ ?>
        <a target="_blank" href="http://pinterest.com/pin/create/button/?<?php the_permalink(); ?>"><i class="fa fa-pinterest"></i></a>
        <?php } ?>
        <?php if($linkedin == true){ ?>
        <a target="_blank" href="https://www.linkedin.com/cws/share?url=<?php the_permalink(); ?>"><i class="fa fa-linkedin"></i></a>
        <?php } ?>
    </div>
  <?php
    return ob_get_clean();
}

// Service (use)
add_shortcode('service','service_func');
function service_func($atts, $content = null){
  extract(shortcode_atts(array(
    'number'  => '',
    'column'  => '2',
    'column2' => '1',
    'button'  => '',
    'style'   => 'style1',
  ), $atts));
  if(!$number){
    $number = -1;
  }
  ob_start(); ?>
  <?php if($style == 'style1'){ ?>
    <div class="row">
    <div class="services-h4">
        <?php
          $args = array(
            'post_type' => 'service',
            'posts_per_page' => $number,
          );
          $wp_query = new WP_Query($args);
          if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
          $detail_service = get_post_meta(get_the_ID(),'_cmb_detail_service', true);
        ?>
        <div class="col-sm-4 col-md-<?php if($column == 3){echo '4';}elseif($column == 4){echo '3';}else{echo '6';} ?> ">
          <div class="block-img-full services-fix">
            <a class="img-block" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
            <div class="text-box">
              <a href="<?php the_permalink(); ?>"><h4 class="text-cap"><?php the_title(); ?></h4></a>
              <p><?php echo htmlspecialchars_decode($detail_service); ?></p>
              <?php if($button ==true){ ?>
              <a class="text-cap view-more" href="<?php the_permalink(); ?>"><?php esc_html_e('View service','architect'); ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
    <?php endwhile; endif; ?>
  </div>
  </div>
  <?php }elseif($style=='style2'){ ?>
      <div class="row">
        <?php
          $args = array(
            'post_type' => 'service',
            'posts_per_page' => $number,
          );
          $wp_query = new WP_Query($args);
          if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
          $detail_service = get_post_meta(get_the_ID(),'_cmb_detail_service', true);
        ?>
        <div class="col-md-<?php if($column == 3){echo '4';}elseif($column == 4){echo '3';}else{echo '6';} ?>">
          <div class="block-img-full service-item">
            <a class="img-block" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
            <div class="text-box">
              <h4 class="text-cap"><?php the_title(); ?></h4>
              <p><?php echo htmlspecialchars_decode($detail_service); ?></p>
              <?php if($button ==true){ ?>
              <a class="text-cap view-more" href="<?php the_permalink(); ?>"><?php esc_html_e('View service','architect'); ?></a>
              <?php } ?>
            </div>
            
          </div>
        </div>
        <?php endwhile; endif; ?>
      </div>
  <?php }elseif($style =='style3'){ ?>
      <div class="row">
        <?php
        $i=0;
          $args = array(
            'post_type' => 'service',
            'posts_per_page' => $number,
          );
          $wp_query = new WP_Query($args);
          if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); $i++;
          $detail_service = get_post_meta(get_the_ID(),'_cmb_detail_service', true);
        ?>
        <div class="col-md-<?php if($column2 == 1){echo '12';}else{echo '6';} ?>">
          <div class="block-img-<?php if($i%2==1){echo 'right';}else{echo 'left';} ?>">
            <div class="img-block"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></div>
            <div class="text-box">
              <h4 class="text-cap"><?php the_title(); ?></h4>
              <p><?php echo htmlspecialchars_decode($detail_service); ?></p>
              <?php if($button ==true){ ?>
              <a class="text-cap view-more" href="<?php the_permalink(); ?>"><?php esc_html_e('View service','architect'); ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php endwhile; endif; ?>
      </div>
  <?php }else{ ?>
      <div class="row">
        <?php
        $i=1;
          $args = array(
            'post_type' => 'service',
            'posts_per_page' => $number,
          );
          $wp_query = new WP_Query($args);
          if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); $i++;
          $detail_service = get_post_meta(get_the_ID(),'_cmb_detail_service', true);
        ?>
        <div class="col-md-<?php if($column2 == 1){echo '12';}else{echo '6';} ?>">
          <div class="block-img-<?php if($i%2==1){echo 'right';}else{echo 'left';} ?>">
            <div class="img-block"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></div>
            <div class="text-box">
              <h4 class="text-cap"><?php the_title(); ?></h4>
              <p><?php echo htmlspecialchars_decode($detail_service); ?></p>
              <?php if($button ==true){ ?>
              <a class="text-cap view-more" href="<?php the_permalink(); ?>"><?php esc_html_e('View service','architect'); ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php endwhile; endif; ?>
      </div>
  <?php } ?>
  <?php
    return ob_get_clean();
}

// OT Process (new)
add_shortcode('ot_group', 'ot_group_func');
function ot_group_func($atts, $content = null){
  extract(shortcode_atts(array(
    'style'   => '',
    'titles'  => ''
  ), $atts));
  $titles = (array) vc_param_group_parse_atts( $titles );
  ob_start(); 
?>
<?php if($style=='style1'){ ?>
<div class="row">
<div class="process-2-container">
<?php 
  foreach ( $titles as $data ) {
    $data['title'] = isset( $data['title'] ) ? $data['title'] : '';
    $data['order'] = isset( $data['order'] ) ? $data['order'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
?>
    <div class="col-md-3">
      <div class="process-2-item">
        <span class="order"><?php echo $data['order']; ?></span><h4 class="text-cap"><?php echo $data['title']; ?></h4>
        <p><?php echo $data['desc']; ?></p>
      </div>
    </div>  
<?php } ?>
</div> 
</div>
<?php }else{ ?>
<div class="process-container">
<div id="sync5" class="owl-carousel owl-process clearfix">
<?php 
  foreach ( $titles as $data ) {
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
?>
    <div class="item ">
        <p><?php echo $data['desc']; ?></p>
    </div>  
<?php } ?>
</div> 
<div id="sync6" class="owl-carousel thumb-process-slide ">
<?php 
  foreach ( $titles as $data ) {
    $data['title'] = isset( $data['title'] ) ? $data['title'] : '';
    $data['order'] = isset( $data['order'] ) ? $data['order'] : '';
?>
  <div class="item">
    <div class="process-item mgb0">
       <span><?php echo $data['order']; ?></span>
       <p class="text-cap"><?php echo $data['title']; ?></p>
    </div>
  </div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php
    return ob_get_clean();
}

// OT Testimonial (new)
add_shortcode('ot_testimonialnew', 'ot_testimonialnew_func');
function ot_testimonialnew_func($atts, $content = null){
  extract(shortcode_atts(array(
    'style'   => '',
    'body'  => ''
  ), $atts));
  $body = (array) vc_param_group_parse_atts( $body );   
  ob_start(); 
?>
<?php if($style=='style1'){ ?>
<div class="row">
<div class="testimonial-warp testimonial-2-col">
  <div class="customNavigation">
    <a class="btn prev-testimonials-2-columns"><i class="fa fa-angle-left"></i></a>
    <a class="btn next-testimonials-2-columns"><i class="fa fa-angle-right"></i></a>
  </div>  
<div id="owl-testimonials-2-columns" class="owl-carousel owl-theme clearfix">
<?php 
  foreach ( $body as $data ) {
    $data['name'] = isset( $data['name'] ) ? $data['name'] : '';
    $data['job'] = isset( $data['job'] ) ? $data['job'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
    $data['image'] = isset( $data['image'] ) ? $data['image'] : '';
    $testi_img = wp_get_attachment_image_src($data['image'],'full');
    $testi_img = $testi_img[0];
?>
    <div class="item item-testimonials text-left">
        <p class="quote-icon">&#8220;</p>
        <p><i><?php echo $data['desc']; ?></i></p>
        <div class="avatar-testimonials">
          <img src="<?php echo $testi_img; ?>" class="img-responsive" alt="Image">
        </div>
        <h4 class="name-testimonials text-cap"><?php echo $data['name']; ?></h4>
        <span class="job-testimonials"><?php echo $data['job']; ?></span>
    </div> 
<?php } ?>
</div> 
</div>
</div>
<?php }else{ ?>
<div class="testimonial-warp testimonial-2-col testimonial-2-col-about">
  <?php 
  foreach ( $body as $data ) {
    $data['name'] = isset( $data['name'] ) ? $data['name'] : '';
    $data['job'] = isset( $data['job'] ) ? $data['job'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
    $data['image'] = isset( $data['image'] ) ? $data['image'] : '';
    $testi_img = wp_get_attachment_image_src($data['image'],'full');
    $testi_img = $testi_img[0];
  ?>
  <div class="col-md-6 ">
    <div class="item-testimonials  item-testimonials-about text-left">
      <p class="quote-icon">&#8220;</p>
      <p><i><?php echo $data['desc']; ?></i></p>
      <div class="avatar-testimonials">
        <img src="<?php echo $testi_img; ?>" class="img-responsive" alt="Image">
      </div>
      <h4 class="name-testimonials text-cap"><?php echo $data['name']; ?></h4>
      <span class="job-testimonials"><?php echo $data['job']; ?></span>
    </div>
  </div>
<?php } ?>
</div>
<?php } ?>
<?php
    return ob_get_clean();
}

// OT Testimonial 2 (new)
add_shortcode('ot_testimonialnew2', 'ot_testimonialnew2_func');
function ot_testimonialnew2_func($atts, $content = null){
  extract(shortcode_atts(array(
    'style'   => '',
    'imgnv1'   => '',
    'imgnv2'   => '',
    'body'  => ''
  ), $atts));
  $body = (array) vc_param_group_parse_atts( $body );    
  $imgnv1 = wp_get_attachment_image_src($imgnv1,'full');
  $imgnv1 = $imgnv1[0];
  $imgnv2 = wp_get_attachment_image_src($imgnv2,'full');
  $imgnv2 = $imgnv2[0];
  ob_start(); 
?>

<div class="testimonial-sync-container">
  <div class="customNavigation">
     <a class="btn prev-testimonial-sync"><img src="<?php echo esc_url($imgnv1); ?>" class="img-responsive" alt="Image"></a>
     <a class="btn next-testimonial-sync"><img alt="Image" src="<?php echo esc_url($imgnv2); ?>"></a>
  </div>
<div id="sync7" class="owl-carousel owl-testimonial-sync clearfix">
<?php 
  foreach ( $body as $data ) {
    $data['name'] = isset( $data['name'] ) ? $data['name'] : '';
    $data['job'] = isset( $data['job'] ) ? $data['job'] : '';
    $data['desc'] = isset( $data['desc'] ) ? $data['desc'] : '';
    $data['image'] = isset( $data['image'] ) ? $data['image'] : '';
    $testi_img = wp_get_attachment_image_src($data['image'],'full');
    $testi_img = $testi_img[0];
?>
    <div class="item ">
      <div class="item-testimonials large-avatar text-center">
         <div class="avatar-testimonials">
            <img src="<?php echo $testi_img; ?>" class="img-responsive" alt="Image">
         </div>
         <h4 class="name-testimonials text-cap"><?php echo $data['name']; ?></h4>
         <span class="job-testimonials"><?php echo $data['job']; ?></span>
         <p class="content-testimonials"><?php echo $data['desc']; ?></p>
      </div>
   </div>
<?php } ?>
</div> 
<div id="sync8" class="owl-carousel thumb-testimonial-sync-slide">
<?php 
  foreach ( $body as $data ) {
    $data['logo'] = isset( $data['logo'] ) ? $data['logo'] : '';
    $testi_lg = wp_get_attachment_image_src($data['logo'],'full');
    $testi_lg = $testi_lg[0];
?>
    <div class="item">
      <img src="<?php echo $testi_lg; ?>" class="img-responsive" alt="Image">
    </div>
<?php } ?>
</div>
</div>
<?php
    return ob_get_clean();
}

// Google Map 
add_shortcode('ggmap','ggmap_func');
function ggmap_func($atts, $content = null){
    extract( shortcode_atts( array(      
      'title'    => 'WE ARE ARCHITECT', 
      'info'    => 'Email: contact@architect.com',
      'lat'      => '',
      'long'     => '',
      'zoom'     => '',
      'icon'     => '',
      'gmap_custom_style' => '',
  ), $atts ) );

  $gmap_custom_style = rawurldecode( base64_decode( strip_tags( $gmap_custom_style ) ) );
  $icon1 = wp_get_attachment_image_src($icon,'full');
  $icon1 = $icon1[0];

  $id = uniqid( 'gmap-' );

  $zoom1 = (!empty($zoom) ? $zoom : 14);

  ob_start(); ?>

  	<div class="no-padding ">
      <div id="map-canvas" class=""></div>
    </div>

    <script type="text/javascript">
    	  (function($) { "use strict";
    
    //set your google maps parameters

    $(document).ready(function(){
        var latitude = <?php echo esc_attr($lat); ?>,
            longitude = <?php echo esc_attr($long); ?>,
            map_zoom = <?php echo esc_attr($zoom); ?>;

        var locations = [
            ['<div class="infobox"><span><?php echo htmlspecialchars_decode($title); ?><span></br><span><?php echo htmlspecialchars_decode($info); ?></span></div>'

            , latitude, longitude, 2]
        ];
    
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: map_zoom,
            scrollwheel: false,
            navigationControl: true,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            styles: [
              <?php echo $gmap_custom_style; ?>
            ]
        }
        ],
            center: new google.maps.LatLng(latitude, longitude),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    
        var infowindow = new google.maps.InfoWindow();
    
        var marker, i;
    
        for (i = 0; i < locations.length; i++) {  
      
            marker = new google.maps.Marker({ 
                position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
                map: map,
                icon: '<?php echo esc_url($icon1); ?>'
            });
        
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
        
    });

})(jQuery); 

    </script>

<?php
    return ob_get_clean();
}


// Google Map 2
add_shortcode('ggmap2','ggmap2_func');
function ggmap2_func($atts, $content = null){
    extract( shortcode_atts( array(   
      'body'      => '',
      'gmap_custom_style' => '',
  ), $atts ) );

  $body = (array) vc_param_group_parse_atts( $body );  
  $gmap_custom_style = rawurldecode( base64_decode( strip_tags( $gmap_custom_style ) ) );

  ob_start(); ?>

    <div class="row">
      <div class="col-md-3">
        <div class="sidebar-left sidebar-control-map">
          <div id="controls"></div>
        </div>
      </div>
    <div class="col-md-9">
      <div id="gmap-menu" style="width:100%;height:320px;"></div>
    </div>
    </div>

    <script type="text/javascript">
        (function($) { "use strict";
    
    //set your google maps parameters

    $(document).ready(function(){
        var LocsA = [
      <?php 
  foreach ( $body as $data ) {
    $data['lat'] = isset( $data['lat'] ) ? $data['lat'] : '';
    $data['long'] = isset( $data['long'] ) ? $data['long'] : '';
    $data['tit_tab'] = isset( $data['tit_tab'] ) ? $data['tit_tab'] : '';
    $data['title'] = isset( $data['title'] ) ? $data['title'] : '';
    $data['info'] = isset( $data['info'] ) ? $data['info'] : '';
    $map_img = wp_get_attachment_image_src($data['image'],'full');
    $map_img = $map_img[0];
    $data['zoom'] = isset( $data['zoom'] ) ? $data['zoom'] : '';
    $data['asas'] = isset( $data['asas'] ) ? $data['asas'] : '';
?>
    {
   lat: <?php echo $data['lat']; ?>,
        lon: <?php echo $data['long']; ?>,
        title: '<?php echo $data['tit_tab'] ?>',
        html: [ 
          '<h3><?php echo $data['title']; ?></h3>',
          '<p><?php echo $data['info']; ?></p>'
        ].join(''),
        icon: '<?php echo $map_img; ?>',
        show_infowindow: true,
        animation: google.maps.Animation.DROP,
        zoom:<?php echo $data['zoom']; ?>
    },
<?php } ?>
    
];



new Maplace({
    locations: LocsA,
    map_div: '#gmap-menu',
    controls_type: 'list',
    controls_on_map: false,
    map_options: {
  scrollwheel: false
  },
    start:1,
    styles: <?php echo $gmap_custom_style; ?>
}).Load();
        
    });

})(jQuery); 

    </script>

<?php
    return ob_get_clean();
}
