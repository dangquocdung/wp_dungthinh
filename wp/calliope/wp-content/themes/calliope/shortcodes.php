<?php 
global $pre_text;
$pre_text = 'OT ';

// Custom Heading

add_shortcode('heading','heading_func');

function heading_func($atts, $content = null){

	extract(shortcode_atts(array(
		'text'		=>	'',
		'tag'		=> 	'',
		'size'		=>	'',
		'color'		=>	'',
		'align'		=>	'',
		'bot'		=>	'',
		'class'		=>	'',
	), $atts));
	
	$size1 = (!empty($size) ? 'font-size: '.esc_attr($size).'px;' : '');
	$color1 = (!empty($color) ? 'color: '.esc_attr($color).';' : '');
	$align1 = (!empty($align) ? 'text-align: '.esc_attr($align).';' : '');
	$bot = (!empty($bot) ? 'margin-bottom: '.esc_attr($bot).';' : '');
	$cl = (!empty($class) ? ' class= "'.esc_attr($class).'"' : '');
	
	$html .= '<'.$tag.$cl.' style="' . $size1 . $align1 . $color1 . $bot .'">'. $text .'</'.$tag.'>';
	
	return $html;
}

// Button

add_shortcode('btneffect','btneffect_func');
function btneffect_func($atts, $content = null){
	extract(shortcode_atts(array(
		'btn'		=> 	'',
		'link'		=>	'',
		'hover'		=>	'',
		'target'	=>	'',
	), $atts));

	ob_start(); ?>

	<div class="cl-effect-10 effect-btn"><a <?php if($target) echo 'target="_blank"'; ?> <?php if($link) echo 'href='.esc_url($link); ?> data-hover="<?php echo esc_attr($hover); ?>"><span><?php echo esc_attr($btn); ?></span></a></div> 

	<?php

    return ob_get_clean();
}

// Slider Video
add_shortcode('slidervideo', 'slidervideo_func');
function slidervideo_func($atts, $content = null){
	extract(shortcode_atts(array(
		'mp4'		=> 	'',
		'webm'		=> 	'',
		'ogg'		=> 	'',
		'stext'		=>	'',
	), $atts));
	
	$img = wp_get_attachment_image_src($poster,'full');
	$img = $img[0];

	ob_start(); ?>
	
	<video id="video_background" preload="auto" autoplay loop muted volume="0"> 
		<?php if($webm || $mp4 ||$ogg) { ?>
			<source src="<?php echo esc_url($webm); ?>" type="video/webm"> 
			<source src="<?php echo esc_url($mp4); ?>" type="video/mp4"> 
			<source src="<?php echo esc_url($ogg); ?>" type="video/ogg">
		<?php } ?> 
	</video>
	<div class="just_pattern"></div>
	<?php if($stext) { ?><div class="small-text"><?php echo htmlspecialchars_decode($stext); ?></div><?php } ?>
	<div class="big-text flippy">
		<?php echo htmlspecialchars_decode($content); ?>
	</div>

	<?php

    return ob_get_clean();
}

// Home Slider
add_shortcode('homeslider', 'homeslider_func');
function homeslider_func($atts, $content = null){
	extract(shortcode_atts(array(
		'gallery'	=> 	'',
		'stext'		=>	'',
	), $atts));

	$img = wp_get_attachment_image_src($image,'full');
	$img = $img[0];

	ob_start(); ?>
	
	<div class="home-top-slider" id="slider-wrap">
		<div class="just_pattern"></div>	
		<div id="wrapper-slider">
			<div id="controls">
				<div class="prev"></div>
				<div class="next"></div>
			</div>
		</div>
		
		<a href="#scroll-link" class="scroll scroll-down"></a>
		
	</div>
	<?php if($stext) { ?><div class="small-text"><?php echo htmlspecialchars_decode($stext); ?></div><?php } ?>
	<div class="big-text flippy">
		<?php echo htmlspecialchars_decode($content); ?>
	</div>

	<script type="text/javascript">

		(function($) { "use strict";
		//Home Background Slider
		$(window).load(function () {
            $.mbBgndGallery.buildGallery({
                containment:"#slider-wrap",
                timer:2000,
                effTimer:3000,
                controls:"#controls",
                grayScale:false,
                preserveWidth:false,
                effect:"zoom",
//				effect:{enter:{transform:"scale("+(1+ Math.random()*2)+")",opacity:0},exit:{transform:"scale("+(Math.random()*2)+")",opacity:0}},

                // If your server all``ow directory listing you can use:
                // (however this doesn't work locally on your computer)

                //folderPath:"testImage/",

                // else:
                
                images:[
                <?php 
				$img_ids = explode(",",$gallery);
				foreach( $img_ids AS $img_id ){
				$image_src = wp_get_attachment_image_src($img_id,''); 
				$attachment = get_post( $img_id );?>
                 "<?php echo esc_js($image_src[0]); ?>",
                 <?php } ?>
                 ],

                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });
		});
		})(jQuery); 
	</script>

	<?php

    return ob_get_clean();
}


