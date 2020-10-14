jQuery(document).ready(function($){
	$('.add-new-skill').click(function(){
		$('.lecturer-more_info tbody tr').eq(0).clone(true).appendTo('.lecturer-more_info tbody');
		$('.lecturer-more_info tbody tr').eq(1).clone(true).appendTo('.lecturer-more_info tbody');
		return false;
	});

	$('.remove-skill').click(function() {
		var index = $('.lecturer-more_info tbody tr').last().index();
		if ( index > 1 ) {
			$('.lecturer-more_info tbody tr').eq(index).remove();
			$('.lecturer-more_info tbody tr').eq(index - 1).remove();
		}
		return false;
	});
	
});