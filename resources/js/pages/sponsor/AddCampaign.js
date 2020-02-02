export default {

    data() {
        return {
            navLink: 'Campaigns',
            defaultLogo: "/img/profile/profile-fit.png",
            logo: null,
            campaign: {},
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
    mounted: function () {
        this.initValidation();
    },
    methods: {
        initValidation: function() {
            $('#validation-form').validate({
                rules: {
                    'campaignName': {
                        required: true
                    }
                },
                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.right-side2');
                    if ($parent.find('.jquery-validation-error').length) { return; }
                    $parent.append(
                        error.addClass('jquery-validation-error small form-text invalid-feedback')
                    );
                },
                highlight: function(element) {
                    var $el = $(element);
                    $el.addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                }
            });
        },
        selectLogo() {
            this.logo = this.$refs.logo.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logo-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.logo);
        },
        save() {
            if (!$('#validation-form').valid()) {
                return;
            }

            console.log($('#validation-form').valid());
            return;

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
