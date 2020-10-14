<?php

/*
 * Template Name: Coming Soon Page
 * Description: A Page Template.
 */

//get_header(); ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php global $architect_option; ?>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body>
<section id="section-coming-soon" class="coming-soon no-padding">
    <div class="container">
        <div class="coming-soon-content text-center">              
            <div class="intro-text">
                <h2><?php echo esc_attr($architect_option['title_cs']); ?></h2>
                <p><?php echo htmlspecialchars_decode($architect_option['stitle_cs']); ?></p>
            </div>
            <div class="newsletter-comingsoon">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/plugins/newsletter/do/subscribe.php" method="post">                        
                    <input class="form-control newsletter-email" name="s" type="email" placeholder="<?php echo esc_html_e('Your Email Address','architect'); ?>">
                    <button class="ot-btn btn-main-color btn-submit" type="submit" ><i class="fa fa-paper-plane"></i> <?php echo esc_html_e('Subscribe','architect'); ?></button>
                </form>
            </div>
                             
                <ul class="countdown">
                  <li> 
                    <span class="days">00</span>
                    <p class="days_ref"><?php echo esc_html_e('days','architect'); ?></p>
                  </li>
                  <li>
                    <span class="hours">00</span>
                    <p class="hours_ref"><?php echo esc_html_e('hours','architect'); ?></p>
                  </li>
                  <li> 
                    <span class="minutes">00</span>
                    <p class="minutes_ref"><?php echo esc_html_e('minutes','architect'); ?></p>
                  </li>
                  <li>
                    <span class="seconds">00</span>
                    <p class="seconds_ref"><?php echo esc_html_e('seconds','architect'); ?></p>
                  </li>
                </ul>
            
            <ul class="social social-dark">
              <?php if($architect_option['facebook']!=''){ ?>
              <li class="facebook"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
              <?php } ?>
              <?php if($architect_option['twitter']!=''){ ?>
                  <li class="twitter"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
              <?php } ?>
              <?php if($architect_option['google']!=''){ ?>
                  <li class="google-plus"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['google']); ?>"><i class="fa fa-google-plus"></i></a></li>
              <?php } ?>  
              <?php if($architect_option['youtube']!=''){ ?>
                  <li class="youtube"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['youtube']); ?>"><i class="fa fa-youtube-play"></i></a></li>
              <?php } ?>
              <?php if($architect_option['linkedin']!=''){ ?>
                  <li class="linkedin"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li>
              <?php } ?>  
              <?php if($architect_option['pinterest']!=''){ ?>
                  <li class="pinterest"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li>
              <?php } ?>
              <?php if($architect_option['flickr']!=''){ ?>
                  <li class="flickr"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['flickr']); ?>"><i class="fa fa-flickr"></i></a></li>
              <?php } ?>
              <?php if($architect_option['instagram']!=''){ ?>
                   <li class="instagram"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['instagram']); ?>"><i class="fa fa-instagram"></i></a></li>            
              <?php } ?>
              <?php if($architect_option['github']!=''){ ?>
                  <li class="github"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['github']); ?>"><i class="fa fa-github"></i></a></li>
              <?php } ?>
              <?php if($architect_option['dribbble']!=''){ ?>
                  <li class="dribbble"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['dribbble']); ?>"><i class="fa fa-dribbble"></i></a></li>
              <?php } ?>
              <?php if($architect_option['behance']!=''){ ?>
                  <li class="behance"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['behance']); ?>"><i class="fa fa-behance"></i></a></li>
              <?php } ?>  
              <?php if($architect_option['skype']!=''){ ?>
                   <li class="skype"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['skype']); ?>"><i class="fa fa-skype"></i></a></li>
              <?php } ?>
              <?php if($architect_option['vimeo']!=''){ ?>
                  <li class="vimeo"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['vimeo']); ?>"><i class="fa fa-vimeo"></i></a></li>
              <?php } ?>  
              <?php if($architect_option['tumblr']!=''){ ?>
                  <li class="tumblr"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['tumblr']); ?>"><i class="fa fa-tumblr"></i></a></li>
              <?php } ?>
              <?php if($architect_option['soundcloud']!=''){ ?>
                  <li class="soundcloud"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['soundcloud']); ?>"><i class="fa fa-soundcloud"></i></a></li>
              <?php } ?>
              <?php if($architect_option['lastfm']!=''){ ?>
                  <li class="lastfm"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['lastfm']); ?>"><i class="fa fa-lastfm"></i></a></li>            
              <?php } ?>
              <?php if($architect_option['rss']!=''){ ?>
                  <li class="rss"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['rss']); ?>"><i class="fa fa-rss"></i></a></li>            
              <?php } ?>
              <?php if($architect_option['email']!=''){ ?>
                  <li class="email"><a class="social-icon" target="_blank" href="<?php echo esc_url($architect_option['email']); ?>"><i class="fa fa-envelope"></i></a></li>            
              <?php } ?>
            </ul>
        </div>   
        <div class="overley-cs" <?php if($architect_option['bg_cs']['url'] != ''){ ?> style="background-image:url(<?php echo esc_url($architect_option['bg_cs']['url']); ?>)"<?php } ?>></div>          
    </div>
