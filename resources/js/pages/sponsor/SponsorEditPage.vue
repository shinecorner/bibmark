<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <span class="edit-profile">Edit Profile</span>
            <div class="row edit-profile-row">
                <div class="col-6">
                    <div class="input-wrap">
                        <div class="left-side"><label for="imageProfile">Profile Picture</label></div>
                        <div class="right-side"><img id="logo-image" :src="logoUrl" alt="logo" class="logo"><input v-on:change="selectLogo" ref="logo" id="imageProfile" type="file">
                            <label class="input-label" for="imageProfile">Choose File</label></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="companyName">Comapny Name</label></div>
                        <div class="right-side"><input id="companyName" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="bio">Bio</label></div>
                        <div class="right-side"><textarea></textarea></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="website">Website</label></div>
                        <div class="right-side"><input id="website" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="instagram">Instagram</label></div>
                        <div class="right-side"><input id="instagram" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="facebook">Facebook</label></div>
                        <div class="right-side"><input id="facebook" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="twitter">Twitter</label></div>
                        <div class="right-side"><input id="twitter" type="text"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-wrap">
                        <div class="left-side"><label for="companyAddress">Comapny Address</label></div>
                        <div class="right-side"><input id="companyAddress" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="city">City</label></div>
                        <div class="right-side"><input id="city" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="state">State</label></div>
                        <div class="right-side"><input id="state" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="zipCode">Zip Code</label></div>
                        <div class="right-side"><input id="zipCode" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="country">Country</label></div>
                        <div class="right-side"><input id="country" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="companyPhone">Company Phone</label></div>
                        <div class="right-side"><input id="companyPhone" type="text"></div>
                    </div>
                    <div class="input-wrap">
                        <div class="left-side"><label for="email">Email</label></div>
                        <div class="right-side"><input id="email" type="text"></div>
                    </div>
                </div>
            </div>
            <button @click="saveProfile" class="save-btn">Save</button>
        </template>
    </sponsor-common>
</template>

<script>
    export default {
        data() {
            return {
                navLink: 'Edit Profile'
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
            saveProfile() {
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

                axios
                    .post(`/sponsors/${this.sponsor.id}/profile/edit`, formData, {
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

    .sponsor-common {
        .save-btn {
            size: 28px;
            color: #444444;
            width: 132px;
            height: 33px;
            background-color: white;
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
            font-family: HelveticaNeue, sans-serif;
            font-weight: bold;
            color: #ffc600;
            margin-bottom: 25px;
            padding-left: 232px;
        }
    }
</style>
