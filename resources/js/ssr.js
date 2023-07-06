import {createInertiaApp, router} from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import {renderToString} from '@vue/server-renderer';
import {gsap} from 'gsap';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createSSRApp, h} from 'vue';

import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME ?? 'Billy Barnyard Wedding';

import.meta.glob(['../images/**', '../favicon/**']);

if (process.env.NODE_ENV === 'production') {
  router.on('navigate', (event) => {
    window.gtag('js', new Date());
    window.gtag('config', 'G-T952524GJS');
  });
}

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
      resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({App, props, plugin}) {
      return createSSRApp({render: () => h(App, props)})
        .use(plugin)
        .use(ZiggyVue, {
          ...page.props.ziggy,
          location: new URL(page.props.ziggy.location)
        })
        .provide('gsap', gsap);
    }
  })
);
