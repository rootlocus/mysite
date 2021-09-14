// require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import route from 'ziggy';
import { Ziggy } from './ziggy';
import Toaster from "@meforma/vue-toaster";
import { Inertia } from '@inertiajs/inertia';

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});

Inertia.on('start', (event) => {
    //hide all buttons that is non disable and turn on loader
    if (document.getElementById('loader')) {
        document.getElementById('loader').style.display = 'flex';
    }
});

Inertia.on('finish', (event) => {
    if (document.getElementById('loader')) {
        document.getElementById('loader').style.display = 'none';
    }
})

createInertiaApp({
    title: title => `${title} - Eric Heng`,
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
        .use(plugin)
        .use(Toaster)
        .mount(el)
    },
})