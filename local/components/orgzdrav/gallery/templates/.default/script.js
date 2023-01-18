(function() {
    $(function() {
        $('.js-gallery[data-id]').each(function() {
            let galleryID = $(this).attr('data-id'); 

            Macy({
                container: '.js-gallery[data-id="'+galleryID+'"]',
                trueOrder: false,
                waitForImages: false,
				margin: {
				  x: 0,
				  y: 8  
				},
                columns: 3,
                breakAt: {
                    768: 2,
                    420: 1
                }
            });
        });
    });
})();