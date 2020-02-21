export default {

    data() {
        return {
            navLink: 'Campaigns',
            defaultLogo: "/img/profile/profile-fit.png",
            logo: null,
            mainGeoTargets: [],
            tempGeoTarget: {},            
            addGeoTargetError: '',
            displayGeoEditIndex: '',
            editGeoTargetIndex: -1,                        
        };
    },
    props: {
        campaignId: {
            type: [Object, String],
            require: true
        },
        charity: {
            type: Object,
            require: true
        },
        campaign: {
            type: Object,
            require: true
        },
        currentGeoTargets: {
            type: [Array],
            require: false,
            default: function(){return []}
        }
    },   
    computed: {
        logoUrl() {
            return (this.campaign.logo && (typeof this.campaign.logo === 'string')) ? this.campaign.logo : this.defaultLogo
        },
    },
    created: function(){
        this.mainGeoTargets = this.currentGeoTargets;
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
            formData.append('charity_id', this.charity.id);
            formData.append('logo_width', this.campaign.logo_width);
            formData.append('hashtags', this.campaign.hashtags);
            formData.append('status', this.campaign.status ? 1 : 0);
            formData.append('geo_targets', (this.mainGeoTargets) ? JSON.stringify(this.mainGeoTargets) : []);
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
                .post(`/charity/${this.charity.id}/campaign/save`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    window.location.href = `/charity/${this.charity.id}/campaign`;
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
                status: false,
                zipcodes: [],
            };
            this.tempGeoTarget.zipcodes.push({zipcode: '', radius: '10'})
            this.$modal.show('add-geo-target-modal');
        },
        addGeoZipcode() {
            this.tempGeoTarget.zipcodes.push({zipcode: '', radius: '10'})
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
                if (value.zipcode === '') {
                    isValid = false;
                    that.addGeoTargetError += 'The zip code must be filled.';
                }
            });

            if (isValid) {
                if (this.editGeoTargetIndex >= 0) {
                    // this.editGeoTargetIndex += 1;
                    this.mainGeoTargets[this.editGeoTargetIndex] = this.tempGeoTarget;
                    // Vue.set(this.mainGeoTargets, this.editGeoTargetIndex, this.tempGeoTarget);
                    // this.campaign.geoTargets.splice(0, 1, this.tempGeoTarget);
                    
                } else {
                    // this.editGeoTargetIndex += 1;
                    this.mainGeoTargets.push(this.tempGeoTarget);
                    // Vue.set(this.mainGeoTargets, this.editGeoTargetIndex, this.tempGeoTarget);
                    // this.campaign.geoTargets.splice(0, 1, this.tempGeoTarget);
                }
                console.log(this.mainGeoTargets);
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
        cancel() {
            const self = this;
            bootbox.confirm({
                message: 'Are you sure discard this campaign?',
                className: 'bootbox-sm bootbox-yellow',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'bg-yellow'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn'
                    }
                },
                callback: function (res) {
                    if(res) {
                        window.history.back();
                    }
                }
            });
        }
    }
}
