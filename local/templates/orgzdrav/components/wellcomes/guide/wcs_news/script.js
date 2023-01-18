$(function() {
	$('.js-grid-toggle .btn[data-style]').on('click', function (e) {
		e.preventDefault();

		const style = $(this).attr('data-style');

		$(this).parent().find('.btn[data-style]').removeClass('btn--active');
		$(this).addClass('btn--active');
		
		if ('list' == style) {
			$('.js-main-list').addClass('display-list grid-2col--one-column');
		} else {
			$('.js-main-list').removeClass('display-list grid-2col--one-column');
		}
		
		Cookies.set('display-style', style);
	});
});