export default {

    data() {
        return {
            navLink: 'Campaigns',
            defaultLogo: "/img/profile/profile-fit.png",
            logo: null,
            tempGeoTarget: {},
            addGeoTargetError: '',
            displayGeoEditIndex: '',
            editGeoTargetIndex: -1,
            sizes: [
                {size: 'Small', price: '$3'},
                {size: 'Medium', price: '$6'},
                {size: 'Large', price: '$10'},
                {size: 'Full', price: '$14'},
            ],
            excludeCompanies: [],
            mockupCompanies: [
                {id: 1, logo: '/img/companies/cocacola.png'},
                {id: 2, logo: '/img/companies/cocacola.png'},
                {id: 3, logo: '/img/companies/cocacola.png'},
                {id: 4, logo: '/img/companies/cocacola.png'},
                {id: 5, logo: '/img/companies/cocacola.png'},
                {id: 6, logo: '/img/companies/cocacola.png'},
                {id: 1, logo: '/img/companies/cocacola.png'},
                {id: 2, logo: '/img/companies/cocacola.png'},
                {id: 3, logo: '/img/companies/cocacola.png'},
                {id: 4, logo: '/img/companies/cocacola.png'},
                {id: 5, logo: '/img/companies/cocacola.png'},
                {id: 6, logo: '/img/companies/cocacola.png'},
                {id: 1, logo: '/img/companies/cocacola.png'},
                {id: 2, logo: '/img/companies/cocacola.png'},
                {id: 3, logo: '/img/companies/cocacola.png'},
                {id: 4, logo: '/img/companies/cocacola.png'},
                {id: 5, logo: '/img/companies/cocacola.png'},
                {id: 6, logo: '/img/companies/cocacola.png'},
            ],
            ageRanges: [
                '14 and under',
                '15-19',
                '20-24',
                '25-29',
                '30-34',
                '35-39',
                '40-44',
                '45-49',
                '50-54',
                '55-59',
                '60-64',
                '70-74',
                '75-79',
                '80-84',
                '85-89',
                '90 and over',
            ],
            enableSizePrice: {},
        };
    },
    props: {
        campaignId: {
            type: [Object, String],
            require: true
        },
        sponsor: {
            type: Object,
            require: true
        },
        campaign: {
            type: Object,
            require: true
        }
    },
    computed: {
        logoUrl() {
            return (this.campaign.logo && (typeof this.campaign.logo === 'string')) ? this.campaign.logo : this.defaultLogo
        },
    },
    beforeMount: function () {
        if (this.campaign == null) {
            this.campaign = {budget: 0};
        }
    },
    mounted: function () {
        this.initValidation();
    },
    methods: {
        initValidation: function () {
            $.validator.addMethod(
                "numberIfNotNull",
                function (value, elm) {
                    if (value) {
                        return !isNaN(value);
                    } else {
                        return true;
                    }
                },
                "Budget has to be a Number"
            );
            $('#validation-form').validate({
                rules: {
                    'name': {
                        required: true
                    },
                    'budget': {
                        numberIfNotNull: true
                    }
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
            formData.append('budget', this.campaign.budget ? this.campaign.budget : 0);
            formData.append('sponsor_id', this.sponsor.id);
            formData.append('status', this.campaign.status ? 1 : 0);
            if (this.campaign.id) {
                formData.append('id', this.campaign.id);
            }

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
                .post(`/sponsor/${this.sponsor.id}/campaign/save`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    window.location.href = `/sponsor/${this.sponsor.id}/campaign`;
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

            if (this.tempGeoTarget.name === '') {
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
        addExcludeCompany(company) {
            this.excludeCompanies.push(company);
        },
        removeExcludeCompany(index) {
            this.excludeCompanies.splice(index, 1);
        },
        cancel() {
            const self = this;
            bootbox.confirm({
                message: 'Are you sure remove this campaign?',
                className: 'bootbox-sm',
                callback: function (res) {
                    if(res) {
                        window.history.back();
                    }
                }
            });
        }
    }
}
