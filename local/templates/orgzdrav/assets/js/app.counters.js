(function() {
	$(function() {
		run();
		
		$('body').on('content:new', function() {
			run();
		});
	});
	
	async function run()
	{
		let list = [];
		
		$('.js-cnt[data-id][data-type]').each(function() {
			list.push(this.getAttribute('data-id'));
		});
		
		if (!list.length) {
			return;
		}
		
		let response = await fetch('/api/views', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json;charset=utf-8'
			},
			body: JSON.stringify(list)
		});
		let data = await response.json();
		
		data.forEach((row) => {
			$('.js-cnt[data-id="'+row.entity_id+'"][data-type="'+row.guide+'"]')
				.removeClass('js-cnt')
				.find('.post-meta__cnt')
					.text(row.total);
		});
		
		$('.js-cnt[data-id][data-type] .post-meta__cnt:empty').each(function() {
			$(this).text('0');
		});
	}
})();