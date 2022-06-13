import './bootstrap';

import {createApp, h, onMounted} from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {NotyfPlugin} from "@/plugins";
import { Components } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import VueTippy from 'vue-tippy'




const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Valed';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const myApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(NotyfPlugin)
            .use( VueTippy,{
                defaultProps: { placement: 'bottom' }
            } )
            .component('InertiaLink', Link)
            .mixin({ methods: { route } });
        return myApp.mount(el)
    },
});
InertiaProgress.init({ color: '#4B5563' });

Components.Pagination.setTranslations({
    no_results_found: "Görüntülenecek sonuç yok.",
    previous: "Önceki",
    next: "Sonraki",
    to: "ile",
    of: "arası toplam",
    results: "sonuç",
});
