
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import VueRouter from 'vue-router';

Vue.use(ElementUI);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const users = require('./components/User.vue');
const articles = require('./components/Article.vue');
const tags = require('./components/Tag.vue');
const dashboard = require('./components/Dashboard.vue');
const links = require('./components/Link.vue');

Vue.component('aside-component', require('./components/Aside.vue'));

const routes = [
	{ path: '/dashboard', component: dashboard },
	{ path: '/users', component: users },
	{ path: '/articles', component: articles },
	{ path: '/tags', component: tags },
	{ path: '/links', component: links }
];

const router = new VueRouter({
	routes
});
const app = new Vue({
    router
}).$mount('#app');
