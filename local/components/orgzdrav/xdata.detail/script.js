BX.ready(function(){

    BX.Vue.component('button-favorites',
    {
        data() {
            return {

            }
        },
        template: `
            <a class="post-meta__bookmark" href=""></a>
        `
    });

    BX.Vue.create({
        el: '#orgzdrav-button-favorites',
        data() {
            return {
                count: ''
            }
        },
        template: `
            <button-favorites></button-favorites>
        `
    })
});
