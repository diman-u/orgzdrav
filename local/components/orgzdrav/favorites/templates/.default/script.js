BX.ready(function(){

    BX.Vue.create({
        el: '#orgzdrav-favorites',
        data() {
            return {
                favoritesList: {}
            }
        },
        created() {
            if (window.orgzdrav_user_favorites) {
                this.favoritesList = window.orgzdrav_user_favorites
                console.log(this.favoritesList)
            }
        },
        methods: {
            deleteFavorite: function (favoriteID) {
                BX.ajax.runComponentAction('orgzdrav:favorites', 'delete', {
                    mode: 'class',
                    data: {
                        favoriteID: favoriteID
                    }
                }).then((response) => {
                    console.log(response)
                }, (response) => {
                    console.log(response)
                });
            }
        },
        template: `
            <section>
                <div class="grid grid--lg-3">
                    <div class="grid__column" v-for="item in favoritesList">
                        <article class="event-item">
                            <div class="event-item__img">
                                <img :src="item.photos.asis" alt="">
                            </div>
                            <div class="event-item__content">
                                <a :href="item.DETAIL_PAGE_URL" class="event-item__title u-link-holder">
                                    {{ item.header }}</a>
                                <div class="event-item__value">Проводим: <span>Конференция в Zoom</span></div>

                                <div class="post-meta">
                                    <div class="post-meta__tag is-big">Вебинар</div>
                                    <div class="post-meta__txt">12 дек 2021</div>
                                    <div class="post-meta__cnt">180</div>
                                    <a class="post-meta__bookmark" href="" @click.prevent="deleteFavorite(item.id)"></a>
                                </div>
                            </div>
                        </article>
                    </div>                    
                </div>
            </section>
        `
    });
})