<template>
    <div id="footer-container">
        <footer class="page-footer">
            <div class="first-row padding-side row mx-0">
                <div class="footer-description text-sm-center text-md-center text-lg-left text-xl-left">
                    Get the latest on news, events and races from Bibmark.
                </div>
                <div class="input-email d-flex mx-0">
                    <input type="email" class="form-control ml-0" id="email" placeholder="E-mail">
                    <button class="search-btn">Search</button>
                </div>
            </div>

            <!-- yellow line-->
            <div class="yellow-line"></div>
            <!-- Footer Links -->
            <div class="second-row padding-side text-center text-md-left d-lg-flex mx-0">

                <div class="social-links">
                    <div class="">
                        <img src="/img/bibmark-footer-logo.svg">
                    </div>
                    <ul class="list-unstyled list-inline pt-3">
                        <li class="list-item pt-1">
                            <a href="javascript:void(0)">
                                <img src="/img/instagram-icon.svg">
                            </a>
                        </li>
                        <li class="list-item pt-1">
                            <a href="javascript:void(0)">
                                <img src="/img/fb-icon.svg">
                            </a>
                        </li>
                        <li class="list-item pt-1">
                            <a href="javascript:void(0)">
                                <img src="/img/twitter-icon.svg">
                            </a>
                        </li>
                        <li class="list-item pt-1">
                            <a href="javascript:void(0)">
                                <img src="/img/youtube-icon.svg">
                            </a>
                        </li>
                        <li class="list-item pt-1">
                            <a href="javascript:void(0)">
                                <img src="/img/snapchat-icon.svg">
                            </a>
                        </li>
                    </ul>
                </div>


                <span class="clearfix w-100 d-md-none"></span>

                <!--<div class="page-links row mx-0">-->
                <div class="common-cls">
                    <h5 class="pane-title mb-3 text-white">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Story
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Contact
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Press
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Blog
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Terms and Privacy
                            </a>
                        </li>
                    </ul>
                </div>

                <span class="clearfix w-100 d-md-none"></span>

                <div class="common-cls">
                    <h5 class="pane-title mb-3 text-white">Help</h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Sizing
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Group Orders
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Shipping & Delivery
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <span class="clearfix w-100 d-md-none"></span>

                <div class="common-cls  mx-0">
                    <h5 class="pane-title mb-3 text-white">Collaborate</h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Sponsors
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Partnerships
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Charity
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" class="grey">
                                Social Responsibility
                            </a>
                        </li>
                    </ul>
                </div>
                <!--</div>-->

            </div>
            <!-- Footer Links -->

            <!-- Copyright -->
            <div class="footer-copyright padding-side text-white">
                ©&nbsp;2019&nbsp;Bibmark,&nbsp;Inc.&nbsp;All&nbsp;Rights&nbsp;Reserved
            </div>
            <!-- Copyright -->

        </footer>
    </div>
</template>

<script>
    export default {
        name: "Footer"
    }
</script>

<style lang="scss" scoped>
    @font-face {
        font-family: "SFProDisplay";
        src: url("/fonts/SF-Pro-Display-Regular.otf") format('truetype');
    }

    @font-face {
        font-family: "SFProText";
        src: url("/fonts/SFProText-Regular.ttf") format('truetype');
    }

    #footer-container {
        padding-top: 67px;
        background: #ffffff;
        .page-footer {
            background-color: #000000;
            .first-row {
                .footer-description {
                    padding-top: 10px;
                    font-family: SFProDisplay;
                    font-size: 26px;
                    font-style: normal;
                    font-stretch: normal;
                    line-height: normal;
                    letter-spacing: normal;
                    color: #ffffff;
                }
                .input-email {
                    padding-top: 8px;
                    padding-bottom: 11px;
                    padding-right: 55px;
                    padding-left: 55px;
                    #email {
                        width: 420px;
                        height: 40px;
                        border-radius: 3px;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
                        border: solid 1px #d4d4d4;
                        background-color: #ffffff;
                    }
                    .search-btn {
                        width: 127px;
                        height: 40px;
                        border-radius: 5px;
                        background-color: #ffe100;
                        margin-left: 15px;
                        font-family: SFProText;
                        font-size: 17px;
                        font-weight: bold;
                        font-style: normal;
                        font-stretch: normal;
                        line-height: normal;
                        letter-spacing: normal;
                        color: #000000;
                        border: none;
                        cursor: pointer;
                    }
                }

            }

            .yellow-line {
                width: 100%;
                height: 3px;
                background-color: #fff300;
                z-index: 9;
            }

            .second-row {
                .social-links {
                    margin-top: 48px;
                    padding-right: 169px;
                    ul {
                        width: 155px;
                    }
                    .list-item {
                        padding-right: 3px;
                        display: inline-block;
                    }
                }

                .pane-title {
                    font-family: SFProText;
                    font-size: 14px;
                    font-weight: bold;
                    font-style: normal;
                    font-stretch: normal;
                    line-height: normal;
                    letter-spacing: normal;
                    color: #ffffff;
                }
                a.grey {
                    color: grey;
                }

                a:hover {
                    color: lightblue;
                }
            }

            .footer-copyright {
                padding-top: 31px;
                padding-bottom: 13px;
                font-family: SFProText, "San Francisco", sans-serif;
                font-size: 14px;
                font-weight: normal;
                font-style: normal;
                font-stretch: normal;
                line-height: normal;
                letter-spacing: normal;
                color: #ffffff;
            }
        }

    }

    .common-cls {
        margin-top: 54px;
        padding-right: 110px;
        min-height: 185px;
    }

    .padding-side {
        padding-left: 331px;
    }

    @media screen and (min-width: 320px) and (max-width: 550px) {
        .input-email {
            display: flex;
            justify-content: space-evenly;
            width: 220px;
            padding-right: 0px !important;
            padding-left: 0px !important;
            .search-btn {
                width: 70px !important;
                font-size: 14px !important;
            }
        }
    }

    @media screen and (max-width: 768px) {
        .input-email {
            padding: 8px 55px 11px 55px;
            #email {
                width: 420px;
                height: 40px;
            }
            .search-btn {
                width: 127px;
                height: 40px;
                font-size: 17px;
            }
        }
    }

    @media screen and (max-width: 768px) {

        .first-row {
            display: block;
        }
        .footer-description {
            font-size: 16px !important;
            padding-left: 20px;
        }
        .social-links ul {
            width: 100% !important;
        }
    }

    @media screen and (min-width: 768px) and (max-width: 1600px) {
        .second-row {
            display: flex;
            justify-content: space-evenly;
        }
        .footer-copyright {
            text-align: center;
        }
    }

    @media screen and (max-width: 1600px) {
        .first-row {
            display: flex;
            justify-content: center;
        }

        .footer-copyright {
            text-align: center;
        }
        .common-cls, .social-links {
            padding-right: 0px !important;

        }
        .padding-side {
            padding-left: 0px !important;;
        }
    }

    @media screen and (min-width: 1600px) {
        .footer-copyright {
            text-align: left;
        }
    }


</style>
