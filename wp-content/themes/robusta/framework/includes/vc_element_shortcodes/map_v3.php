<?php
vc_map(array(
    "name" => 'Google Maps V3',
    "base" => "maps",
    "category" => __('Robusta', 'robusta'),
	"icon" => "tb-icon-for-vc",
    "description" => __('Google Maps API V3', 'robusta'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'robusta'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'robusta'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'robusta'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'robusta'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Marker", 'robusta'),
            "description" => __('Click a marker and show info window (Default Show).', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'robusta'),
            "param_name" => "markercoordinate",
            "value" => '',
            "group" => __("Marker", 'robusta'),
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'robusta'),
            "param_name" => "markertitle",
            "value" => '',
            "group" => __("Marker", 'robusta'),
            "description" => __('Enter Title Info windows for marker', 'robusta')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'robusta'),
            "param_name" => "markerdesc",
            "value" => '',
            "group" => __("Marker", 'robusta'),
            "description" => __('Enter Description Info windows for marker', 'robusta')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'robusta'),
            "param_name" => "markericon",
            "value" => '',
            "group" => __("Marker", 'robusta'),
            "description" => __('Select image icon for marker', 'robusta')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'robusta'),
            "param_name" => "markerlist",
            "value" => '',
            "group" => __("Multiple Marker", 'robusta'),
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'robusta'),
            "param_name" => "infowidth",
            "value" => '200',
            "group" => __("Marker", 'robusta'),
            "description" => __('Set max width for info window', 'robusta')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'robusta'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'robusta')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'robusta'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Subtle Grayscale" => "Subtle-Grayscale",
                "Shades of Grey" => "Shades-of-Grey",
                "Blue water" => "Blue-water",
                "Pale Dawn" => "Pale-Dawn",
                "Blue Essence" => "Blue-Essence",
                "Apple Maps-esque" => "Apple-Maps-esque",
            ),
            "group" => __("Map Style", 'robusta'),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'robusta'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'robusta'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'robusta')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'robusta'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'robusta'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'robusta'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Pan control.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'robusta'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Zoom Control.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'robusta'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Scale Control.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'robusta'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Map Type Control.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'robusta'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Street View Control.', 'robusta')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'robusta'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'robusta') => true
            ),
            "group" => __("Controls", 'robusta'),
            "description" => __('Show or hide Over View Map Control.', 'robusta')
        )
    )
));