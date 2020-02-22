<template>
    <div class="container-fluid charity-common">
        <div class="image-wrapper">
            <img class="background-image" id="cover-image" :src="coverUrl" alt="background-image">
            <div class="input-cover-wrap">
                <input v-on:change="selectCover" ref="cover" id="cover" type="file">
                <label for="cover">Change Cover</label>
            </div>
        </div>
        <template v-if="type==='full'">
            <div class="main-section">
                <div class="col-12 tab-section">
                    <slot name="charity-content" :cover="cover"></slot>
                </div>
            </div>
        </template>
        <template v-else>
                <div class="main-section pt-5 pb-3">
                    <div class="col-2 nav-links">
                        <span class="navigation-link" :class="{ active: item.isActive, disabled: !item.url }" v-for="(item, index) in navLinks"
                            :key="index" @click="redirect(item.url)">{{item.text}}</span>
                    </div>
                    <div class="col-9 offset-1 pr-4vw">
                        <slot name="setting-content" :cover="cover"></slot>
                    </div>
                </div>
        </template>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                navLinks: [
                    {text: "Edit Profile", isActive: false, url: "/charity/{0}/profile/edit"},
                    {text: "Manage Team", isActive: false, url: ""},
                    {text: "Campaigns", isActive: false, url: ""},
                    {text: "Order Gallery", isActive: false, url: "/charity/{0}/order"},
                    {text: "Reports", isActive: false, url: ""},
                    {text: "Payment Information", isActive: false, url: ""},
                    {text: "Donation History", isActive: false, url: "/charity/{0}/donation"}
                ],
                logo: null,
                defaultLogo: "/img/profile/profile-fit.png",
                defaultCover: "/img/bg/1.jpg",
                cover: null,
                isLoading: false
            };
        },
        props: {
            charity: {
                type: Object,
                require: true
            },
            activeLink: {
                type: String,
            },
            type: {
                type: String,
                default: ''
            }
        },
        computed: {
            coverUrl() {
                return this.charity && this.charity.background_image ? this.charity.background_image : this.defaultCover;
            }
        },
        methods: {
            selectLogo() {
            },
            selectCover() {
            },
            redirect(url) {
                if (window.charity_id) {
                    url = url.replace('{0}', window.charity_id);
                    window.location = url;
                }
            }
        },
        mounted() {
            if (this.activeLink) {
                let that = this;
                this.navLinks = this.navLinks.filter(function (link) {
                    if (link.text === that.activeLink) {
                        link.isActive = true;
                    }
                    return link;
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '~@/_variables.scss';
    @font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SF-Pro-Display-Regular.otf") format('truetype');
    }
    .charity-common {
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
            margin-bottom: 29px;
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

        .nav-links {
            padding: 0 15px 67px 95px;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            flex-direction: column;
            border-right: solid 2px #cccccc;

            & > *:not(:last-child) {
                margin-bottom: 14px;
            }
        }

        .navigation-link {
            font-family: $font-family-helvetica-neue;
            font-size: 20px;
            cursor: pointer;
            color: #444444;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            letter-spacing: normal;
            color: #444444;

            &.active {
                color: $line-yellow;
                font-weight: bold;
            }

            &.disabled {
                opacity: 0.25;
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
                font-family: $font-family-helvetica-neue;
                font-size: 22px;
                font-weight: 500;
                font-stretch: normal;
                font-style: normal;
                line-height: normal;
                letter-spacing: normal;
                text-align: right;
                color: #444444;
                margin-bottom: 0;
            }
        }

        .left-side2 {
            margin-right: 40px;
            max-width: 300px;
            width: 100%;
            padding-top: 14px;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: flex-end;

            label {
                font-family: $font-family-helvetica-neue, sans-serif;
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
            flex-wrap: wrap;

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

            input[type="text"], select, textarea {
                border: solid 2px #f2f2f2;
                padding: 13px 11px;
                font-size: 20px;
                font-family: $font-family-helvetica-neue;
                font-weight: regular;
                color: #444444;
                width: 100%;
                height: 48px;
            }

            textarea {
                resize: none;
                height: 122px;
            }
        }

        .right-side2 {
            max-width: 600px;
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

            input[type="text"], textarea {
                border: solid 2px #f2f2f2;
                padding: 13px 11px;
                font-size: 20px;
                font-family: $font-family-helvetica-neue, sans-serif;
                font-weight: normal;
                color: #444444;
                width: 368px;
                height: 48px;
            }

            select {
                border: solid 2px #f2f2f2;
                padding: 13px 11px;
                font-size: 20px;
                font-family: $font-family-helvetica-neue, sans-serif;
                font-weight: normal;
                color: #444444;
                width: 368px;
                height: 48px;
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
            object-fit: cover;
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

        .table {
            font-size: 20px;
        }

        .save-btn {
            size: 18px !important;
            color: #444444;
            width: 100px;
            height: 35px;
            background-color: #ffe100;
            border-radius: 3px;
            border: 1px solid #f2f2f2;
            font-weight: normal;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: center;
            align-items: center;
            align-self: center;
            margin-top: 10px;
            font-family: $font-family-helvetica-neue, sans-serif;
        }
    }
</style>
