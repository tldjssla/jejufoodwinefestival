<?php
vc_map ( array (
		"name" => 'Blog List',
		"base" => "blog_list",
		"icon" => "tb-icon-for-vc",
		"category" => __ ( 'Robusta', 'robusta' ), 
		'admin_enqueue_js' => array(URI_PATH_FR.'/admin/assets/js/customvc.js'),
		"params" => array (
					array (
							"type" => "tb_taxonomy",
							"taxonomy" => "category",
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
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Pagination", 'robusta'),
						"param_name" => "show_pagination",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"description" => __("Show or not pagination in this element.", 'robusta')
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
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt Length", 'robusta'),
						"param_name" => "excerpt_lenght",
						"value" => "",
						"group" => __("Template", 'robusta'),
						"description" => __("Please, Enter number excerpt lenght of post in this element. Default: 50", 'robusta')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Excerpt More", 'robusta'),
						"param_name" => "excerpt_more",
						"value" => "",
						"group" => __("Template", 'robusta'),
						"description" => __("Please, Enter text excerpt more of post in this element. Default: ... ", 'robusta')
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => __("Read More Text", 'robusta'),
						"param_name" => "read_more_text",
						"value" => "",
						"group" => __("Template", 'robusta'),
						"description" => __("Please, Enter text of labe button read more in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Meta", 'robusta'),
						"param_name" => "show_meta",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not meta of post in this element.", 'robusta')
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => __("Show Actions", 'robusta'),
						"param_name" => "show_actions",
						"value" => array (
							__ ( "Yes, please", 'robusta' ) => true
						),
						"group" => __("Template", 'robusta'),
						"description" => __("Show or not actions of post in this element.", 'robusta')
					),
		)
));