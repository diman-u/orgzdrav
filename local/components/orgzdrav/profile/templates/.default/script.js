BX.ready(function(){
    "use strict";

    BX.Vue.component('profile-form',
    {
        data() {
            return {
                success: false,
                errors: {},
                form: {
                    NAME: '',
                    LAST_NAME: '',
                    SECOND_NAME: '',
                    EMAIL: '',
                    PERSONAL_PHONE: '',
                    PERSONAL_PROFESSION: '',
                    WORK_COMPANY: '',
                    WORK_POSITION: '',
                    WORK_COUNTRY: '',
                    WORK_CITY: '',
                }
            }
        },
        created() {
            if (window.orgzdrav_profile) {
                this.form = window.orgzdrav_profile
            }
        },
        methods: {
            save: function() {
                this.errors = {}

                BX.ajax.runComponentAction('orgzdrav:profile', 'update', {
                    mode: 'class',
                    data: {
                        name: this.form.NAME,
                        secondName: this.form.SECOND_NAME,
                        lastName: this.form.LAST_NAME,
                        email: this.form.EMAIL,
                        phone: this.form.PERSONAL_PHONE
                    }
                }).then((response) => {
                    this.success = false

                    if (!response.data.errors) {
                        this.success = true
                    } else {

                        response.data.errors.forEach((item, i, arr) => {
                            if (Object.keys(item)[0]) {
                                this.$set(this.errors, Object.keys(item)[0], Object.values(item)[0]);
                                // this.errors[Object.keys(item)[0]] = Object.values(item)[0]
                            } else {
                                this.errors.other = [Object.values(item)[0]]
                            }
                        })
                    }

                    console.log(this.errors)

                }, (response) => {
                    this.success = false

                    if (response.errors) {
                        this.errors.other = [Object.values(response.errors)[0].message]
                    }
                });
            }
        },
        template: `
            <div>
                <div class="errorUpdateProfile" v-if="errors.other">
                    <ul>
                        <li v-for="error in errors.other">{{ error }}</li>
                    </ul>                
                </div>
                <div class="succesUpdateProfile" v-if="success">
                    <div>
                        Данные успешно обновлены
                    </div>
                </div>
                
                <p class="h5">Личные данные</p>

                <div class="grid grid--gap-8">
                    <div class="grid__column">
                        <label class="label">Имя</label>
                        <div class="control">
                            <input type="text" v-model="form.NAME" placeholder="Введите имя">
                            <p v-if="errors.NAME" v-html="errors.NAME"></p>
                        </div>
                    </div>
                    <div class="grid__column">
                        <label class="label">Отчество</label>
                        <div class="control">
                            <input type="text" v-model="form.SECOND_NAME" placeholder="Введите отчество">
                            <p v-if="errors.SECOND_NAME" v-html="errors.SECOND_NAME"></p>
                        </div>
                    </div>
                </div>

                <label class="label">Фамилия</label>
                <div class="control">
                    <input type="text" v-model="form.LAST_NAME" placeholder="Введите фамилию">
                    <p v-if="errors.LAST_NAME" v-html="errors.LAST_NAME"></p>
                </div>


                <p class="h5">Контакты</p>

                <label class="label">Email</label>
                <div class="control">
                    <input type="email" v-model="form.EMAIL" placeholder="Введите email">
                    <p v-if="errors.EMAIL" v-html="errors.EMAIL"></p>
                </div>

                <label class="label">Телефон</label>
                <div class="control js-control-phone">
                    <input type="text" v-model="form.PERSONAL_PHONE" placeholder="Введите телефон">
                    <p v-if="errors.PERSONAL_PHONE" v-html="errors.PERSONAL_PHONE"></p>
                </div>
                
                <p class="h5">Информация о работе</p>
                
                <label class="label">Субъект РФ</label>
                <div class="control control--select">
                    <select>
                        <option value="">Выберите субъект</option>
                        <option value="">Москва</option>
                    </select>
                </div>
                
                <label class="label">Город</label>
                <div class="control control--select">
                    <select>
                        <option value="">Выберите город</option>
                        <option value="">Москва</option>
                    </select>
                </div>
                
                <label class="label">Место работы</label>
                <div class="control">
                    <input type="text" v-model="form.WORK_COMPANY" placeholder="">
                    <p v-if="errors.WORK_COMPANY" v-html="errors.WORK_COMPANY"></p>
                </div>
                
                <label class="label">Должность</label>
                <div class="control">
                    <input type="text" v-model="form.WORK_POSITION" placeholder="">
                    <p v-if="errors.WORK_POSITION" v-html="errors.WORK_POSITION"></p>
                </div>
                
                <label class="label">Специальность</label>
                <div class="control">
                    <input type="text" v-model="form.PERSONAL_PROFESSION" placeholder="">
                    <p v-if="errors.PERSONAL_PROFESSION" v-html="errors.PERSONAL_PROFESSION"></p>
                </div>
                
                <a href="/logout">Выйти из аккаунта</a>
                
                <div class="panel-card__footer">
                    <button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="save">Сохранить</button>
                </div>

            </div>
        `
    });

    BX.Vue.component('user-subscribe',
    {
        data() {
            return {
                subscribeList: {}
            }
        },
        created() {
            if (window.orgzdrav_user_subcribe) {
                this.subscribeList = window.orgzdrav_user_subcribe
            }
        },
        methods: {
            save: function () {
                this.subscribeList.forEach((item, i, arr) => {
                    if (item.ACTIVE == 1) {
                        this.addSubscribe(item.ID)
                    } else {
                        this.deleteSubscribe(item.ID)
                    }
                })
            },
            addSubscribe: function (subscribeID) {
                BX.ajax.runComponentAction('orgzdrav:profile', 'addSubscribe', {
                    mode: 'class',
                    data: {
                        subscribeID: subscribeID
                    }
                }).then((response) => {}, (response) => {});
            },
            deleteSubscribe: function (subscribeID) {
                BX.ajax.runComponentAction('orgzdrav:profile', 'deleteSubscribe', {
                    mode: 'class',
                    data: {
                        ID: subscribeID
                    }
                }).then((response) => {
                    console.log(response)
                }, (response) => {
                    console.log(response)
                });
            }
        },
        template: `
            <div>
                <p class="h5">Быть в курсе</p>
                
                <div v-for="item in subscribeList">
                    <div class="control control--block">
                        <div class="checkbox checkbox--reverse">
                            <input 
                                type="checkbox" 
                                :id="item.ID"
                                v-model="item.ACTIVE"
                            >
                            <label :for="item.ID">{{ item.UF_TITLE }}</label>
                        </div>
                    </div>
                </div>
                <button 
                    class="btn btn--big btn--block btn--bright mt-24" 
                    @click.prevent="save"
                >
                    Сохранить
                </button>
            </div>
        `
    });

    BX.Vue.component('change-password',
        {
            data() {
                return {
                    success: false,
                    errors: [],
                    form: {
                        currentPassword: '',
                        newPassword: '',
                        repeatPassword: ''
                    }
                }
            },
            computed: {
                fieldsNotEmpty: function () {

                    if (0 < this.form.currentPassword.length) {
                        return false;
                    }

                    if (0 < this.form.newPassword.length) {
                        return false;
                    }

                    if (0 < this.form.repeatPassword.length) {
                        return false;
                    }

                    return true
                }
            },
            methods: {
                save: function() {
                    this.errors = {}

                    BX.ajax.runComponentAction('orgzdrav:profile', 'changePassword', {
                        mode: 'class',
                        data: {
                            currentPassword: this.form.currentPassword,
                            newPassword: this.form.newPassword,
                            repeatPassword: this.form.repeatPassword
                        }
                    }).then((response) => {
                        this.success = false

                        if (!response.data.errors) {
                            this.success = true
                        } else {
                            response.data.errors.forEach((item, i, arr) => {
                                if (Object.keys(item)[0]) {
                                    this.errors[Object.keys(item)[0]] = Object.values(item)[0]
                                } else {
                                    this.errors.other = [Object.values(item)[0]]
                                }

                            })
                        }

                    }, (response) => {
                        this.success = false

                        if (response.errors) {
                            this.errors.other = [Object.values(response.errors)[0].message]
                        }
                    });
                }
            },
            template: `
                <div>
                
                    <div class="errorUpdatePassword" v-if="errors.other">
                        <ul>
                            <li v-for="error in errors.other">{{ error }}</li>
                        </ul>
                    </div>
                    <div class="succesUpdatePassword" v-if="success">
                        <div>
                            Данные успешно обновлены
                        </div>
                    </div>
                    
                    <p class="h5">Изменить пароль</p>

                    <label class="label">Текущий пароль</label>
                    <div class="control control--password">
                        <input 
                            type="password"
                            v-model="form.currentPassword"
                            placeholder="Введите текущий пароль"
                        >
                        <p v-if="errors.currentPassword" v-html="errors.currentPassword"></p>
                    </div>

                    <label class="label">Новый пароль</label>
                    <div class="control control--password">
                        <input type="password" v-model="form.newPassword" placeholder="Придумайте новый пароль">
                        <p v-if="errors.newPassword" v-html="errors.newPassword"></p>
                    </div>

                    <label class="label">Новый пароль</label>
                    <div class="control control--password">
                        <input type="password" v-model="form.repeatPassword" placeholder="Повторите новый пароль">
                        <p v-if="errors.repeatPassword" v-html="errors.repeatPassword"></p>
                    </div>

                    <button 
                        class="btn btn--big btn--block btn--bright mt-24" 
                        @click.prevent="save"
                        :disabled="!fieldsNotEmpty"
                    >
                        Сохранить
                    </button>
                </div>
            `
    });

    BX.Vue.create({
        el: '#orgzdrav-profile',
        data() {
            return {
                tab: 'profile'
            }
        },
        methods: {},
        template: `
            <div class="panel-card">
                <div class="panel-card__header">
                    <h3>Профиль</h3>
    
                    <ul class="tabs-nav">
                        <li class="tabs-nav__item" v-bind:class="{ 'tabs-nav__item--active': tab == 'profile' }">
                            <a href="#" @click="tab = 'profile'">Настройки</a>
                        </li>
                        <li class="tabs-nav__item" v-bind:class="{ 'tabs-nav__item--active': tab == 'subscribe' }">
                            <a href="#" @click="tab = 'subscribe'">Подписка на разделы</a>
                        </li>
                        <li class="tabs-nav__item" v-bind:class="{ 'tabs-nav__item--active': tab == 'security' }">
                            <a href="#" @click="tab = 'security'">Безопасность</a>
                        </li>
                    </ul>
                </div>
    
                <div class="panel-card__content">
                    <div class="tab-content">
                        <div class="tab-content__pane tab-content__pane--active" v-if="tab == 'profile'">
                            <profile-form></profile-form>
                        </div>
                        <div class="tab-content__pane tab-content__pane--active" v-if="tab == 'subscribe'">
                            <user-subscribe></user-subscribe>
                        </div>                        
                        <div class="tab-content__pane tab-content__pane--active" v-if="tab == 'security'">
                            <change-password></change-password>
                        </div>                            
                    </div>
                </div>
            </div>
        `
    });
})