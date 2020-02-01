export default {

    data() {
        return {
            navLink: 'Campaigns',
            defaultLogo: "/img/profile/profile-fit.png",
            logo: null,
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
    computed: {
        logoUrl() {
            return this.sponsor.logo ? this.sponsor.logo : this.defaultLogo
        },
    },
    methods: {
        selectLogo() {
            this.logo = this.$refs.logo.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logo-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.logo);
        },
        saveCampaign() {
            let formData = new FormData();
            if (this.logo) {
                formData.append("logo", this.logo);
            }
            formData.append("_method", "post");

            let loader = this.$loading.show({
                // Optional parameters
                container: null,
                canCancel: false,
                width: 128,
                height: 128
            });

            axios
                .post(`/sponsors/${this.sponsor.id}/campaign/store`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response.data.errors);
                })
                .finally(() => {
                    loader.hide()
                });
        }
    }
}
