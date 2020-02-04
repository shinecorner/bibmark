<template>
    <div class="container-fluid1" style="background: #ffffff">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <!-- <SideBar></SideBar> -->
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid1">
                    <div class="profile-content">
                        <div class="col-lg col-xs-12">
                            <h2 class="welcome">My Shopping Cart</h2>
                            <button class="btn btn-primary" @click="testCart">Test Cart</button>
                            <hr class="content-divider">
                            <div class="contain" v-if="!cartIsEmpty">
                                <div class="main-step">
                                    <!-- <div class="wizard"> -->
                                        <vue-good-wizard
                                            :steps="steps"
                                            :onNext="nextClicked"
                                            :onBack="backClicked">
                                            <div slot="page1">
                                                <product/>
                                            </div>
                                            <div slot="page2">
                                                <product :editable='true'/>
                                                <shipping
                                                    :setValidness="setStepValidness"
                                                />
                                            </div>
                                            <div slot="page3">
                                                <product :editable='true'/>
                                                <billing/>
                                            </div>
                                            <div slot="page4">
                                                <product :editable='true'/>
                                                <review/>
                                            </div>
                                            <div slot="page5">
                                                <confirmation/>
                                            </div>
                                        </vue-good-wizard>
                                </div>                                
                            </div>
                            <div v-else>
                                <h3>Your cart is empty, explore the <a href="#">products</a>!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </div>
</template>

<script>
import GoodWizard from './Wizard.vue';
import Product from './Product.vue';
import Shipping from './Shipping.vue';
import Billing from './Billing.vue';
import Review from './Review.vue';
import Confirmation from './Confirmation.vue';
import { random as fetchRandomProduct } from '../../services/product';

    export default {
        components: {'vue-good-wizard': GoodWizard, Product, Shipping, Billing, Review, Confirmation},
        name: 'cart',
        props: ['backClicked','nextClicked'],
        computed: {
            cartIsEmpty(){
                return this.$store.state.cart.length < 1;
            }
        },
        data(){
            return {
                stepValidness: {
                    status: true,
                    errorsMessage: 'test'
                },
            steps: [
                {
                label: 'CART',
                slot: 'page1',
                },
                {
                label: 'SHIPPING',
                slot: 'page2',
                },
                {
                label: 'BILLING',
                slot: 'page3',
                },
                {
                label: 'REVIEW',
                slot: 'page4',
                },
                {
                label: 'CONFIRMATION',
                slot: 'page5',
                options: {
                    nextDisabled: true, // control whether next is disabled or not
                },
                }
            ],
            };
        },
        methods: {
            testCart(){
                fetchRandomProduct()
                    .then(({ data }) => {
                        if(data){
                            this.$store.commit('addToCart', data);
                            this.$store.commit('saveCart');
                        } else {
                            alert('No products found! Create one!');
                        }
                    });
            },
            setStepValidness(status, errorsMessage = ''){
                this.stepValidness = { status, errorsMessage };
            },
            nextClicked: function(currentPage){

                if(!this.stepValidness.status){
                    this.$toastr('error', this.stepValidness.errorsMessage, 'Error');
                    return;
                }

                console.log(currentPage);
                if (currentPage == 1) {
                    if (jQuery.isEmptyObject(this.$store.state.shipping)) {
                        this.$toastr('error', 'Select a shipping method', 'Error');
                        return false;
                    }
                    if (jQuery.isEmptyObject(this.$store.state.address)) {
                        this.$toastr('error', 'Select a shipping address', 'Error');
                        return false;
                    }
                }
                if (currentPage == 2 && jQuery.isEmptyObject(this.$store.state.card)){
                    this.$toastr('error', 'Select a payment method', 'Error')
                    return false;
                }
                return true
            }
        },
    }

</script>

<style scoped>

    @font-face {
        font-family: "HelveticaNeue";
        src: url("/fonts/HelveticaNeueCyr-Bold.eot");
        src: url("/fonts/HelveticaNeueCyr-Bold.woff") format("woff");
    }

    @font-face {
        font-family: "SFUIDisplay-Regular";
        src: url("/fonts/SFUIDisplay-Regular.ttf") format('truetype');
    }

    @font-face {
        font-family: "SFProText";
        src: url("/fonts/SFUIText-Bold.ttf") format('truetype');
    }

    @font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SourceSansPro-Bold.ttf") format('truetype');
    }

    @font-face {
        font-family: "SourceSansPro-Regular";
        src: url("/fonts/SourceSansPro-Regular.ttf") format('truetype');
    }


    /* Profile Content */
    .profile-content {
        /* padding-right: 80px; */
        padding: 0 4vw;
        background: #fff;
        min-height: 460px;
    }

    .welcome {
        font-family: sf-pro-display;
        font-size: 42px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #444444;
        margin-bottom: 16px;
    }

 

    hr.sidebar-divider {
        width: 100%;
        border-color: #cccccc;
        border-width: 2px;
        /*margin-top: 2rem;*/
        /*margin-bottom: 1rem;*/
        /*border-top: 1px solid #cccccc;*/
        /*border-bottom: 1px solid #cccccc;*/
    }

    hr.content-divider {
        border-top: 1px solid #cccccc;
    }

    .content {
        margin-bottom: 58px;
        font-family: sf-pro-text;
        font-size: 18px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }

    #wrapper {
        padding-top: 59px;
    }

    @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
    }

    @media (max-width: 768px) {
        .profile-content {
            padding-top: 0px !important;
            padding-right: 2px !important;
            padding-bottom: 0px !important;
            padding-left: 2px !important;
            text-align: center;
        }
        #wrapper {
            display: block !important;
        }
        #sidebar-wrapper {
            border: none;
            margin: 0px;
            min-height: unset;
        }
        .dashboard-link {
            margin-bottom: 100px !important;
            text-align: center;
            margin-left: 0px;
            margin-right: 0px;
        }


        .profile-usermenu ul li {
            display: flex;
            justify-content: center;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }
        .profile-sidebar {
            padding: 0px !important;
        }
        
    }

    @media (max-width: 900px) {
        .profile-content {
            padding: 0px 20px;
        }
    }


    .col-10 {
        padding-right: 0;
        padding-left: 0;
    }    

/* Custom css */

    .main-step{
        /* max-width: 700px; */
        margin-left: auto;
        margin-right: auto;
    }

        /* 
    ##Device = Tablets, Ipads (portrait)
    ##Screen = B/w 768px to 1024px
    */
    @media (min-width: 768px) and (max-width: 1024px) {
        .contain{
            margin-left: 40px;
            margin-right: 60px;
        }
    }
    
    @media (min-width: 1025px) {
    /* 
    ##Device = Desktops
    ##Screen = 1025px to higher resolution desktops
    */
        .contain{
            margin-left: 80px;
            margin-right: 120px;
        }
    
    }
</style>
