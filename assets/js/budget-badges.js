
jQuery(document).ready(function($) {
	
	
	// Cache the Window object
	var $window = $(window);
	
	
	var scrollLimit = 0;

	$(window).scroll(function () {
	
		var scrollPos = $(this).scrollTop();
		
		if (scrollPos > scrollLimit) {
		
			//Scrolling Down
			$('.mi-budget-badges').addClass('min');
		
		} else {
		
			//Scrolling Up
			$('.mi-budget-badges').removeClass('min');
		}
		
	
	});

	

	$('.badges-text').click(function() {
		$('.mi-budget-badges').removeClass('min');
	});
	
});