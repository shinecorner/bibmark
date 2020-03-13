<template>
    <charity-common :charity="charity" :slug="slug" :activeLink="navLink">
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
                            <div class="right-side"><input id="companyName" name="companyName" type="text" v-model="charity.name"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="bio">Bio</label></div>
                            <div class="right-side"><textarea id="bio" name="bio" v-model="charity.bio"></textarea></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="website">Website</label></div>
                            <div class="right-side"><input id="website" type="text" v-model="charity.website"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="instagram">Instagram</label></div>
                            <div class="right-side"><input id="instagram" type="text" v-model="charity.instagram"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="facebook">Facebook</label></div>
                            <div class="right-side"><input id="facebook" type="text" v-model="charity.facebook"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="twitter">Twitter</label></div>
                            <div class="right-side"><input id="twitter" type="text"  v-model="charity.twitter"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="hashtags">Hashtags</label></div>
                            <div class="right-side">
                                <input @keyup="onHashtagChange" ref="hashtag" id="hashtags" type="text" v-model="charity.hashtags">
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="slug">Slug</label></div>
                            <div class="right-side">
                                <input id="slug" name="slug" type="text" v-model="slug">
                                <small v-if="!errorsList.slug.valid" id="slugError" class="form-text">
                                    <p class="text-red" v-for="error in errorsList.slug.messages" style="color: red;">
                                        {{ error }}
                                    </p>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyAddress">Company&nbsp;Address</label></div>
                            <div class="right-side"><input id="companyAddress" type="text" v-model="charity.company_address"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="city">City</label></div>
                            <div class="right-side"><input id="city" type="text" v-model="charity.city"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="state">State</label></div>
                            <div class="right-side"><input id="state" type="text" v-model="charity.state"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="zipCode">Zip&nbsp;Code</label></div>
                            <div class="right-side"><input id="zipCode" type="text" v-model="charity.zip"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="country">Country</label></div>
                            <div class="right-side"><input id="country" type="text" v-model="charity.country"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyPhone">Phone</label></div>
                            <div class="right-side"><input id="companyPhone" type="text" v-model="charity.company_phone"></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side"><label for="companyEmail">Email</label></div>
                            <div class="right-side"><input id="companyEmail" type="text" v-model="charity.email"></div>
                        </div>
                    </div>
                </div>
                <button @click="saveProfile" class="save-btn">Save</button>
            </form>
        </template>
    </charity-common>
</template>

<script>
    export default {
        data() {
            return {
                navLink: 'Edit Profile',
                showProfilePic:false,
                errorsList: {
                    slug: {
                        valid: true,
                        messages: []
                    }
                }
            };
        },
        props: {
            charity: {
                type: Object,
                require: true
            },
            slug: {
                type: String,
                require: true
            }
        },
        mounted: function() {
            this.initValidation();
            this.showProfilePic = this.charity.logo;
            this.charity.hashtags = this.prepareHashtags(this.$refs.hashtag.value);
        },
        computed: {
            logoUrl() {
                return this.charity.logo ? this.charity.logo : this.defaultLogo
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
                const self = this;
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
                formData.append("id", this.charity.id);
                if(this.charity.name){
                    formData.append("name", this.charity.name);
                }

                if(this.slug){
                    formData.append("slug", this.slug);
                }

                if(this.charity.hashtags){
                    formData.append("hashtags", this.charity.hashtags.replace(/#/g, ''));
                }
                if(this.charity.bio){
                    formData.append("bio", this.charity.bio);
                }
                if(this.charity.website){
                    formData.append("website", this.charity.website);
                }
                if(this.charity.instagram){
                    formData.append("instagram", this.charity.instagram);
                }
                if(this.charity.twitter){
                    formData.append("twitter", this.charity.twitter);
                }
                if(this.charity.facebook){
                    formData.append("facebook", this.charity.facebook);
                }
                if(this.charity.company_address){
                    formData.append("company_address", this.charity.company_address);
                }
                if(this.charity.city){
                    formData.append("city", this.charity.city);
                }
                if(this.charity.state){
                    formData.append("state", this.charity.state);
                }
                if(this.charity.zip){
                    formData.append("zip", this.charity.zip);
                }
                if(this.charity.country){
                    formData.append("country", this.charity.country);
                }
                if(this.charity.company_phone){
                    formData.append("company_phone", this.charity.company_phone);
                }
                if(this.charity.email){
                    formData.append("email", this.charity.email);
                }
                axios
                    .post(`/charity/${this.charity.id}/profile/edit`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        self.charity = response.data.charity
                        if(response.data.errors) {
                            self.errorsList.slug.valid = false;
                            self.errorsList.slug.messages = response.data.errors.slug;
                        } else {
                            self.errorsList.slug.valid = true;
                            self.errorsList.slug.messages = [];
                        }
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
    .charity-common {
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
            margin-right: -100px;
        }
        @media (max-width: 1800px)  {
            #validation-form {
                margin-right: 20px;
            }
        }
    }
</style>
