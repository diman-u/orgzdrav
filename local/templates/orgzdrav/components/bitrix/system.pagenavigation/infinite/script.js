(function($) {
    $(function() {
        if (! $('.js-load-more[data-total]').length) {
            return;
        }
		
		$('.js-load-more[data-total]').each(function() {
			var $loadMore = $(this);
			var $loadMoreContainer = $loadMore.parent().find('.js-is-container');
			
			if (!$loadMoreContainer.is('.js-waiting')) {
				initInfiniteScroll($loadMore);
			} else {
				$loadMore.hide();
			}
		});
    });
	
	function initInfiniteScroll($loadMore, loadNextPage)
	{
		loadNextPage = loadNextPage || false;
		
		var $loadMoreContainer = $loadMore.parent().find('.js-is-container');
			
		var pagen = $loadMore.attr('data-pagen');
		var totalPages = parseInt($loadMore.attr('data-total'));

		var infScroll = new InfiniteScroll( $loadMoreContainer[0], {
			path: function() {
				var nextPage = this.loadCount + 2;

				if (totalPages >= nextPage) {
					return window.location.pathname
						+ (window.location.search.length ? window.location.search + '&' : '?')
						+ 'PAGEN_' + pagen + '=' + nextPage
						+ '&load_more'
				}
			},
			append: '.js-is-container-item',
			status: '.page-load-status.js-pagen-'+pagen,
			hideNav: '.js-load-more.js-pagen-'+pagen,
			history: false,
			prefill: false
		});
		
		infScroll.on( 'append', function( response, path, items ) {
			$('body').append($(response).find('script'));
			$('body').trigger('content:new');
		});
		
		if (loadNextPage) {
			infScroll.loadNextPage();
		}
	}
})(window['cash']);