<?php 
    // Comment Loop
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comments-wrap">
    <?php
    if (have_posts()) :
        while(have_posts()) : the_post(); 

            if ( have_comments() ) :?>
                <h2 class="comments-wrap--title">
                    <?php  ?>
                </h2>
                
                <ul class="comments-list">
                    <?php
                        wp_list_comments( array(
                            'style'       => 'ul',
                            'callback'    => 'format_comment',
                            'short_ping'  => false,
                            'avatar_size' => 60
                        ) );
                    ?>
                </ul>

            <?php
            else :
                ?>
                <p>No comment found</p>
                <?php 
            
            endif;
        endwhile;
    endif;
?>

</div>

<div class= "col-lg-12 col-md-12 col-sm-12 col-xs-12 comments-form">
    <?php 
        $commenter = wp_get_current_commenter();
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $args = array(
            'fields' => array(
                'author' =>
                    '<input id="author" name="author" type="text" placeholder="Name*" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30"' . $aria_req . ' />',

                'email' =>
                    '<input id="email" name="email" type="text" placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30"' . $aria_req . ' />'
            ),

            'comment_field' => 
                '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Message*"></textarea></p>',

            'label_submit' => 'Submit'
        );
        comment_form($args);
    ?>
</div>