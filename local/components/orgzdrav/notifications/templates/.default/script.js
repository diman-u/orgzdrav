BX.ready(function() {
    "use strict";

    BX.Vue.create({
        el: '#orgzdrav-notifications',
        data() {
            return {
                notificationsList: {}
            }
        },
        methods: {
            getData: function () {
                BX.ajax.runComponentAction('orgzdrav:notifications', 'getAllByUserID', {
                    mode: 'class',
                    data: {}
                }).then((response) => {
                    this.notificationsList = response.data.notifications
                }, (response) => {});
            }
        },
        template: `
        <div class="panel-card">
            <div class="panel-card__header">
                <h3>Уведомления</h3>
            </div>

            <div class="panel-card__content">
                <div class="notify-item notify-item--attention" v-for="item in notificationsList">
                    <div class="notify-item__img notify-item__img--icon">
                        <span class="icon icon--blue icon--lg-lock"></span>
                    </div>
                    <div class="notify-item__content">
                        <a href="#" class="notify-item__title u-link-holder">{{ item.TITLE }}</a>
                        <div class="post-meta"></div>
                    </div>
                </div>
            </div>
        </div>
        `
    });
});