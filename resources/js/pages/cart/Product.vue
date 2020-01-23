<template>
    <div class="cart">
        <!-- <div v-for="item in items" :key="item.id">
            <h5>{{ item.title }} Price: ${{ item.price.toFixed(2) }}</h5>
            <button  @click="addToCart(item)">Add to cart</button>
        </div> -->
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th style="padding-left: 10px;">ITEM</th>
                    <th>QUANTITY</th>
                    <th class="text-center">PRICE</th>
                    <th class="text-center">SUB-TOTAL</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in $store.state.cart" :key="item.id">
                    <td class="border-bottom-total"><a class="thumbnail pull-left" href="#"><img class="img-responsive" width="80px" :src="item.image" />
                        </a></td>
                    <td class="border-bottom-total">
                        <div class="product">
                            <div class="product-title">{{ item.name }}</div>
                            <div class="product-sub-title">Some Design Name</div>
                        </div>
                    </td>
                    <td class="border-bottom-total" style="text-align: center;">
                        <div class="center">
                            <div class="input-group" v-show='!editable'>
                                <span class="input-group-btn">
                                    <button @click="decrement(item)" type="button" class="btn btn-default btn-number" data-type="minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </span>
                                <div class="counter-box">
                                    <span class="counter">{{item.quantity}}</span>
                                </div>
                                <span class="input-group-btn">
                                    <button @click="increment(item)" type="button" class="btn btn-default btn-number" data-type="plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                            <div v-show='editable'>
                                <span class="counter-new">{{ item.quantity }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="price text-center border-bottom-total">$ {{ item.price }}</td>
                    <td class="price text-center border-bottom-total">${{ item.totalPrice.toFixed(2) }}</td>
                    <td class="border-bottom-total">
                        <span class="remove float-right">
                            <a href="javascript:void(0)" @click="removeFromCart(item)" ><img src="/img/remove_icon.png" class="img-responsive" style="margin-top:5px"/></a>
                        </span></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="border-bottom-total"><h5 class="total-label">TOTAL</h5></td>
                    <td class="border-bottom-total">
                        <h5 class="total text-center">$ {{ totalPrice }}</h5>
                    </td>
                    <td class="text-right border-bottom-total">
                    </td>
                </tr><br><br>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: 'product',
    props: ['editable'],
    mounted(){
    },
    methods:{
        addToCart(item) {
            this.$store.commit('addToCart', item);
            this.$store.commit('saveCart');
        },
        removeFromCart(item) {
            this.$store.commit('removeFromCart', item);
            this.$store.commit('saveCart');
        },
        increment(item){
            this.$store.commit('increment', item);
            this.$store.commit('saveCart');
        },
        decrement(item){
            if(item.quantity > 1){
                this.$store.commit('decrement', item);
                this.$store.commit('saveCart');
            }else{
                item.quantity = 1; 
            }
        }
    },
    computed: {
    totalPrice() {
        let total = 0;
        // let shipping = jQuery.isEmptyObject(this.$store.state.shipping) ? 0 : this.$store.state.shipping.price
        for (let item of this.$store.state.cart) {
            total += item.totalPrice;
        }
        // total = total + shipping
        return total.toFixed(2);
    }
}
}
</script>
<style scoped>
@font-face {
        font-family: "SFProText";
        src: url("/fonts/SFProText-Regular.ttf") format('truetype');
    }
thead{
    height: 33px !important ;
    background-color: #f2f2f2;
    }
thead th{
    padding: 5px;
    font-family: SFProText;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.table > tbody > tr > td {
    vertical-align: middle;
}
.product-title{
    /* display: block; */
    font-family: SFProText;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.product-sub-title{
    /* display: block; */
    font-family: SFProText;
    font-size: 18px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.price{
    font-family: SFProText;
    font-size: 18px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.remove .fa{
    color: #626469;
    font-size: 14px;
    font-weight: 600;
}
.cart{
    margin-top:25px;
}
.total-label{
    font-family: SFProText;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
    margin-bottom: 7px;
    margin-top: 7px;
}
.total{
    font-family: SFProText;
    font-size: 18px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
    margin-bottom: 7px;
    margin-top: 7px;
}
.border-bottom-total{
    border-bottom:solid 1px #cccccc;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid #979797;
    /* padding: 0.2rem 0.6rem; */
    padding: 0.2rem 0.4rem;
    font-size: 0.894rem;
    line-height: 1.54;
    border-radius: 0;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.counter-box{
    /* width: 43px;
    height: 30px; */
    width: 28px;
    /* height: 28px; */
    border: solid 1px #979797;
    /* border-bottom: solid 1px #979797; */
}
.counter {
    padding: 3px;
    display: block;
    font-family: SFProText;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.counter-new{
    font-family: SFProText;
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
    float: left;
    margin-left: 35px;
}
.btn.fa{
    font-size: 18px;
    font-weight: bold;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
@media (min-width: 768px) {
    .table-responsive{
        display: inline-table;
    }
}
@media (max-width: 768px) {
    .counter-box{
        border: solid 1px #979797;
        /* border-left: solid 1px #979797; */
        /* border-top: 0;
        border-bottom: 0; */
        width: 28px;
        height: 25px;
        /* margin-left: 24px; */
        margin-left: 17px;

    }
    .input-group{
        display: inline-block
    }
    .cart{
        margin-top:0;
    }
    /* discrease a little bit the font size on mobile */
    .table thead th {
        font-size: 14px;
    }
}
.table td {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}
.btn .btn-default:disabled{
    border: 1px solid #979797 !important;
}
</style>


