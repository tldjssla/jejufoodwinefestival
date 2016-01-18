<?php
vc_map ( array (
		"name" => 'Testimonial_slider',
		"base" => "testimonial_slider",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Robusta', 'robusta' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array (
							"type" => "tb_taxonomy",
							"taxonomy" => "testimonial_category",
							"heading" => __ ( "Categories", 'robusta' ),
							"param_name" => "category",
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'robusta' )
					),
					
					array (
							"type" => "textfield",
							"heading" => __ ( 'Count', 'robusta' ),
							"param_name" => "posts_per_page",
							'value' => '',
							"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'robusta' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order by', 'robusta' ),
							"param_name" => "orderby",
							"value" => array (
									"None" => "none",
									"Title" => "title",
									"Date" => "date",
									"ID" => "ID"
							),
							"description" => __ ( 'Order by ("none", "title", "date", "ID").', 'robusta' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Order', 'robusta' ),
							"param_name" => "order",
							"value" => Array (
									"None" => "none",
									"ASC" => "ASC",
									"DESC" => "DESC"
							),
							"description" => __ ( 'Order ("None", "Asc", "Desc").', 'robusta' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Extra Class", 'robusta'),
						"param_name" => "el_class",
						"value" => "",
						"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'robusta' )
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Image", 'robusta'),
						"param_name" => "show_image",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not featured image of post in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Title", 'robusta'),
						"param_name" => "show_title",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not title of post in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Excerpt", 'robusta'),
						"param_name" => "show_excerpt",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not excerpt of post in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Quotation", 'robusta'),
						"param_name" => "show_quotation",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not quotation of post in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Position", 'robusta'),
						"param_name" => "show_position",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not position of post in this element.", 'robusta')
					),
		)
));