// Header Page

add_shortcode('headpage','headpage_func');
function headpage_func($atts, $content = null){
	extract(shortcode_atts(array(
		'title'		=> 	'',
		'color1'	=>	'',
		'color2'	=>	'',
	), $atts));

	ob_start(); ?>
	
	<div class="head-page">
		<?php if($title) { ?><h1 style="<?php if($color1) echo 'color:'.esc_attr($color1).';';?>"><?php echo htmlspecialchars_decode($title); ?></h1><?php } ?>
		<div class="sep-center" style="<?php if($color1) echo 'border-color:'.esc_attr($color1).';';?>"></div> 
		<?php if($content) { ?><p style="<?php if($color2) echo 'color:'.esc_attr($color2).';';?>"><?php echo htmlspecialchars_decode($content); ?></p><?php } ?>
	</div>

	<?php

    return ob_get_clean();
}


// Socials
add_shortcode('socslider','socslider_func');
function socslider_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon1'		=> 	'',
		'icon2'		=> 	'',
		'icon3'		=> 	'',
		'icon4'		=> 	'',
		'icon5'		=> 	'',
		'link1'		=> 	'',
		'link2'		=> 	'',
		'link3'		=> 	'',
		'link4'		=> 	'',
		'link5'		=> 	'',
	), $atts));

	ob_start(); ?>
	
	<div class="social-top">
		<?php if($icon1) { ?>
		<div class="icon-soc">
			<a target="_blank" href="<?php echo esc_url($link1); ?>"><i class="fa fa-<?php echo esc_attr($icon1); ?>"></i></a>
		</div>
		<?php } ?>
		<?php if($icon2) { ?>
		<div class="icon-soc">
			<a target="_blank" href="<?php echo esc_url($link2); ?>"><i class="fa fa-<?php echo esc_attr($icon2); ?>"></i></a>
		</div>
		<?php } ?>
		<?php if($icon3) { ?>
		<div class="icon-soc">
			<a target="_blank" href="<?php echo esc_url($link3); ?>"><i class="fa fa-<?php echo esc_attr($icon3); ?>"></i></a>
		</div>
		<?php } ?>
		<?php if($icon4) { ?>
		<div class="icon-soc">
			<a target="_blank" href="<?php echo esc_url($link4); ?>"><i class="fa fa-<?php echo esc_attr($icon4); ?>"></i></a>
		</div>
		<?php } ?>
		<?php if($icon5) { ?>
		<div class="icon-soc">
			<a target="_blank" href="<?php echo esc_url($link5); ?>"><i class="fa fa-<?php echo esc_attr($icon5); ?>"></i></a>
		</div>
		<?php } ?>
	</div>
	
	<?php

    return ob_get_clean();
}


