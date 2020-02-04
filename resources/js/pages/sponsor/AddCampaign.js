export default {

    data() {
        return {
            navLink: 'Campaigns',
            defaultLogo: "/img/profile/profile-fit.png",
            logo: null,
            campaign: {
                geoTargets: [],
            },
            tempGeoTarget: {},
            addGeoTargetError: '',
            displayGeoEditIndex: '',
            editGeoTargetIndex: -1,
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
            return this.campaign.logo ? this.campaign.logo : this.defaultLogo
        },
    },
    mounted: function () {
        this.initValidation();
    },
    methods: {
        initValidation: function () {
            $('#validation-form').validate({
                rules: {
                    'name': {
                        required: true
                    },
                },
                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents('.add-input-group');
                    if ($parent.find('.jquery-validation-error').length) {
                        return;
                    }
                    $parent.append(
                        error.addClass('jquery-validation-error small form-text invalid-feedback')
                    );
                },
                highlight: function (element) {
                    var $el = $(element);
                    $el.addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).parents('.right-side2').find('.is-invalid').removeClass('is-invalid');
                }
            });
        },
        selectLogo() {
            this.campaign.logo = this.$refs.logo.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#logo').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.campaign.logo);
        },
        save() {
            if (!$('#validation-form').valid()) {
                return;
            }

            let formData = new FormData();
            formData.append('name', this.campaign.name);
            formData.append('budget', this.campaign.budget);
            formData.append('sponsor_id', this.sponsor.id);
            formData.append('status', this.campaign.status ? 1 : 0);

            if (this.campaign.logo) {
                formData.append("logo_url", this.campaign.logo);
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
                .post(`/sponsors/${this.sponsor.id}/campaign/save`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    window.history.go(-1);
                })
                .catch(error => {
                    console.log(error.response.data.errors);
                })
                .finally(() => {
                    loader.hide()
                });
        },
        showAddGeoTargetModal() {
            this.addGeoTargetError = '';
            this.editGeoTargetIndex = -1;

            // Refesh modal data
            this.tempGeoTarget = {
                name: '',
                zipcodes: [],
            };
            this.tempGeoTarget.zipcodes.push({code: '', radius: '10'})
            this.$modal.show('add-geo-target-modal');
        },
        addGeoZipcode() {
            this.tempGeoTarget.zipcodes.push({code: '', radius: '10'})
        },
        saveGeoTarget() {
            this.addGeoTargetError = '';
            let isValid = true;

            if(this.tempGeoTarget.name === '' ){
                isValid = false;
                this.addGeoTargetError += 'The target name must be filled. <br/>';
            }

            let that = this;
            this.tempGeoTarget.zipcodes.forEach(function (value) {
                if (value.code === '') {
                    isValid = false;
                    that.addGeoTargetError += 'The zip code must be filled.';
                }
            });

            if (isValid) {
                if (this.editGeoTargetIndex >= 0) {
                    this.campaign.geoTargets[this.editGeoTargetIndex] = this.tempGeoTarget;
                } else {
                    this.campaign.geoTargets.push(this.tempGeoTarget);
                }
                this.$modal.hide('add-geo-target-modal');
            }
        },
        editGeoTarget(target, index) {
            this.addGeoTargetError = '';
            this.editGeoTargetIndex = index;
            this.tempGeoTarget = target;
            this.$modal.show('add-geo-target-modal');
        },
        displayButton(index) {
            this.displayGeoEditIndex = index;
        },
        hideButton() {
            this.displayGeoEditIndex = '';
        },
    }
}
