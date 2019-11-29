/** app.js
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueInstantSearch from 'vue-instantsearch';
Vue.use(VueInstantSearch);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// register the component
Vue.component('select-component', require('./components/SelectComponent.vue').default);
Vue.component('topic-component', require('./components/Topic.vue').default);
Vue.component('feed-component', require('./components/Feed.vue').default);
Vue.component('notification-component', require('./components/Notification.vue').default);
Vue.component('search-component', require('./components/Search.vue').default);
Vue.component('upload-files', require('./components/UploadFiles.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { store } from './store';

const app = new Vue({
    el: '#app',
    store: store
});
