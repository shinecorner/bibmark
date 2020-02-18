export default {
    data() {
        return {
            navLink: 'Order Gallery',
            showProfilePic: false
        };
    },
    props: {
        charity: {
            type: Object,
            require: true
        }
    },
}