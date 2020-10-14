<?php
/* add_ons_php */
if(!isset($mp4)) $mp4 = '';
if(!isset($vimeo)) $vimeo = '';
if(!isset($youtube)) $youtube = '';
if(!isset($photos)) $photos = array();
if(!isset($azp_attrs)) $azp_attrs = array();
$images_size = 'full';
if( !empty($azp_attrs['images_size']) ) $images_size = $azp_attrs['images_size'];
$bgimg = '';
if(!empty($photos)){
    $bgimg = townhub_addons_get_attachment_thumb_link( reset($photos), $images_size );
} 


?>
<section class="listing-hero-section hidden-section" data-scrollax-parent="true" id="lhead_sec">
	<div class="bg-parallax-wrap">
        <div class="media-container video-parallax">
            <div class="bg mob-bg par-elem" data-bg="<?php echo esc_url( $bgimg ); ?>"></div>
        <?php 
	        if( $youtube != '') : 

	            $mute = !empty($azp_attrs['unmuted']) && $azp_attrs['unmuted'] != 'yes' ? '1' : '0';
	            $quality = 'highres'; // 'default','small','medium','large','hd720','hd1080'
	            $fittobackground = '1';
	            $pauseonscroll = '0';
	            $loop = '1';
	            // Hg5iNVSp2z8
	        ?>
	        <div  class="background-youtube-wrapper" data-vid="<?php echo esc_attr( $youtube );?>" data-mt="<?php echo esc_attr( $mute );?>" data-ql="<?php echo esc_attr( $quality );?>" data-ftb="<?php echo esc_attr( $fittobackground );?>" data-pos="<?php echo esc_attr( $pauseonscroll );?>" data-rep="<?php echo esc_attr( $loop );?>"></div>
	    <?php 
	        elseif( $vimeo != '') : 
	            $dataArr = array();
	            $dataArr['video'] = esc_attr( $vimeo );
	            $dataArr['quality'] = '1080p'; // '4K','2K','1080p','720p','540p','360p'
	            $dataArr['mute'] = !empty($azp_attrs['unmuted']) && $azp_attrs['unmuted'] != 'yes' ? '1' : '0';
	            $dataArr['loop'] = '1';
	            // 97871257
	            ?>
	        <div class="video-holder">
	            <div  class="background-vimeo" data-opts='<?php echo json_encode( $dataArr );?>'></div>
	        </div>
	    <?php else : 
	        $video_attrs = ' autoplay';
	        if( !empty($azp_attrs['unmuted']) && $azp_attrs['unmuted'] != 'yes' ) $video_attrs .=' muted';
	        $video_attrs .=' loop';
	    ?>
	        <div class="video-container">
	            <video<?php echo esc_attr( $video_attrs );?> class="bgvid">
	                <source src="<?php echo esc_url( $mp4 );?>" type="video/mp4" data-scrollax="properties: { translateY: '30%' }">
	            </video>
	        </div>
	    <?php endif; ?>

        </div>
        <div class="overlay"></div>
    </div>
    <div class="container">

        <?php townhub_addons_get_template_part( 'template-parts/single/head_infos', '', array('azp_attrs'=>$azp_attrs) ); ?>
        
    </div>
</section>