import './bootstrap';
import '../css/app.css';

import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';

import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({el, App, props, plugin}) {
    return (
      createApp({render: () => h(App, props)})
        .use(plugin)
        // eslint-disable-next-line no-undef
        .use(ZiggyVue, Ziggy)
        .mount(el)
    );
  },
  progress: {
    color: import.meta.env.VITE_APP_THEME
  }
});
