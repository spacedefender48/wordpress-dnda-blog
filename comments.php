<?php 
    // Comment Loop
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 comments-wrap">
    <h2 class="comments-wrap--title">
        Comments
    </h2>
    <?php
    if (have_posts()) :
        while(have_posts()) : the_post(); 

            if ( have_comments() ) :?>
                               
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
                <p class="no-comments">No one has commented this article. Be the first to leave your opinion.</p>
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
                    '<div class="container-fluid"><div class="row"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-author"><input id="author" name="author" type="text" placeholder="Name*" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30"' . $aria_req . ' /></div>',

                'email' =>
                    '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-email"><input id="email" name="email" type="text" placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30"' . $aria_req . ' /></div></div></div>'
            ),

            'comment_notes_before' => '',

            'comment_field' => 
                '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Message*"></textarea></p>',

            'label_submit' => 'Submit'
        );
        comment_form($args);
    ?>
</div>