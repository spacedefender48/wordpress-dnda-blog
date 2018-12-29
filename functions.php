<?php 

    function load_resources() {
        wp_enqueue_style('DNDA-style', get_stylesheet_uri());
        wp_enqueue_script('brands.min.js', get_template_directory_uri() . '/js/brands.min.js');
        wp_enqueue_script('solid.min.js', get_template_directory_uri() . '/js/solid.min.js');
        wp_enqueue_script('fontawesome.min.js', get_template_directory_uri() . '/js/fontawesome.min.js');
        wp_enqueue_script('jquery.js', get_template_directory_uri() . '/js/jquery.js');
        wp_enqueue_script('jquery-ui.js', get_template_directory_uri() . '/js/jquery-ui.js');
        wp_enqueue_script('app.js', get_template_directory_uri() . '/js/app.js');

        wp_localize_script('app.js', 'load_posts_ajax', array(
            'url' => admin_url( 'admin-ajax.php' )
        ));

        wp_localize_script( 'app.js', 'send_email_ajax', array( 'url' => admin_url( 'admin-ajax.php' ),
                                                            'security' => wp_create_nonce('send_email_nonce') ) );
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
                    $order_1 = 'order-sm-1';
                    $order_2 = 'order-sm-2';
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

    // Move Comment message field to bottom
    function wpb_move_comment_field_to_bottom( $fields ) {
        $comment_field = $fields['comment'];
        unset( $fields['comment'] );
        $fields['comment'] = $comment_field;
        return $fields;
    }
        
    add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

    function wpshout_twitter_length_excerpt( $text ) {
        if( is_admin() ) {
            return $text;
        }
        // Fetch the post content directly
        $text = get_the_content();
        // Clear out shortcodes
        $text = strip_shortcodes( $text );
        
        // Get the first 140 characteres
        $text = substr( $text, 0, 180 );
    
        // Add a read more tag
        $text .= '…';
        return $text;
    }
    // Leave priority at default of 10 to allow further filtering
    add_filter( 'wp_trim_excerpt', 'wpshout_twitter_length_excerpt', 10, 1 );

    // Send Email function
    function send_email_ajax() {

        if (! check_ajax_referer( 'send_email_nonce', 'security' )) {

            wp_send_json_error( 'Invalid security token sent.' );
            wp_die();
            
        } else {
            
            $data = $_POST['data'];
            $parsed_str = array();
            parse_str($data, $parsed_str);

            $name = $parsed_str['f_name'];
            $from_email = $parsed_str['f_email'];
            $message = $parsed_str['f_message'];
            $to_email = 'spacedefender48@gmail.com';


            $body = sprintf('Name: %s%sEmail: %s%sMessage: %s', $name, PHP_EOL,  $from_email, PHP_EOL, $subject, PHP_EOL, $message);

            apply_filters( 'wp_mail_from', 'spacedefender48@gmail.com');

            $email_status = wp_mail($to_email, 'DNDA blog: ' .  $subject, $body);
            
            if ($email_status) {
                echo "An email has been sent.";
            } else {
                echo "Error: email has not been sent";
            }
        }

        
        die();
    }

    add_action('wp_ajax_send_email_ajax', 'send_email_ajax');
    add_action('wp_ajax_nopriv_send_email_ajax', 'send_email_ajax');



?>