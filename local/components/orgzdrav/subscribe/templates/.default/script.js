BX.ready(function(){

    BX.Vue.create({
        el: '#orgzdrav-subscribe',
        data() {
            return {
                email: '',
                fio: '',
                organization: '',
            }
        },
        methods: {
            checkEmail: function () {
                BX.ajax.runComponentAction('orgzdrav:subscribe', 'checkEmail', {
                    mode: 'class',
                    data: {
                        email: this.email,
                        fio: this.fio,
                        organization: this.organization,
                    }
                }).then((response) => {
                    console.log(response)
                }, (response) => {
                    console.log(response)
                });
            },
        },
        template: `
        <div>
            <input class="fio" type="text" placeholder="Введите фио" v-model="fio">
            <input class="userEmail" type="text" placeholder="Введите email" v-model="email">
            <input class="organization" type="text" placeholder="Название организации" v-model="organization">
            <button class="btn" @click.prevent="checkEmail()">Подписаться</button>
        </div>
        `
    });
})