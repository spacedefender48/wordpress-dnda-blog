<?php
    get_header();
?>
            <div class="row page search">
                <div class="col-12" data-post-image="<?php bloginfo('template_url'); ?>/img/search-bg.jpg">
                    <h3 class="search-page--title">Search results for: <br><span><?php echo get_search_query(); ?></span></h3>

                    <div class="search-page--options-wrap">
                        <p class="search-page--number-results">
                            <?php 
                                $s = get_search_query();
                                $allsearch = new WP_Query("s=" . $s . "&showposts=0");
                                $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

                                echo $allsearch->found_posts;
                            ?> results found
                        </p> 
                        
                        <?php
                            if ($allsearch->found_posts > 0) {
                                ?>

                                <p> 
                                    Sort by: 

                                    <a href="<?php bloginfo('url');?>?s=<?php echo get_search_query(); ?>&order=asc" title="Oldest Posts" 
                                    <?php 
                                        if ($order == 'asc') {
                                            echo 'class="sorted-item"';
                                        }
                                    ?>>
                                        Oldest
                                    </a>

                                    <a href="<?php bloginfo('url');?>?s=<?php echo get_search_query(); ?>&order=desc" title="Newest Posts"
                                    <?php 
                                        if ($order == 'desc') {
                                            echo 'class="sorted-item"';
                                        }
                                    ?>>
                                    
                                        Newest
                                    </a>
                                </p>

                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>  <!-- Close div.row -->
        </div> <!-- Close div.container-fluid -->

    </header>

    <section id="content">
    <div class="posts-wrap">
            <div class="container-fluid">
                    <?php 
                
                    $search_results = new WP_query(array(
                        'posts_per_page' => '5',
                        'orderby' => 'post_date',
                        'order' => $order,
                        's' => $s
                    ));


                    // $num_post = 1;
                    $isRight = false;

                    if ($search_results->have_posts()) :
                        while($search_results->have_posts()) : $search_results->the_post();
                            ?>

                            <div class="row post search-post <?php if ($isRight) { echo 'right'; }?>">
                                <div class="col-sm-6 col-xs-12 <?php if ($isRight) { echo 'order-sm-2'; }?> post-image">
                                    <a href="<?php the_permalink();?>" class="post-image--link">
                                        <?php 
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail('large');
                                            }
                                        ?>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-xs-12 <?php if ($isRight) { echo 'order-sm-1'; }?> post-details-wrap">
                                    <h2 class="post-details-wrap--title">
                                        <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
                                    </h2>

                                    <div class="post-details-wrap--excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <p class="post-details-wrap--meta">
                                        <?php echo get_the_date();?> <span>/</span> <?php $categories = get_the_category(); echo $categories[0]->name ?> <span>/</span> BY <?php the_author(); ?>
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
                    
                    else:?>

                        <div class="row">
                            <div class="col-12">
                                <div class="no-results-wrap">
                                    <div class="no-results-wrap--icon">
                                        <i class="fas fa-search"></i>
                                    </div>

                                    <p class="no-results-wrap--desc">No Results Found</p>

                                    <p class="no-results-wrap--desc">We couldn't find any content that match your search</p>
                                </div>
                            </div>                        
                        </div>

                    <?php
                        endif;
                    ?>
            </div>
        </div>
    </section>


    
<?php
    get_footer();

?>