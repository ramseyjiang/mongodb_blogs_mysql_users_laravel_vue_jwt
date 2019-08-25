import Vue from 'vue';
import VueRouter from 'vue-router';

//pages
import Nav from './components/common/Nav.vue';
import Register from './components/common/Register.vue';
import Login from './components/common/Login.vue';
import Dashboard from './components/common/Dashboard.vue';
import BlogList from './components/BlogList.vue';
import Blog from './components/Blog.vue';

Vue.component('Nav', Nav);
Vue.component('Register', Register);
Vue.component('Login', Login);
Vue.component('Dashboard', Dashboard);
Vue.component('BlogList', BlogList);
Vue.component('Blog', Blog);

// Routes
const routes = [
	{
		path: '/',
		name: '/',
		component: BlogList,
		props: false,
	},
	{
		path: '/login',
		name: 'login',
		component: Login,
		props: false,
	},
	{
		path: '/register',
		name: 'register',
		component: Register,
		props: false,
	},
	{
		path: '/dashboard',
		name: 'dashboard',
		component: Dashboard,
		props: false,
	},
	{
		path: '/blogs',
		name: 'blogs',
		component: BlogList,
		props: false,
	},
	{
		path: '/createBlog',
		name: 'createBlog',
		component: Blog,
		props: false,
	},
	{
		path: '/editBlog',
		name: 'editBlog',
		component: Blog,
		props: false,
	},
	{
		path: '/viewBlog',
		name: 'viewBlog',
		component: Blog,
		props: false,
	},
];

const router = new VueRouter({
	history: true,
	mode: 'history',
	fallback: true,
	routes,
});

export default router;
