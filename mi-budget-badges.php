<?php 
/*Plugin Name: MI Budget Badge - By Bit Spring
Description: Provides a MI Data Budget Badges
Version: 1.0
Author: Bit Spring Web Services
Author URI: http://bit-spring.com/
License: GPLv2
*/
 
define( 'BUDGET_BADGE__PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

add_action( 'wp_enqueue_scripts', 'add_plugin_scripts' );
function add_plugin_scripts() {
    wp_enqueue_style('budget_badge_css', plugins_url( '/assets/css/budgetbadge.css', __FILE__ ), false, null);
}


// add_action('init', 'myStartSession', 1);
// function myStartSession() {
//     if(!session_id()) {
//         session_start();
//     }
// }


// add_action('wp_footer', 'insert_my_footer');
// function insert_my_footer() {
// 	$options = get_option( 'budget_badge_settings' );
	
// 	$budgetLink = $options['budget_badge_text_field_0'];
// 	$dataLink = $options['budget_badge_text_field_1'];
	
// 	$sessionToggleURL = plugins_url( '/inc/session.php', __FILE__ );
	
// 	include('inc/html.php');
	
// }



// Add Shortcode
function mi_budget_badges_shortcode( $atts ) {

	$options = get_option( 'budget_badge_settings' );
	
	$budgetLink = $options['budget_badge_text_field_0'];
	$dataLink = $options['budget_badge_text_field_1'];

	$output = '';

	$output .= '<div class="mi-budget-badges">';
	$output .= '	<div class="badge transparency-reporting">';
	$output .= '		<a href="' . $budgetLink . '" target="_blank"><img src="' . BUDGET_BADGE__PLUGIN_DIR . '/assets/img/transparency-reporting.png" /></a>';
	$output .= '	</div>';
	$output .= '	<div class="badge mi-school-data">';
	$output .= '		<a href="' . $dataLink . '" target="_blank"><img src="' . BUDGET_BADGE__PLUGIN_DIR . '/assets/img/mi_school_data_logo.png" /></a>';
	$output .= '	</div>';
	$output .= '</div>';
	  
	return $output;

}
add_shortcode( 'budget_badges', 'mi_budget_badges_shortcode' );








/*
	ADMIN SETTINGS PAGE
*/

add_action( 'admin_menu', 'budget_badge_add_admin_menu' );
add_action( 'admin_init', 'budget_badge_settings_init' );


function budget_badge_add_admin_menu(  ) { 

	add_options_page( 'MI Budget Badges', 'MI Budget Badges', 'manage_options', 'mi-budget-badges', 'budget_badge_options_page' );

}


function budget_badge_settings_init(  ) { 

	register_setting( 'pluginPage', 'budget_badge_settings' );

	add_settings_section(
		'budget_badge_pluginPage_section', 
		__( 'Budget Report URLs', 'wordpress' ), 
		'budget_badge_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'budget_badge_text_field_0', 
		__( 'Budget and Salary/Compensation Transparency Reporting URL', 'wordpress' ), 
		'budget_badge_text_field_0_render', 
		'pluginPage', 
		'budget_badge_pluginPage_section' 
	);

	add_settings_field( 
		'budget_badge_text_field_1', 
		__( 'MI School Data Report URL', 'wordpress' ), 
		'budget_badge_text_field_1_render', 
		'pluginPage', 
		'budget_badge_pluginPage_section' 
	);


}


function budget_badge_text_field_0_render(  ) { 

	$options = get_option( 'budget_badge_settings' );
	?>
	<input type='text' name='budget_badge_settings[budget_badge_text_field_0]' value='<?php echo $options['budget_badge_text_field_0']; ?>'>
	<?php

}


function budget_badge_text_field_1_render(  ) { 

	$options = get_option( 'budget_badge_settings' );
	?>
	<input type='text' name='budget_badge_settings[budget_badge_text_field_1]' value='<?php echo $options['budget_badge_text_field_1']; ?>'>
	<?php

}


function budget_badge_settings_section_callback(  ) { 

	echo __( 'Enter the URLs to the appropriate budget pages below.', 'wordpress' );

}


function budget_badge_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h1>MI Budget Badges Settings</h1>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}


