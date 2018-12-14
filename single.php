<?php get_header(); ?>
            <div class="row">
                <?php 
                    if (have_posts()) :
                        while(have_posts()) : the_post(); ?>
                            
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 single-post" data-post-image="<?php if( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail_url($query -> ID, 'original');
                                    }?>">
                            <div class="single-post-wrap">
                                <h2 class="single-post--title">
                                    <?php the_title(); ?>
                                </h2>

                                <p class="single-post--author">
                                    by <?php the_author(); ?>
                                </p>

                                <p class="single-post--date">
                                    <?php the_date();?>
                                </p>
                            </div>
                        </div>
                <?php
                        endwhile;
                    endif;
                ?>

                
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>

    <section id="content">
        <div class="container-fluid wrap">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 single-post-content">
                    <?php 
                        if (have_posts()) :
                            while(have_posts()) : the_post(); ?>

                            <div class="single-post-content--categories">
                                Category: <?php the_category(', '); ?>
                            </div>

                            <div class="single-post-content--the-content">
                                <?php the_content(); ?>
                            </div>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 single-post-content--nav-link">
                                        <?php previous_post_link('%link', 'Previous article', false);?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 social">

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 single-post-content--nav-link right">
                                        <?php next_post_link('%link', 'Next Article', false);?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>

            <div class="row">
                <?php 
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif; 
                ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>