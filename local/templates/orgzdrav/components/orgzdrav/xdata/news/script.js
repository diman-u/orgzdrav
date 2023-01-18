(function($) {
	$(function() {
		$('.js-toggle-th').on('click', function(e) {
			e.preventDefault();
			
			var $list = $('.js-view-list:visible').eq(0);
			var size = $list.attr('data-gridsize');
			
			$list.addClass('l-grid--'+size).removeClass('is-flat-list');
			
			$(this).parent().find('.c-button').removeClass('c-button--red');
			$(this).addClass('c-button--red');
		});
		$('.js-toggle-list').on('click', function(e) {
			e.preventDefault();
			
			var $list = $('.js-view-list:visible').eq(0);
			var size = $list.attr('data-gridsize');
			
			$list.removeClass('l-grid--'+size).addClass('is-flat-list');
			
			$(this).parent().find('.c-button').removeClass('c-button--red');
			$(this).addClass('c-button--red');
		});
		
		$('.js-load-more-toggle[data-pagen="2"]').on('click', function() {
			$('.l-page').addClass('is-sidebar-full');
			$('.l-page__sidebar .l-grid').addClass('l-grid--4').removeClass('is-flat-list');
			
			Foundation.SmoothScroll.scrollToLoc('.l-page-tabs');
		});
	});
})(jQuery);