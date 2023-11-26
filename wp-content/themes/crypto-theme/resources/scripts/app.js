import domReady from '@roots/sage/client/dom-ready';
import CryptoTable from './components/CryptoTable.vue';
import { createApp } from 'vue';

/**
 * Application entrypoint:
 * 
 * I import CryptoTable in order to render this component in #crypto element using Vue.js CreateApp method.
 * 
 */
domReady(async () => {
  const app = createApp(CryptoTable);
  app.mount('#crypto');
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
