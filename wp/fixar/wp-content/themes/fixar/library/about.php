<?php
function pix_add_adminpanel() {
	add_theme_page('About Theme', 'About fixar', 'administrator', 'adminpanel', 'adminpanel');
}


if (current_user_can('switch_themes')) {
    add_action('admin_menu', 'pix_add_adminpanel');
}

function adminpanel() {

	global $theme_name, $shortname, $options;

  $phpv = phpversion();
  $res_phpv = ( (float)$phpv < 5.6 ) ? "fa-close" : "fa-check";

  $max_execution_time = ini_get('max_execution_time');
  $res_max_execution_time = ( (int)$max_execution_time < 360 ) ? "fa-close" : "fa-check";

  $memory_limit = ini_get('memory_limit');
  $res_memory_limit = ( (int)$memory_limit < 128 ) ? "fa-close" : "fa-check";

  $post_max_size = ini_get('post_max_size');
  $res_post_max_size = ( (int)$post_max_size < 32 ) ? "fa-close" : "fa-check";

  $upload_max_filesize = ini_get('upload_max_filesize');
  $res_upload_max_filesize = ( (int)$upload_max_filesize < 32 ) ? "fa-close" : "fa-check";

  echo wp_kses_post("<div class='pix_about'>
      <div class='pix_about_header'>
          <h1 class='pix_about_title'>" . esc_html__("Welcome to Fixar Wordpress Theme", "fixar") . "</h1>
          <div class='pix_about_description'>
              <p>" . esc_html__("Thank you for purchasing our theme.", "fixar") . "</p>
             
          </div>
      </div>
      <div id='pix_about_tabs' class='pix_tabs pix_about_tabs'>
          <ul class='ui-tabs-nav pix-tabs'>
              <li class='ui-state-active'>
                  <a href='#pix_theme_about' class='ui-tabs-anchor' >" . esc_html__("Getting started", "fixar") . "</a>
              </li>
              <li>
                  <a href='#pix_theme_requirements' class='ui-tabs-anchor'>" . esc_html__("Requirements", "fixar") . "</a>
              </li>
              <li>
                  <a href='#pix_theme_changelog' class='ui-tabs-anchor'>" . esc_html__("Changelog", "fixar") . "</a>
              </li>
          </ul>
          <div id='pix_theme_about' class='pix_tabs_section pix_about_section'>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-network'></i>
                          " . esc_html__("Theme activation", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>");
                          echo esc_attr(get_option('pix_theme_code'));
                          if ( class_exists( 'Envato_Market' ) ) {
                              echo wp_kses_post("<p>" . esc_html__("Activate this theme using Envato API Connection and get all the premium features and theme auto-update. ", "fixar") . "</p>");
                              echo wp_kses_post("<a href='" . esc_url(admin_url('admin.php?page=envato-market')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Activate this theme", "fixar") . "</a>");
                          } else {
                              
                              echo wp_kses_post("<p>" . esc_html__("Please install a plugin Envato Market and get all the premium features and theme auto-update.", "fixar") . "</p>
                              
                              
                              <a href='" . admin_url('themes.php?page=tgmpa-install-plugins') . "' class='pix_about_block_link button button-primary'>" . esc_html__("Install plugins", "fixar") . "</a>");
                          }
                      echo wp_kses_post("</div>
                  </div>
              </div>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-book'></i>
                          " . esc_html__("Read full documentation", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Need more details? Please check our full online documentation for detailed information on how to use fixar.", "fixar") . "
                      </div>
                      <a href='" . esc_url('http://fixar.templines.org/documentation/') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("Documentation", "fixar") . "</a>
                  </div>
              </div>");
          if ( !TGM_Plugin_Activation::get_instance()->is_tgmpa_complete() ) {
              echo wp_kses_post("<div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-plugins'></i>
                          " . esc_html__("Recommended plugins", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Theme fixar is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.", "fixar") . "
                      </div>
<a href='" . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Install plugins", "fixar") . "</a>
                  </div>
              </div>");            
          }
              echo wp_kses_post("<div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-customizer'></i>
                          " . esc_html__("Demo import", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme.	It will allow you to quickly edit everything instead of creating content from scratch.", "fixar") . "
                      </div>
                      <a href='" . esc_url(admin_url('themes.php?page=pt-one-click-demo-import')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Import", "fixar") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-appearance'></i>
                          " . esc_html__("Setup Theme options", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Using the WordPress Customizer you can easily customize every aspect of the theme. ", "fixar") . "
                      </div>
                      <a href='" . esc_url(admin_url('customize.php')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Customizer", "fixar") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-appearance'></i>
                          " . esc_html__("Kawara addons", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("For the construction of our theme, we use Kaswara addons . This add-on for WPBakery Page Builder (formerly Visual Composer) . With this module you can create different pages without any limits .  ", "fixar") . "
                      </div>
                      <a href='" . esc_url(admin_url('admin.php?page=kaswara-framework')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Kaswara Addons", "fixar") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-sos'></i>
                          " . esc_html__("Support", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("This theme comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest. Envato Elements does not provide technical support for this theme.", "fixar") . "
                      </div>
                      <a href='" . esc_url('http://support.templines.com/') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("Support", "fixar") . "</a>
                  </div>
              </div>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-images-alt2'></i>
                          " . esc_html__("On-line demo", "fixar") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Visit the Demo Version of fixar to check out all the features it has", "fixar") . "
                      </div>
                      <a href='" . esc_url('http://fixar.templines.org/') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("View demo", "fixar") . "</a>
                  </div>
              </div>
          </div>
          <div id='pix_theme_changelog' class='pix_tabs_section pix_about_section' style='display: none;'>
          
          
          
          <h2 class='pix_about_block_title'>" . esc_html__("Version 1.2.4 (14.08.2018)", "fixar") . "</h2>   
          
           <ul>
                      <li>" . esc_html__("Update google Map key ","fixar") ."</li>
                  </ul> 
                   <code>" . esc_html__(" style.css ","fixar") ."</code><br>
                  <code>" . esc_html__(" js/custom-admin.js ","fixar") ."</code><br>
                  <code>" . esc_html__(" library/core/admin/admin-panel/style.php ","fixar") ."</code><br>
                  
                  
                     <hr>
                     
                     
              <div class='pix_about_block_inner'>
              
              
               <h2 class='pix_about_block_title'>" . esc_html__("Version 1.2.3 (06.08.2018)", "fixar") . "</h2>      
                  <ul>
                      <li>" . esc_html__("Mobile form fixed","fixar") ."</li>
                  </ul> 
                  <code>" . esc_html__(" style.css ","fixar") ."</code><br>
                   <code>" . esc_html__(" css/responsive.css ","fixar") ."</code><br>
                  
                  <hr>
                  
                  
              
                  <h2 class='pix_about_block_title'>" . esc_html__("Version 1.2 (17.07.2018)", "fixar") . "</h2>      
                  <ul>
                      <li>" . esc_html__("Minify js fixed","fixar") ."</li>
                  </ul> 
                  <code>" . esc_html__(" assets/minify ","fixar") ."</code><br>
                  
                  <hr>
                  
                  
                  
                  <h2 class='pix_about_block_title'>" . esc_html__("Version 1.03 (01.07.2018)", "fixar") . "</h2>      
                  <ul>
                      <li>" . esc_html__("Woocommerce attributes fixed ","fixar") ."</li>
                  </ul> 
                  <code>" . esc_html__(" library/core/global/functions.php ","fixar") ."</code><br>
                  
                  <hr>
                  
                  <h2 class='pix_about_block_title'>" . esc_html__("Version 1.02 (18.05.2018)", "fixar") . "</h2>      
                  <ul>
                      <li>" . esc_html__("Globaly update ","fixar") ."</li>
                  </ul> 
                  <code>" . esc_html__(" All files and plugings ","fixar") ."</code><br>
                  
                  <hr>
                  
              </div>
          </div>
          <div id='pix_theme_requirements' class='pix_tabs_section pix_about_section' style='display: none;'>
              <div class='pix_about_block_inner requirements_inner'>
                  <h2>" . esc_html__("Theme requirements","fixar") ."</h2>
                  <p>" . esc_html__("All of our server requirements are minimal and are recommended by WordPress team .","fixar") ."</p>
<p>" . wp_kses_post("

Contact your web host and ask them to increase those limits to a minimum as follows:","fixar") ."</p>
                  <ul class='theme-requirement-list'>
                      <li>
                      
                          <code>PHP 5.6</code>
                          <i class='fa " . esc_attr($res_phpv) . "'></i>
                          <p>Currently: " . esc_attr($phpv) . "</p>
                      </li>
                      <li>
                      
                          <code>max_execution_time 360</code>
                          <i class='fa " . esc_attr($res_max_execution_time) . "'></i>
                          <p>Currently: " . esc_attr($max_execution_time) . "</p>
                      </li>
                      <li>
                       
                          <code>memory_limit 128M</code>
                         <i class='fa " . esc_attr($res_memory_limit) . "'></i>
                          <p>Currently: " . esc_attr($memory_limit) . "</p>
                      </li>
                      <li>
                     
                          <code>post_max_size 32M</code>
                           <i class='fa " . esc_attr($res_post_max_size) . "'></i>
                          <p>Currently: " . esc_attr($post_max_size) . "</p>
                      </li>
                      <li>
                     
                          <code>upload_max_filesize 32M</code>
                           <i class='fa " . esc_attr($res_upload_max_filesize) . "'></i>
                          <p>Currently: " . esc_attr($upload_max_filesize) . "</p>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div> ");

}
