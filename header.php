<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>

    <div class="scroll-top">
        <i class="fas fa-chevron-up"></i>
    </div>

    <div class="canvas-menu">
        <div class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <ul class="main-menu">
            <li>
                <a href="<?php echo get_home_url();?>">Home</a>
            </li>
            <li class="dropdown">
                <span>Categories</span>
                <i class="fas fa-chevron-right icon"></i>

                <ul class="dropdown-submenu">
                    <?php 
                        $args = array(
                            'title_li' => '',
                            'show_count' => true
                        );

                        wp_list_categories($args);
                    ?>
                </ul>
            </li>
            <li>
                <a href="<?php echo get_page_link(35); ?>">About Me</a>
            </li>
            <li>
                <a href="<?php echo get_page_link(38); ?>">Contact Me</a>
            </li>
        </ul>
    </div>

    <div class="canvas-menu-overlay">
    </div>


    <header class="site-header">
        <div class="overlay-bg">
        </div>

        <div class="container-fluid wrap">
            <div class="row">
                <div class="col-md-4 col-4" id="canvas-btn-wrap">
                    <div class="canvas-btn">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="col-4 d-md-block" id="logo-wrap">
                    <div class="logo-wrap">
                        <a href="<?php bloginfo('url');?>" title="Home page">
                            <img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>

                <div class="col-md-4 col-4" id="search-wrap">
                    <?php get_search_form(); ?>
                </div>
            </div>