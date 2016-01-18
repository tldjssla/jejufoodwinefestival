<?php
if(class_exists('Woocommerce')){
    vc_map(array(
        "name" => __("Product Grid", 'robusta'),
        "base" => "products-grid",
        "class" => "ro-products-grid",
        "category" => __('Robusta', 'robusta'),
        'admin_enqueue_js' => array(URI_PATH_ADMIN.'/assets/js/customvc.js'),
        "icon" => "tb-icon-for-vc",
        "params" => array(
			array (
                "type" => "tb_taxonomy",
                "taxonomy" => "product_cat",
                "heading" => __ ( "Categories", 'robusta' ),
                "param_name" => "product_cat",
                "class" => "",
                "description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'robusta' )
            ),
			array (
					"type" => "dropdown",
					"class" => "",
					"heading" => __ ( "Show", 'robusta' ),
					"param_name" => "show",
					"value" => array (
							"All Products" => "all_products",
							"Featured Products" => "featured",
							"On-sale Products" => "onsale",
					),
					"description" => __ ( "", 'robusta' )
			),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Post Count", 'robusta'),
                "param_name" => "number",
                "value" => "",
				"description" => __('Please, enter number of post per page. Show all: -1.', 'robusta')
            ),
			array(
                "type" => "checkbox",
                "heading" => __('Show Title', 'robusta'),
                "param_name" => "show_title",
                "value" => array(
                    __("Yes, please", 'robusta') => 1
                ),
				"group" => __("Template", 'robusta'),
                "description" => __('Show or hide title of product.', 'robusta')
            ),
			array(
                "type" => "checkbox",
                "heading" => __('Show Price', 'robusta'),
                "param_name" => "show_price",
                "value" => array(
                    __("Yes, please", 'robusta') => 1
                ),
				"group" => __("Template", 'robusta'),
                "description" => __('Show or hide price of product.', 'robusta')
            ),
			array(
                "type" => "checkbox",
                "heading" => __('Hide Free', 'robusta'),
                "param_name" => "hide_free",
                "value" => array(
                    __("Yes, please", 'robusta') => 1
                ),
                "description" => __('Hide free product.', 'robusta')
            ),
			array(
                "type" => "checkbox",
                "heading" => __('Show Hidden', 'robusta'),
                "param_name" => "show_hidden",
                "value" => array(
                    __("Yes, please", 'robusta') => 1
                ),
                "description" => __('Show Hidden product.', 'robusta')
            ),
            array (
					"type" => "dropdown",
					"heading" => __ ( 'Order by', 'robusta' ),
					"param_name" => "orderby",
					"value" => array (
							"None" => "none",
							"Date" => "date",
							"Price" => "price",
							"Random" => "rand",
							"Sales" => "sales",
					),
					"description" => __ ( 'Order by ("none", "date", "price", "rand", "sales").', 'robusta' )
			),
            array(
                "type" => "dropdown",
                "heading" => __('Order', 'robusta'),
                "param_name" => "order",
                "value" => Array(
                    "None" => "none",
                    "ASC" => "ASC",
                    "DESC" => "DESC"
                ),
                "description" => __('Order ("None", "Asc", "Desc").', 'robusta')
            ),
            array(
                "type" => "checkbox",
                "heading" => __('Show Pagination', 'robusta'),
                "param_name" => "show_pagination",
                "value" => array(
                    __("Yes, please", 'robusta') => 1
                ),
                "description" => __('Show or hide pagination of post on your blog.', 'robusta')
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
}
