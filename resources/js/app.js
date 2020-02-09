/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

let token = document.head.querySelector('meta[name="csrf-token"]')
import Vue from 'vue'
import Axios from 'axios'
import VueMoment from 'vue-moment'
import VeeValidate from 'vee-validate'
import VModal from 'vue-js-modal'
import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'

// State management
import Vuex from 'vuex'

// Vue.use(store)
window.Vuex = Vuex;

import store from './store.js';
// Import component
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
Vue.use(Loading, {
    color: '#ffe100',
    opacity: 0.8,
});

window.Vue = Vue
window.axios = Axios
Vue.use(Vuex)
Vue.use(VueMoment)
Vue.use(VeeValidate)
Vue.use(VModal)
Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-center',
    defaultType: 'info',
    defaultTimeout: 1500
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

//frontend
Vue.component('app-home', require('./pages/home/Home.vue'))
Vue.component('home-slider', require('./pages/home/Slider.vue'))
Vue.component('common-header', require('./pages/common/Header.vue'))
Vue.component('common-footer', require('./pages/common/Footer.vue'))

Vue.component('auth-login', require('./pages/auth/Login.vue'))
Vue.component('auth-join', require('./pages/auth/Join.vue'))
Vue.component('auth-forgot-password', require('./pages/auth/ForgotPassword.vue'))
Vue.component('auth-reset-password', require('./pages/auth/ResetPassword.vue'))

Vue.component('user-profile', require('./pages/profile/Profile.vue'))
Vue.component('edit-account', require('./pages/profile/EditAccount.vue'))
Vue.component('my-events', require('./pages/profile/MyEvents.vue'))
Vue.component('my-designs', require('./pages/profile/MyDesigns.vue'))

// backend
Vue.component('sponsor-common', require('./pages/sponsor/SponsorCommon.vue'))
Vue.component('sponsor-list', require('./pages/sponsor/SponsorList.vue'))
Vue.component('sponsor-edit', require('./pages/sponsor/SponsorEdit.vue'))
Vue.component('sponsor-show', require('./pages/sponsor/SponsorShow.vue'))
Vue.component('sponsor-detail-page', require('./pages/sponsor/SponsorDetailPage.vue'))
Vue.component('sponsor-edit-page', require('./pages/sponsor/SponsorEditPage.vue'))
Vue.component('sponsor-index', require('./pages/sponsor/SponsorIndex.vue'))


Vue.component('campaign-page', require('./pages/sponsor/CampaignPage.vue'))
Vue.component('add-campaign', require('./pages/sponsor/AddCampaign.vue'))
Vue.component('campaign-edit', require('./pages/sponsor/CampaignEdit.vue'))

Vue.component('payment-history-list', require('./pages/sponsor/PaymentHistoryList.vue'))
Vue.component('payment-history-page', require('./pages/sponsor/PaymentHistoryPage.vue'))

Vue.component('charity-list', require('./pages/charity/CharityList.vue'))
Vue.component('charity-edit', require('./pages/charity/CharityEdit.vue'))
Vue.component('charity-show', require('./pages/charity/CharityShow.vue'))
Vue.component('charity-detail-page', require('./pages/charity/CharityDetailPage.vue'))

Vue.component('asset-list', require('./pages/asset/AssetList.vue'))
Vue.component('asset-edit', require('./pages/asset/AssetEdit.vue'))
Vue.component('asset-show', require('./pages/asset/AssetShow.vue'))
Vue.component('asset-detail-page', require('./pages/asset/AssetDetailPage.vue'))

Vue.component('event-list', require('./pages/event/EventList.vue'))
Vue.component('event-edit', require('./pages/event/EventEdit.vue'))
Vue.component('event-show', require('./pages/event/EventShow.vue'))
Vue.component('event-detail-page', require('./pages/event/EventDetailPage.vue'))

Vue.component('user-list', require('./pages/user/UserList.vue'))
Vue.component('user-edit', require('./pages/user/UserEdit.vue'))

Vue.component('product-list', require('./pages/product/ProductList.vue'))
Vue.component('product-edit', require('./pages/product/ProductEdit.vue'))

Vue.component('location-list', require('./pages/location/LocationList.vue'))
Vue.component('location-create', require('./pages/location/LocationCreate.vue'))
Vue.component('location-edit', require('./pages/location/LocationEdit.vue'))

Vue.component('order-list', require('./pages/order/OrderList.vue'))

Vue.component('design-list', require('./pages/design/DesignList.vue'))
Vue.component('design-edit', require('./pages/design/DesignEdit.vue'))

Vue.component('dashboard', require('./pages/dashboard/Dasboard.vue'))

Vue.component('cart', require('./pages/cart/Cart.vue'))

Vue.component('Design', require('./pages/design/Design.vue'))

Vue.component('Apparel', require('./pages/apparel/Product.vue'))

// common component
Vue.component('hash-tag', require('./pages/common/components/Hashtag.vue'))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var Events = new Vue({})
const _app = new Vue({
    el: '#app',
    //store,
    store: new Vuex.Store(store),
    data: {
        activeModal: null,
        isMobile: false,
        user: {
            id: null
        },
        eventEmitter: Events
    },
    mounted: function() {
        if (this.screen().width < 768) {
            this.isMobile = true
        }
        if (typeof _user !== 'undefined') {
            this.user = _user
        }

        Events.$on('showModal', (id) => {
            this.showModal(id)
        })
    },
    methods: {
        showModal: function(m) {
            this.activeModal = m
            Events.$emit('modalShown', m)
        },
        screen: function() {
            var myWidth = 0,
                myHeight = 0
            if (typeof(window.innerWidth) == 'number') {
                //Non-IE
                myWidth = window.innerWidth
                myHeight = window.innerHeight
            } else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
                //IE 6+ in 'standards compliant mode'
                myWidth = document.documentElement.clientWidth
                myHeight = document.documentElement.clientHeight
            } else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
                //IE 4 compatible
                myWidth = document.body.clientWidth
                myHeight = document.body.clientHeight
            }
            return {
                height: myHeight,
                width: myWidth
            }
        }
    }
})


Vue.component('modal-test', function(resolve, reject) {
    axios.get('/modal/test', {
        params: {
            is_mobile: _app.isMobile ? 1 : 0
        }
    }).then(function(response) {
        resolve({
            template: response.data,
            props: [],
            data: function() {
                return {
                    isLoading: false,
                    isLoaded: false,
                    hasError: false,
                    errorType: 'error',
                    errorMessage: '',
                    isMobile: _app.isMobile
                }
            },
            mounted: function() {

            },
            methods: {
                close: function() {
                    this.$emit('closed')
                }
            }
        })
    })
})
