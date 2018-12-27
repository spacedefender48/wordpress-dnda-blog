<?php 

    function load_resources() {
        wp_enqueue_style('DNDA-style', get_stylesheet_uri());
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

    add_theme_support('html5', array('search-form'));    

    add_theme_support( 'post-thumbnails' );


    //  Highlight search results
    function wps_highlight_results($text){
        if (is_search()) {
            $sr = get_query_var('s');
            $keys = explode(" ",$sr);
            $text = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-term-highlight">'.$sr.'</strong>', $text);
        }
        return $text;
   }
   add_filter('the_excerpt', 'wps_highlight_results');
   add_filter('the_title', 'wps_highlight_results');


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
        $singleCategory = (isset($_POST['category'])) ? strtolower($_POST['category']) : '';

        if ($singleCategory) {
            $new_posts_loop = new WP_query(array(
                'posts_per_page' => $posts_per_page,
                'orderby' => 'post_date',
                'offset' => $posts_offset,
                'category_name' => $singleCategory
            ));
        } else {
            $new_posts_loop = new WP_query(array(
                'posts_per_page' => $posts_per_page,
                'orderby' => 'post_date',
                'offset' => $posts_offset
            ));
        }
        

        $post_html = '';

        

        if ($new_posts_loop -> have_posts()) :
            while($new_posts_loop -> have_posts()) : $new_posts_loop -> the_post();

                if ($isRight == 1) {
                    $rightClass = '';
                    $order_1 = '';
                    $order_2 = '';
                } else {
                    $rightClass = 'right';
                    $order_1 = 'order-1';
                    $order_2 = 'order-2';
                }

                $post_html .= '<div class="row post ' . $rightClass . '">
                        <div class="col-sm-6 col-xs-12 ' . $order_2 . ' post-image">
                            <a href="' . get_the_permalink() . '" class="post-image--link">';
                                
                if( has_post_thumbnail() ) {
                    $post_html .= get_the_post_thumbnail($new_posts_loop -> ID, 'large');
                }
                                
                $post_html .= '</a>
                        </div>

                        <div class="col-sm-6 col-xs-12 ' . $order_1 . ' post-details-wrap">
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

    // Comments function
    function format_comment($comment, $args, $depth) {
        if ( 'div' === $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }?>
        <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
        if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
        } ?>
            <div class="comment-author vcard"><?php 
                if ( $args['avatar_size'] != 0 ) {
                    echo get_avatar( $comment, $args['avatar_size'] ); 
                } 
                printf( __( '<span class="author-name">%s</span> <span class="comment-date">%s</span>' ), get_comment_author_link(), get_comment_date() . ' ' . get_comment_time() ); ?>
            </div><?php 
            if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
            } ?>
                
            <div class="comment-text">
                <?php comment_text(); ?>
            </div>

            <div class="reply-btn"><?php 
                    comment_reply_link( 
                        array_merge( 
                            $args, 
                            array( 
                                'add_below' => $add_below, 
                                'depth'     => $depth, 
                                'max_depth' => $args['max_depth'] 
                            ) 
                        ) 
                    ); ?>
            </div><?php 
        if ( 'div' != $args['style'] ) : ?>
            </div><?php 
        endif;
    }

    function calculateDaysAgo($comment_date) {
        $now = time('YYYY-MM-dd HH:mm:ss');
        // $local_time = localtime($now, true); // or your date as well
        // $server_time = strtotime((1900 + $local_time['tm_year']) . '-' . ($local_time['tm_mon'] + 1) . '-' . $local_time['tm_mday'] . ' ' . $local_time['tm_hour'] . ':' . $local_time['tm_min'] . ':' . $local_time['tm_sec']);

        $your_date = strtotime($comment_date);
        $datediff = $now - $your_date;
        $hours = round($datediff / (60 * 60));
        $minutes = floor($datediff / 60);

        if ($minutes < 1) {
            $output = 'Right now';
        } else if ($minutes == 1) {
            $output = $minutes . ' minute ago';
        } else if ($minutes < 60) {
            $output = $minutes . ' minutes ago';
        } else if ($hours < 24) {
            $output = $hours . ' hours ago';
        } else {
            $days_count = floor($hours / 24);
            
            if ($days_count == 1) {
                $output = $days_count . ' day ago';
            } else {
                $output = $days_count . ' days ago';
            }
        }
        
        
        return $output;
    }

    // Move Comment message field to bottom
    function wpb_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
        
    add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

?>