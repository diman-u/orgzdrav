$(function() {
	const controls = new BX.Orgzdrav.Controls();
	controls.initControls('#controls');
	controls.initPanels('#panels');
	
	const store = controls.getStore();
	
	/** init */
	setTimeout(() => updateBookmarks(), 500);
	
	/** global events */
	$('body').on('content:new', () => updateBookmarks());
	$('body').on('profile:update', () => store().fetchProfile());
	
	/** click events */
	$('body').on('click', '.js-bookmark[data-id][data-type] .post-meta__bookmark', function(e) {
		e.preventDefault();
		
		const id = $(this).closest('.js-bookmark').attr('data-id');
		const type = $(this).closest('.js-bookmark').attr('data-type');
		const status = store().hasBookmark(id, type);
		
		status
			? store().delBookmark(id, type)
			: store().addBookmark(id, type);
		
		$(this).toggleClass('is-active', !status);
	});
	
	/** update functions */
	function updateBookmarks()
	{
		$('.js-bookmark[data-id][data-type]').each(function() {
			const id = this.getAttribute('data-id');
			const type = this.getAttribute('data-type');
			const status = store().hasBookmark(id, type);
			
			$(this).find('.post-meta__bookmark').toggleClass('is-active', status);
		});
	}
});