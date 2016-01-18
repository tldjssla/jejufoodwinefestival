<?php
vc_map(array(
	"name" => __("Video Fancy Box Button", 'robusta'),
	"base" => "video_fancybox_button",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'robusta'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Select box image in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video Link", 'robusta'),
			"param_name" => "video_link",
			"value" => "",
			"description" => __("Please, enter video link in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Class", 'robusta'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'robusta' )
		),
	)
));
