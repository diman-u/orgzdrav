BX.ready(function(){
    "use strict";

    BX.Vue.component('filter-tags',
        {
            data() {
                return {
                    newsCategory: {},
                    userFilter: {}
                }
            },
            created() {
                if (window.orgzdrav_newsCategory) {
                    this.newsCategory = window.orgzdrav_newsCategory
                }

                if (window.orgzdrav_userFilter) {
                    this.userFilter = window.orgzdrav_userFilter
                }
            },
            methods: {
                addToDB: function () {
                    BX.ajax.runComponentAction('orgzdrav:filter.show', 'add', {
                        mode: 'class',
                        data: {
                            categories: this.tagsList
                        }
                    }).then((response) => {}, (response) => {});
                },
                deleteTag: function (key) {
                    this.$delete(this.tagsList, key)
                }
            },
            template: `
                <div>
                    <h3>Тэги фильтра</h3>
                    <div class="grid">
                        <div class="grid__column">
                            <input type="text" v-model="userFilter.DATE_BEGIN">
                        </div>
                        <div class="grid__column">
                            <input type="text" v-model="userFilter.DATE_END">
                        </div>
                    </div>
                    <div v-for="item, key in newsCategory">
                        <span>{{ item.UF_TITLE }}</span>
                        <span>
                            <input type="checkbox" :checked="item.ACTIVE" @click="deleteTag(key)">
                        </span>
                    </div>
                </div>
            `
            });

    BX.Vue.create({
        el: '#orgzdrav-filter-tags',
        template: `
            <filter-tags></filter-tags>
        `
    });
})