// Our Team
add_shortcode('team', 'team_func');
function team_func($atts, $content = null){
	extract(shortcode_atts(array(
		'photo'		=> 	'',
		'name'		=>	'',
		'job'		=>	'',
		'lor'		=>	'',
		'icon1'		=>	'',
		'icon2'		=>	'',
		'icon3'		=>	'',
		'icon4'		=>	'',
		'url1'		=>	'',
		'url2'		=>	'',
		'url3'		=>	'',
		'url4'		=>	'',
	), $atts));

	$img = wp_get_attachment_image_src($photo,'full');
	$img = $img[0];
	$avatar = wp_get_attachment_image_src($ava,'full');
	$avatar = $avatar[0];
	$icon11 = (!empty($icon1) ? '<a href="'.esc_url($url1).'" target="_blank"><i class="fa fa-'.esc_attr($icon1).'"></i></a>' : '');
	$icon22 = (!empty($icon2) ? '<a href="'.esc_url($url2).'" target="_blank"><i class="fa fa-'.esc_attr($icon2).'"></i></a>' : '');
	$icon33 = (!empty($icon3) ? '<a href="'.esc_url($url3).'" target="_blank"><i class="fa fa-'.esc_attr($icon3).'"></i></a>' : '');
	$icon44 = (!empty($icon4) ? '<a href="'.esc_url($url4).'" target="_blank"><i class="fa fa-'.esc_attr($icon4).'"></i></a>' : '');
	$width1 = (!empty($width) ? 'width: '.$width.';' : '');

	ob_start(); ?>

	<div class="team-info<?php if($lor == 'left') echo '1'; ?>">
		<div class="team-img<?php if($lor == 'left') echo '1'; ?>">
			<img src="<?php echo esc_url($img); ?>" alt=""/>
		</div>
		<h6><?php echo htmlspecialchars_decode($name); ?></h6>
		<div class="team-subtext<?php if($lor == 'left') echo '1'; ?>"><?php echo htmlspecialchars_decode($job); ?></div>
		<p><?php echo htmlspecialchars_decode($content); ?></p>
		<div class="social-team<?php if($lor == 'left') echo '1'; ?>">
			<ul class="team-social">
				<?php if($icon1) { ?>
				<li class="icon-team">
					<?php echo htmlspecialchars_decode($icon11); ?>
				</li>
				<?php } ?>
				<?php if($icon2) { ?>
				<li class="icon-team">
					<?php echo htmlspecialchars_decode($icon22); ?>
				</li>
				<?php } ?>
				<?php if($icon3) { ?>
				<li class="icon-team">
					<?php echo htmlspecialchars_decode($icon33); ?>
				</li>
				<?php } ?>
				<?php if($icon4) { ?>
				<li class="icon-team">
					<?php echo htmlspecialchars_decode($icon44); ?>
				</li>
				<?php } ?>
			</ul>	
		</div>
	</div>

	<?php

    return ob_get_clean();
}


// Gallery Post
add_shortcode('folioslider', 'folioslider_func');
function folioslider_func($atts, $content = null){
	extract(shortcode_atts(array(
		'gallery'		=> 	'',
	), $atts));

	ob_start(); ?>
	
	<div class="project2">
		<ul class="bxslider">
			<?php 
			$img_ids = explode(",",$gallery);
			foreach( $img_ids AS $img_id ){
			$image_src = wp_get_attachment_image_src($img_id,''); 
			$attachment = get_post( $img_id );?>
				<li class="slide"><img src="<?php echo esc_url( $image_src[0] ); ?>" alt=""></li>
			<?php } ?>
		</ul>
	</div>	

	<?php

    return ob_get_clean();
}

// Video Player 
add_shortcode('videoplayer', 'videoplayer_func');
function videoplayer_func($atts, $content = null){
	extract(shortcode_atts(array(
		'video'  => 	'',
	), $atts));
	ob_start(); ?>
	<div class="video">
		<iframe width="1180" height="650" src="<?php echo esc_url($video); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff"></iframe>
	</div>
	<?php
    return ob_get_clean();
}


// Skills

add_shortcode('skill', 'skill_func');
function skill_func($atts, $content = null){
	extract(shortcode_atts(array(
		'name'		=> 	'',
		'per'		=> 	'',
	), $atts));

	ob_start(); ?>
	
	<ul class="skill">
		<li class="tipped" data-title="<?php echo esc_attr($name).' '.esc_attr($per); ?>"  data-tipper-options='{"direction":"right","follow":"true"}'><span class="bar bar-prc4" style="<?php echo 'width: '.esc_attr($per).';'; ?>"></span><p><?php echo htmlspecialchars_decode($name); ?></p></li>
	</ul>

	<?php

    return ob_get_clean();
}


