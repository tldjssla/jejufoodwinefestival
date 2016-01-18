<?php
vc_map(array(
	"name" => __("Heading", 'robusta'),
	"base" => "heading",
	"class" => "title",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Template", 'robusta'),
			"param_name" => "tpl",
			"value" => array(
				"Template 1" => "tpl1",
				"Template 2" => "tpl2",
				"Template 3" => "tpl3",
				"Template 4" => "tpl4",
			),
			"description" => __("Select select template in this element.", 'robusta')
		),
		array(
                "type" => "attach_image",
                "class" => "",
                "heading" => __("Image", 'robusta'),
                "param_name" => "img",
                "value" => "",
                "description" => __("Select box image in this element.", 'robusta')
            ),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'robusta'),
			"param_name" => "text",
			"value" => "",
			"description" => __("Please, Enter text in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sub Text", 'robusta'),
			"param_name" => "sub_text",
			"value" => "",
			"description" => __("Please, Enter sub text in this element.", 'robusta')
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'robusta'),
			"param_name" => "content",
			"value" => "",
			"description" => __("Please, Enter content in this element.", 'robusta')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra Class", 'robusta'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'robusta')
		),
	)
));
