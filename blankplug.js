/**
 * Block Styles Example
 *
 * https://github.com/modularwp/gutenberg-block-styles-example
 */

//import apiFetch from '@wordpress/api-fetch';
/*
apiFetch( { path: '/wp/v2/posts' } ).then( posts => {
	console.log( posts );
} );
*/


( function() {

	const { 
		apiFetch 
	} = wp;
	
	var __                = wp.i18n.__; // The __() function for internationalization.
	var createElement     = wp.element.createElement; // The wp.element.createElement() function to create elements.
	var registerBlockType = wp.blocks.registerBlockType; // The registerBlockType() function to register blocks.
	var RichText          = wp.editor.RichText; // For creating editable elements.
	var InspectorControls = wp.editor.InspectorControls; // For adding block controls.
	var Panel 			  = wp.components.Panel; // For adding a Panel.
	var PanelBody 		  = wp.components.PanelBody; // For adding a PanelBody.
	var ToggleControl     = wp.components.ToggleControl; // For adding toggle controls to block settings panels.
	var SelectControl     = wp.components.SelectControl; // For adding select controls to block settings panels.
	var articoliLOut = 'ciao';

	/**
	 * Register block
	 *
	 * @param  {string}   name     Block name.
	 * @param  {Object}   settings Block settings.
	 * @return {?WPBlock}          Block itself, if registered successfully,
	 *                             otherwise "undefined".
	 */
	registerBlockType(
		'va/block-my-blank', // Block name. Must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
		{
			title: __( 'Blank Plug' ), // Block title. __() function allows for internationalization.
			description: __( 'Dealing with the Rest Api' ), // Block description.
			icon: 'admin-settings', // Block icon from Dashicons. https://developer.wordpress.org/resource/dashicons/.
			category: 'common', // Block category. Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
			attributes: {
				content: {
		            type: 'array',
		            source: 'children',
		            selector: 'div',
					default: 'Block content rendered on the frontpage',
				},
				applyStyles: {
					type: 'string',
					default: '',
				},
			},

			// Defines the block within the editor.
			edit: function( {wp, attributes, setAttributes, className} ) {
				const {
					content,
					applyStyles,
				} = attributes;
				
				
				
				function onChangeContent( updatedContent ) {
					setAttributes( { content: updatedContent } );
				}

				function onChangeStyleSettings() {
					if ( applyStyles ) {
						setAttributes( { applyStyles: '' } );
					} else {
						setAttributes( { applyStyles: 'styled' } );
					}
				}

				const controls = [
					createElement( InspectorControls,
						{},
						createElement( PanelBody, 
							{
								title: __( 'Select Endpoint' ),
								className: 'block-gb-cta-link',
								initialOpen: true,
							},
							/*createElement( ToggleControl,
								{
								label: __('Apply Styles'),
								checked: !!applyStyles,
								onChange: onChangeStyleSettings
								}
							),*/
							createElement( SelectControl,
								{
								type: 'string',
								label: __( 'Number of Columns' ),
								//onChange: console.log (wp.blocks.getBlockTypes()),
								options: [
									{ value: 'a', label: 'User A' },
									{ value: 'b', label: 'User B' },
									{ value: 'c', label: 'User c' },
									],

								}
							),
						),
					),
				];

				return [controls,
					createElement(
						RichText,
						{
							tagName: 'p',
							className: className + ' ' + applyStyles,
							value: content,
							onChange: onChangeContent
						},
					),
				];
			},

			// Defines the saved block.
			save: function( ) {
			/*	const {
					content,
					applyStyles,
				} = attributes;
*/
				return null;
				/*
				createElement(
					'p',
					{
						className: applyStyles,
					},
					content
				);*/
			},
		}
	);
})();