import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue'
import App from 'app.vue'

import { createApp, defineAsyncComponent } from 'vue';

createApp(defineAsyncComponent(() =>
    import ('app.vue'))).mount('#app');