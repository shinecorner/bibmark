export default {
    data() {
        return {
            navLink: 'Donation History',
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