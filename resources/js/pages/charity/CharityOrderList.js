import Gallery from './Gallery';

export default {
    components: { Gallery },
    data() {
        return {
            navLink: 'Order Gallery',
            showProfilePic: false,
            bus: new Vue()
        };
    },
    props: {
        charity: {
            type: Object,
            require: true
        }
    },
    methods: {
        showModal() {
            this.$root.$emit('showGalleryModalEvent')
        }
    }
}