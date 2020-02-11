<template>
    <div id="sidebar-wrapper">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="avatar">
                <div class="avatar-upload">
                    <img :src="sponsor.logo"
                         class="img-responsive center profile_icon"
                         width="150"
                         alt="">
                </div>
            </div>
            <div class="profile-content">
                <span class="sponsor-name">{{sponsor.name}}</span>
                <p class="sponsor-description" >{{sponsor.bio}}</p>
                <span class="sponsor-link">{{sponsor.website}}</span>
                <div class="sponsor-social-icons">
                    <a v-if="sponsor.instagram" :href="sponsor.instagram"><i class="fab fa-instagram"></i></a>
                    <a v-if="sponsor.facebook" :href="sponsor.facebook"><i class="fab fa-facebook-square"></i></a>
                    <a v-if="sponsor.twitter" :href="sponsor.fa-twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <!-- END MENU -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "SideBar",
        props: {
            sponsor: {
            }
        },
        data() {
            return {};
        },
        mounted() {
        },
    }
</script>


<style lang="scss" scoped>
    @import '~@/_variables.scss';


    #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
        border-right: solid 2px #cccccc;
    }

    #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
    }

    #sidebar-wrapper .list-group {
        width: 15rem;
    }

    #page-content-wrapper {
        min-width: 100vw;
    }

    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
    }

    .profile-sidebar {
        padding-left: 50px;
        padding-right: 25px;
    }

    .profile-usermenu ul {
        margin-bottom: 33px;
    }

    .nav-link {
        padding: 0px;
    }

    .active {
        border-bottom: solid 2px #ffc600 !important;
        padding-bottom: 9px;
        margin-bottom: 3px !important;
        width: fit-content;
    }

    /* Profile Content */
    .profile-content {
        margin-top: 20px;
        background: #fff;
        min-height: 460px;
        width: 180px;
    }

    .content {
        margin-bottom: 58px;
        font-family: $font-family-sf-pro-text;
        font-size: 18px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }

    #wrapper {
        padding-top: 58px;
    }

    @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
    }

    @media (max-width: 768px) {
        .profile-content {
            padding: 0px 20px !important;
            text-align: center;
        }
        #wrapper {
            display: block !important;
        }
        #sidebar-wrapper {
            border: none;
            margin: 0px;
            min-height: unset;
        }
        .dashboard-link {
            margin-bottom: 100px !important;
            text-align: center;
            margin-left: 0px;
            margin-right: 0px;
        }

        .profile-usermenu ul li {
            display: flex;
            justify-content: center;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {

        }
        .profile-sidebar {
            padding: 0px !important;
        }
    }

    @media (max-width: 900px) {
        .profile-content {
            padding: 0px 20px;
        }
    }

    .avatar {
        display: flex;
        justify-content: center;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;

        .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;

            input {
                display: none;

                + label {
                    font-family: 'FontAwesome';
                    color: #757575;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 34px;
                    height: 34px;
                    margin-bottom: 0;
                    border-radius: 100%;
                    background: #FFFFFF;
                    border: 1px solid transparent;
                    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                    cursor: pointer;
                    font-weight: normal;
                    transition: all .2s ease-in-out;

                    &:hover {
                        background: #f1f1f1;
                        border-color: #d6d6d6;
                    }
                }
            }
        }

        .avatar-preview {
            width: 150px;
            height: 150px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

            > div {
                width: 100%;
                height: 100%;
                border-radius: 100%;
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
            }
        }
    }

    .sponsor-name {
        font-family: $font-family-helvetica-neue;
        font-size: 20px;
        font-weight: bold;
    }

    .sponsor-description {
        font-family: $font-family-helvetica-neue;
        font-size: 13px;
        font-weight: normal;
        margin-top: 5px;
    }

    .sponsor-link {
        font-family: $font-family-helvetica-neue;
        font-size: 13px;
        font-weight: 300;
        margin-top: 20px;
    }

    .sponsor-social-icons i {
        margin-right: 5px;
    }
</style>
