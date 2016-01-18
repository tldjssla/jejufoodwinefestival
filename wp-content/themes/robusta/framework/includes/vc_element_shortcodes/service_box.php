<?php
vc_map(array(
	"name" => __("Service Box", 'robusta'),
	"base" => "service_box",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'robusta'),
			"param_name" => "style",
			"value" => array(
				"Style 1" => "style1",
				"Style 2" => "style2",
			),
			"description" => __('Select style in this element.', 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon", 'robusta'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Please, enter class icon in this element.", 'robusta')
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
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", 'robusta'),
			"param_name" => "desc",
			"value" => "",
			"description" => __("Please, enter description in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Link", 'robusta'),
			"param_name" => "ex_link",
			"value" => "",
			"description" => __("Please, enter extra link in this element.", 'robusta')
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
