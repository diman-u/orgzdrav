(function($) {
	$(function() {
		let loadingHtml = '<div class="spinner-border m-5" role="status"><span class="visually-hidden">Загрузка...</span></div>';
		
		let thesaurusTemplate = document.getElementById('thesaurus-template').innerHTML;
		let attacheTemplate = document.getElementById('attache-template').innerHTML;
		
		/** attache */
		$('img[data-src^="attache:"]').each(function() {
			let attache = document.createElement('a');
			attache.href = this.getAttribute('data-src');
			attache.innerHTML = '<i class="bi bi-image"></i>';
			
			let $section = $(this).closest('.js-section');
			if (!$section.find('.js-section-media').length) {
				$section.append('<div class="mt-3 p-3 bg-light border rounded-3 d-inline-block js-section-media" />');
			}
			
			let url = buildAttacheUrl(attache.href);
			let thumb = buildAttacheUrl(attache.href, true);
			let preview = '<img class="js-attache-img img-thumbnail" src="'+thumb+'" loading="lazy" data-original="'+url+'" alt="" />';
			$section.find('.js-section-media').append(preview);
			
			this.parentNode.replaceChild(attache, this);
		});
		
		$('body').on('click', 'img.js-attache-img', function(e) {
			e.preventDefault();
			
			tippy.hideAll();
			
			const viewer = new Viewer(this, {
				url: "data-original",
				inline: false,
				loading: true,
				navbar: false,
				viewed() {
					this.viewer.zoomTo(1.5);
				},
				hidden() {
					this.viewer.destroy();
				}
			});
			viewer.show();
		});
		
		/** tippy */
		$('body').on('click', 'a[href^="internal:"], a[href^="attache:"]', function(e) {
			e.preventDefault();
			
			gateLink.process(this.href);
		});
		
		tippy.delegate('.js-guide-entity-workspace', {
			target: 'a[href^="internal:"][tooltip]',
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
		
		tippy.delegate('.js-guide-entity-workspace', {
			target: 'a[href^="attache:"]',
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
			onHidden(instance) {
				instance.setContent(loadingHtml);
			},
			onShow(instance) {
				let data = {
					url: buildAttacheUrl(instance.reference.href),
					thumb: buildAttacheUrl(instance.reference.href, true)
				};
				
				let tempImg = new Image;
				tempImg.onload = function() {
					instance.setContent(Mustache.render(attacheTemplate, data));
				};
				tempImg.src = data.thumb;
			}
		});
		
		if (window.gate22.anchor) {
			gateEntity.scrollTo(window.gate22.anchor);
		}
	});
	
	function buildAttacheUrl(originalUrl)
	{
		let url = new URL(window.gate22.url + 'db');
		let params = url.searchParams;
		
		params.append('SSr', window.gate22.ssr);
		params.append('cmd', 'file');
		
		originalUrl.replace('attache:', '').split(';').forEach(function(value) {
			let paramItem = value.split(':'); 
			params.append(paramItem[0], paramItem[1]);
		});
		
		if (arguments[1] && true === arguments[1] && params.has('img_id')) {
			let imgId = params.get('img_id');
			
			params.delete('img_id');
			params.append('img_id', 'fix-'+imgId+'-80x80');
		}
		
		return url.toString();
	}
})(jQuery);

const gateLink = (function () {
	
	let skipRegexp = /^(internal:thesaurus|attache:)/i;
	
	return {
		process: function(url) {
			if (url.match(skipRegexp)) {
				return;
			}
			
			let current = window.gate22.guide+'/'+ window.gate22.entity_id;
			let found = url.match(new RegExp(current+'/([^/]+)', 'i'));
			
			console.log(current);
			console.log(found);
			
			if (found && found.length) {
				gateEntity.scrollTo(found[1]);
			} else {
				window.location.href = url.replace('internal:', '/');
			}
		}
	};
})();

const gateEntity = (function () {
	let delayedElement;
	
	document.addEventListener('shown.bs.collapse', function () {
		if (delayedElement) {
			delayedElement.scrollIntoView({ block: 'start', behavior: 'smooth' });
			delayedElement = null;
		}
	});
	
	return {
		scrollTo: function(entityAnchor) {
			let chunks = entityAnchor.split('.');
			
			let sectionId = '';
			let elementId = chunks.reverse().shift();
			
			let section = document.getElementById(elementId);
			let el = document.getElementById(elementId);
			
			while (chunks.length) {
				let part = chunks.shift();
				
				sectionId += (sectionId.length ? '.' : '') + part;
				section = document.getElementById(sectionId);
				
				if (section) {
					break;
				}
			}
			
			if (section && section.classList.contains('accordion-collapse') && !section.classList.contains('show')) {
				bootstrap.Collapse.getOrCreateInstance(section).show();
				
				delayedElement = el;
				el = null;
			}
			
			if (el) {
				el.scrollIntoView({ block: 'start', behavior: 'smooth' });
			}
		}
	};
})();



const gateTooltip = (function () {
	
	let storage = [];
	
	return {
		fetch: async function(url) {
			let item = storage.find((el) => {
				return el.url == url;
			});
			
			if (item) return await Promise.resolve(item);
			
			return await fetch(url.replace('internal:', '/api/'))
				.then((response) => response.json())
				.then((data) => {
					data.url = url;
					storage.push(data);
					
					return data;
				});
		}
	};
})();


/*

const bsCollapse = bootstrap.Collapse.getInstance(section) 
					? bootstrap.Collapse.getInstance(section) 
					: new bootstrap.Collapse(section, { toggle: false });
					
				bsCollapse.show();
*/