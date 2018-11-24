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
                                Category: <?php 
                                    $categories = get_the_category(', ');
                                    $category_names = '';
                                    foreach($categories as $category) {
                                        $category_names .= $category->cat_name . ', ';
                                    }
                                    
                                    echo $category_names;
                                ?>
                            </div>


                        <?php 
                            endwhile;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </section>


<?php get_footer(); ?>