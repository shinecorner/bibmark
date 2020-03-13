<template>
    <div class="cart">
        <div class="card mb-2">
            <h5 class="card-header">Shipping Method : 
                <span class="shipping float-right" v-if="this.$store.state.shipping"> {{ shipping.name}} : $ {{ shipping.price}} </span>
                <span v-else class="float-right">No shipping Selected</span>
            </h5>
            <h5 class="card-header">Ship to : 
                <span class="shipping float-right">  </span>
            </h5>
        </div>
        <div class="card mb-3">
            <h5 class="card-header">Payment Method :
                <span class="list-group-item-text float-right" v-if="this.$store.state.card">
                    <span class="cartype">
                        <img :src="'/svg/'+card.card_brand+'.svg'" :alt="card.card_brand" height="50px" width="60px" />
                    </span>
                    <span class="end">
                        {{ card.name }}
                    </span>
                    <span class="end">
                        *****{{ card.card_last_four }}
                    </span>
                </span>
                <span class="float-right" v-else>No payment method chosen</span>
            </h5>
        </div>
    </div>
</template>
<script>
export default {
    name: 'review',
    data() {
        return {
            //shipping: JSON.parse(localStorage.getItem('shipping')),
            //card: {}
            shipping: this.$store.state.shipping
        }
    },
    methods: {
        generaltotal() {
            let total = 0;
            let shipping = jQuery.isEmptyObject(this.$store.state.shipping) ? 0 : this.$store.state.shipping.price
            for (let item of this.$store.state.cart) {
                total += item.totalPrice;
            }
            total = total + shipping
            return total.toFixed(2);
        }
    },
    computed: {
        card() {
            return this.$store.state.card
        }
    },
}
</script>
<style lang="scss" scoped>
@import '~@/_variables.scss';
.shipping{
    font-family: $font-family-sf-pro-text;
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
</style>



