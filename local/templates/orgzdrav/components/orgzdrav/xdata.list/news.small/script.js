$(function() {

    $(document).on('click', '.news-small__content .post-meta__bookmark', function(e) {
        e.preventDefault();

        BX.ajax.runComponentAction('orgzdrav:favorites', 'add', {
            mode: 'class',
            data: {
                favoriteID: $(this).data('id'),
                favoriteType: $(this).data('type')
            }
        }).then((response) => {}, (response) => {});
    });

    $(document).on('click', '.news-small__content .post-meta__bookmark__active', function(e) {
        e.preventDefault();

        BX.ajax.runComponentAction('orgzdrav:favorites', 'delete', {
            mode: 'class',
            data: {
                favoriteID: $(this).data('id')
            }
        }).then((response) => {}, (response) => {});
    });
});