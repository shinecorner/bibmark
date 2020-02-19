import Gallery from './Gallery';

export default {
    components: { Gallery },
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