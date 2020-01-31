export default {

    data() {
        return {
            navLink: 'Campaigns'
        };
    },
    props: {
        campaigns: {
            type: Array,
            require: true
        },
        sponsor: {
            type: Object,
            require: true
        }
    },
    methods: {
    }
}
