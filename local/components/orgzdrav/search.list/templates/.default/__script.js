BX.ready(function() {
    "use strict";


    BX.Vue.component('search-terms',
    {
        data() {
            return {
                termsList: {}
            }
        },
        created() {
            if (window.orgzdrav_terms) {
                this.termsList = window.orgzdrav_terms
            }
        },
        methods: {},
        template: `
            <div>
                <table class="table">
                    <tr>
                        <td>Всего</td>
                        <td>{{ termsList.TOTAL }}</td>
                    </tr>
                    <tr>
                        <td>Теги</td>
                        <td>
                            <ul>
                                <li v-for="item in termsList.TERMS">{{ item }}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Счетчики</td>
                        <td>
                            <ul>
                                <li>
                                    <a 
                                        :href="'/test/search/?search='+ termsList.PARAMS.SEARCH +'&total='+ termsList.PARAMS.TOTAL +' '">
                                        all - {{ termsList.TOTAL }}
                                    </a>
                                </li>
                                <li v-for="item,key in termsList.COUNTS">
                                    <a 
                                        :href="'/test/search/?search='+ termsList.PARAMS.SEARCH +'&total='+ termsList.PARAMS.TOTAL +'&type='+ key +' '">
                                        {{ key }} - {{ item }}
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        `
    });

    BX.Vue.component('search-list',
        {
            data() {
                return {
                    searchList: {}
                }
            },
            created() {
                if (window.orgzdrav_search_list) {
                    this.searchList = window.orgzdrav_search_list
                }
            },
            methods: {
            },
            template: `
                <div class="grid grid--lg-3">
                    <div class="grid__column" v-for="item in searchList">
                        <article class="event-item">
                            <div class="event-item__img">
                                <img :src="item.photos.asis" alt="">
                                <div class="event-item__img-badge theme-blue">Online</div>
                            </div>
                            <div class="event-item__content">
                                <a :href="item.DETAIL_PAGE_URL" class="event-item__title u-link-holder">{{ item.header }}</a>
                                <p>{{ item.announcement }}</p>

                                <div class="post-meta">
                                    <div class="post-meta__tag is-big">Статья</div>
                                    <div class="post-meta__txt">{{ item.DISPLAY_CREATED }}</div>
                                    <div class="post-meta__cnt"></div>
                                    <a class="post-meta__bookmark" href=""></a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                `
            });

    BX.Vue.create({
        el: '#orgzdrav-search-list',
        template: `
            <div>
                <search-terms></search-terms>
                <search-list></search-list>
            </div>
        `
    });
});