import {Inertia} from "@inertiajs/inertia";
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import {onMounted} from "vue";
import {forEach} from "lodash/collection"; // for React, Vue and Svelte

export const NotyfPlugin = {
    install(app,options) {
        const notyf = new Notyf({
            ...options,
            position: {x:'right',y:'bottom'},
            duration: 3500,
            types: [
                {
                    type: 'info',
                    background: '#4299e1',
                    icon: {
                        className: 'notyf__icon--info',
                        tagName: 'i',
                        text: ''
                    }
                },
                {
                    type: 'warning',
                    background: 'orange',
                    icon: {
                        className: 'notyf__icon--warning',
                        tagName: 'i',
                        text: ''
                    }
                },
            ]
        })
        Object.defineProperty(app.config.globalProperties, '$notyf', { get: () => notyf })
        app.provide('notyf', app.config.globalProperties.$notyf)

        const runFlash = () => {
            const flash = JSON.parse(JSON.stringify(Inertia.page.props.flash))
            forEach(flash, (ff) => {
                if (ff.type === 'danger')
                    ff.type = 'error';
                if (ff.dismissible) {
                    ff.duration = 0;
                }
                notyf.open(ff);
            })
            Inertia.page.props.flash = []
        }
        Inertia.on('finish', (event) => runFlash())

        app.mixin({
            mounted() {
                if (!this.$parent) {
                    runFlash()
                }
            }
        })

    },
}
