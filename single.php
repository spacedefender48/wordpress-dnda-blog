<?php get_header(); ?>
            <div class="row">
                <?php 
                    if (have_posts()) :
                        while(have_posts()) : the_post(); ?>
                            
                        <div class="col-12 single-post" data-post-image="<?php if( has_post_thumbnail() ) {
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
                <div class="col-12 single-post-content">
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
                                    <div class="col-md-3 col-6 order-1 single-post-content--nav-link">
                                        <?php 
                                        
                                        // next_post_link('%link', 'Next Article', false);
                                        $previous_post = get_adjacent_post( false, '', true);
                                        if (is_a($previous_post, 'WP_Post')) { ?>

                                            <a href="<?php echo get_permalink( $previous_post->ID ); ?>" title="<?php echo get_the_title( $previous_post->ID ); ?>">
                                                Previous Post
                                            </a>

                                        <?php 
                                        
                                        } else { ?>
                                            <p class="missing-post">This is oldest post</p>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-12 order-md-2 order-3 mt-4 mt-md-0">
                                        <div class="social-icons">
                                            <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 order-md-3 order-2 single-post-content--nav-link right">
                                        <?php 
                                        
                                        // next_post_link('%link', 'Next Article', false);
                                        $next_post = get_adjacent_post( false, '', false); 
                                        if (is_a($next_post, 'WP_Post')) { ?>

                                            <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo get_the_title( $next_post->ID ); ?>">
                                                Next Post
                                            </a>

                                        <?php 
                                        
                                        } else { ?>
                                            <p class="missing-post">This is latest post</p>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            $categories = get_the_category();
                            $post_categories = '';
                            if ($categories) {
                                for($i=0; $i < count($categories); $i++) {
                                    if ($i == count($categories) - 1) {
                                        $post_categories .= $categories[$i]->term_id;
                                    } else {
                                        $post_categories .= $categories[$i]->term_id . ', '; 
                                    }
                                    
                                }
                            }
                            // debug_to_console($post_categories);


                            $post_tags = get_the_tags($post->ID);
                            $all_tags = array();
                            // Check if the post has any tags
                            if ( $post_tags ) {
                                foreach ( $post_tags as $tag ) {
                                    $all_tags[] = $tag->term_id; 
                                }
                            }
                            // debug_to_console();
                            $current_post_id = $post->ID;

                            endwhile;
                        endif;
                    ?>
                </div>
            </div>

            <div class="row similar-posts-wrap">
                <div class="col-12">
                    <h2 class="similar-posts-wrap--title">Next story from your reading list</h2>
                </div>
                <?php 
                    $similar_posts = new WP_query(array(
                        'post_type' => 'post',
                        'post__not_in' => array($current_post_id),
                        'tag__in' => $all_tags,
                        'posts_per_page' => 3
                    ));

                    if($similar_posts->have_posts()) :
                        while($similar_posts->have_posts()): $similar_posts->the_post();
                        ?>
                            <div class="col-sm-4 col-xs-12">
                                <div class="similar-post" data-post-image="<?php if( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail_url($similar_posts -> ID, 'large');
                                    }?>">
                                    

                                    <h3 class="similar-post--title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title();?>
                                        </a>
                                    </h3>

                                    <p class="similar-post--meta">
                                        <?php echo get_the_date();?> <span>/</span> <?php $categories = get_the_category(); echo $categories[0]->name ?> <span>/</span> BY <?php the_author(); ?>
                                    </p>

                                    <div class="overlay-bg"></div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    else :?>

                        <p>No similar posts</p>

                        <?php
                    endif;

                    wp_reset_postdata();
                ?>
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