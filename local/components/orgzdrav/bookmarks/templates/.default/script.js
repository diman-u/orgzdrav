BX.ready(function(){

    BX.Vue.create({
        el: '#orgzdrav-bookmarks',
        data() {
            return {
                TYPE: 'IBLOCK',
                ENTITY_ID: '',
                GUIDE: 'articles'
            }
        },
        methods: {
            add: function (id) {
                BX.ajax.runComponentAction('orgzdrav:bookmarks', 'add', {
                    mode: 'class',
                    data: {
                        type: this.TYPE,
                        entityID: id,
                        guide: this.GUIDE
                    }
                }).then((response) => {
                    console.log(response)
                }, (response) => {
                    console.log(response)
                });
            },
            delete: function () {
                console.log('del')
                // BX.ajax.runComponentAction('orgzdrav:bookmarks', 'delete', {
                //     mode: 'class',
                //     data: {
                //         ID: id
                //     }
                // }).then((response) => {
                //     console.log(response)
                // }, (response) => {
                //     console.log(response)
                // });
            }
        }
    });
})