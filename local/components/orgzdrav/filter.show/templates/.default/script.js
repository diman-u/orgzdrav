BX.ready(function(){
    "use strict";

    BX.Vue.component('news-filter',
        {
            data() {
                return {
                    newsList: [],
                    checkCategories: []
                }
            },
            created() {

                if (window.orgzdrav_newsFilter) {
                    this.newsList = window.orgzdrav_newsFilter
                }

                if (window.orgzdrav_checkCategories) {
                    this.checkCategories = window.orgzdrav_checkCategories
                    // console.log(this.checkCategories)
                }
            },
            methods: {
                addToDB: function () {
                    BX.ajax.runComponentAction('orgzdrav:filter.show', 'add', {
                        mode: 'class',
                        data: {
                            categories: this.checkCategories
                        }
                    }).then((response) => {}, (response) => {});
                },
                apply: function () {
                    this.addToDB();
                }
            },
            template: `
                <div class="panel-card">
                    <div class="panel-card__header">
                        <h3>Фильтр</h3>
                    </div>
        
                    <div class="panel-card__content">
                        <div class="control control--block" v-for="item in newsList">
                            <div class="checkbox checkbox--reverse">
                                <input
                                    :id="item.ID"
                                    type="checkbox"
                                    v-model="checkCategories"
                                    :value="item.ID"
                                >
                                <label :for="item.ID">{{ item.UF_TITLE }}</label>
                            </div>
                        </div>
                        <div>
                            <button 
                                class="btn btn--big btn--block btn--bright mt-24" 
                                @click.prevent="apply"
                            >
                                Применить
                            </button>
                        </div>                        
                    </div>
                </div>
                `
            });

    BX.Vue.create({
        el: '#orgzdrav-filter-show',
        template: `
            <news-filter></news-filter>
        `
    });
})