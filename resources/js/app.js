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
import { Chrome } from 'vue-color'
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
Vue.component('color-picker', Chrome);
Vue.component('app-home', require('./front/home/Home.vue'))
Vue.component('home-slider', require('./front/home/Slider.vue'))
Vue.component('common-header', require('./front/common/Header.vue'))
Vue.component('common-footer', require('./front/common/Footer.vue'))

Vue.component('auth-login', require('./front/auth/Login.vue'))
Vue.component('auth-join', require('./front/auth/Join.vue'))
Vue.component('auth-forgot-password', require('./front/auth/ForgotPassword.vue'))
Vue.component('auth-reset-password', require('./front/auth/ResetPassword.vue'))

Vue.component('user-profile', require('./front/profile/Profile.vue'))
Vue.component('edit-account', require('./front/profile/EditAccount.vue'))
Vue.component('my-events', require('./front/profile/MyEvents.vue'))
Vue.component('my-designs', require('./front/profile/MyDesigns.vue'))

// backend
Vue.component('sponsor-list', require('./admin/sponsor/SponsorList.vue'))
Vue.component('sponsor-edit', require('./admin/sponsor/SponsorEdit.vue'))
Vue.component('sponsor-show', require('./admin/sponsor/SponsorShow.vue'))
Vue.component('sponsor-detail-page', require('./admin/sponsor/SponsorDetailPage.vue'))
Vue.component('sponsor-edit-page', require('./front/sponsor/SponsorEditPage.vue'))
Vue.component('sponsor-index', require('./front/sponsor/SponsorIndex.vue'))


Vue.component('campaign-page', require('./front/sponsor/CampaignPage.vue'))
Vue.component('add-campaign', require('./front/sponsor/AddCampaign.vue'))
Vue.component('sponsor-common', require('./front/sponsor/SponsorCommon.vue'))
Vue.component('payment-history-list', require('./front/sponsor/PaymentHistoryList.vue'))
Vue.component('payment-history-page', require('./front/sponsor/PaymentHistoryPage.vue'))

Vue.component('charity-list', require('./admin/charity/CharityList.vue'))
Vue.component('charity-edit', require('./admin/charity/CharityEdit.vue'))
Vue.component('charity-show', require('./admin/charity/CharityShow.vue'))
Vue.component('charity-detail-page', require('./admin/charity/CharityDetailPage.vue'))
Vue.component('charity-edit-page', require('./front/charity/CharityEditPage.vue'))

Vue.component('asset-list', require('./admin/asset/AssetList.vue'))
Vue.component('asset-edit', require('./admin/asset/AssetEdit.vue'))
Vue.component('asset-show', require('./admin/asset/AssetShow.vue'))
Vue.component('asset-detail-page', require('./admin/asset/AssetDetailPage.vue'))

Vue.component('event-list', require('./admin/event/EventList.vue'))
Vue.component('event-edit', require('./admin/event/EventEdit.vue'))
Vue.component('event-show', require('./admin/event/EventShow.vue'))
Vue.component('event-detail-page', require('./admin/event/EventDetailPage.vue'))

Vue.component('user-list', require('./admin/user/UserList.vue'))
Vue.component('user-edit', require('./admin/user/UserEdit.vue'))
Vue.component('user-show', require('./admin/user/UserShow.vue'))
Vue.component('user-change-password', require('./admin/user/UserChangePassword.vue'))

Vue.component('product-list', require('./admin/product/ProductList.vue'))
Vue.component('product-edit', require('./admin/product/ProductEdit.vue'))

Vue.component('location-list', require('./admin/location/LocationList.vue'))
Vue.component('location-create', require('./admin/location/LocationCreate.vue'))
Vue.component('location-edit', require('./admin/location/LocationEdit.vue'))

Vue.component('order-list', require('./admin/order/OrderList.vue'))

Vue.component('design-list', require('./admin/design/DesignList.vue'))
Vue.component('design-edit', require('./admin/design/DesignEdit.vue'))
Vue.component('design-tool', require('./front/design_tool/DesignTool.vue'))

Vue.component('dashboard', require('./admin/dashboard/Dasboard.vue'))

Vue.component('cart', require('./front/cart/Cart.vue'))

// Vue.component('Design', require('./pages/design/Design.vue'))

Vue.component('Apparel', require('./front/apparel/Product.vue'))

// common component
Vue.component('hash-tag', require('./front/common/components/Hashtag.vue'))
Vue.component('logo-width', require('./front/common/components/LogoWidth.vue'))

// Charity Donation...
Vue.component('charity-common', require('./front/charity/CharityCommon.vue'))
Vue.component('charity-donation-list', require('./front/charity/CharityDonationList.vue'))
Vue.component('charity-order-list', require('./front/charity/CharityOrderList.vue'))
Vue.component('charity-index', require('./front/charity/CharityIndex.vue'))
Vue.component('charity-campaign-page', require('./front/charity/CampaignPage.vue'))
Vue.component('add-charity-campaign', require('./front/charity/AddCampaign.vue'))

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