// Testimonial
add_shortcode('testi', 'testi_func');
function testi_func($atts, $content = null){
	extract(shortcode_atts(array(
		'number'	=>		'',
	), $atts));

	ob_start(); ?>

	<div id="sync3" class="owl-carousel">
		<?php

			$args = array(

				'post_type' => 'testimonial',

				'posts_per_page' => $number,

			);

			$testimonial = new WP_Query($args);

			if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();

		?>		
		<?php $job = get_post_meta(get_the_ID(),'_cmb_job_testi', true); ?>
		<div class="item" >
			<div class="testi-wrap">
				<?php the_content(); ?>
				<h6><?php the_title(); if($job) { ?>, <small><em><?php echo htmlspecialchars_decode($job); ?></em></small><?php } ?></h6> 	
			</div>				
		</div>
		<?php endwhile; endif; ?>
	</div>
	<div id="sync4" class="owl-carousel">
		<?php

			$args = array(

				'post_type' => 'testimonial',

				'posts_per_page' => $number,

			);

			$testimonial = new WP_Query($args);

			if($testimonial->have_posts()) : while($testimonial->have_posts()) : $testimonial->the_post();

		?>
		<div class="item" >
			<div class="arrow-up"></div>
			<?php
 
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			 
			if ( is_plugin_active('meta-box/meta-box.php') ) { ?>
				<?php $images = rwmb_meta( '_cmb_logo_testi', "type=image" ); ?>
		        <?php                                                        
		        foreach ( $images as $image ) {                              
		        
		        $img = $image['full_url']; ?>
					<img src="<?php echo esc_url($img); ?>" alt="">	
		    <?php } } ?>
		</div>
		<?php endwhile; endif; ?>
	</div>	
	
	<?php

    return ob_get_clean();
}


// Header Portfolio
add_shortcode('headerfolio', 'headfolio_func');
function headfolio_func($atts, $content = null){
	extract(shortcode_atts(array(
		'title'		=> 	'',
		'sub1'		=> 	'',
		'sub2'		=> 	'',
	), $atts));

	ob_start(); ?>
	
	<div id="sep1">
		<div class="parallax2"></div>
		<div class="container z-index">
			<div class="twelve columns">
				<h1><?php echo htmlspecialchars_decode($title); ?></h1>
				<div class="sep-center"></div>
			</div>
			<div class="twelve columns">
				<div class="sub-font" data-typer-targets='{ "targets" : ["<?php echo htmlspecialchars_decode($sub1); ?>","<?php echo htmlspecialchars_decode($sub2); ?>"]}' ><?php echo htmlspecialchars_decode($sub1); ?></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php

    return ob_get_clean();
}

// Our Work

add_shortcode('workfilter', 'workfilter_func');
function workfilter_func($atts, $content = null){
	extract(shortcode_atts(array(
		'col'		 => '',
		'all'		 => '',
		'number'	 => '',
	), $atts));
	ob_start(); ?>

	<div id="portfolio-filter">
		<ul id="filter">
			<li><a href="#" class="current" data-filter="*" title=""><?php echo esc_attr($all); ?></a></li>
			<?php 

			$categories = get_terms('categories');   

			foreach( (array)$categories as $categorie){

				$cat_name = $categorie->name;

				$cat_slug = $categorie->slug;

			?>

			<li><a href="#" data-filter=".<?php echo esc_attr($cat_slug); ?>"><?php echo esc_attr($cat_name); ?></a></li>

			<?php } ?>
		</ul>
	</div>
	<ul class="portfolio-wrap">
		<?php 

			$args = array(

				'paged' => $paged,

				'post_type' => 'portfolio',

				'posts_per_page' => $number,

				);

			$wp_query = new WP_Query($args);

			while ($wp_query -> have_posts()): $wp_query -> the_post(); 

			$cates = get_the_terms(get_the_ID(),'categories');

			$cate_name ='';

			$cate_slug = '';

			    foreach((array)$cates as $cate){

					if(count($cates)>0){

						$cate_name .= $cate->name.'. ' ;

						$cate_slug .= $cate->slug .' ';     

					} 

			}

		?>
		<li class="four columns portfolio-box <?php echo esc_attr($cate_slug); ?>">	
			<a class="iframe group1" href="<?php the_permalink(); ?>">
				<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="" />
				<div class="mask"></div>
				<h4><?php the_title(); ?></h4>
			</a>
		</li>
		<?php endwhile;?>

	</ul>

	<?php
    return ob_get_clean();
}


// Blog List
add_shortcode('bloglist', 'bloglist_func');
function bloglist_func($atts, $content = null){
	extract(shortcode_atts(array(
		'number'	 => '',
	), $atts));
	$number1 = (!empty($number) ? $number : 5);
	ob_start(); ?>

	<?php $i=0; 
		$args = array(    		
			'post_type' => 'post',
			'posts_per_page' => $number1
			);

		$blog = new WP_Query($args);

		while ($blog -> have_posts()): $blog -> the_post(); ?>	
			<div class="blog-wrap <?php if($i%2 != 0) echo 'post2'; ?>">	
			<?php get_template_part( 'content', get_post_format() ) ; ?>
			</div>
		<?php $i++; endwhile;?>

		<?php wp_reset_postdata(); ?>

	<?php
    return ob_get_clean();
}

