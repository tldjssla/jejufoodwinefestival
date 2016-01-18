<?php
vc_map(array(
	"name" => __("Countdown", 'robusta'),
	"base" => "countdown",
	"class" => "ro_countdown",
	"category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Date End", 'robusta'),
			"param_name" => "date_end",
			"value" => "",
			"description" => __("Please, Enter date end in this element. Ex: +6o +15d +8h +30m +15s", 'robusta')
		),
	)
));
