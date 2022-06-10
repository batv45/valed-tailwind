import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import {NotyfPlugin} from "@/plugins";
import {Notyf} from "notyf";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Valed';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const myApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(NotyfPlugin)
            .component('InertiaLink', Link)
            .mixin({ methods: { route } });

        return myApp.mount(el)
    },
});
InertiaProgress.init({ color: '#4B5563' });
