import './bootstrap';
import '../sass/app.scss'
import { createApp, h } from 'vue';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import CKEditor from '@ckeditor/ckeditor5-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import PermissionsMixin from './Mixins/permissions.vue';
import HelperMixin from './Mixins/helpers.vue';

import Vue3ColorPicker from "vue3-colorpicker";
import "vue3-colorpicker/style.css";
import store from './store';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .use(CKEditor)
            .use(ZiggyVue, Ziggy)
            .use(VueSweetalert2)
            .use(ToastPlugin)
            .use(Vue3ColorPicker)
            .mixin(PermissionsMixin)
            .mixin(HelperMixin)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
