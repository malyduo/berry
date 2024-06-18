<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
	if( function_exists('acf_register_block_type') ) {
		acf_register_block_type(array(
			'name'              => 'calculator',
			'title'             => __('Calculator'),
			'description'       => __('A custom calculator block.'),
			'render_template'   => 'template-parts/blocks/block-calculator.php',
			'category'          => 'formatting',
			'icon'              => 'calculator',
			'keywords'          => array('calculator', 'math'),
		));
	}
}

function enqueue_calculator_assets() {
	wp_enqueue_style('calculator-styles', get_template_directory_uri() . '/css/styles.css');
	wp_enqueue_script('calculator-js', get_template_directory_uri() . '/js/calculator.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_calculator_assets');

function save_calculation() {
	if (isset($_POST['calculation']) && isset($_POST['result'])) {
		$calculation = sanitize_text_field($_POST['calculation']);
		$result = sanitize_text_field($_POST['result']);
		$date = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];

		$data = array($date, $ip, $calculation, $result);
		$file = fopen(get_template_directory() . '/calculations.csv', 'a');
		fputcsv($file, $data);
		fclose($file);

		wp_send_json_success('Calculation saved.');
	} else {
		wp_send_json_error('Invalid data.');
	}
}
add_action('wp_ajax_save_calculation', 'save_calculation');
add_action('wp_ajax_nopriv_save_calculation', 'save_calculation');

add_action('acf/init', 'my_acf_init_calculator_block_fields');
function my_acf_init_calculator_block_fields() {
	if( function_exists('acf_add_local_field_group') ) {
		acf_add_local_field_group(array(
			'key' => 'group_calculator_block',
			'title' => 'Calculator Block Settings',
			'fields' => array(
				array(
					'key' => 'field_background_color',
					'label' => 'Background Color',
					'name' => 'background_color',
					'type' => 'color_picker',
					'instructions' => 'Select background color for the calculator.',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/calculator',
					),
				),
			),
		));
	}
}
