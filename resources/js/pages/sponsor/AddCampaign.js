export default {

    data() {
        return {
            navLink: 'Campaigns',
            sizes: [
                {size: 'Small', price: '$3'},
                {size: 'Medium', price: '$6'},
                {size: 'Large', price: '$10'},
                {size: 'Full', price: '$14'},
            ]
        };
    },
    props: {
        sponsor: {
            type: Object,
            require: true
        }
    },
    methods: {
    }
}
