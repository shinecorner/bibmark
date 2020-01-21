<template>
<div class="cart">
    <div class="row">
        <div class="col-md-7 col-12" v-if="shipping">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ship To:</h5>
                    <div class="row card-subtitle">
                        <div class="col-8">
                            <div class="name">{{ name }}</div>
                            <div class="adress">{{ adress1 }} {{ city }} {{ country }}</div>   
                        </div>
                        <div class="col-4">
                            <a href="#" @click.prevent="edit" class="btn btn-sm  btn-edit align-content-sm-center"><span class="search-btn-text">Edit</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <!-- <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio"> Ground
            </label>
            </div>
            <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio"> Two-Day Shipping
            </label>
            </div>
            <div class="form-check disabled">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio">Standard Shipping
            </label>
            </div> -->
            <div class="radio-button">
                <div class="radio" v-for="shipping in shipingMethod" :key="shipping.id">
                    <input :id="shipping.id" v-on:change="selectShipping(shipping)" v-model="selectshipping" :value="shipping" name="radio" type="radio">
                    <label :for="shipping.id" class="radio-label">{{ shipping.name }} ($ {{ shipping.price }})</label>
                </div>

                <!-- <div class="radio">
                    <input id="radio-2" v-on:change="addShipping" v-model="selectshipping" value="9.50" name="radio" type="radio">
                    <label  for="radio-2" class="radio-label">Two-Day Shipping ($9.50)</label>
                </div>

                <div class="radio">
                    <input id="radio-3" v-on:change="addShipping" v-model="selectshipping" value="5.00" name="radio" type="radio">
                    <label for="radio-3" class="radio-label">Standard Shipping ($5.00)</label>
                </div> -->
            </div>
        </div>
    </div>
        <form class="shipping" v-if="editShipping">
            <div class="ship-title">Ship To:</div>
            <div class="form-row">
                <div class="col form-group mb-5 mr">
                    <label for="name" class="mb-3">Name</label>
                    <input v-model="name" type="text" class="form-control" id="name" name="name"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('name') }">
                    <div class="error">
                        <div v-if="errors.has('name')" class="invalid-feedback">{{ errors.first('name') }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="col form-group mb-5 ml">
                        <label for="email" class="mb-3">Email</label>
                        <input v-model="email" type="email" class="form-control" id="email" name="email"
                            v-validate="'required'"
                            :class="{ 'is-invalid': errors.has('email') }">
                        <div class="error">
                            <div v-if="errors.has('email')" class="invalid-feedback">{{ errors.first('email') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group mb-5 mr">
                    <label for="adress1" class="mb-3">Address 1</label>
                    <input v-model="adress1" type="text" class="form-control" id="adress1" name="adress1"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('adress1') }">
                    <div class="error">
                        <div v-if="errors.has('adress1')" class="invalid-feedback">{{ errors.first('adress1') }}</div>
                    </div>
                </div>
                <div class="col">
                    <div class="col form-group mb-5 ml">
                        <label for="adress2" class="mb-3">Address 2</label>
                        <input v-model="adress2" type="text" class="form-control" id="adress2" name="adress2"
                            v-validate="'required'"
                            :class="{ 'is-invalid': errors.has('adress2') }">
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
                        <label for="state" class="mb-3">State/Province</label>
                        <input v-model="state" type="text" class="form-control" id="state" name="state"
                            v-validate="'required'"
                            :class="{ 'is-invalid': errors.has('state') }">
                        <div class="error">
                            <div v-if="errors.has('state')" class="invalid-feedback">{{ errors.first('state') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col form-group mb-5">
                    <label for="pcode" class="mb-3">Postal Code</label>
                    <input v-model="pcode" type="text" class="form-control" id="pcode" name="pcode"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('pcode') }">
                    <div class="error">
                        <div v-if="errors.has('pcode')" class="invalid-feedback">{{ errors.first('pcode') }}</div>
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
            <div class="form-row">
                <div class="col-6 form-group mb-5 mr">
                    <label for="phone" class="mb-3">Phone Number</label>
                    <input v-model="phone" type="tel" class="form-control" id="phone" name="phone"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('phone') }">
                    <div class="error">
                        <div v-if="errors.has('phone')" class="invalid-feedback">{{ errors.first('phone') }}</div>
                    </div>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Confirm identity</button> -->
                <div class="col">
                    <!-- <div class="col-6 form-group"> -->
                        <a href="#" @click.prevent="update" class="btn btn-md btn-update"><span class="search-btn-text">Update</span></a>                    
                    <!-- </div> -->
                </div>
            </div>
        </form>
    </div>
</template>


<script>
export default {
    name: 'shipping',
    data() {
        return {
            shipping: true,
            editShipping: false,
            name: '',
            email: '',
            adress1: '',
            adress2: '',
            phone: '',
            pcode: '',
            city: '',
            state: '',
            country: '',
            user_id: Laravel.user.id,
            shipingMethod: [
                {
                    id: 1,
                    name: 'Ground',
                    price: 7.77
                },
                {
                    id: 2,
                    name: 'Two-Day Shipping',
                    price: 9.50
                },
                {
                    id: 3,
                    name: 'Standard Shipping',
                    price: 5
                },
            ],
            // selectshipping: JSON.parse(localStorage.getItem('shipping'))
            selectshipping: this.$store.state.shipping
        };
    },
    mounted(){
        this.getAddress()
    },
    methods: {
        edit() {
            this.editShipping = true;
            this.shipping = false;
        },
        update() {
            // this.editShipping = false;
            // this.shipping = true;
            const data = {
                name: this.name,
                email: this.email,
                address_1: this.adress1,
                adress_2: this.adress2,
                phone: this.phone,
                postal_code: this.pcode,
                city: this.city,
                state: this.state,
                country: this.country,
            }
            console.log(data)
            this.$validator.validate().then(valid => {
                if (valid) {
                    let loader = this.$loading.show({
                        canCancel: true,
                        onCancel: this.onCancel,
                    });
                    axios.post('/internal/address', data).then(response => {
                        loader.hide()
                        console.log(response.data);
                        this.editShipping = false;
                        this.shipping = true;
                        this.$toastr('success', 'Your address has been updated', 'Success')
                    }).catch(error => {
                        console.log(error)
                        loader.hide()
                        this.$toastr('error', error.message, 'Error')
                    });
                }
            });
        },
        getAddress(){
            console.log('Getting the address ....')
            let id = this.user_id
            axios.get('/internal/address/'+id).then(response => {
                console.log(response.data)
                // this.cards = response.data
            })
        },
        // addShipping(shipping) {
        //     let selectshipping = this.selectshipping.toFixed(2)
        //     window.localStorage.setItem('shipping', JSON.stringify(selectshipping));
        // },
        selectShipping(shipping){
            this.$store.commit('Shipping', shipping)
        }
    },
}
</script>
<style lang="scss" scoped>
    @font-face {
            font-family: "SFProText";
            src: url("/fonts/SFProText-Regular.ttf") format('truetype');
    }
    .cart{
        margin-top:25px;
        margin-bottom: 40px;
    }
    .ship-title{
        font-family: SFProText;
        font-size: 18px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
        margin-bottom: 40px;
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
    .card{
        // width: 43vw;
        // margin-top: 100px !important;
        border: 1px solid #979797 !important;
        border-radius: 2 !important;
    }
    .col-md-7{
        padding-left: 0;
    }
    .card-body {
        padding: 0.7rem !important;
    }
    .card-title{
        font-family: SFProText;
        font-size: 18px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
        margin-bottom: 0;
    }
    .card-subtitle{
        font-size: 17px;
        // color: #000000;
        margin-top: 10px;
        font-family: SFProText;
        line-height: 28px;
    }

    .card-subtitle .name{
        font-family: SFProText;
        font-size: 18px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }
    .card-subtitle .adress{
        font-family: SFProText;
        font-size: 18px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
        margin-top: 7px;
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
        padding-left: 30px;
        padding-right: 30px;
        margin-right: 10px;
    }
    .btn-update{
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
        margin-top: 3.8em;
    }
    @media (min-width: 1025px) {
        .mr{
            margin-right: 30px;
        }
        .ml{
            margin-left: 30px;
        }
    
    }
    @media (max-width: 768px) {
        .form-group label {
            font-size: 15px;
        }
        .cart{
            text-align: left;
        }
        .btn-edit{
            margin-top:13px;
        }
    }

    //$color1: #f4f4f4;
    $color1:#ffffff;
    $color2: #ffe100;

    .radio {
    margin: 0.5rem;
    input[type="radio"] {
        position: absolute;
        opacity: 0;
        + .radio-label {
        &:before {
            content: '';
            background: $color1;
            border-radius: 100%;
            border: 1px solid darken($color1, 25%);
            display: inline-block;
            width: 1.4em;
            height: 1.4em;
            position: relative;
            top: -0.2em;
            margin-right: 1em; 
            vertical-align: top;
            cursor: pointer;
            text-align: center;
            transition: all 250ms ease;
        }
        }
        &:checked {
        + .radio-label {
            &:before {
            background-color: $color2;
            box-shadow: inset 0 0 0 4px $color1;
            }
        }
        }
        &:focus {
        + .radio-label {
            &:before {
            outline: none;
            border-color: $color2;
            }
        }
        }
        &:disabled {
        + .radio-label {
            &:before {
            box-shadow: inset 0 0 0 4px $color1;
            border-color: darken($color1, 25%);
            background: darken($color1, 25%);
            }
        }
        }
        + .radio-label {
        &:empty {
            &:before {
            margin-right: 0;
            }
        }
        }
    }
    }
    .radio label{
        font-family: SFProText;
        font-size: 16px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }
    .radio-button{
        margin-bottom: 15px;
    }
</style>

