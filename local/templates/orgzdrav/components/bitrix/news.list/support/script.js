BX.ready(function() {
	$('.js-support-item[data-docid]').on('click', function(e) {
		if ('' === this.getAttribute('data-docid')) {
			return true;
		}
		
		e.preventDefault();
		
		const container = this.parentNode;
		const itemUrl = this.href;
		
		const loading = document.getElementById('loading-tpl').content.firstElementChild.cloneNode(true);
		container.appendChild(loading);
		
		BX.ajax.runComponentAction('wellcomes:doc', 'menu', {
			data: {
				id: this.getAttribute('data-docid')
			}
		}).then((response) => {
			const menu = document.createElement('ul');
			
			Object.keys(response.data).forEach((key) => {
				const li = document.createElement('li');
				const link = document.createElement('a');
				
				link.href = itemUrl + '#' + key;
				link.innerText = response.data[key];
				
				li.appendChild(link);
				menu.appendChild(li);
			});
			
			container.appendChild(menu);
			loading.remove();
			
			$(this).off('click').removeClass('link-text');
			
		}, (response) => {
			window.location = itemUrl;		
		});
	});
});