</section>

<script type="text/javascript">
  /**
   * downCount: Simple Countdown clock with offset
   * Author: Sonny T. <hi@sonnyt.com>, sonnyt.com
   */

  (function ($) {
    $.fn.downCount = function (options, callback) {
      var settings = $.extend({
          date: null,
          offset: null
        }, options);

      // Throw error if date is not set
      if (!settings.date) {
        $.error('Date is not defined.');
      }

      // Throw error if date is set incorectly
      if (!Date.parse(settings.date)) {
        $.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
      }

      // Save container
      var container = this;

      /**
       * Change client's local date to match offset timezone
       * @return {Object} Fixed Date object.
       */
      var currentDate = function () {
        // get client's current date
        var date = new Date();

        // turn date to utc
        var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

        // set new Date object
        var new_date = new Date(utc + (3600000*settings.offset))

        return new_date;
      };

      /**
       * Main downCount function that calculates everything
       */
      function countdown () {
        var target_date = new Date(settings.date), // set target date
          current_date = currentDate(); // get fixed current date

        // difference of dates
        var difference = target_date - current_date;

        // if difference is negative than it's pass the target date
        if (difference < 0) {
          // stop timer
          clearInterval(interval);

          if (callback && typeof callback === 'function') callback();

          return;
        }

        // basic math variables
        var _second = 1000,
          _minute = _second * 60,
          _hour = _minute * 60,
          _day = _hour * 24;

        // calculate dates
        var days = Math.floor(difference / _day),
          hours = Math.floor((difference % _day) / _hour),
          minutes = Math.floor((difference % _hour) / _minute),
          seconds = Math.floor((difference % _minute) / _second);

          // fix dates so that it will show two digets
          days = (String(days).length >= 2) ? days : '0' + days;
          hours = (String(hours).length >= 2) ? hours : '0' + hours;
          minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
          seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

        // based on the date change the refrence wording
        var ref_days = (days === 1) ? 'day' : '<?php esc_html_e('days', 'architect');  ?>',
          ref_hours = (hours === 1) ? 'hour' : '<?php esc_html_e('hours', 'architect');  ?>',
          ref_minutes = (minutes === 1) ? 'minute' : '<?php esc_html_e('minutes', 'architect');  ?>',
          ref_seconds = (seconds === 1) ? 'second' : '<?php esc_html_e('seconds', 'architect');  ?>';
          

        // set to DOM
        container.find('.days').text(days);
        container.find('.hours').text(hours);
        container.find('.minutes').text(minutes);
        container.find('.seconds').text(seconds);

        container.find('.days_ref').text(ref_days);
        container.find('.hours_ref').text(ref_hours);
        container.find('.minutes_ref').text(ref_minutes);
        container.find('.seconds_ref').text(ref_seconds);
      };
      
      // start
      var interval = setInterval(countdown, 1000);
    };

  })(jQuery); 
  
  (function($) { "use strict";      
    //Timer
    $('.countdown').downCount({
      date: '<?php echo htmlspecialchars_decode($architect_option['date_cs']); ?> 12:00:00',
      offset: +10
    }, function () {
      alert('WOOT WOOT, done!');
    }); 
  })(jQuery);
</script>

<?php wp_footer(); ?>
</body>
</html>