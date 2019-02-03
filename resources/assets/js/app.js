
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
import httpPlugs from './plugins/http/index';
import VueCookie from 'vue-cookie';

Vue.use(ElementUI);
Vue.use(VueRouter);
Vue.use(httpPlugs);
Vue.use(VueCookie);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const users = require('./components/Users.vue');
const articles = require('./components/Articles.vue');
const tags = require('./components/Tags.vue');
const dashboard = require('./components/Dashboard.vue');
const links = require('./components/Links.vue');
const newArticle = require('./components/Article');

Vue.component('aside-component', require('./components/Aside.vue'));

const routes = [
	{ path: '/dashboard', component: dashboard, name: 'dashboard' },
	{ path: '/users', component: users, name: 'users' },
	{ path: '/articles', component: articles, name: 'articles' },
	{ path: '/tags', component: tags, name: 'tags' },
	{ path: '/links', component: links, name: 'links' },
	{ path: '/newArticle', component: newArticle, name: 'newArticle' }
];

const router = new VueRouter({
	// mode: 'history',
	routes: routes
});
const app = new Vue({
    router
}).$mount('#app');
