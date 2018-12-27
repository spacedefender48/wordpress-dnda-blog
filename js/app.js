(function($, window, document) {

    var $win = $( window );
    var $doc = $( document );

    $doc.ready(function(){

        // Load image as background
        var $header = $('header');
        var $index_main_post = $('header .main-post');
        var isInSearchPage = $('header .row.page.search').length;
        var post_image_src;
        
        if ($index_main_post.length) {
            post_image_src = $index_main_post.data('post-image');
        } else if ($('header .single-post').data('post-image')) {
            post_image_src = $('header .single-post').data('post-image');
        } else {
            post_image_src = $('header .page div').data('post-image');
        }
        
        
        if (isInSearchPage) {
            $header.css({
                'background': 'url(' + post_image_src + ') no-repeat bottom center',
                'background-size': 'cover' 
            });
        } else {
            $header.css({
                'background': 'url(' + post_image_src + ') no-repeat center center',
                'background-size': 'cover' 
            });
        }
        

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
        var posts_to_load = 3;
        var offset; 
        var isInSingleCategory = ($('#single-category-title').length) ? true : false;

        if (isInSingleCategory) {
            offset = $('#content .posts-wrap .post').length;
        } else {
            offset = $('#content .posts-wrap .post').length + 1; // +1 for the post in header
        }

        $load_more_btn.on('click', function() {
            if( !($load_more_btn.hasClass('spinner') || $load_more_btn.hasClass('no-more-posts'))) {


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
                        $load_more_btn.addClass('spinner');
                        $load_more_btn.text('');
                        
                    },

                    success: function(data) {

                        var $data = $(data);

                        if ($data.length) {
                            
                            var $posts_wrap = $('.posts-wrap .container-fluid');
                            $data.hide().appendTo($posts_wrap).fadeIn(800);
                            
                            $load_more_btn.text('Read More Stories');
                            $load_more_btn.removeClass('spinner');
    
    
                            offset += posts_to_load;

                        } else {
                            $load_more_btn.removeClass('spinner').addClass('no-more-posts').html('No more posts');
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

        // Search field
        var $search_field = $('header .search-field--wrap .search-field--input');
        var $search_icon = $('header .search-field--wrap .search-field--icon');

        $search_icon.on('click', function(){
            $search_field.addClass('open');
            $search_icon.addClass('open');
            // $search_icon.hide();
        });

        $search_field.on('blur scroll', function(){
            $search_field.removeClass('open');
            $search_icon.removeClass('open');
        });


        // Scroll top button
        var $scroll_top_btn = $('.scroll-top');

        function calculateScrollTop() {
            if ($win.scrollTop() < 500) {
                $scroll_top_btn.fadeOut(200);
            } else {
                $scroll_top_btn.fadeIn(200);
            }
        }

        $win.on('resize scroll', function(){
            calculateScrollTop();
        });

        $scroll_top_btn.on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });

        calculateScrollTop();

    });

})(jQuery, window, document)