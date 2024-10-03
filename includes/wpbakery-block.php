<?php

// WPBakery integration - Greenhouse Job Board with light/dark style options
function greenhouse_register_vc_block() {
    vc_map( array(
        "name" => "Greenhouse Job Board",
        "base" => "greenhouse_jobs",
        "class" => "",
        "category" => "Content",
        "content_element" => true,
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => "Style Mode",
                "param_name" => "style_mode",
                "value" => array(
                    "Light" => "light",
                    "Dark" => "dark"
                ),
                "description" => "Select between light and dark styles."
            ),
        ),
        "show_settings_on_create" => true, 
    ));
}
add_action( 'vc_before_init', 'greenhouse_register_vc_block' );
