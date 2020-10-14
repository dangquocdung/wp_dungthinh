(function($){
'use strict';
   $(document).on('click', '.load-more-posts:not(.loading)', function(e){
    e.prevent
        var that = $(this);
        var page = that.data('page');
        var message = that.data('message');
        var search_term = that.data('search_term');
        var posts        = that.data('posts');
        var author = that.data('author');
        var category = that.data('category');
        var tag = that.data('tag');
        var newPage = page+1;
        var ajaxUrl = that.data('url');
        that.addClass('loading');

        $.ajax({
            url : ajaxUrl,
            type : 'post',
            data : {
                page        : page,
                search_term : search_term,
                tag         : tag,
                author      : author,
                category    : category,
                action      : 'eunice_load_more_ajax'
            },
            error : function( response ) {
                console.log( response );
            },
            success : function( response ){
                that.data('page', newPage );
                    var $items = $( response );
                    $('#blog-post').append( $items )
                    .isotope( 'appended', $items );
                    setTimeout(function(){
                        setInterval(function(){
                             var $blogContent = $("body").has("#blog-post").length;
                            if(true == $blogContent){
                                var blogCaroselet = $(".blog-post-curosel");
                                blogCaroselet.each(function(){
                                        var $this = $(this);
                                    $this.height($this.children(".owl-stage-outer").height());
                                });
                            }
                        }, 100);

                        $("#blog-post").load( response, function() {
                            var $blogContent = $("body").has("#blog-post").length;
                            if(true == $blogContent){
                                // blog post carousel
                                var blogCaroselet = $(".blog-post-curosel");
                                blogCaroselet.owlCarousel({
                                    autoplay:false,
                                    loop: true,
                                    items: 1,
                                    center:true,
                                    dots:false,
                                    nav: true,
                                    navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
                                });
                                blogCaroselet.each(function(){
                                        var $this = $(this);
                                    $this.height($this.children(".owl-stage-outer").height());
                                });

                                // bolg mesonary
                                $( '#blog-post' ).isotope({
                                   itemSelector: '.single-post-mesonary',
                                   percentPosition: true
                                });
                            }
                            return;
                        }); // carousel and isotop
                    }, 2000);

                    var postLength = $('.single-post-mesonary').length;
                    if (posts <= postLength) {
                        $('.load_more_blog_messages').append('<h4>'+message+'</h4>');
                        that.slideUp(300);
                    }
                    that.removeClass('loading');

            }
        });
   });

$(document).on('click resize', '.gallery-load-more-posts:not(.loading)', function(e){
    e.prevent
        var that = $(this);
        var page = that.data('page');
        var newPage = page+1;
        var message = that.data('message');
        var posts = that.data('posts');
        var category = that.data('category');
        var author = that.data('author');
        var ajaxUrl = that.data('url');
        var totalPages = that.data('totalPge');
        var postPerPage = that.data('perpage');
        var orderby = that.data('orderby');
        var order = that.data('order');
        var col_class = that.data('class');
        that.addClass('loading');

        $.ajax({
            url : ajaxUrl,
            type : 'post',
            data : {
                author : author,
                category : category,
                page : page,
                col_class : col_class,
                totalPages : totalPages,
                postPerPage : postPerPage,
                order : order,
                orderby : orderby,
                action : 'eunice_gallery_load_more_ajax'
            },
            error : function( response ) {
                console.log( response );
            },
            success : function( response ){
                    that.data('page', newPage );
                        var $items = $( response );
                        $('.media-grid').append( $items )
                        .isotope( 'appended', $items );
                        setTimeout(function(){
	                    	setInterval(function(){
                                $("body").height($("#filter-content").height());
                        	}, 100);
                                filter_function();
                        }, 3000);
                    var postLength = $('.grid-item').length;
                    if (posts <= postLength) {
                        $('.load_more_gallery_messages').append('<h4>'+message+'</h4>');
                        that.slideUp(300);
                    }
                that.removeClass('loading');
            }
        });
   });

function filter_function(){
    var $content = $("body").has(".media-grid").length;

    if(true == $content){
        // var $grid = $('.media-grid').isotope({
        //   itemSelector: '.grid-item',
        //   layoutMode: 'fitRows'
        // });
        var $grid = $('.media-grid').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'fitRows',
            percentPosition: true,
        });
        var $len = $("#filter-content  .grid-item").length;
            $(".filter-item-count, .init-item-count").text($len);

        $('.filter-btn-group').on( 'click', 'li', function() {

          $('.load_more_gallery_messages h4').hide();

          var filterValue = $(this).attr('data-filter');

          $grid.isotope({ filter: filterValue });
          $("#filters.filter-btn-group ul > li").removeClass('is-checked');
          $(this).addClass('is-checked');

          setTimeout(function(){
            var $len = $("#filter-content  "+filterValue).length;
                $len = ((0<$len) && (10>$len) ) ? "0"+$len:$len;

            if("*" == filterValue){
                var $len = $("#filter-content  .grid-item").length;
            }


            $(".filter-item-count").text($len);
          },3000);

          return false;
        });
        setTimeout(function(){
            setInterval(function(){
                $("body").height($("#filter-content").height());
            }, 100);
        }, 3000);

    }
    return;

}
/*============ 4.BLOG CAROUSEL INIT AND CUSTOM HEIGHT FUNCTION ===========*/
function blog_Carousel_height(){
    var $blogContent = $("body").has("#blog-post").length;
    if(true == $blogContent){
        var blogCaroselet = $(".blog-post-curosel");
        blogCaroselet.each(function(){
                var $this = $(this);
            $this.height($this.children(".owl-stage-outer").height());
        });
    }
    return;
}

function blog_js_init(){
    var $blogContent = $("body").has("#blog-post").length;
    if(true == $blogContent){

        // blog post carousel
        var blogCaroselet = $(".blog-post-curosel");
        blogCaroselet.owlCarousel({
            autoplay:false,
            loop: true,
            items: 1,
            center:true,
            dots:false,
            nav: true,
            navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
        });
        blogCaroselet.each(function(){
                var $this = $(this);
            $this.height($this.children(".owl-stage-outer").height());
        });

        // bolg mesonary
        $('#blog-post').isotope({
          itemSelector: '.single-post-mesonary',
          percentPosition: true
        });
    }
    return;
}

$(window).on("load  resize",function(){
  blog_Carousel_height();
});

$(window).load(function(){
    filter_function();
    $(".touch .filter-list-warp").click(function(){
        $(this).toggleClass('active');
    });
    blog_js_init();
});

})(jQuery);