<?php 

    function load_resources() {
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('brands.min.js', get_template_directory_uri() . '/js/brands.min.js');
        wp_enqueue_script('solid.min.js', get_template_directory_uri() . '/js/solid.min.js');
        wp_enqueue_script('fontawesome.min.js', get_template_directory_uri() . '/js/fontawesome.min.js');
        wp_enqueue_script('jquery.js', get_template_directory_uri() . '/js/jquery.js');
        wp_enqueue_script('app.js', get_template_directory_uri() . '/js/app.js');
    }

    add_action('wp_enqueue_scripts', 'load_resources');

    add_theme_support( 'post-thumbnails' );


?>