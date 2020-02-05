<template>
    <div class="container-fluid1" style="background: #ffffff">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <SideBar></SideBar>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid1">
                    <div class="profile-content">
                        <h2 class="welcome text-left">My Designs</h2>
                        <h5 class="content text-left">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure tempora
                            numquam eum quod quia.</h5>
                        <hr class="content-divider">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="design in designs" :key="design.id">
                                <div class="row col-lg">
                                    <div class="col-lg-1">
                                        <a class="thumbnail pull-left" href="#">
                                            <img :src="design.image" class="img-fluid thumbnail" style="margin-bottom:8px;"/>
                                        </a>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="title pull-left">{{ design.name }}</div>
                                        <div class="sub-title pull-left">{{ design.exported_file }}</div>
                                    </div>
                                    <div class="col-lg-3">
                                        <a class="join-cta-element d-flex send pull-right" href="/design">
                                            <img src="/img/auth/next.png" class="img-fluid" style="width: 60px; height: 60px;"/>
                                            <div class="join-cta-labels d-flex flex-column ml-3">
                                                <div class="join-cta-label-desc">Finish Design </div>
                                                <div class="join-cta-label">Continue</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
    </div>
</template>

<script>
    import SideBar from "./SideBar";
    export default {
        components: {SideBar},
        data() {
            return {
                designs: {}
            }
        },
        mounted () {
            this.getDesign();
        },
        methods: {
            getDesign() {
                axios.get('/profile/my-design').then(response => {
                    if (response.data) {
                        console.log(response.data)
                        this.designs = response.data;
                    }
                }).catch(error => {
                    console.log('Error', error);
                });
            },
        //     uploadImage: function(type, file, id, callback) {
        //     if () {
        //         let formData = new FormData();
        //         formData.append('image', file);
        //         formData.append('type', type);
        //         axios.post('/internal/image/upload', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data'
        //             }
        //         }).then((response) => {
        //             console.log(response.data.url);
        //             callback(true, response.data.url);
        //         }).catch((error) => {
        //             callback(false, null);
        //         });
        //     }
        // },
        },
    }

</script>

<style lang="scss" scoped>
    @import '~@/_variables.scss';
    @font-face {
        font-family: "HelveticaNeue";
        src: url("/fonts/HelveticaNeueCyr-Bold.eot");
        src: url("/fonts/HelveticaNeueCyr-Bold.woff") format("woff");
    }

    @font-face {
        font-family: "SFUIDisplay-Regular";
        src: url("/fonts/SFUIDisplay-Regular.ttf") format('truetype');
    }

    @font-face {
        font-family: "SFProText";
        src: url("/fonts/SFUIText-Bold.ttf") format('truetype');
    }

    @font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SourceSansPro-Bold.ttf") format('truetype');
    }

    @font-face {
        font-family: "SourceSansPro-Regular";
        src: url("/fonts/SourceSansPro-Regular.ttf") format('truetype');
    }

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
        padding-left: 119px;
        padding-right: 69px;
    }

    .profile-usertitle-name {
        font-size: 16px;
        font-weight: 500;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: 2px;
        text-align: center;
        color: #000000;
        margin-top: 44px;
        margin-bottom: 58px;
        /*border-bottom: solid 1px #cccccc;*/
        height: 19px;
        opacity: 0.9;
        font-family: $font-family-sf-pro-display;
    }

    .profile-usermenu ul li a {
        font-family: $font-family-helvetica-neue;
        font-size: 18px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #444444;
        margin: 14px 15px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #fafcfd;
        color: #ffc600;
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
        padding-right: 80px;
        padding-left: 70px;
        background: #fff;
        min-height: 460px;
    }

    .welcome {
        font-family: $font-family-sf-pro-display;
        font-size: 42px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #444444;
        margin-bottom: 16px;
    }

    .dashboard-link {
        margin-top: 34px;
        margin-left: 130px;
        margin-bottom: 275px;
        height: 22px;
        font-family: $font-family-helvetica-neue;
        font-size: 18px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #4a90e2;
    }

    hr.sidebar-divider {
        width: 100%;
        border-color: #cccccc;
        border-width: 2px;
        /*margin-top: 2rem;*/
        /*margin-bottom: 1rem;*/
        /*border-top: 1px solid #cccccc;*/
        /*border-bottom: 1px solid #cccccc;*/
    }

    hr.content-divider {
        border-top: 1px solid #cccccc;
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
    .title{
        width: 200px;
        height: 21px;
        font-family: $font-family-sf-pro-text;
        font-size: 18px;
        font-weight: bold;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }
    .sub-title{
        width: 200px;
        height: 21px;
        font-family: $font-family-sf-pro-text;
        font-size: 18px;
        font-weight: normal;
        font-style: normal;
        font-stretch: normal;
        line-height: normal;
        letter-spacing: normal;
        color: #000000;
    }
    .col-lg, .col-lg-1, .col-lg-3, .list-group-item{
        margin-left: 0;
        margin-right: 0;
        padding-left: 0;
        padding-right: 0;
    }
    .list-group-item {
        position: relative;
        display: block;
        padding: 0;
        margin-bottom: -1px;
        background-color: transparent;
        border-left: 0;
        border-right: 0;
        border-bottom: 1px solid #cccccc;
        border-top: 1px solid #cccccc;
    }
    .list-group-item:first-child{
        border-top:0;
    }
    .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .join-cta-label{
    width: 95px;
    height: 29px;
    font-family: $font-family-sf-pro-display;
    font-size: 24px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.join-cta-label-desc{
    width: 93px;
    height: 19px;
    opacity: 0.6;
    font-family: $font-family-sf-pro-display;
    font-size: 16px;
    font-weight: 500;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
}
.list-group-item:not(:first-child) {
    padding-top:14px;
}
</style>
