<?php get_header(); ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="error-404-wrap">
                    <h2 class="error-404-wrap--title">404 - Page not found</h2>

                    <p class="error-404-wrap--desc">
                        Sorry! The page you are looking for cannot be found. The resource you are trying to get has been changed, moved, deleted or does not exist.
                    </p>

                    <div class="error-404-wrap--link">
                        <a href="<?php echo get_home_url();?>">Go to homepage</a>
                    </div>
                </div>
            </div>
        </div>

        </div> <!-- Close div.container-fluid -->
    </header>

    <img class="error-404-image" src="<?php echo get_template_directory_uri() ?>/img/404-bg.jpg" alt="404 background">

    <div class="body-overlay-bg">
    </div>

<?php get_footer(); ?>