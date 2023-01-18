BX.ready(function(){

    BX.Vue.create({
        el: '#orgzdrav-top-filter',
        data() {
            return {
                count: ''
            }
        },
        created() {
            this.count = ''
            this.getNotifications()
        },
        methods: {
            getNotifications: function (id) {
                BX.ajax.runComponentAction('orgzdrav:filter.top_count', 'getCountFilterNews', {
                    mode: 'class',
                    data: {
                    }
                }).then((response) => {
                    this.count = response.data.count
                }, (response) => {
                    console.log(response)
                });
            },
        }
    });
})