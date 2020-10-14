<?php

function studylms_user_profile_fields( $user ) {
	$user_info = get_the_author_meta( 'apus_edr_info', $user->ID );
	?>
	<h3><?php esc_html_e( 'Lecturer Profile', 'studylms' ); ?></h3>

	<table class="form-table">
		<tbody>
		<tr>
			<th>
				<label for="lecturer_job"><?php esc_html_e( 'Job', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_job" class="regular-text" type="text" value="<?php echo isset( $user_info['job'] ) ? $user_info['job'] : ''; ?>" name="apus_edr_info[job]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_mobile"><?php esc_html_e( 'Mobile', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_mobile" class="regular-text" type="text" value="<?php echo isset( $user_info['mobile'] ) ? $user_info['mobile'] : ''; ?>" name="apus_edr_info[mobile]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_facebook"><?php esc_html_e( 'Facebook Account', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_facebook" class="regular-text" type="text" value="<?php echo isset( $user_info['facebook'] ) ? $user_info['facebook'] : ''; ?>" name="apus_edr_info[facebook]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_twitter"><?php esc_html_e( 'Twitter Account', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_twitter" class="regular-text" type="text" value="<?php echo isset( $user_info['twitter'] ) ? $user_info['twitter'] : ''; ?>" name="apus_edr_info[twitter]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_google"><?php esc_html_e( 'Google Plus Account', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_google" class="regular-text" type="text" value="<?php echo isset( $user_info['google'] ) ? $user_info['google'] : ''; ?>" name="apus_edr_info[google]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_linkedin"><?php esc_html_e( 'LinkedIn Plus Account', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_linkedin" class="regular-text" type="text" value="<?php echo isset( $user_info['linkedin'] ) ? $user_info['linkedin'] : ''; ?>" name="apus_edr_info[linkedin]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="lecturer_youtube"><?php esc_html_e( 'Youtube Account', 'studylms' ); ?></label>
			</th>
			<td>
				<input id="lecturer_youtube" class="regular-text" type="text" value="<?php echo isset( $user_info['youtube'] ) ? $user_info['youtube'] : ''; ?>" name="apus_edr_info[youtube]">
			</td>
		</tr>
		</tbody>
	</table>

	<?php $apus_edr_more_info = get_the_author_meta( 'apus_edr_more_info', $user->ID );?>

	<h3><?php esc_html_e( 'Lecturer More Information', 'studylms' ); ?></h3>
	<table class="form-table lecturer-more_info">
		<tbody>
			<?php
				if ( isset($apus_edr_more_info['label']) &&  count($apus_edr_more_info['label']) > 0 ) {
					$number = count($apus_edr_more_info['label']);
				} else {
					$number = 1;
				}
				for ($i=0; $i < $number; $i++) {
					?>
					<tr>
						<th>
							<label><?php esc_html_e( 'Label', 'studylms' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_more_info['label'][$i] ) ? $apus_edr_more_info['label'][$i] : ''; ?>" name="apus_edr_more_info[label][]">
							<br>
							<i><?php esc_html_e( 'Ex: Experience', 'studylms' ); ?></i>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Volume', 'studylms' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_more_info['volume'][$i] ) ? $apus_edr_more_info['volume'][$i] : ''; ?>" name="apus_edr_more_info[volume][]">
							<br>
							<i><?php esc_html_e( 'Ex: 12 Years', 'studylms' ); ?></i>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>
					<button class="add-new-skill button button-primary"><?php esc_html_e( 'Add New Skill', 'studylms' ); ?></button>
				</th>
				<td>
					<button class="remove-skill button"><?php esc_html_e( 'Remove Skill', 'studylms' ); ?></button>
				</td>
			</tr>
		</tfoot>
	</table>
	<?php
}
add_action( 'show_user_profile', 'studylms_user_profile_fields' );
add_action( 'edit_user_profile', 'studylms_user_profile_fields' );

function studylms_save_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	update_user_meta( $user_id, 'apus_edr_info', $_POST['apus_edr_info'] );
	update_user_meta( $user_id, 'apus_edr_more_info', $_POST['apus_edr_more_info'] );
}

add_action( 'personal_options_update', 'studylms_save_user_profile_fields' );
add_action( 'edit_user_profile_update', 'studylms_save_user_profile_fields' );

function studylms_add_scripts() {
	$js_folder = studylms_get_js_folder();
	$min = studylms_get_asset_min();
	wp_enqueue_script( 'studylms-user-admin', $js_folder . '/user-admin'.$min.'.js', array( 'jquery' ), '20150315', true );
}
add_action( 'admin_enqueue_scripts', 'studylms_add_scripts' );

function studylms_educator_get_lecturers($number = -1) {
	$roles = array( 'administrator', 'lecturer' );
	$users_by_role = get_users( array( 'role__in' => $roles, 'number' => $number ) );
	return $users_by_role;
}

function studylms_get_lecturers_by_ids( $args = array() ) {
	$wp_user_query = new WP_User_Query( array( 'include' => $args ) );
	return $wp_user_query->get_results();
}

if ( !function_exists('studylms_lecturer_content_class') ) {
	function studylms_lecturer_content_class( $class ) {
		if ( studylms_get_config('lecturer_profile_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'studylms_lecturer_content_class', 'studylms_lecturer_content_class', 1 , 1  );

if ( !function_exists('studylms_get_lecturer_layout_configs') ) {
	function studylms_get_lecturer_layout_configs() {
		$left = studylms_get_config('lecturer_profile_left_sidebar');
		$right = studylms_get_config('lecturer_profile_right_sidebar');

		switch ( studylms_get_config('lecturer_profile_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}

// send message
function studylms_send_message() {
	check_ajax_referer( 'ajax-send-message-instructor-nonce', 'instructor-security' );
	$error = false;
	$sent = false;

	// sanitize form values
	$name      = sanitize_text_field( $_POST["sender-name"] );
	$email     = sanitize_email( $_POST["sender-email"] );
	$subject   = sanitize_text_field( $_POST["sender-subject"] );
	$message   = esc_textarea( $_POST["sender-message"] );
	$to        = sanitize_email( $_POST["instructor-email"] );

	$headers[] = "Reply-To: $name <$email>" . "\r\n";

	if ( wp_mail( $to, $subject, $message, $headers ) && $error == false) {
		$sent = true;
		echo json_encode( array( 'message' => esc_html__('Thanks for contacting me, expect a response soon.', 'studylms'), 'class' => 'text-success' ) );
	} else {
		echo json_encode( array( 'message' => esc_html__('An unexpected error occurred.', 'studylms'), 'class' => 'text-danger' ) );
	}

	die();
}
add_action( 'wp_ajax_studylms_send_message', 'studylms_send_message' );
add_action( 'wp_ajax_nopriv_studylms_send_message', 'studylms_send_message' );
