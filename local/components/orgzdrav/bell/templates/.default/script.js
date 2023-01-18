BX.ready(function(){

    BX.Vue.create({
        el: '#orgzdrav-bell',
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
                BX.ajax.runComponentAction('orgzdrav:bell', 'getNotifications', {
                    mode: 'class',
                    data: {
                    }
                }).then((response) => {
                    this.count = response.data.count
                }, (response) => {
                    console.log(response)
                });
            },
        },
        template: `
            <div class="panel-card">
            <div class="panel-card__header">
                <h3>Уведомления</h3>
            </div>

            <div class="panel-card__content">
                <div class="notify-item notify-item--attention">
                    <div class="notify-item__img">
                        <img src="img/demo/news-small-1.jpg" alt="">
                    </div>
                    <div class="notify-item__content">
                        <a href="news-one.html" class="notify-item__title u-link-holder">Интервью с Эдуардом Никитеным
                            на открытой площадке «Весть»</a>

                        <div class="post-meta">
                            <div class="post-meta__tag">Интервью</div>
                            <div class="post-meta__txt">Завтра в 12:30</div>
                            <a class="post-meta__bookmark" href="#"></a>
                        </div>
                    </div>
                </div>
                <div class="notify-item">
                    <div class="notify-item__img notify-item__img--icon">
                        <span class="icon icon--blue icon--lg-lock"></span>
                    </div>
                    <div class="notify-item__content">
                        <span class="notify-item__title">Пароль успешно изменен</span>

                        <div class="post-meta">
                            <div class="post-meta__txt">1 день назад</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `
    });
})