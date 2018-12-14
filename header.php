<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>

    <div class="canvas-menu">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Categories</a>
            </li>
            <li>
                <a href="#">About Us</a>
            </li>
            <li>
                <a href="#">Contact Us</a>
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
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="canvas-btn">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="logo-wrap">
                        <a href="<?php bloginfo('url');?>" title="Home page">
                            <img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                </div>
            </div>