// Our Service
add_shortcode('servicebox', 'service_func');
function service_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon'		=> 	'',
		'title'		=>	'',
		'des'		=>	'',
	), $atts));

	ob_start(); ?>

	<div class="services-offer">
		<h6><?php echo htmlspecialchars_decode($title); ?></h6>
		<?php if($icon) { ?><div class="services-icon"><i class="fa fa-<?php echo esc_attr($icon); ?>"></i></div><?php } ?>
		<?php if($des) { ?><p><?php echo htmlspecialchars_decode($des); ?></p><?php } ?>
		<div class="services-list">
			<?php echo htmlspecialchars_decode($content); ?>
		</div>
	</div>

	<?php

    return ob_get_clean();
}

// Our Features
add_shortcode('ourfeatures', 'ourfeatures_func');
function ourfeatures_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon'		=> 	'',
		'title'		=>	'',
	), $atts));

	ob_start(); ?>

	<div class="last-services">
		<div class="icon-left1"><i class="fa fa-<?php echo esc_attr($icon); ?>"></i></div>
		<h6><?php echo htmlspecialchars_decode($title); ?></h6>
		<p><?php echo htmlspecialchars_decode($content); ?></p>
	</div>
	<?php

    return ob_get_clean();
}


// Contact Info

add_shortcode('ctinfo', 'ctinfo_func');
function ctinfo_func($atts, $content = null){
	extract(shortcode_atts(array(
		'icon'		=> 	'',
	), $atts));

	ob_start(); ?>
	
	<div class="con-info">
		<div class="con-icon"><i class="fa fa-<?php echo esc_attr($icon); ?>"></i></div>
		<?php echo htmlspecialchars_decode($content); ?>
	</div>

	<?php

    return ob_get_clean();
}


//Google Map

add_shortcode('maps','maps_func');
function maps_func($atts, $content = null){
	extract(shortcode_atts(array(
		'height'	 => '',
		'imgmap'	 	 => '',
		'tooltip'	 	 => '',
		'latitude'		 => '',
		'longitude'	 	 => '',
		'zoom'		 => '',
	), $atts));
	ob_start(); ?>
	<?php 
		$img = wp_get_attachment_image_src($imgmap,'full');
		$img = $img[0];
		if(!$zoom){
			$zoom = 14;
		}
	 ?>
	<div id="google_map" class="ggmap" style="<?php if($height) echo 'height: '.esc_attr($height).';';?>"></div>

	<script>
	
	//Google map	
		
	(function($) { "use strict"

		var e=new google.maps.LatLng(<?php echo esc_js($latitude); ?>,<?php echo esc_js($longitude); ?>),
		o={zoom:<?php echo esc_js($zoom); ?>,center:new google.maps.LatLng(<?php echo esc_js($latitude); ?>,<?php echo esc_js($longitude); ?>),
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl:!1,
		scrollwheel:!1,
		draggable:!0,
		navigationControl:!1
		},
		n=new google.maps.Map(document.getElementById("google_map"),o);
		google.maps.event.addDomListener(window,"resize",function(){var e=n.getCenter();
		google.maps.event.trigger(n,"resize"),n.setCenter(e)});
		
		var g='<div class="map-tooltip"><h6><?php echo esc_js($tooltip); ?></h6></div>',a=new google.maps.InfoWindow({content:g})
		,t=new google.maps.MarkerImage("<?php echo esc_js($img); ?>",new google.maps.Size(40,70),
		new google.maps.Point(0,0),new google.maps.Point(20,55)),
		i=new google.maps.LatLng(<?php echo esc_js($latitude); ?>,<?php echo esc_js($longitude); ?>),
		p=new google.maps.Marker({position:i,map:n,icon:t,zIndex:3});
		google.maps.event.addListener(p,"click",function(){a.open(n,p)});
		<?php if($showgmap != 'optionmap2'){ ?>			
			$(".button-map").click(function(){$("#google_map").slideToggle(300,function(){google.maps.event.trigger(n,"resize"),n.setCenter(e)}),
			$(this).toggleClass("close-map show-map")});
		<?php } ?>
	
	})(jQuery);

	</script>

	<?php

    return ob_get_clean();

}