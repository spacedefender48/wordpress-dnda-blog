<?php get_header(); ?>
            <div class="row">
                <?php 
                    $query = new WP_query(array(
                        'posts_per_page' => '1',
                        'orderby' => 'post_date'
                    ));

                    if ($query -> have_posts()) :
                        while($query -> have_posts()) : $query -> the_post(); ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="post-wrap">
                                <h2 class="post-wrap--title"><?php the_title(); ?></h2>
                                <div class="post-wrap--excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <p class="post-wrap--meta">
                                    <?php the_date();?> <span>/</span> <?php $categories = get_the_category(); echo $categories[0]->name ?> <span>/</span> BY <?php the_author(); ?>
                                </p>
                            </div>
                        </div>
                <?php
                        endwhile;
                    endif;

                    wp_reset_postdata();
                ?>

                
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>


<?php get_footer(); ?>