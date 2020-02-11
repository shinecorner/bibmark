<template>
    <sponsor-common :sponsor="sponsor" type="full">
        <template v-slot:setting-content>
            <div class="container-fluid1" style="background: #ffffff">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <SideBar :sponsor="sponsor"></SideBar>
                    <!-- /#sidebar-wrapper -->

                    <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row mb-2">
                                            <div class="event-container col-12">
                                                <div class="box image">
                                                    <div class="box-header">
                                                        <h3>
                                                            <a href=""><img :src="sponsor.logo" alt="">
                                                                {{sponsor.name}}
                                                            </a>
                                                            <span class="summary">add an <a>event</a></span>
                                                            <span>March 21,18:45pm <i
                                                                class="fas fa-globe-americas"></i></span>
                                                        </h3>
                                                    </div>
                                                    <div class="box-content">
                                                        <div class="bottom">
                                                            <p>
                                                                orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                                            </p>
                                                            <span><span class="fa fa-search-plus"></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="box-buttons">
                                                        <div class="row">
                                                            <button class="btn"><i class="far fa-comment-alt"></i> <span>123</span></button>
                                                            <button class="btn"><i class="fas fa-retweet"></i> <span>123</span></button>
                                                            <button class="btn"><i class="far fa-heart"></i> <span>123</span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 pl-0 pr-1">
                                                <img src="/img/demo2.png" width="100%"/>
                                            </div>
                                            <div class="col-6 pr-0 pl-1">
                                                <img src="/img/demo2.png" width="100%"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="event-container">
                                            <div class="box image">
                                                <div class="box-header">
                                                    <h3>
                                                        <a href=""><img :src="sponsor.logo" alt="">
                                                            {{sponsor.name}}
                                                        </a>
                                                        <span class="summary">add an <a>event</a></span>
                                                        <span>March 21,18:45pm <i
                                                            class="fas fa-globe-americas"></i></span>
                                                    </h3>
                                                </div>
                                                <div class="box-content">
                                                    <div class="content">
                                                        <img src="/img/demo-image.png" alt="" width="100%">
                                                    </div>
                                                    <div class="bottom">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /#page-content-wrapper -->
                </div>
                <!-- /#wrapper -->
            </div>
        </template>
    </sponsor-common>
</template>

