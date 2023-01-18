(function(window)
{
   "use strict";

BX.Vue.component('orgzdrav-auth-promt', 
{
    template: `
<div class="auth-promt">
	<div class="auth-promt__card">
		<span class="icon icon--white icon--lg-lock"></span>
		<h2 class="mt-28">Войдите, чтобы использовать весь функционал платформы</h2>

		<div class="mb-32">
			<button class="btn-action" @click.prevent="$root.$emit('setStep', 'login')">
				Войти в личный кабинет
				<span class="btn-action__icon">
					<i class="icon icon--blue icon--md-user"></i>
				</span>
			</button>
			<button class="btn-action" @click.prevent="$root.$emit('setStep', 'registration')">
				Регистрация на платформе
				<span class="btn-action__icon">
					<i class="icon icon--blue icon--md-arrow-right"></i>
				</span>
			</button>
		</div>

		<p class="help-text help-text--white">Забыли логин или пароль? <a href="#" @click.prevent="$root.$emit('setStep', 'reset')">Восстановите доступ</a></p>
	</div>
	<div class="auth-promt__card">
		<h4>Занимает 2 минуты и дает много возможностей</h4>
		<ul class="icon-list">
			<li>Без ограничений просматривать статьи и материалы</li>
			<li>Оставлять комментарии к статьям и новостям</li>
			<li>Оставлять комментарии к статьям и новостям</li>
			<li>Подписаться на контент, который вас интересует</li>
			<li>Добавлять материалы в &laquo;Избранное&raquo;</li>
			<li>Вежливая поддержка пользователей 24/7</li>
		</ul>
	</div>
</div>
	`
});

BX.Vue.component('orgzdrav-auth-login', 
{
	data() {
		return {
			loading: false,
			error: '',
			login: '',
			password: '',
			remember: true
		}
    },
	methods: {
		submit: function() {
			this.error = '';
			this.loading = true;
			
			BX.ajax.runComponentAction('orgzdrav:auth', 'login', {
				data: {
					login: this.login,
					password: this.password,
					remember: this.remember
				}
			}).then((response) => {
				document.location.reload();				
			}, (response) => {
				this.error = response.errors[0].message;
				this.loading = false;		
			});
		}
	},
    template: `
<div class="alert">
	<div class="alert__title">Войти в личный кабинет</div>
	<p class="alert__help" v-if="error" v-html="error"></p>

	<label class="label">Email</label>
	<div class="control">
		<input type="email" placeholder="you@mail.com" v-model="login">
	</div>
            
	<label class="label">Пароль</label>
	<div class="control control--password">
		<input type="password" placeholder="Укажите пароль" v-model="password">
	</div>

	<div class="grid mt-24">
		<div class="grid__column">
			<div class="checkbox">
				<input type="checkbox" id="remember" v-model="remember" />
				<label for="remember">Запомнить меня</label>
			</div>
		</div>
		<div class="grid__column">
			<p class="text-md-right"><a href="#" @click.prevent="$root.$emit('setStep', 'reset')">Забыли пароль?</a></p>
		</div>
	</div>

	<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="submit" :disabled="loading">Войти</button>

	<p class="alert__help">У вас нет аккаунта? <a href="#" @click.prevent="$root.$emit('setStep', 'registration')">Регистрация</a></p>
</div>
	`
});

BX.Vue.component('orgzdrav-auth-reset', 
{
	data() {
		return {
			loading: false,
			error: '',
			step: 'choice',
			type: 'email',
			value: '',
			code: ['','','','','',''],
			hash: '',
			password: '',
			password_confirm: '',
			remember: true
		}
    },
	watch: {
		type: function() {
			this.value = '';
		},
		step: function(value) {
			if ('confirm' == value) {
				this.$nextTick(() => {
					document.querySelector('.alert input[type="text"]').focus();
				});
			}
		},
		code: function(value) {
			const active = document.activeElement;;
			if (active && active.parentNode.parentNode.nextSibling) {
				active.parentNode.parentNode.nextSibling.querySelector('input[type="text"]').focus();
			}
			
		},
		password_confirm: function(value) {
			this.password_error = this.password != value;
		}
	},
	methods: {
		submitChoice: function() {
			this.error = '';
			this.loading = true;
			
			BX.ajax.runComponentAction('orgzdrav:auth', 'resetSend', {
				data: {
					value: this.value,
					type: this.type
				}
			}).then((response) => {
				this.loading = false;
				this.step = 'confirm';				
			}, (response) => {
				this.error = response.errors[0].message;
				this.loading = false;		
			});
		},
		submitConfirm: function() {
			this.error = '';
			this.loading = true;
			
			BX.ajax.runComponentAction('orgzdrav:auth', 'resetConfirm', {
				data: {
					code: this.code.join('')
				}
			}).then((response) => {
				this.hash = response.data.hash;
				this.loading = false;
				this.step = 'reset';				
			}, (response) => {
				this.error = response.errors[0].message;
				this.loading = false;		
			});
		},
		submitReset: function() {
			this.error = '';
			this.loading = true;
			
			BX.ajax.runComponentAction('orgzdrav:auth', 'reset', {
				data: {
					hash: this.hash,
					password: this.password,
					password_confirm: this.password_confirm,
					remember: this.remember
				}
			}).then((response) => {
				this.loading = false;
				this.step = 'success';
				this.$root.$emit('setModal', true);				
			}, (response) => {
				this.error = response.errors[0].message;
				this.loading = false;		
			});
		},
		reload: function() {
			document.location.reload();
		}
	},
    template: `
<div class="alert">
	<template v-if="'choice' == step">
		<div class="alert__title">Забыли пароль?</div>
		<p class="alert__help" v-if="error" v-html="error"></p>
		
		<ul class="tabs-nav">
			<li class="tabs-nav__item" :class="{'tabs-nav__item--active': ('email' == type) }">
				<a href="#" @click.prevent="type = 'email'">Email</a>
			</li>
			<li class="tabs-nav__item" :class="{'tabs-nav__item--active': ('phone' == type) }">
				<a href="#" @click.prevent="type = 'phone'">Телефон</a>
			</li>
		</ul>
		
		<template v-if="'email' == type">
			<label class="label">Email</label>
			<div class="control">
				<input type="email" placeholder="you@mail.com" v-model="value">
			</div>
		</template>
		<template v-else>
			<label class="label">Телефон</label>
			<div class="control">
				<input type="text" placeholder="+7 900 00-00-00" v-model="value">
			</div>
		</template>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="submitChoice" :disabled="loading">Отправить</button>
		
		<p class="alert__help">Возникли проблемы? <a href="#" @click.prevent="$root.$emit('setStep', 'support')">Обратиться в поддержку</a></p>
	</template>
	<template v-else-if="'confirm' == step">
		<template v-if="'email' == type">
			<div class="alert__icon"><i class="icon icon--blue icon--lg-mail-download"></i></div>
			<div class="alert__title">Проверьте почту</div>
		</template>
		<template v-else>
			<div class="alert__icon"><i class="icon icon--blue icon--lg-iphone"></i></div>
			<div class="alert__title">Код из СМС</div>
		</template>
		<p class="alert__help">Выслали код на <strong>{{ value }}</strong>. Пожалуйста, укажите код для идентификации</p>
		<p class="alert__help" v-if="error" v-html="error"></p>

		<div class="grid grid--gap-8">
			<div class="grid__column" v-for="n in 6">
				<div class="control control--mini">
					<input type="text" placeholder="0" maxlength="1" v-model="code[(n-1)]">
				</div>
			</div>
		</div>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="submitConfirm" :disabled="loading">Отправить</button>

		<p class="alert__help">Возникли проблемы? <a href="#" @click.prevent="$root.$emit('setStep', 'support')">Обратиться в поддержку</a></p>
	</template>
	<template v-else-if="'reset' == step">
		<div class="alert__icon"><i class="icon icon--blue icon--lg-lock"></i></div>
		<div class="alert__title">Новый пароль</div>
		<p class="alert__help" v-if="error" v-html="error"></p>

		<label class="label">Придумайте пароль</label>
		<div class="control control--password">
			<input type="password" placeholder="Введите пароль" v-model="password">
		</div>
				
		<label class="label">Повторите пароль</label>
		<div class="control control--password">
			<input type="password" placeholder="Введите пароль" v-model="password_confirm">
		</div>

		<div class="checkbox  mt-24">
			<input type="checkbox" id="remember" v-model="remember" />
			<label for="remember">Запомнить меня</label>
		</div>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="submitReset" :disabled="loading">Сохранить</button>
	</template>
	<template v-else-if="'success' == step">
		<div class="alert__icon"><i class="icon icon--blue icon--lg-unlock"></i></div>
		<div class="alert__title">Пароль успешно изменен</div>
		
		<p class="alert__help">Поздравляем! Вы успешно изменили пароль <br />и вошли в личный кабинет</p>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="reload">Отлично</button>
	</template>
</div>
	`
});

BX.Vue.component('orgzdrav-auth-registration', 
{
	data() {
		return {
			loading: false,
			step: 2,
			errors: {},
			form: {
				NAME: '',
				LAST_NAME: '',
				SECOND_NAME: '',
				EMAIL: '',
				LOGIN: '',
				PERSONAL_PHONE: '',
				PERSONAL_PROFESSION: '',
				WORK_COMPANY: '',
				WORK_POSITION: '',
				WORK_COUNTRY: '',
				WORK_CITY: '',
				PASSWORD: '',
				PASSWORD_CONFIRM: '',
				remember: true,
			}
		}
    },
	methods: {
		next: function() {
			this.errors = {}

			// Step 1
			if (this.step == 1) {
				BX.ajax.runComponentAction('orgzdrav:auth', 'registration', {
					mode: 'class',
					data: {
						form: {
							step: this.step,
							NAME: this.form.NAME,
							SECOND_NAME: this.form.SECOND_NAME,
							LAST_NAME: this.form.LAST_NAME,
							EMAIL: this.form.EMAIL,
							LOGIN: this.form.EMAIL,
							PERSONAL_PHONE: this.form.PERSONAL_PHONE
						}
					}
				}).then((response) => {

					if (response.data.errors.length > 0) {

						response.data.errors.forEach((item, i, arr) => {
							if (Object.keys(item)[0]) {
								this.errors[Object.keys(item)[0]] = Object.values(item)[0]
							} else {
								this.errors.other = [Object.values(item)[0]]
							}

						})
					} else {
						this.step++;
					}

				}, (response) => {
					console.log(response)
				});
			}

			// Step 2
			if (this.step == 2) {
				BX.ajax.runComponentAction('orgzdrav:auth', 'registration', {
					mode: 'class',
					data: {
						form: {
							step: this.step,
							PERSONAL_PROFESSION: this.form.PERSONAL_PROFESSION,
							WORK_COMPANY: this.form.WORK_COMPANY,
							WORK_POSITION: this.form.WORK_POSITION,
							WORK_COUNTRY: this.form.WORK_COUNTRY,
							WORK_CITY: this.form.WORK_CITY,
						}
					}
				}).then((response) => {

					if (response.data.errors.length > 0) {

						response.data.errors.forEach((item, i, arr) => {
							if (Object.keys(item)[0]) {
								this.errors[Object.keys(item)[0]] = Object.values(item)[0]
							} else {
								this.errors.other = [Object.values(item)[0]]
							}

						})
					} else {
						this.step++;
					}

				}, (response) => {
					console.log(response)
				});
			}

		},
		submit: function() {
			this.errors = {}
			// Step 3
			if (this.step == 3) {
				BX.ajax.runComponentAction('orgzdrav:auth', 'registration', {
					mode: 'class',
					data: {
						form: {
							step: this.step,
							NAME: this.form.NAME,
							SECOND_NAME: this.form.SECOND_NAME,
							LAST_NAME: this.form.LAST_NAME,
							EMAIL: this.form.EMAIL,
							LOGIN: this.form.EMAIL,
							PERSONAL_PHONE: this.form.PERSONAL_PHONE,
							PERSONAL_PROFESSION: this.form.PERSONAL_PROFESSION,
							WORK_COMPANY: this.form.WORK_COMPANY,
							WORK_POSITION: this.form.WORK_POSITION,
							WORK_COUNTRY: this.form.WORK_COUNTRY,
							WORK_CITY: this.form.WORK_CITY,
							PASSWORD: this.form.PASSWORD,
							PASSWORD_CONFIRM: this.form.PASSWORD_CONFIRM,
							remember: this.remember
						}
					}
				}).then((response) => {

					if (response.data.errors.length > 0) {

						response.data.errors.forEach((item, i, arr) => {
							if (Object.keys(item)[0]) {
								this.errors[Object.keys(item)[0]] = Object.values(item)[0]
							} else {
								this.errors.other = [Object.values(item)]
							}
						})
					}

					if (response.data.success == true) {
						this.step = 'success';
					}

				}, (response) => {
					console.log(response)
				});
			}
			this.$root.$emit('setModal', true);
		},
		reload: function() {
			document.location.reload();
		}
	},
    template: `
<div>
<div class="steps" v-if="'success' != step">
	<div class="steps__item" :class="{'steps__item--active': (1 == step) }">
		<i class="icon icon--white" :class="(1 < step) ? 'icon--md-check' : 'icon--md-number-one'"></i>
	</div>
	<div class="steps__devider"></div>
	<div class="steps__item" :class="{'steps__item--active': (2 == step) }">
		<i class="icon icon--white" :class="(2 < step) ? 'icon--md-check' : 'icon--md-number-two'"></i>
	</div>
	<div class="steps__devider"></div>
	<div class="steps__item" :class="{'steps__item--active': (3 == step) }">
		<i class="icon icon--white" :class="(3 < step) ? 'icon--md-check' : 'icon--md-number-three'"></i>
	</div>
</div>
<div class="alert">
	<template v-if="1 == step">
		<div class="alert__title">Создать аккаунт</div>
		
		<div class="grid mb-12">
            <div class="grid__column">
                <label class="label">Имя</label>
                <div class="control">
                    <input type="text" placeholder="Имя" v-model="form.NAME">
                    <p v-if="errors.NAME" v-html="errors.NAME"></p>
                </div>
            </div>
            <div class="grid__column">
                <label class="label">Отчество</label>
                <div class="control">
                    <input type="text" placeholder="Отчество" v-model="form.SECOND_NAME">
                    <p v-if="errors.SECOND_NAME" v-html="errors.SECOND_NAME"></p>
                </div>
            </div>
        </div>
            
        <label class="label">Фамилия</label>
        <div class="control">
            <input type="text" placeholder="Фамилия" v-model="form.LAST_NAME">
            <p v-if="errors.LAST_NAME" v-html="errors.LAST_NAME"></p>
        </div>

        <label class="label">Email</label>
        <div class="control">
            <input type="email" placeholder="you@mail.com" v-model="form.EMAIL">
            <p v-if="errors.EMAIL" v-html="errors.EMAIL"></p>
        </div>

        <label class="label">Телефон</label>
        <div class="control">
            <input type="text" placeholder="+7 900 00-00-00" v-model="form.PERSONAL_PHONE">
            <p v-if="errors.PERSONAL_PHONE" v-html="errors.PERSONAL_PHONE"></p>
        </div>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="next" :disabled="loading">Дальше</button>
		
		<p class="alert__help">Уже зарегистрировались? <a href="#" @click.prevent="$root.$emit('setStep', 'login')">Войти</a></p>
	</template>
	<template v-else-if="2 == step">
		<div class="alert__title">Где вы работаете?</div>

        <label class="label">Субъект РФ</label>
        <div class="control control--select">
            <select v-model="form.WORK_COUNTRY">
                <option value="0">Выберите субъект</option>
                <option value="Московская область">Московская область</option>
            </select>
            <p v-if="errors.WORK_COUNTRY" v-html="errors.WORK_COUNTRY"></p>
        </div>

        <label class="label">Город</label>
        <div class="control control--select">
            <select v-model="form.WORK_CITY">
                <option value="">Выберите город</option>
                <option value="Москва">Москва</option>
            </select>
            <p v-if="errors.WORK_CITY" v-html="errors.WORK_CITY"></p>
        </div>

        <label class="label">Место работы</label>
        <div class="control">
            <input type="text" placeholder="Организация" v-model="form.WORK_COMPANY">
            <p v-if="errors.WORK_COMPANY" v-html="errors.WORK_COMPANY"></p>
        </div>
		
        <label class="label">Должность</label>
        <div class="control">
            <input type="text" placeholder="Должность" v-model="form.WORK_POSITION">
            <p v-if="errors.WORK_POSITION" v-html="errors.WORK_POSITION"></p>
        </div>
		
        <label class="label">Специальность</label>
        <div class="control">
            <input type="text" placeholder="Специальность" v-model="form.PERSONAL_PROFESSION">
            <p v-if="errors.PERSONAL_PROFESSION" v-html="errors.PERSONAL_PROFESSION"></p>
        </div>
		
		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="next" :disabled="loading">Дальше</button>
	</template>
	<template v-else-if="3 == step">
		<div class="alert__title">Придумайте пароль</div>
		
		<label class="label">Придумайте пароль</label>
		<div class="control control--password">
			<input type="password" placeholder="Введите пароль" v-model="form.PASSWORD">
			<p v-if="errors.EMAIL" v-html="errors.PASSWORD"></p>
		</div>
				
		<label class="label">Повторите пароль</label>
		<div class="control control--password">
			<input type="password" placeholder="Введите пароль" v-model="form.PASSWORD_CONFIRM">
			<p v-if="errors.EMAIL" v-html="errors.PASSWORD_CONFIRM"></p>
		</div>

		<div class="checkbox  mt-24">
			<input type="checkbox" id="remember" v-model="form.remember" />
			<label for="remember">Запомнить меня</label>
		</div>
		
		<div v-if="errors.other">
			<ul class="errorsRegister">
				<li v-for="error in errors.other">{{ error }}</li>
			</ul>
		</div>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="submit" :disabled="loading">Зарегистрироваться</button>
		
	</template>
	<template v-else-if="'success' == step">
		<div class="alert__icon"><i class="icon icon--blue icon--lg-check-one"></i></div>
		<div class="alert__title">Успешная регистрация</div>
		
		<p class="alert__help">Поздравляем! Вы успешно прошли регистрацию. <br />Добро пожаловать на портал &laquo;Оргздрав Эксперт&raquo;</p>

		<button class="btn btn--big btn--block btn--bright mt-24" @click.prevent="reload">Я молодец!</button>
	</template>
</div>
</div>
	`
});

BX.Vue.component('orgzdrav-auth-support', 
{
	data() {
		return {
			loading: false,
			success: false,
			error: '',
			email: '',
			message: ''
		}
    },
	methods: {
		submit: function() {
			this.error = '';
			this.loading = true;
			
			BX.ajax.runComponentAction('orgzdrav:auth', 'support', {
				data: {
					email: this.email,
					message: this.message
				}
			}).then((response) => {
				this.success = true;		
			}, (response) => {
				this.error = response.errors[0].message;
				this.loading = false;		
			});
		}
	},
    template: `
<div class="alert">
	<div class="alert__title">Обратиться в поддержку</div>
	<template v-if="success">
		<p class="alert__help">Ваше сообщение успешно отправлено!</p>
	</template>
	<template v-else>
		<p class="alert__help" v-if="error" v-html="error"></p>
		
		<label class="label">Email</label>
		<div class="control">
			<input type="email" placeholder="you@mail.com" v-model="email">
		</div>
				
		<label class="label">Сообщение</label>
		<div class="control">
			<textarea v-model="message"></textarea>
		</div>

		<button class="btn btn--big btn--block btn--bright mt-24" @click="submit" :disabled="loading">Отправить сообщение</button>
	</template>
</div>
	`
});

BX.Vue.create({ 
	el: '#orgzdrav-auth',
	data: {
		active: false,
		modal: false,
		year: '',
		step: 'login'
	},
	watch: {
		step: function(value) {
			this.modal = 'promt' === value;
		}
	},
	methods: {
		close: function() {
			this.active = false;
			this.step = 'promt';
			
			$('body').removeClass('overflow-hidden');
		}
	},
	created()
    {
		this.year = (new Date()).getFullYear();
		
        this.$root.$on('setStep', (step) => {
			this.step = step;
		});
		this.$root.$on('setModal', (modal) => {
			this.modal = modal;
		});
		
		$(document).on('orgzdrav-auth', (e, step) => {
			this.step = step || 'login';
			this.active = true;
			
			$('body').addClass('overflow-hidden');
		});
    },
	template: `
<div class="page-overlay" :class="{ 'page-overlay--active': active, 'page-overlay--modal': modal }">
	<header>
        <button class="page-overlay__close" @click="close">
            <i class="icon icon--blue icon--md-arrow-left"></i>
        </button>
        <img class="page-overlay__logo" src="/local/templates/orgzdrav/assets/img/logo-org.svg" loading="lazy" alt="Оргздрав Эксперт">
    </header>
	<orgzdrav-auth-promt v-if="'promt' === step" />
	<orgzdrav-auth-login v-else-if="'login' === step" />
	<orgzdrav-auth-reset v-else-if="'reset' === step" />
	<orgzdrav-auth-registration v-else-if="'registration' === step" />
	<orgzdrav-auth-support v-else-if="'support' === step" />
	<footer>
        <p>&copy; {{ year }} Оргздрав Эксперт. Все права защищены, копирование с сайта недопустимо.</p>
    </footer>
</div>
	`
});

})(window);