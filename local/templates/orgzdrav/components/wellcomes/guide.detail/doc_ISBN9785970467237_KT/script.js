$(function() {
	var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
	if (window.location.hash && isChrome) {
		setTimeout(function () {
			var hash = window.location.hash;
			window.location.hash = "";
			window.location.hash = hash;
		}, 300);
	}
	
	setTimeout(() => {
		let txtIndex = window.location.hash.match(/#txt-(\d+)/);
		if (txtIndex) {
			scrollToTxtByIndex(parseInt(txtIndex[1]) - 1);
		}
	}, 500);
	
	
	$('a[href^="internal:doc"]').on('click', function(e) {
		e.preventDefault();
		
		scrollToTxtByIndex(parseInt(this.href.split('/')[2]) - 1);
	});
	
	$('a[href^="'+window.location.pathname+'#txt-"]').on('click', function(e) {
		e.preventDefault();
		
		scrollToTxtByIndex(parseInt(this.href.split('#txt-')[1]) - 1);
	});
	
	
	$('a[href^="internal:thesaurus"]').on('click', function(e) {
		e.preventDefault();
	});
	
	let loadingHtml = '<div class="spinner-border m-5" role="status"><span class="visually-hidden">Загрузка...</span></div>';
	let thesaurusTemplate = document.getElementById('thesaurus-template').innerHTML;
	
	tippy.delegate('.js-doc-workspace', {
		target: 'a[href^="internal:thesaurus"]',
		content: loadingHtml,
		allowHTML: true,
		interactive: true,
		arrow: false,
		maxWidth: 'none',
		theme: 'orgzdrav',
		placement: 'bottom',
		offset: 0,
		popperOptions: { 
			positionFixed: true 
		},
		onCreate(instance) {
			instance._isFetching = false;
			instance._error = null;
		},
		onHidden(instance) {
			instance.setContent(loadingHtml);
			instance._error = null;
		},
		onShow(instance) {
			if (instance._isFetching || instance._error) {
				return;
			}

		instance._isFetching = true;
				
		gateTooltip.fetch(instance.reference.href)
			.then((data) => {
				instance.setContent(Mustache.render(thesaurusTemplate, data));
			})
			.catch((error) => {
				instance._error = error;
				instance.setContent(`Request failed. ${error}`);
			})
			.finally(() => {
				instance._isFetching = false;
			});
		}
	});
});

function scrollToTxtByIndex(index)
{
	if ($('.js-doc-workspace .js-doc-txt').eq(index).length) {
		$('.js-doc-workspace .js-doc-txt').eq(index)[0].scrollIntoView();
	}
}

const gateTooltip = (function () {
	
	let storage = [];
	
	return {
		fetch: async function(url) {
			let item = storage.find((el) => {
				return el.url == url;
			});
			
			if (item) return await Promise.resolve(item);
			
			let params = url.replace('internal:', '').split('/');
			let result = await BX.ajax.runComponentAction('orgzdrav:thesaurus', 'definition', {
				data: {
					id: params[1]
				}
			});
			
			result.data.url = url;
			storage.push(result.data);
			
			return await Promise.resolve(result.data);
		}
	};
})();