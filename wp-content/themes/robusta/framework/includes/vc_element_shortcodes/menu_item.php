<?php
vc_map(array(
	"name" => __("Menu Item", 'robusta'),
	"base" => "menu_item",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Text Featured", 'robusta'),
			"param_name" => "text_featured",
			"value" => "",
			"description" => __("Please, enter text featured in this element.", 'robusta')
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
