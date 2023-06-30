import './bootstrap';
import '../css/app.css';

import {createInertiaApp, router} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';

import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME ?? 'Billy Barnyard Wedding';

if (process.env.NODE_ENV === 'production') {
  router.on('navigate', (event) => {
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      window.dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'G-T952524GJS');
  });
}

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
