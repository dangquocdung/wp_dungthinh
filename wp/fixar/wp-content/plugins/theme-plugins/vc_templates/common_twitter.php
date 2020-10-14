<?php
$transName = $cacheTime = $carousel_class = '';

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $username
 * @var $consumer_key
 * @var $consumer_secret
 * @var $access_token
 * @var $access_token_secret
 * @var $num_of_tweets
 * @var $disable_carousel
 * @var $autoplay
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Common_Twitter
 */
$title = $username = $consumer_key = $consumer_secret = $access_token = $access_token_secret =
$num_of_tweets = $disable_carousel = $autoplay = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$transName = 'vc_list_tweets'.$username;
$cacheTime = 20;
$carousel_class = $carousel == 1 ? 'enable-owl-carousel' : 'disable-owl-carousel';
$twitter_autoplay = is_numeric($autoplay) && $autoplay > 0 ? $autoplay : 'false';
$out = '';

use Abraham\TwitterOAuth\TwitterOAuth;

$out .= '<div class="twitter">';

if( !empty($username) && !empty($consumer_key) && !empty($consumer_secret) && !empty($access_token) && !empty($access_token_secret)  ){
	$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
	if(false === ($twitterData = get_transient($transName) ) ){

		$twitterConnection = new TwitterOAuth( $consumer_key , $consumer_secret , $access_token , $access_token_secret	);
		$twitterData = $twitterConnection->get(
				  'statuses/user_timeline',
				  array(
					'screen_name'     => $username ,
					'count'           => $num_of_tweets
					)
				);

		if($twitterConnection->getLastHttpCode() !== 200)
		{
			$twitterData = get_transient($transName);
		}
		// Save our new transient.
		set_transient($transName, $twitterData, 60 * $cacheTime);
	}

	if( !empty($twitterData) && is_array($twitterData)  && !isset($twitterData['error'])){
		$i=0;
		$hyperlinks = true;
		$encode_utf8 = true;
		$twitter_users = true;
		$update = true;
$out .= '
		<article>
		<i class="fa fa-twitter"></i>
		<div class="'.esc_attr($carousel_class).' owl-carousel owl-theme" data-items="1" data-responsive-items="1" data-pagination="false"  data-navigation="true" data-autoplay="'.esc_attr($twitter_autoplay).'">';

		foreach($twitterData as $item){
				$msg = $item->text;
				$permalink = esc_url('http://twitter.com/#!/'. $username .'/status/'. $item->id_str);
				if($encode_utf8) $msg = utf8_encode($msg);
					$link = $permalink;
$out .= '
			<div class="twitter-feed">
		';
				if ($hyperlinks) { $msg = $this->hyperlinks($msg); }
				if ($twitter_users) { $msg = $this->twitter_users($msg); }
$out .= '<p>'.wp_kses_post($msg).'</p>';
				if($update) {
					$time = strtotime($item->created_at);
					if ( ( abs( time() - $time) ) < 86400 )
						$h_time = sprintf( __('%s ago', 'fixar'), human_time_diff( $time ) );
					else
						$h_time = date(esc_html__('Y/m/d', 'fixar'), $time);
$out .= sprintf( __('%s', 'fixar'),' <div class="tw-fot"><a href="'.esc_url('http://twitter.com/'.$username).'">@'.esc_html($username).'</a> <cite title="' . date(esc_html__('Y/m/d H:i:s', 'fixar'), $time) . '">' . wp_kses_post($h_time) . '</cite></div>' );
				}
$out .= '
			</div>
';
				$i++;
				if ( $i >= $num_of_tweets ) break;
		}
$out .= '
		</div>
	</article>
';
	} else {
		$out .= esc_attr__('Sorry , Twitter seems down or responds slowly.', 'fixar');
	}
}
else{
		$out .= esc_attr__('You need to Setup Twitter API OAuth settings first', 'fixar');
}

$out .= '</div>';

echo $out;