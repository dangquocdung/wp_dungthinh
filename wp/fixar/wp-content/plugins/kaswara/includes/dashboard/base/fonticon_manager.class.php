<?php 
/**
* Kaswar Font Icon Manager 
*/
if(!class_exists('Kaswara_Icon_Manager')){

	class Kaswara_Icon_Manager{		
		function __construct(){
			
		}

		//Function to Upload The Zip Icon Files
		static function upload_font_icon($icon_zip,$icon_set_name){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_path = $destination['path']; $dest_basedir = $destination['basedir'];		
			//Creating the Kaswara Directory to store icon fonts
			if(!is_dir($dest_basedir.'/'.'kaswara') ){
				wp_mkdir_p($dest_basedir.'/'.'kaswara');
			}
			if(is_dir($dest_basedir.'/'.'kaswara') ){
				$font_path = $dest_basedir.'/'.'kaswara/fonts_icon/'.$icon_set_name;
				wp_mkdir_p($font_path);
				$unzipfile = unzip_file( $destination_path.'/'.$icon_zip, $font_path);
				kaswara_delete_allfiles($font_path);

			}
		}

		//Function to Return The Array Of Icons
		static function get_font_icons(){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_path = $destination['path']; $dest_basedir = $destination['basedir'];			
			$fonticons_dir = $dest_basedir.'/'.'kaswara/fonts_icon';
			$fonticons_array = array();
			if(is_dir($fonticons_dir)){
				$directories = glob($fonticons_dir . '/*' , GLOB_ONLYDIR);				
				foreach ($directories as $directory) {
					array_push($fonticons_array, basename($directory));
				}
			}
			
			$plugin_dir = WP_PLUGIN_DIR;			
			$fil_dir = $plugin_dir . '/font-icons-loader/fonts/';
			if(is_dir($fil_dir)){
				$directories = glob($fil_dir . '/*' , GLOB_ONLYDIR);					
				foreach ($directories as $directory) {
					array_push($fonticons_array, basename($directory));
				}
			}						
			
			return $fonticons_array;
		}

		//Function to Delete the Font set
		static function delete_font_set($fontname){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_path = $destination['path']; $dest_basedir = $destination['basedir'];					
			$fonticons_dir = $dest_basedir.'/'.'kaswara/fonts_icon/'.$fontname;
			kswr_delete_allfolder($fonticons_dir);			
			
			$plugin_dir = WP_PLUGIN_DIR;			
			$fil_dir = $global_plugin_dir . '/font-icons-loader/fonts/' . $fontname;			
			kswr_delete_allfolder($fil_dir);
			
		}

		//Function to Load Icons Styles
		static function get_font_icons_load_styles($fontarray){
		
            $active_fonts = get_option('fil_font_icons');
		
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_baseurl = $destination['baseurl'];
			
			$plugin_url = plugins_url( );			
			$fil_url = $plugin_url . '/font-icons-loader/fonts/';
			
			foreach ($fontarray as $font) {
			
                
				$style = $dest_baseurl.'/'.'kaswara/fonts_icon/'.$font.'/style.css';		
				if ( checkCssFileExistKaswara($font) ){
                    wp_enqueue_style( $font.'-icons-set',$style);   
				}else{	
                    if (!in_array($font, array_keys($active_fonts)))
                        continue;
                    $style = $fil_url.$font.'/style.css';		
                    if ( checkCssFileExistFIC($font) ){
                        wp_enqueue_style( $font.'-icons-set',$style);   
                    }
				}
				
			}
		}
		static function get_font_icons_load_single_style($fname){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_baseurl = $destination['baseurl'];
			
			
			
			
			$style = $dest_baseurl.'/'.'kaswara/fonts_icon/'.$fname.'/style.css';	
			
			$plugin_url = plugins_url( );			
			$fil_url = $plugin_url . '/font-icons-loader/fonts/';
			
			if ( checkCssFileExistKaswara($fname) ){
                echo '<link rel="stylesheet" type="text/css" href="'.$style.'">';
			}else{
			
                $active_fonts = get_option('fil_font_icons');
                if (!in_array($fname, array_keys($active_fonts)))
                    return '';
			
                $style = $fil_url.$fname.'/style.css';	
                if ( checkCssFileExistFIC($fname) ){
                    echo '<link rel="stylesheet" type="text/css" href="'.$style.'">';
                }
			}
			
			
		}



		//Function to Print The Icon Styles
		static function get_font_icons_printer($fontarray){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_baseurl = $destination['baseurl']; $dest_basedir = $destination['basedir'];
			$plugin_dir = WP_PLUGIN_DIR;			
			$fil_dir = $plugin_dir . '/font-icons-loader/fonts/';
			
			foreach ($fontarray as $font) {
			
                
				$json_content = checkSelectionFileExistKaswara($dest_basedir .'/'.'kaswara/fonts_icon/'.$font.'/selection.json');				
				
				if($json_content !== false){
					$selection = json_decode($json_content, true);
					$classname = $selection['preferences']['fontPref']['prefix'];
					$iconsList = $selection['icons'];
					echo '<div class="kswr-back-fonticon-container" data-iconset-name="'.$font.'"><div class="kswr-back-fonticon-title">'.$font.'<div class="thatred kswr-back-intit-button" data-fonticon-name="'.$font.'" onclick="kaswara_remove_fonticon(this);">'.esc_html__('Remove','kaswara').'</div></div>';
					foreach ($iconsList as $icon) {
						kaswara_print_single_icon_back($icon,$classname,false);	
					}
					echo '</div>';					
				}
				
				$active_fonts = get_option('fil_font_icons');
                if (!in_array($font, array_keys($active_fonts)))
                    continue;
				
				$json_content_additional = checkSelectionFileExistKaswara($fil_dir.$font.'/selection.json');								
				if($json_content_additional !== false){
				
					$selection = json_decode($json_content_additional, true);					
					$classname = $selection['preferences']['fontPref']['prefix'];
					$iconsList = $selection['icons'];
					echo '<div class="kswr-back-fonticon-container" data-iconset-name="'.$font.'"><div class="kswr-back-fonticon-title">'.$font.'<div class="thatred kswr-back-intit-button" data-fonticon-name="'.$font.'" onclick="kaswara_remove_fonticon(this);">'.esc_html__('Remove','kaswara').'</div></div>';
					foreach ($iconsList as $icon) {
						kaswara_print_single_icon_back($icon,$classname,false);	
					}
					echo '</div>';					
				}
				
				
				
			}die;
			
		}

		static function get_font_icons_backend($fontarray){
			WP_Filesystem(); $destination = wp_upload_dir(); $dest_baseurl = $destination['baseurl']; $dest_basedir = $destination['basedir'];
			$plugin_dir = WP_PLUGIN_DIR;			
			$fil_dir = $plugin_dir . '/font-icons-loader/fonts/';
			$result = '';		
			
			
			
			foreach ($fontarray as $font) {
				$json_content = checkSelectionFileExistKaswara($dest_basedir.'/'.'kaswara/fonts_icon/'.$font.'/selection.json');
				if($json_content !== false){
					$selection = json_decode($json_content, true);
					$classname = $selection['preferences']['fontPref']['prefix'];
					$iconsList = $selection['icons'];
					foreach ($iconsList as $icon) {
						$result .= kaswara_print_single_icon_back_returner($icon,$classname,true);	
					}
				}
				
				$active_fonts = get_option('fil_font_icons');
                if (!in_array($font, array_keys($active_fonts)))
                    continue;
                    
				$json_content_additional = checkSelectionFileExistKaswara($fil_dir.$font.'/selection.json');
				
				if($json_content_additional !== false){
					$selection = json_decode($json_content_additional, true);
					$classname = $selection['preferences']['fontPref']['prefix'];
					$iconsList = $selection['icons'];
					foreach ($iconsList as $icon) {
						$result .= kaswara_print_single_icon_back_returner($icon,$classname,true);	
					}				
				}
			}
			return $result;
		}

		
		


	//Class End	
	}

function kaswara_print_single_icon_back($icon,$classname,$withAction){
	$action = '';
	if($withAction == true)	$action = 'onclick="kswr_choose_icon(this);"';
    echo '<div class="kswr-the-icon" title="'.esc_attr($icon['properties']['name']).'"  '.$action.' data-class="'.esc_attr($icon['properties']['name']).'" data-name="'.esc_attr($icon['properties']['name']).'"><i class="'.$classname.''.esc_attr($icon['properties']['name']).'"></i></div>';	 
}

function kaswara_print_single_icon_back_returner($icon,$classname,$withAction){
	$action = '';
	if($withAction == true)	$action = 'onclick="kswr_choose_icon(this);"';
    return '<div class="kswr-the-icon" title="'.esc_attr($icon['properties']['name']).'"  '.$action.' data-class="'.$classname.''.esc_attr($icon['properties']['name']).'"data-name="'.esc_attr($icon['properties']['name']).'"><i class="'.$classname.''.esc_attr($icon['properties']['name']).'"></i></div>';	 
}

function kaswara_delete_allfiles($font_path){
	unlink($font_path.'/demo.html');unlink($font_path.'/Read Me.txt');
	$dir = $font_path.'/demo-files';
  	array_map('unlink', glob("$dir/*.*"));
  	rmdir($dir);
}


function kswr_delete_allfolder($directory){
    $contents = glob($directory . '*');
    var_dump($contents);
    foreach($contents as $item){
        if (is_dir($item))
            kswr_delete_allfolder($item . '/', true);
        else
            unlink($item);
    }   
   rmdir($directory);
}

function checkCssFileExistKaswara($font){
    $uploadDir = wp_upload_dir();    
    return file_exists($uploadDir['basedir'] . '/kaswara/fonts_icon/'.$font.'/style.css') ? true : false;
}

function checkCssFileExistFIC($font){
    $pluginDir = WP_PLUGIN_DIR;
    return file_exists($pluginDir . '/font-icons-loader/fonts/' . $font . '/style.css') ? true : false;
}

function checkSelectionFileExistKaswara($file){
    if (file_exists( $file )){
        return file_get_contents( $file );
    }
    return false;
}

}






?>
