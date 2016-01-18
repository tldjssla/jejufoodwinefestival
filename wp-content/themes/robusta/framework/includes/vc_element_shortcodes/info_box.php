<?php
vc_map(array(
	"name" => __("Info Box", 'robusta'),
	"base" => "info_box",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Image", 'robusta'),
			"param_name" => "img",
			"value" => "",
			"description" => __("Select image in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'robusta'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Please, enter title in this element.", 'robusta')
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'robusta'),
			"param_name" => "content",
			"value" => "",
			"description" => __("Please, enter content in this element.", 'robusta')
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
