let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');
let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        card : {},
        shipping:{}
        // shipping: {"id":2,"name":"Two-Day Shipping","price":9.5}
    },
    mutations: {
        addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);
        
            if (found) {
                found.quantity ++;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.push(item);
        
                Vue.set(item, 'quantity', 1);
                Vue.set(item, 'totalPrice', item.price);
            }
        
            state.cartCount++;
        },
        Card(state, card){
            console.log(card)
            state.card = card
        },
        Shipping(state, shipping){
            state.shipping = shipping
        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);
        
            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;
        
                state.cart.splice(index, 1);
            }
        },
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },
        saveShipping(state) {
            window.localStorage.setItem('shipping', state.shipping);
        },
        // increment the cart
        increment(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            found.quantity ++;
            found.totalPrice = found.quantity * found.price;
            state.cartCount++;
        },
        // Decrement the cart
        decrement(state, item) {
            let found = state.cart.find(product => product.id == item.id);

            found.quantity --;
            found.totalPrice = found.quantity * found.price;
            state.cartCount++;
        },
    }
};
export default store;