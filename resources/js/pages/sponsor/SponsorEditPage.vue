<template>
    <div class="container-fluid sponsor-edit">
        <div class="image-wrapper">
            <img class="background-image" id="cover-image" :src="coverUrl" alt="background-image">
            <div class="input-cover-wrap">
                <input v-on:change="selectCover" ref="cover" id="cover" type="file">
                <label for="cover">Change Cover</label>
            </div>
        </div>
        <div class="main-section">
            <div class="col-2 nav-links">
                <span class="navigation-link" :class="{ active: item.isActive }" v-for="(item, index) in navLinks" :key="index">{{item.text}}</span>
            </div>
            <div class="col-10 tab-section">
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                navLinks: [{text:"Edit Profile", isActive:true}, {text:"Manage Team", isActive:false}, {text:"Campaigns", isActive:false}, {text:"Order Gallery", isActive:false}, {text:"Reports", isActive:false}, {text:"Payment Information", isActive:false}, {text:"Payment History", isActive:false}],
                logo: null,
                defaultLogo: "/img/profile/profile-fit.png",
                defaultCover: "/img/bg/1.jpg",
                cover: null,
                isLoading: false
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
            coverUrl() {
                return this.sponsor.background_image ? this.sponsor.background_image : this.defaultCover;
            }
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
            selectCover() {
                this.cover = this.$refs.cover.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.cover);
            },
            saveProfile() {
                let formData = new FormData();
                if (this.logo) {
                    formData.append("logo", this.logo);
                }
                if (this.cover) {
                    formData.append("cover", this.cover);
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

.sponsor-edit {
    padding: 0;
    background-color: white;
    .main-section {
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        align-items: flex-start;
    }

    .image-wrapper {
        height: 431px;
        width: 100%;
        margin-bottom: 59px;
        position: relative;
    }

    .input-cover-wrap {
        position: absolute;
        bottom: 19px;
        right: 76px;
        input {
            display: none;
        }
        label {
            size: 18px;
            color: #444444;
            padding: 6px 7px;
            background-color: white;
            border-radius: 3px;
            font-weight: bold;
        }
    }

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

    .nav-links {
        padding: 0 15px 67px 28px;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        flex-direction: column;
        border-right: solid 2px #cccccc;
        &>*:not(:last-child) {
            margin-bottom: 14px;
        }
    }

    .navigation-link {
        font-family: HelveticaNeue, sans-serif;
        font-size: 20px;
        cursor: pointer;
        color: #444444;
        font-weight: regular;

        &.active {
            font-weight: bold;
            color: #ffc600;
        }
    }

    .tab-section {
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        flex-direction: column;
        padding-top: 11px;
    }

    .edit-profile {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #ffc600;
        margin-bottom: 25px;
        padding-left: 232px;
    }

    .left-side {
        margin-right: 40px;
        max-width: 189px;
        width: 100%;
        padding-top: 14px;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        justify-content: flex-end;

        label {
            font-family: HelveticaNeue, sans-serif;
            font-size: 22px;
            font-weight: 500;
            color: #444444;
            margin-bottom: 0;
        }
    }

    .right-side {
        max-width: 348px;
        width: 100%;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        align-items: center;

        .input-label {
            font-size: 18px;
            color: #444444;
            width: 117px;
            height: 33px;
            border: solid 1px #d4d4d4;
            display: -webkit-inline-flex;
            display: -moz-inline-flex;
            display: -ms-inline-flex;
            display: -o-inline-flex;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 0;
        }

        .logo {
            $size: 49px;
            height: $size;
            width: $size;
            border-radius: 50%;
            margin-right: 20px;
            background-color: #ffc600;
        }

        input[type="file"] {
            display: none;
        }

        input[type="text"],textarea {
            border: solid 2px rgba(212, 212, 212, 0.89);
            padding: 13px 11px;
            font-size: 20px;
            font-family: HelveticaNeue, sans-serif;
            font-weight: regular;
            color: #444444;
            width: 100%;
        }

        textarea {
            resize: none;
            height: 122px;
        }
    }

    .background-image {
        background-color: #ffc600;
        width: 100%;
        height: 100%;
        display: block;
    }

    .input-wrap {
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;

        &:not(:last-child) {
            margin-bottom: 13px;
        }
    }
}
</style>
