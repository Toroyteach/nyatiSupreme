require('./bootstrap');
window.Vue = require('vue');
Vue.component('datatable-component', require('./components/DataTableComponent.vue').default);
const app = new Vue({
    el: '#app',
});