<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <form id="validation-form" v-on:submit.prevent>
                <span class="edit-profile">Edit Profile</span>
                <div class="row">
                    <div class="col-6">
                        <div class="input-wrap">
                            <div class="left-side"><label for="imageProfile">Profile&nbsp;Picture</label></div>
                            <div class="right-side">
                                <img v-show="showProfilePic" id="logo-image" :src="logoUrl" alt="logo" class="logo">
                                <input v-on:change="selectLogo" ref="logo" id="imageProfile" type="file">
                                <label class="input-label" for="imageProfile">Choose File</label></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyName">Full&nbsp;Name</label></div>
                            <div class="right-side"><input id="companyName" name="companyName" type="text" v-model="sponsor.name"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="bio">Bio</label></div>
                            <div class="right-side"><textarea id="bio" name="bio" v-model="sponsor.bio"></textarea></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="website">Website</label></div>
                            <div class="right-side"><input id="website" type="text" v-model="sponsor.website"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="instagram">Instagram</label></div>
                            <div class="right-side"><input id="instagram" type="text" v-model="sponsor.instagram"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="facebook">Facebook</label></div>
                            <div class="right-side"><input id="facebook" type="text" v-model="sponsor.facebook"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="twitter">Twitter</label></div>
                            <div class="right-side"><input id="twitter" type="text"  v-model="sponsor.twitter"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="hashtags">Hashtags</label></div>
                            <div class="right-side">
                                <input @keyup="onHashtagChange" ref="hashtag" id="hashtags" type="text" v-model="sponsor.hashtags">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyAddress">Company&nbsp;Address</label></div>
                            <div class="right-side"><input id="companyAddress" type="text" v-model="sponsor.company_address"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="city">City</label></div>
                            <div class="right-side"><input id="city" type="text" v-model="sponsor.city"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="state">State</label></div>
                            <div class="right-side"><input id="state" type="text" v-model="sponsor.state"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="zipCode">Zip&nbsp;Code</label></div>
                            <div class="right-side"><input id="zipCode" type="text" v-model="sponsor.zip"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="country">Country</label></div>
                            <div class="right-side"><input id="country" type="text" v-model="sponsor.country"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyPhone">Phone</label></div>
                            <div class="right-side"><input id="companyPhone" type="text" v-model="sponsor.company_phone"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyEmail">Email</label></div>
                            <div class="right-side"><input id="companyEmail" type="text" v-model="sponsor.email"></div>
                        </div>
                    </div>
                </div>
                <button @click="saveProfile" class="save-btn">Save</button>
            </form>
        </template>
    </sponsor-common>
</template>

<script>
    export default {
        data() {
            return {
                navLink: 'Edit Profile',
                showProfilePic:false
            };
        },
        props: {
            sponsor: {
                type: Object,
                require: true
            }
        },
        mounted: function() {
            this.initValidation();
            this.showProfilePic = this.sponsor.logo;
            this.sponsor.hashtags = this.prepareHashtags(this.$refs.hashtag.value);
        },
        computed: {
            logoUrl() {
                return this.sponsor.logo ? this.sponsor.logo : this.defaultLogo
            },
        },
        methods: {
            initValidation: function() {
                $('#validation-form').validate({
                    rules: {
                        'companyName': {
                            required: true
                        }
                    },
                    errorPlacement: function errorPlacement(error, element) {
                        var $parent = $(element).parents('.right-side');
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
                        $(element).parents('.right-side').find('.is-invalid').removeClass('is-invalid');
                    }
                });
            },
            selectLogo() {
                this.logo = this.$refs.logo.files[0];
                const reader = new FileReader();
                this.showProfilePic = true;
                reader.onload = function(e) {
                    $('#logo-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.logo);
            },
            onHashtagChange: function(e){
                let str = e.target.value;
                var key = event.keyCode || event.charCode;
                if( key == 8 || key == 46 )
                    return false;
                if(str){
                    this.$refs.hashtag.value = this.prepareHashtags(str);
                }
            },
            prepareHashtags: function(str){
                if(str){
                    str = str
                        .replace(/#,/g, '')
                        .replace(/#/g, '')
                        .trim()
                        .split(',').map(item => {
                        return  '#' + item.trim();
                    })
                .join(', ');
                    return str;
                }
                return str;
            },
            saveProfile() {
                if (!$('#validation-form').valid()) {
                    return;
                }
                let formData = new FormData();
                if (this.logo) {
                    formData.append("logo", this.logo);
                }
                formData.append("_method", "put");
                let loader = this.$loading.show({
                    // Optional parameters
                    container: null,
                    canCancel: false,
                    width: 128,
                    height: 128
                });
                formData.append("id", this.sponsor.id);
                if(this.sponsor.name){
                    formData.append("name", this.sponsor.name);
                }
                if(this.sponsor.hashtags){
                    formData.append("hashtags", this.sponsor.hashtags.replace(/#/g, ''));
                }
                if(this.sponsor.bio){
                    formData.append("bio", null);
                }
                if(this.sponsor.website){
                    formData.append("website", this.sponsor.website);
                }
                if(this.sponsor.instagram){
                    formData.append("instagram", this.sponsor.instagram);
                }
                if(this.sponsor.twitter){
                    formData.append("twitter", this.sponsor.twitter);
                }
                if(this.sponsor.facebook){
                    formData.append("facebook", this.sponsor.facebook);
                }
                if(this.sponsor.company_address){
                    formData.append("company_address", this.sponsor.company_address);
                }
                if(this.sponsor.city){
                    formData.append("city", this.sponsor.city);
                }
                if(this.sponsor.state){
                    formData.append("state", this.sponsor.state);
                }
                if(this.sponsor.zip){
                    formData.append("zip", this.sponsor.zip);
                }
                if(this.sponsor.country){
                    formData.append("country", this.sponsor.country);
                }
                if(this.sponsor.company_phone){
                    formData.append("company_phone", this.sponsor.company_phone);
                }
                if(this.sponsor.email){
                    formData.append("email", this.sponsor.email);
                }
                axios
                    .post(`/sponsor/${this.sponsor.id}/profile/edit`, formData, {
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
</script>

<style lang="scss" scoped>
    @import '~@/_variables.scss';
    .sponsor-common {
        .save-btn {
            size: 28px;
            color: #444444;
            width: 132px;
            height: 33px;
            background-color: #ffe100;
            border-radius: 3px;
            border: 1px solid black;
            font-weight: bold;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: center;
            align-items: center;
            align-self: center;
            margin-top: 30px;
        }
        .edit-profile {
            font-size: 25px;
            font-family: font-family-helvetica-neue;
            font-weight: bold;
            color: #ffc600;
            margin-bottom: 25px;
            padding-left: 232px;
        }
        .invalid-feedback {
            align-self: baseline;
        }
        .is-invalid {
            border-color: #d9534f !important;
        }
        form {
            display: flex;
            flex-direction: column;
            input[type="text"], textarea{
                border-radius: 3px;
                border: solid 2px rgba(212, 212, 212, 0.33) !important;
                &:focus{
                     outline: none;
                 }
            }
        }
        #validation-form {
            margin-right: -120px;
        }
        @media (max-width: 1800px)  {
            #validation-form {
                margin-right: 0px;
            }
        }
    }
</style>
