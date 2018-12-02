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
    <?php comment_form();?>
</div>