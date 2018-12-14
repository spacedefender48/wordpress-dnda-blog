(function($, window, document) {

    var $win = $( window );
    var $doc = $( document );

    $doc.ready(function(){

        // Load image as background
        var $header = $('header');
        var $index_main_post = $('header .main-post');
        var post_image_src;
        
        if ($index_main_post.length) {
            post_image_src = $index_main_post.data('post-image');
        } else {
            post_image_src = $('header .single-post').data('post-image');
        }

        var single_post_image_src = $('header .single-post').data('post-image');
        $header.css({
            'background': 'url(' + post_image_src + ') no-repeat center center',
            'background-size': 'cover' 
        });

        // Load More posts 
        var $load_more_btn = $('.load-more-posts--link');
        var posts_to_load = 2;
        var offset = $('#content .posts-wrap .post').length + 1; // +1 for the post in header
        offset = 0;

        $load_more_btn.on('click', function() {
            if( !($load_more_btn.hasClass('loading') || $load_more_btn.hasClass('no-more-posts'))) {
                // Load AJAX
                var lastPostRight = $('#content .posts-wrap .post:last-child');
                var isRight;
                if (lastPostRight.hasClass('right')) {
                    isRight = 1;
                } else {
                    isRight = 0;
                }

                $.ajax({
                    type: 'POST',
                    url: load_posts_ajax.url,
                    data: {
                        'action': 'load_more_posts',
                        'posts_to_load': posts_to_load,
                        'offset': offset,
                        'isRightPost': isRight
                    },

                    beforeSend: function() {
                        $load_more_btn.addClass('loading');
                        $load_more_btn.text('Loading');
                    },

                    success: function(data) {

                        var $data = $(data);

                        if ($data.length) {
                            
                            var $posts_wrap = $('.posts-wrap .container-fluid');
                            $data.hide().appendTo($posts_wrap).fadeIn(800);
                            
                            $load_more_btn.text('Read More Stories');
                            $load_more_btn.removeClass('loading');
    
    
                            offset += posts_to_load;

                        } else {
                            $load_more_btn.removeClass('loading').addClass('no-more-posts').html('No more posts');
                        }

                    }

                });

            } else {
                
            }
        });

        // Canvas button
        var $canvas_btn = $('.canvas-btn');
        var $canvas_menu = $('.canvas-menu');
        var $canvas_btn_close = $('.canvas-menu .close-btn');
        var $body = $( 'body' );
        var $canvas_overlay = $('.canvas-menu-overlay');

        function openNavigation(){
            $canvas_menu.addClass('open');
            $body.addClass('nav-open');
            $canvas_overlay.addClass('open');
        }

        function closeNavigation(){
            $canvas_menu.removeClass('open');
            $body.removeClass('nav-open');
            $canvas_overlay.removeClass('open');
        }

        $canvas_btn.on('click', function(){
            if($canvas_menu.hasClass('open')) {
                closeNavigation();
            } else {
                openNavigation();
            }
        });

        $canvas_btn_close.on('click', function(){
            closeNavigation();
        });

        $canvas_overlay.on('click', function(){
            closeNavigation();
        });

    });

})(jQuery, window, document)