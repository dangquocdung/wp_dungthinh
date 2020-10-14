// Modified version of http://www.billerickson.net/infinite-scroll-in-wordpress/#comment-674098.
// Adds spinner to show that it's working on loading more posts.
// Adds "Load More" pagination and when no more posts will display "No More Posts".

jQuery(function($){

	$('#genesis-content').append( '<div class="load-more"><span class="fa-spinner-hidden"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i></span> MORE POSTS<span class="more-posts-arrow"></span></div>' );

	var button = $('#genesis-content .load-more');
	var page = 2;
	var loading = false;

	// Get max number of pages
	var maxpage = beloadmore.maxpage;

	// Remove Page links - .pagination
	$('#genesis-content .pagination').remove();
	$('body').on('click', '.load-more', function(){
		$(".fa-spinner-hidden").fadeIn( "slow" );
		if( ! loading ) {
			$(".fa-spinner-hidden").fadeOut( 1400 );
			loading = true;
			var data = {
				action: 'be_ajax_load_more',
				nonce: beloadmore.nonce,
				page: page,
				query: beloadmore.query,
			};
			$.post(beloadmore.url, data, function(res) {
				if( res.success) {
					// Add and Fade in new articles
					$(res.data).hide().appendTo('#genesis-content').fadeIn(1000);
					if( page >= maxpage) {
						// If last page, remove "load more" button and replace with "No more articles" text.
						$('#genesis-content .load-more').remove();
						$('#genesis-content').append( '<span class="no-more-posts">NO MORE POSTS</span>' );
					} else {
						$('#genesis-content').append( button );
					}
					page = page + 1;
					loading = false;
				} else {
					// console.log(res);
				}
			}).fail(function(xhr, textStatus, e) {
				// console.log(xhr.responseText);
			});
		}
	});
		
});