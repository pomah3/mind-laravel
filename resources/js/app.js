'use strict';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

try {
    require('./bootstrap');
    require('./banner');
    require('./notes');
} catch (e) {
     alert('Error ' + e.name + ":" + e.message + "\n" + e.stack);
}

if (window.userId) {
    Echo.private(`App.User.${userId}`)
        .notification((notification) => {
            // alert(JSON.stringify(notification));
        });
}

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app'
// });

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

Array.prototype.unique = function() {
    var o = {}, a = [], i, e;
    for (i = 0; e = this[i]; i++) {o[e] = 1};
    for (e in o) {a.push (e)};
    return a;
}

