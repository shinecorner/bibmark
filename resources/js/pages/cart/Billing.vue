<template>
    <div class="cart">
        <div class="container-billing">
            <div class="payment">
                <h3 class="title text-center">Select a payment method</h3>
                <div class="list-group radio-list-group">
                    <div class="list-group-item" v-for="card in cards" :key="card.id" style="padding-bottom:10px;">&nbsp;
                        <label>
                            <input type="radio"  v-model="selected_card" @change="selectCard(card)" name="ra" :value="card" checked>
                            <span class="list-group-item-text">
                                <span class="cartype">
                            <img :src="'/svg/'+card.card_brand+'.svg'" :alt="card.card_brand" height="50px" width="60px" />
                            </span>
                            <span class="end">
                                {{ card.name }}
                            </span>
                            <span class="end">
                                <!-- (12/2020) -->
                                *****{{ card.card_last_four }}
                            </span>
                            <span class="float-right update">
                                <button href="#" @click.prevent="edit(card)" class="btn btn-sm  btn-edit"><span class="search-btn-text">Edit</span></button>
                            </span>
                            </span>
                        </label>
                    </div>
                    <div class="nopayment text-center" v-show="cards.length ==0">
                        <h5>No payment method found</h5>
                        <img src="/svg/no-card.svg" height="60px" width="80px" /><br>
                    </div>
                    <div class="nopayment text-center">
                        <button href="#" @click.prevent="addcard" class="btn btn-sm text-center new-card"><span class="search-btn-text">Add a new Card</span></button>
                    </div>
                    <sweet-modal title="Edit your card" ref="modal">
                        <template class="edit-card">
                            <div>
                                <div class="form-row">
                                <div class="col form-group mb-5 mr">
                                    <label for="name" class="mb-1">Name</label>
                                    <input v-model="name" type="text" class="form-control" id="name" name="name"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('name') }">
                                    <div class="error">
                                        <div v-if="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5 ml">
                                        <label for="email" class="mb-1">Address</label>
                                        <input v-model="address" type="text" class="form-control" id="address" name="address"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('address') }">
                                        <div class="error">
                                            <div v-if="errors.has('address')" class="invalid-feedback">{{ errors.first('address') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group mb-5">
                                    <label for="city" class="mb-3">City</label>
                                    <input v-model="city" type="text" class="form-control" id="city" name="city"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('city') }">
                                    <div class="error">
                                        <div v-if="errors.has('city')" class="invalid-feedback">{{ errors.first('city') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5">
                                        <label for="state" class="mb-3">State</label>
                                        <input v-model="state" type="text" class="form-control" id="state" name="state"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('state') }">
                                        <div class="error">
                                            <div v-if="errors.has('state')" class="invalid-feedback">{{ errors.first('state') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group mb-5">
                                    <label for="pcode" class="mb-3">Zip</label>
                                    <input v-model="zip" type="text" class="form-control" id="zip" name="zip"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('zip') }">
                                    <div class="error">
                                        <div v-if="errors.has('zip')" class="invalid-feedback">{{ errors.first('zip') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5">
                                        <label for="country" class="mb-3">Country</label>
                                        <input v-model="country" type="text" class="form-control" id="country" name="country"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('country') }">
                                        <div class="error">
                                            <div v-if="errors.has('country')" class="invalid-feedback">{{ errors.first('country') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div ref="card"></div>
                            <span id="card-errors"></span>
                            <br/>
                            <div>
                                <button v-on:click="purchase" class='btn btn-sm btn-add' style="float:left;">Update Card</button>
                            </div>
                        </template>
                    </sweet-modal>
                    <sweet-modal title="Add a new card" ref="addmodal">
                        <template class="edit-card">
                            <div>
                                <div class="form-row">
                                <div class="col form-group mb-5 mr">
                                    <label for="name" class="mb-1">Name</label>
                                    <input v-model="name" type="text" class="form-control" id="name" name="name"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('name') }">
                                    <div class="error">
                                        <div v-if="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5 ml">
                                        <label for="email" class="mb-1">Address</label>
                                        <input v-model="address" type="text" class="form-control" id="address" name="address"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('address') }">
                                        <div class="error">
                                            <div v-if="errors.has('address')" class="invalid-feedback">{{ errors.first('address') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group mb-5">
                                    <label for="city" class="mb-3">City</label>
                                    <input v-model="city" type="text" class="form-control" id="city" name="city"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('city') }">
                                    <div class="error">
                                        <div v-if="errors.has('city')" class="invalid-feedback">{{ errors.first('city') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5">
                                        <label for="state" class="mb-3">State</label>
                                        <input v-model="state" type="text" class="form-control" id="state" name="state"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('state') }">
                                        <div class="error">
                                            <div v-if="errors.has('state')" class="invalid-feedback">{{ errors.first('state') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group mb-5">
                                    <label for="pcode" class="mb-3">Zip</label>
                                    <input v-model="zip" type="text" class="form-control" id="zip" name="zip"
                                        v-validate="'required'"
                                        :class="{ 'is-invalid': errors.has('zip') }">
                                    <div class="error">
                                        <div v-if="errors.has('zip')" class="invalid-feedback">{{ errors.first('zip') }}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="col form-group mb-5">
                                        <label for="country" class="mb-3">Country</label>
                                        <input v-model="country" type="text" class="form-control" id="country" name="country"
                                            v-validate="'required'"
                                            :class="{ 'is-invalid': errors.has('country') }">
                                        <div class="error">
                                            <div v-if="errors.has('country')" class="invalid-feedback">{{ errors.first('country') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div ref="addcard"></div>
                            <span id="card-errors2"></span>
                            <br/>
                            <div>
                                <button v-on:click="purchase" class='btn btn-sm btn-add' style="float:left;">Add Card</button>
                            </div>
                        </template>
                    </sweet-modal>
                </div>
            </div>
    </div>
    </div>
</template>
<script>
import { SweetModal, SweetModalTab } from 'sweet-modal-vue'
// import SweetModal from './SweetModal'
let stripe = Stripe(`pk_test_HXMn0Ypc9zk0qC9HLfuzB8ju`),
    elements = stripe.elements(),
    card = undefined;
export default {
    components: {
		SweetModal,
		SweetModalTab
	},
    mounted: function () {
        this.getUserCards();
        card = elements.create('card');
        // card2 = elements.create('card');
    },
    created: function () {
    },
    data() {
        return {
            name: '',
            address: '',
            city: '',
            state: '',
            zip: '',
            token: '',
            country: '',
            user_id: Laravel.user.id,
            cards: [],
            show_card: false,
            selected_card: {},
            card_id: null,
            complete: false
        }
    },
    methods: {
        edit(thiscard) {
            card.unmount(this.$refs.addcard)
            console.log(thiscard)
            card.mount(this.$refs.card);
            card.addEventListener('change', (event) => {
                console.log(event)
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    
                } else {
                    displayError.textContent = '';
                }
                if(event.complete){
                    this.complete = true;
                }
            });
            this.name = thiscard.name ? thiscard.name : '' ,
            this.address = thiscard.address ? thiscard.address : '',
            this.city = thiscard.city ? thiscard.city : '',
            this.state = thiscard.state ? thiscard.state : '',
            this.zip = thiscard.zip ? thiscard.zip : '',
            this.country = thiscard.country ? thiscard.country : ''
            this.card_id = thiscard.id ? thiscard.id : null
            this.$refs.modal.open()
            // this.errors.clear()

        },
        addcard(){
            this.$validator.reset()
            this.$validator.errors.clear()

            this.name = '' ,
            this.address = '',
            this.city = '',
            this.state = '',
            this.zip = '',
            this.country = ''
            this.card_id = null
            card.unmount(this.$refs.card)
            card.mount(this.$refs.addcard);
            this.$refs.addmodal.open()
            card.addEventListener('change', (event) => {
                console.log(event)
                var displayError = document.getElementById('card-errors2');
                if (event.error) {
                    displayError.textContent = event.error.message;
                    
                } else {
                    displayError.textContent = '';
                }
                if(event.complete){
                    this.complete = true;
                }
            });
            this.errors.clear()
        },
        purchase: function () {
            console.log(this.complete)
            this.$validator.validate().then(valid => {
                if(valid && this.complete ==true){
                    this.$refs.modal.close()
                    this.$refs.addmodal.close()
                    let loader = this.$loading.show({
                        canCancel: true,
                        onCancel: this.onCancel,
                    });
                    stripe.createToken(card).then((result) => {
                    // Access the token with result.token
                        console.log(result.token)
                        this.token = result.token.id
                        this.update()
                        loader.hide()
                    });
                }
            });
        },
        update() {
            const data = {
                name: this.name,
                address: this.address,
                city: this.city,
                state: this.state,
                zip: this.zip,
                user_id: this.user_id,
                stripe_token: this.token,
                country: this.country,
                card_id: this.card_id
            }
            console.log(data)
            this.$validator.validate().then(valid => {
                if (valid) {
                    let loader = this.$loading.show({
                        canCancel: true,
                        onCancel: this.onCancel,
                    });
                    let url = this.card_id == null ? '/internal/billing' : '/internal/billing/card'
                    // if( this.card_id == null){
                    //     url = '/internal/billing'
                    // }else{
                    //     url = '/internal/billing/card'
                    // }
                    console.log(url)
                    axios.post(url, data).then(response => {
                        // console.log(response.data.message);
                        this.getUserCards();
                        // this.editcard1 = false;
                        loader.hide()
                        this.$toastr('success', 'Your card has been update successfully', 'Success')
                    }).catch(error => {
                        console.log(error.message)
                        loader.hide()
                        this.$toastr('error', error.message, 'Error')
                    });
                    card.unmount(this.$refs.card);
                }
            });
        },
        getUserCards(){
            console.log('Getting the crads ....')
            let id = this.user_id
            axios.get('/internal/sponsor/'+id+'/cards').then(response => {
                console.log(response.data)
                this.cards = response.data
            })
        },
        selectCard(card){
            this.$store.commit('Card', card)
        }
    }, 
}
</script>
<style lang="scss" scoped>
@font-face {
            font-family: "SFProText";
            src: url("/fonts/SFProText-Regular.ttf") format('truetype');
    }
    .form-group {
        label {
            color: #444444;
            font-family: HelveticaNeue;
            font-size: 18px;
            font-weight: bold;
        }

        input {
            border: 0 none;
            border-bottom: solid 2px #cccccc;
            border-radius: 0;
            font-family: HelveticaNeue;
            font-size: 18px;
            margin-top: 0.5rem;

            &:focus {
                border-color: #26B4FF !important;
                box-shadow: none !important;
            }

            &.is-invalid {
                border-color: #d9534f !important;
            }
        }

        .error {
            height: 25px;
            margin-top: 0.25rem;

            .invalid-feedback {
                display: block;
                margin: 0;
            }
        }
    }
    .stripe-card {
        padding: 10px;
        // width: 300px;
        // border: 1px solid grey;
    }
    @media (min-width: 1025px) {
    /* 
    ##Screen desktop = 1025px to higher resolution desktops
    */
        .list-group{
            width: 70%;
            margin:auto;
        }
    
    }
    
    .radio-list-group input[type=radio] {
        display:none;
    }
    .radio-list-group .list-group-item {
        position:relative;
        overflow:hidden;
        border-style:hidden;
    }
    .radio-list-group .list-group-item label {
        display:block;
        width:100%;
        font-weight:normal;
    }
    .radio-list-group .list-group-item input+span {
        position:absolute;
        top:0;
        right:0;
        left:0;
        bottom:0;
        width:100%;
        height:100%;
        border:1px solid #ddd;
        padding:10px 15px;
        margin-bottom:-1px;
        z-index:1;
    }
    .radio-list-group .list-group-item input+span i.fa:before {
        content: "\f111";
        font-size:20px;
        line-height:20px;
        font-weight:bold;
    }
    .radio-list-group .list-group-item input:checked+span i.fa:before {
        content: "\f10c";
    }
    .radio-list-group .list-group-item:hover input+span {
    background-color:#f5f5f5
    }
        .radio-list-group .list-group-item input:checked+span {
        // color:#fff;
        // background-color:#428bca;
        border-color:#ffe100;
        z-index:10;
        }
        .list-group-item:first-child {
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }
        .list-group-item:last-child {
            margin-bottom: 0;
            border-bottom-right-radius:0 !important;
            border-bottom-left-radius:0 !important;
        }

    .radio-list-group .list-group-item-success input:checked+span i.fa:before {
    color:#d0e9c6 !important;
}
    .btn-edit{
        vertical-align: middle;
        border-radius: 5px;
        background-color: #ffe100;
        font-family: SFProText;
        font-size: 14px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: center;
        color: #000000;
        float: right;
        padding-left: 10px;
        padding-right: 10px;
        margin-top: 10px;
    }
    .pay-with-stripe{
        border-radius: 5px;
        background-color: #ffe100;
        font-family: SFProText;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        font-size: 14px;
        text-align: center;
        color: #000000;
        float: right;
        padding-left: 10px;
        padding-right: 10px;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    .btn-add{
        // width:20%;
        border-radius: 5px;
        background-color: #ffe100;
        font-family: SFProText;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        font-size: 14px;
        text-align: center;
        color: #000000;
        float: left; 
        margin-top: 10px;
        margin-bottom: 25px;
    }
    .new-card{
        border-radius: 5px;
        background-color: #ffe100;
        font-family: SFProText;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        font-size: 14px;
        text-align: center;
        color: #000000;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .edit-card{
        margin-left: 30px;
        margin-top:20px;
    }
    .payment{
        margin-bottom:50px;
    }
    .list-group-item{
        margin: 5px;
        padding: 20px;
    }
    img {
        vertical-align: middle;
        border-style: none;
    }
    button:disabled,
    button[disabled]{
        background-color: #cccccc;
    }
    .container-billing{
        margin-bottom: 20px;
    }

    *:focus:not(a){
        outline: 2px solid none !important;
        box-shadow: none !important;
    }
    .end{
        padding-left:10px;
    }
    .nopayment{
        margin-bottom: 15px;
    }
    #card-errors{
        // height: 20px;
        padding: 4px 0;
        color: #fa755a;
    }
    #card-errors2{
        padding: 4px 0;
        color: #fa755a;
    }

</style>