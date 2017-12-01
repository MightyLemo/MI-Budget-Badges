<?php 
/*Plugin Name: MI Budget Badge - By Bit Spring
Description: Provides a MI Data Budget Badges
Version: 1.1
Author: Bit Spring Web Services
Author URI: http://bit-spring.com/
License: GPLv2
*/
 
define( 'BUDGET_BADGE__PLUGIN_DIR', plugin_dir_url( __FILE__ ) );

add_action( 'wp_enqueue_scripts', 'add_plugin_scripts' );
function add_plugin_scripts() {
    wp_enqueue_style('budget_badge_css', plugins_url( '/assets/css/budget-badges.css', __FILE__ ), false, null);
    wp_enqueue_script('budget_badge_js', plugins_url( '/assets/js/budget-badges.js', __FILE__ ), ['jquery'], null, true);
}


// Add Shortcode
function mi_budget_badges_shortcode( $atts ) {

	$options = get_option( 'budget_badge_settings' );
	
	$budgetLink = $options['budget_badge_text_field_0'];
	$dataLink = $options['budget_badge_text_field_1'];

	$output = '';

	$output .= '<div class="mi-budget-badges">';
	$output .= '	<a href="' . $budgetLink . '" target="_blank" class="badge transparency-reporting" title="Click to view our Transparency Report.">TRANSPARENCY REPORTING</a> ';
	$output .= '	<a href="' . $dataLink . '" target="_blank" class="badge mi-school-data" title="Click to view our MI School Data report.">MISCHOOL DATA</a>';
	$output .= '	<div class="expander-toggle" aria-hidden="true">';
	$output .= '		<div class="trigger show"></div>';
	$output .= '		<div class="trigger hide"></div>';
	$output .= '	</div>';
	$output .= '</div>';
	  
	return $output;

}
add_shortcode( 'budget_badges', 'mi_budget_badges_shortcode' );


add_action('wp_footer', 'footer_badges');
function footer_badges() {
	if (is_home() || is_front_page()) {
		echo do_shortcode('[budget_badges]');
	}
}



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


