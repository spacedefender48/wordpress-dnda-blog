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
        } else if ($('header .single-post').data('post-image')) {
            post_image_src = $('header .single-post').data('post-image');
        } else {
            post_image_src = $('header .page div').data('post-image');
        }
        
        

        $header.css({
            'background': 'url(' + post_image_src + ') no-repeat center center',
            'background-size': 'cover' 
        });

        // var similar_post_image_src = $('.similar-posts-wrap .similar-post').data('post-image');
        var $similar_post = $('.similar-posts-wrap .similar-post');

        $similar_post.each(function(){
            var $this = $(this);            
            var similar_post_image_src = $this.data('post-image');
            $this.css({
                'background': 'url(' + similar_post_image_src + ') no-repeat center center',
                'background-size': 'cover' 
            });
        });

        // Load More posts 
        var $load_more_btn = $('.load-more-posts--link');
        var posts_to_load = 1;
        var offset; 
        var isInSingleCategory = ($('#single-category-title').length) ? true : false;

        if (isInSingleCategory) {
            offset = $('#content .posts-wrap .post').length;
        } else {
            offset = $('#content .posts-wrap .post').length + 1; // +1 for the post in header
        }

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

                var category_search;
                if ($('#single-category-title').length) {
                    category_search = $('#single-category-title').text();
                }

                $.ajax({
                    type: 'POST',
                    url: load_posts_ajax.url,
                    data: {
                        'action': 'load_more_posts',
                        'posts_to_load': posts_to_load,
                        'offset': offset,
                        'isRightPost': isRight,
                        'category': category_search
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
        var $canvas_menu_items = $('.canvas-menu .main-menu > li');
        var $dropdown_menus = $('.canvas-menu ul li.dropdown');
        var $canvas_back_btn = $('.canvas-menu .back-btn');

        function openNavigation(){
            $canvas_menu.addClass('open');
            $body.addClass('nav-open');
            $canvas_overlay.addClass('open');
            $canvas_menu_items.show();
        }

        function closeNavigation(){
            $canvas_menu.removeClass('open');
            $body.removeClass('nav-open');
            $canvas_overlay.removeClass('open');
            $canvas_menu_items.removeClass('open');
            $canvas_back_btn.hide(0);
        }

        $canvas_btn.on('click', openNavigation);

        $canvas_btn_close.on('click', closeNavigation);
        $canvas_overlay.on('click', closeNavigation);

        // Dropdown menu in navigation
        $dropdown_menus.on('click', function(){
            $canvas_menu_items.not(this).each(function() {
                var $this = $(this);
                $this.hide(300); 
            });
            $canvas_back_btn.show(300);
            $(this).addClass('open');
        });

        $canvas_back_btn.on('click', function(){
            $canvas_menu_items.removeClass('open');
            $canvas_menu_items.show(300);
            $(this).hide();
        });

    });

})(jQuery, window, document)