<script src="./SponsorIndex.js"></script>

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
        width: 100%;
    }

    /* Profile Content */
    .profile-content {
        background: #fff;
        min-height: 460px;
    }

    .event-container {
        margin: 0 auto;
        overflow: hidden;
        padding: 0;
        position: relative;
        border: 1px solid lightgrey;
        font-family: $font-family-helvetica-neue;
        font-size: 13px;
    }

    .event-container > h2 {
        color: #9298A4;
        font-weight: 400;
        letter-spacing: -1px;
        margin: 140px auto 80px;
        text-align: center;
    }

    .event-container > h2:first-child {
        margin: 40px auto 80px;
    }

    .event-container > .box {
        background: #FFF;
        border-radius: 4px;
        height: auto;
        overflow: hidden;
        position: relative;
    }

    .event-container > .box > [class*="box-"] {
        margin: 0 auto;
        padding: 0 30px;
        position: relative;
    }

    .event-container > .box > [class*="box-"] img {
        display: block;
        width: 100%;
    }

    .event-container > .box > .box-header {
        margin: 0 auto;
        padding: 0 10px 0px;
        width: initial;
        height: 60px;
    }

    .event-container > .box > .box-header > h3 {
        font-size: 15px;
        font-weight: 700;
        height: 60px;
        margin: 5px auto;
        overflow: hidden;
        padding: 5px 0 0;
        position: relative;
    }

    .event-container > .box > .box-header > h3 > a {
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    .event-container > .box > .box-header > h3 > .summary {
        display: inline-block;
    }

    .event-container > .box > .box-header > h3 > span {
        color: #9197A3;
        display: block;
        font-size: 13px;
        font-weight: 400;
        margin-top: 2px;
    }

    .event-container > .box > .box-header > h3 > span .fa {
        font-size: 15px;
        margin-left: 5px;
    }

    .event-container > .box > .box-header > span {
        background: #F4F4F4;
        border-radius: 3px;
        color: #BCBFC6;
        cursor: pointer;
        font-size: 24px;
        height: 18px;
        line-height: 18px;
        margin: 5px auto 0;
        padding: 3px 4px;
        position: absolute;
        right: 40px;
        top: 0;
    }

    .event-container > .box > .box-header > span:hover {
        color: #888;
    }

    .event-container > .box > .box-header > span > i {
        height: 18px;
        line-height: 18px;
    }

    .event-container > .box > .box-header img {
        border-radius: 100px;
        float: left;
        height: 50px;
        width: 50px;
        margin: -5px 10px 0 0;
        object-fit: cover;
    }

    .event-container > .box > .box-content {
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: initial;
    }

    .event-container > .box > .box-content > .content {
        height: auto;
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: initial;
    }

    .event-container > .box > .box-content > .bottom {
        margin: 0 auto;
        padding: 0 10px 0 50px;
        position: relative;
        width: initial;
    }

    .event-container > .box > .box-content > .bottom > p {
        line-height: 20px;
        margin: 0;
        padding: 0px 10px 0 20px
    }

    .event-container > .box > .box-content > .bottom > span {
        background: linear-gradient(to top, rgba(0, 0, 0, .45), rgba(0, 0, 0, 0));
        height: 160px;
        left: 0;
        line-height: 160px;
        margin: 0 auto;
        overflow: hidden;
        padding: 0;
        position: absolute;
        text-align: right;
        top: -160px;
        vertical-align: bottom;
        width: 100%;
    }

    .event-container > .box > .box-content > .bottom > span > span {
        background: rgba(0, 0, 0, .35);
        border-radius: 4px;
        bottom: 0;
        color: #FFF;
        cursor: pointer;
        font-size: 20px;
        margin: 0 30px 25px auto;
        opacity: .75;
        overflow: hidden;
        padding: 10px;
        position: absolute;
        right: 0;
        top: auto;
        -webkit-transition: all .25s ease-in-out;
        -moz-transition: all .25s ease-in-out;
        transition: all .25s ease-in-out;
    }

    .event-container > .box > .box-content > .bottom > span > span:hover {
        opacity: 1;
    }

    .event-container > .box > .box-likes {
        margin: 0 auto;
        overflow: hidden;
        padding: 0 30px;
        position: relative;
    }

    .event-container > .box > .box-likes > .row {
        border-top: 1px solid #F4F4F4;
        padding: 20px 0;
    }

    .event-container > .box > .box-likes > .row > span {
        display: inline-block;
        font-size: 13px;
        margin: 0 2px 0 0;
        position: relative;
        vertical-align: middle;
    }

    .event-container > .box > .box-likes > .row:first-child {
        float: left;
        width: 60%;
    }

    .event-container > .box > .box-likes > .row:last-child {
        float: left;
        text-align: end;
        width: 40%;
    }

    .event-container > .box > .box-likes > .row:first-child > span:nth-child(4) {
        background: #4D679F;
        border-radius: 50px;
        font-weight: bold;
        padding: 0 8px 0 6px;
    }

    .event-container > .box > .box-likes > .row:first-child > span:nth-child(4) > a {
        color: #FFF;
    }

    .event-container > .box > .box-likes > .row:first-child > span,
    .event-container > .box > .box-likes > .row:last-child > span {
        color: #9197A3;
    }

    .event-container > .box > .box-likes > .row:last-child > span {
        display: inline-block;
        verrtical-align: middle;
    }

    .event-container > .box > .box-likes > .row img {
        border-radius: 100px;
        height: 28px;
        object-fit: cover;
        width: 28px;
    }

    .event-container > .box > .box-buttons {
        overflow: hidden;
        padding: 0;
        position: relative;
        width: 35%;
        margin-left: 70px;
        margin-top: 10px;
    }

    .event-container > .box > .box-buttons *, *::before, *::after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .event-container > .box > .box-buttons > .row {
        border-bottom: 1px solid #F4F4F4;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    .event-container > .box > .box-buttons > .row > button:last-child {
        border: 0;
    }

    .event-container > .box > .box-buttons > .row > button {
        background: #FFF;
        border: 0;
        color: #9197A3;
        font-size: 13px;
        float: left;
        height: 60px;
        line-height: 60px;
        margin: 0;
        *outline: 1px #08F;
        padding: 0;
        width: 33.33333333333%;
    }

    .btn:focus,
    .btn:active:focus,
    .btn.active:focus,
    .btn.focus,
    .btn:active.focus,
    .btn.active.focus {
        background: #FFF;
        border: 0;
        color: #9197A3;
    }
    .btn:hover,
    .btn:focus,
    .btn.focus {
        background: #FFF;
        border: 0;
        color: #9197A3;
    }
    .btn:active,
    .btn.active {
        background: #FFF;
        border: 0;
    }

    .event-container > .box > .box-buttons > .row > button > span {
        margin-left: 10px;
    }

    .event-container > .box > .box-buttons > .row > button:hover {
        background: #F5F5F5;
        color: #7D8696;
    }

    .event-container > .box > .box-buttons > .row > button:focus {
        background: #F0F2F2;
        color: #6C7588;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, .2);
        outline-color: #08F;
    }

    .event-container > .box > .box-click {
        color: #4D679F;
        font-size: 13px;
        margin: 0 auto;
        overflow: hidden;
        padding: 10px 30px;
        position: relative;
    }

    .event-container > .box > .box-click > span {
        cursor: pointer;
    }

    .event-container > .box > .box-click > span i {
        font-size: 18px;
        margin-right: 5px;
    }

    .event-container > .box > .box-comments {
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
    }

    .event-container > .box > .box-comments > .comment {
        border-top: 1px solid #F4F4F4;
        margin: 0;
        overflow: hidden;
        padding: 16px 30px;
        position: relative;
    }

    .event-container > .box > .box-comments > .comment > img {
        border-radius: 100px;
        float: left;
        height: 56px;
        margin: 0;
        object-fit: cover;
        width: 56px;
    }

    .event-container > .box > .box-comments > .comment > .content {
        height: auto;
        line-height: 20px;
        margin: 0 0 0 70px;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: initial;
    }

    .event-container > .box > .box-comments > .comment > .content > h3 {
        float: left;
        font-size: 14px;
        font-weight: 600;
        margin: 4px auto 0;
        text-transform: capitalize;
        width: 150px;
    }

    .event-container > .box > .box-comments > .comment > .content > h3 > span {
        color: #9197A3;
        display: block;
        font-size: 12px;
        font-weight: 400;
        text-transform: none;
    }

    .event-container > .box > .box-comments > .comment > .content > p {
        color: #4B4D53;
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    .event-container > .box > .box-new-comment {
        background: #9298A4;
        margin: 0;
        overflow: hidden;
        padding: 20px 30px;
        position: relative;
    }

    .event-container > .box > .box-new-comment > img {
        border-radius: 100px;
        float: left;
        height: 40px;
        margin: 0;
        object-fit: cover;
        width: 40px;
    }

    .event-container > .box > .box-new-comment > .content {
        border-radius: 20px;
        margin: 4px 0 0 52px;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: initial;
        -webkit-transition: all .25s ease-in-out;
        -moz-transition: all .25s ease-in-out;
        transition: all .25s ease-in-out;
    }

    .event-container > .box > .box-new-comment > .content > .row {
        background: transparent;
        display: inline-block;
        height: 32px;
        overflow: hidden;
        position: relative;
        vertical-align: middle;
        width: 100%;
        -webkit-transition: all .25s ease-in-out;
        -moz-transition: all .25s ease-in-out;
        transition: all .25s ease-in-out;
    }

    .event-container > .box > .box-new-comment > .content > .row:last-child {
        color: #C6C9D0;
        font-size: 22px;
        height: 28px;
        line-height: 27px;
        margin: 2px 0;
        position: absolute;
        text-align: center;
        top: 0;
        right: 10px;
        width: 40px;
    }

    .event-container > .box > .box-new-comment > .content > .row:last-child > span {
        cursor: pointer;
    }

    .event-container > .box > .box-new-comment > .content > .row > textarea {
        border: 1px solid transparent;
        border-radius: 20px;
        color: #555;
        outline: 0;
        padding: 0 40px 0 10px;
        resize: none;
        width: calc(100% - 52px) !important;
        -webkit-transition: all .25s ease-in-out;
        -moz-transition: all .25s ease-in-out;
        transition: all .25s ease-in-out;
    }

    .event-container > .box.update,
    .event-container > .box.text {
        border: 1px solid #E0E1E4;
        box-shadow: none;
        padding: 20px 0 0;
    }

    .event-container > .box.update > .box-header,
    .event-container > .box.text > .box-header {
        padding: 0 30px;
    }

    .event-container > .box.update > .box-header > span,
    .event-container > .box.text > .box-header > span {
        background: transparent;
        color: #9298A4;
        font-size: 32px;
        margin: -10px auto 0;
    }

    .event-container > .box.update > .box-content > .content > p,
    .event-container > .box.text > .box-content > .content > p {
        border-top: 1px solid #F4F4F4;
        color: #4D5057;
        font-size: 14px;
        line-height: 22px;
        padding: 26px 30px;
    }

    .event-container > .box.update > .box-content > .content > .img {
        margin: 0;
        overflow: hidden;
        padding: 0;
        position: relative;
        width: initial;
    }

    .event-container > .box.update > .box-content > .content > .img:before {
        border: 1px solid rgba(0, 0, 0, .25);
        bottom: 0;
        content: "";
        height: 100%;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
    }

    .event-container > .box.text > .box-buttons > .row > button {
        font-size: 13px;
    }

    .event-container > .box.text > .box-buttons > .row > button > span {
        font-size: 20px;
    }

    .event-container > .box.image > .box-new-comment > .content,
    .event-container > .box.image > .box-new-comment > .content > .row > textarea,
    .event-container > .box.video > .box-new-comment > .content,
    .event-container > .box.video > .box-new-comment > .content > .row > textarea {
        background: #9298A4;
        -webkit-transition: all .25s ease-in-out;
        -moz-transition: all .25s ease-in-out;
        transition: all .25s ease-in-out;
    }

    .event-container > .box > .box-new-comment > .content > .row > textarea:focus,
    .event-container > .box.image > .box-new-comment > .content:active > .row {
        background: #FFF;
    }

    .event-container > .box > .box-new-comment > .content > .row > textarea:focus,
    .event-container > .box.video .box-new-comment > .content:active > .row {
        background: #FFF;
    }
</style>



