<?php 

    function load_resources() {
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_script('brands.min.js', get_template_directory_uri() . '/js/brands.min.js');
        wp_enqueue_script('solid.min.js', get_template_directory_uri() . '/js/solid.min.js');
        wp_enqueue_script('fontawesome.min.js', get_template_directory_uri() . '/js/fontawesome.min.js');
        wp_enqueue_script('jquery.js', get_template_directory_uri() . '/js/jquery.js');
        wp_enqueue_script('app.js', get_template_directory_uri() . '/js/app.js');

        wp_localize_script('app.js', 'load_posts_ajax', array(
            'url' => admin_url( 'admin-ajax.php' )
        ));
    }

    add_action('wp_enqueue_scripts', 'load_resources');

    

    add_theme_support( 'post-thumbnails' );


    function debug_to_console( $data ) {
        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
            else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
        echo $output;
    }

    add_action('wp_ajax_load_more_posts', 'load_more_posts');
    add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

    function load_more_posts() {
        $result = 'Loading more posts - ';

        $posts_per_page = (isset($_POST['posts_to_load'])) ? $_POST['posts_to_load'] : 1;
        $posts_offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
        $isRight = (isset($_POST['isRightPost'])) ? $_POST['isRightPost'] : false;

        $new_posts_loop = new WP_query(array(
            'posts_per_page' => $posts_per_page,
            'orderby' => 'post_date',
            'offset' => $posts_offset
        ));

        $post_html = '';

        

        if ($new_posts_loop -> have_posts()) :
            while($new_posts_loop -> have_posts()) : $new_posts_loop -> the_post();

                if ($isRight == 1) {
                    $rightClass = '';
                } else {
                    $rightClass = 'right';
                }

                $post_html .= '<div class="row post ' . $rightClass . '">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-image">
                            <a href="' . get_the_permalink() . '" class="post-image--link">';
                                
                if( has_post_thumbnail() ) {
                    $post_html .= get_the_post_thumbnail($new_posts_loop -> ID, 'large');
                }
                                
                $post_html .= '</a>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post-details-wrap">
                            <h2 class="post-details-wrap--title">
                                <a href="' . get_the_permalink() . '">' . get_the_title() . '</a>
                            </h2>

                            <div class="post-details-wrap--excerpt">'
                                . get_the_excerpt() . '
                            </div>

                             <p class="post-details-wrap--meta">'
                                . get_the_date() . '<span>/</span> ';

                $categories = get_the_category(); 
                $post_html .= $categories[0]->name . ' <span>/</span> BY ' . get_the_author() . '
                            </p>

                            <div class="post-details-wrap--read-wrap">
                                <a href="' . get_the_permalink() . '" class="post-details-wrap--read-link">Read article</a>
                            </div>
                        </div>
                    </div>';

                if ($isRight == 0) {
                    $isRight = 1;
                } else {
                    $isRight = 0;
                }
            endwhile;
        else :

        endif;

        wp_reset_postdata();

        
        $result .= $posts_per_page;

        $result .= '. Offset: ' . $posts_offset;

        wp_die($post_html);
    }

?>