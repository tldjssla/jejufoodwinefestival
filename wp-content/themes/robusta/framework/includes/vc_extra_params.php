<?php
//Add extra params vc_row
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Id One Page", 'robusta' ),
		"param_name" 	=> "id_onepage",
		"value" 		=> "",
		"description" 	=> __( "Please, Enter row id one page.", 'robusta' )
) );
vc_add_param ( 'vc_row', array (
		'type' 			=> 'checkbox',
		'heading' 		=> __("Row Full Height", 'robusta'),
		'param_name' 	=> 'full_height',
		"value" 		=> array (
							__( "Yes, please", 'robusta' )  => 1
						),
		'description' 	=> __("Set full height screen of this row.", 'robusta')
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Type", 'robusta' ),
		"admin_label" 	=> true,
		"param_name" 	=> "type",
		"value" 		=> array (
							"Default" => "default",
							"Background Video" => "custom-bg-video"
						),
		"description" 	=> __( "Select type of this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Text Color", 'robusta' ),
		"param_name" 	=> "text_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all text in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Heading Color", 'robusta' ),
		"param_name" 	=> "heading_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all heading in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Link Color", 'robusta' ),
		"param_name" 	=> "link_color",
		"value" 		=> "",
		"description" 	=> __( "Select color for all link in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "colorpicker",
		"class" 		=> "",
		"heading" 		=> __( "Link Color Hover", 'robusta' ),
		"param_name" 	=> "link_color_hover",
		"value" 		=> "",
		"description" 	=> __( "Select color for all link hover in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Text Align", 'robusta' ),
		"param_name" 	=> "text_align",
		"value" 		=> array (
							"No" => "text-align-none",
							"Left" => "text-left",
							"Right" => "text-right",
							"Center" => "text-center"
						),
		"description" 	=> __( "Select text align for all columns in this row.", 'robusta' )
) );
vc_add_param ( 'vc_row', array (
		'type' 			=> 'checkbox',
		'heading' 		=> __("Content Full Width", 'robusta'),
		'param_name' 	=> 'full_width',
		"value" 		=> array (
							__( "Yes, please", 'robusta' )  => 1
						),
		'description' 	=> __("Set content full width of this row.", 'robusta')
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "checkbox",
		"class" 		=> "",
		"heading" 		=> __( "Same Height", 'robusta' ),
		"param_name" 	=> "same_height",
		"value" 		=> array (
							__( "Yes, please", 'robusta' )  => 1
						),
		"description" 	=> __( "Set the same height for all column in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Effect", 'robusta' ),
		"param_name" 	=> "animation",
		"value" 		=> array(
							"No" => "animation-none",
							"Top to bottom" => "top-to-bottom",
							"Bottom to top" => "bottom-to-top",
							"Left to right" => "left-to-right",
							"Right to left" => "right-to-left",
							"Appear from center" => "appear"
						),
		"description" 	=> __( "Select effect in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "checkbox",
		"class" 		=> "",
		"heading" 		=> __( "Enable parallax", 'robusta' ),
		"param_name" 	=> "enable_parallax",
		"value" 		=> array (
							__( "Yes, please", 'robusta' )  => 1,
						),
		"dependency" => array (
			"element" => "type",
			"value" => array('default')
		),
		"description" 	=> __( "Enable parallax effect in this row.", 'robusta' )
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Parallax speed", 'robusta' ),
		"param_name" 	=> "parallax_speed",
		"value" 		=> "0.5",
		"dependency" => array (
			"element" => "type",
			"value" => array('default')
		),
		"description" 	=> __( "Please, Enter parallax speed in this row.", 'robusta' )
) );

vc_add_param ( "vc_row", array (
		"type" => "attach_image",
		"class" => "",
		"heading" => __( "Video poster", 'robusta' ),
		"param_name" => "poster",
		"value" => "",
		"dependency" => array (
				"element" => "type",
				"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Loop", 'robusta' ),
		"param_name" => "loop",
		"value" => array (
				__( "Yes, please", 'robusta' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Autoplay", 'robusta' ),
		"param_name" => "autoplay",
		"value" => array (
				__( "Yes, please", 'robusta' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Muted", 'robusta' ),
		"param_name" => "muted",
		"value" => array (
				__( "Yes, please", 'robusta' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Controls", 'robusta' ),
		"param_name" => "controls",
		"value" => array (
				__( "Yes, please", 'robusta' )  => true,
		),
		"dependency" => array (
			"element" => "type",
			"value" => array('custom-bg-video')
		)
) );
vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (mp4)", 'robusta' ),
		"param_name" 	=> "bg_video_src_mp4",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (mp4) for background in this row.", 'robusta' )
) );

vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (ogv)", 'robusta' ),
		"param_name" 	=> "bg_video_src_ogv",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (ogv) for background in this row.", 'robusta' )
) );

vc_add_param ( "vc_row", array (
		"type" 			=> "textfield",
		"class" 		=> "",
		"heading" 		=> __( "Video background (webm)", 'robusta' ),
		"param_name" 	=> "bg_video_src_webm",
		"value" 		=> "",
		"dependency" 	=> array (
							"element" 	=> "type",
							"value" 	=> array('custom-bg-video')
						),
		"description" 	=> __( "Please, Enter url video (webm) for background in this row.", 'robusta' )
) );

//Add extra params vc_column
vc_add_param ( "vc_column", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Effect", 'robusta' ),
		"param_name" 	=> "animation",
		"value" 		=> array(
							"No" => "animation-none",
							"Top to bottom" => "top-to-bottom",
							"Bottom to top" => "bottom-to-top",
							"Left to right" => "left-to-right",
							"Right to left" => "right-to-left",
							"Appear from center" => "appear"
						),
		"description" 	=> __( "Select effect in this column.", 'robusta' )
) );
vc_add_param ( "vc_column", array (
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Text Align", 'robusta' ),
		"param_name" 	=> "text_align",
		"value" 		=> array (
							"No" => "text-align-none",
							"Left" => "text-left",
							"Right" => "text-right",
							"Center" => "text-center"
						),
		"description" 	=> __( "Select text align in this column.", 'robusta' )
) );
vc_add_param ( "vc_single_image", array (
		"type" => "checkbox",
		"class" => "",
		"heading" => __( "Show zoom image", 'robusta' ),
		"param_name" => "show_zoom_image",
		"value" => array (
				__( "Yes, please", 'robusta' )  => true,
		),
		"description" 	=> __( "Show btn zoom image in this image.", 'robusta' )
) );