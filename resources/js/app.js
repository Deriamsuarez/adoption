import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Toast, { POSITION } from "vue-toastification";
import { vMaska } from "maska/vue"

import "vue-toastification/dist/index.css";
import 'keen-slider/keen-slider.min.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const options = {
    position: POSITION.BOTTOM_RIGHT,
    timeout: 5000,
    closeOnClick: true,
    pauseOnHover: true,
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props)
        });

        app.directive('maska', vMaska);
        app.use(Toast, options);
        app.use(plugin);
        app.use(ZiggyVue);

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
