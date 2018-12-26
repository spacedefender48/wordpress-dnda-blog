<?php get_header(); 
    $current_category = single_cat_title("", false);
?>
            <div class="row page">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-post-image="<?php bloginfo('template_url'); ?>/img/<?php echo strtolower($current_category); ?>-bg.jpg">
                    <h2 class="category-page--title"><?php single_cat_title('Category: <span id="single-category-title">', '</span>');?></h2>
                </div>                
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>

    <section id="content">
        <div class="posts-wrap">
            <div class="container-fluid">
                    <?php 
                    $query = new WP_query(array(
                        'posts_per_page' => '5',
                        'category_name' => strtolower($current_category),
                    ));

                    // $num_post = 1;
                    $isRight = false;

                    if ($query -> have_posts()) :
                        while($query -> have_posts()) : $query -> the_post();                            
                            ?>

                            <div class="row post <?php if ($isRight) { echo 'right'; }?>">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-image">
                                    <a href="<?php the_permalink();?>" class="post-image--link">
                                        <?php 
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail('large');
                                            }
                                        ?>
                                    </a>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-details-wrap">
                                    <h2 class="post-details-wrap--title">
                                        <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="post-details-wrap--excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <p class="post-details-wrap--meta">
                                        <?php echo get_the_date();?> <span>/</span> <?php single_cat_title(); ?> <span>/</span> BY <?php the_author(); ?>
                                    </p>

                                    <div class="post-details-wrap--read-wrap">
                                        <a href="<?php the_permalink(); ?>" class="post-details-wrap--read-link">Read article</a>
                                    </div>
                                </div>
                            </div>


                    <?php 
                            // Change orientation
                            $isRight = !$isRight;
                        endwhile;
                    endif;

                        wp_reset_postdata();
                    ?>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row load-more-posts--wrap">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="load-more-posts--link">
                        Read more stories
                    </div>

                    <div class="overlay-background">
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>