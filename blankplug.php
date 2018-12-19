<?php
/**
 * Plugin Name: Blankplug: The working one
 * Plugin URI: https://github.com/modularwp/gutenberg-block-inspector-control-example
 * Description: This is an example of a Gutenberg block with an inspector control and CFS
 * Author: virtualascona.com
 * Author URI: http://virtualascona.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Allow for custom client-side validators
 * @since 1.9.5
 */

/**
 * Enqueue the block's assets for the editor.
 *
 * Javascript dependencies:
 * wp-blocks:      The registerBlockType() function to register blocks.
 * wp-element:     The wp.element.createElement() function to create elements.
 * wp-i18n:        The __() function for internationalization.
 *
 * CSS dependencies:
 * wp-edit-blocks: The WordPress core backend block styles.
 *
 * @since 1.0.0
 */

function mdlr_block_inspector_control_example_backend_enqueue() {

	wp_enqueue_script(
		'mdlr-block-inspector-control-example-backend-script', // Unique handle.
		plugins_url( 'blankplug.js', __FILE__ ), // Block.js: We register the block here.
		array( 'wp-blocks', 'wp-i18n', 'wp-element','wp-editor' ), // Dependencies, defined above.
		filemtime( plugin_dir_path( __FILE__ ) . 'blankplug.js' ) // filemtime — Gets file modification time.
	);

	wp_enqueue_style(
		'mdlr-block-inspector-control-example-style', // Handle.
		plugins_url( 'blankplug.css', __FILE__ ), // editor.css: This file styles the block within the Gutenberg editor.
		array( 'wp-edit-blocks' ), // Dependencies, defined above.
		filemtime( plugin_dir_path( __FILE__ ) . 'blankplug.css' ) // filemtime — Gets file modification time.
	);
}
add_action( 'enqueue_block_editor_assets', 'mdlr_block_inspector_control_example_backend_enqueue' );

/**
 * Enqueue the block's assets.
 *
 * It should be noted that this hook fires on both the frontend
 * and the backend.
 *
 * CSS dependencies:
 * wp-blocks: The WordPress core block styles.
 *
 * @since 1.0.0
 */
function mdlr_block_inspector_control_example_enqueue() {
	wp_enqueue_style(
		'mdlr-block-inspector-control-example-style', // Handle.
		plugins_url( 'blankplug.css', __FILE__ ), // style.css: This file styles the block on the frontend.
		array( 'wp-blocks' ), // Dependencies, defined above.
		filemtime( plugin_dir_path( __FILE__ ) . 'blankplug.css' ) // filemtime — Gets file modification time.
	);
}
add_action( 'enqueue_block_assets', 'mdlr_block_inspector_control_example_enqueue' );

function register_va_blocks() {
    register_block_type(
        'va/block-my-blank',
        array(
            'attributes' => array(
                'content' => array(
                    'type' => 'string',
                ),
                'className' => array(
                    'type' => 'string',
                ),
            ),
            'render_callback' => 'blank_va_block_posts',
        )
    );
}

add_action('init', 'register_va_blocks');

function blank_va_block_posts($attributes) {
	
// var_dump($attributes);

?>

<script>
var CFS = CFS || {};
CFS['get_field_value'] = {};
CFS['loop_buffer'] = [];
</script>

    <?php

CFS()->form->load_assets();
$block_content = CFS()->form( array( 'post_id' => 3510 ) );
$field_data = CFS()->get( false, 3510, array( 'format' => 'raw' ) );
do_action( 'cfs_custom_validation' );
//var_dump($field_data);
	// Output the post markup
	/*$block_content = sprintf(
		'<div class="%1$s"><div class="%2$s">%3$s</div></div>',
		esc_attr( 'myclass1' ),
		esc_attr( 'myclass2' ),
		'Hello from php'
	);*/

	return $block_content;
}
