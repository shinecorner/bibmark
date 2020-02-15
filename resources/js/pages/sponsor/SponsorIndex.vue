<template>
    <sponsor-common :sponsor="sponsor" type="full">
        <template v-slot:setting-content>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 sidebar">
                        <div class="text-center">
                            <img class="rounded-circle img-fluid" :src="sponsor.logo" width="200" alt="">
                            <h4 class="pt-3">{{ sponsor.name }}</h4>
                            <p class="text-left">
                                {{ sponsor.bio }}
                            </p>
                            <p class="text-left">
                                <a class="text-dark" href="">{{ sponsor.website }}</a>
                                <br>
                                <a class="text-dark" v-if="sponsor.instagram" :href="sponsor.instagram"><i class="fab fa-instagram"></i></a>
                                <a class="text-dark" v-if="sponsor.facebook" :href="sponsor.facebook"><i class="fab fa-facebook-square"></i></a>
                                <a class="text-dark" v-if="sponsor.twitter" :href="sponsor.fa-twitter"><i class="fab fa-twitter"></i></a>
                            </p>
                            <p class="text-left">
                                <button class="btn btn-sm edit-profile-btn">Edit profile</button>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-5 mt-10">
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="spinner" v-if="loadingTweets">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <!-- tweet list -->
                                <ol class="tweet-list">
                                    <li class="tweet-card mb-3" v-bind:key="tweet.id" v-for="tweet in tweets">
                                        <div class="tweet-content">
                                            <div class="tweet-header">
                                                <span class="fullname">
                                                    <strong>{{ tweet.username }}</strong>
                                                </span>
                                                <span class="username">@{{ tweet.screen_name }}</span>
                                                <span class="tweet-time">- {{ tweet.date | twitterDateFormat }}</span>
                                            </div>
                                            <a>
                                                <img class="tweet-card-avatar" :src="tweet.profile_image_url" alt="">
                                            </a>
                                            <div class="tweet-text">
                                                <p data-aria-label-part="0">
                                                    {{ tweet.description }}
                                                </p>
                                            </div>
                                            <div class="tweet-footer">
                                                <a class="tweet-footer-btn">
                                                    <i class="fas fa-comment-alt"></i><span> 0</span>
                                                </a>
                                                <a class="tweet-footer-btn">
                                                    <i class="fas fa-retweet"></i><span> {{ tweet.retweet_count }}</span>
                                                </a>
                                                <a class="tweet-footer-btn">
                                                    <i class="far fa-heart"></i><span> {{ tweet.favorite_count }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <!-- End: tweet list -->
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="spinner" v-if="loadingInstagramPosts">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2 instagram-posts">
                            <div class="col-md-6 pb-4" :key = "instagramPost.id" v-for="instagramPost in instagramPosts">
                                <img class="img-fluid instagram-img" :src="instagramPost.display_url" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col">
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
        </template>
    </sponsor-common>
</template>

<script src="./SponsorIndex.js"></script>

<style lang="scss" scoped>
    @import '~@/_variables.scss';

    .tweet-list {
        list-style: none;
        margin: 8px 4px 0;
        padding: 0;
    }
    .tweet-card {
        background-color: #fff;
        border-bottom: 1px solid #e6ecf0;
        min-height: 52px;
        padding: 9px 12px;
    }

    .tweet-content {
        margin-left: 58px;
        font-size: 14px;
        line-height: 20px;
        font-weight: normal;
    }

    .tweet-card-avatar {
        border-radius: 50%;
        height: 48px;
        width: 48px;
        float: left;
        margin-top: 3px;
        margin-left: -58px;
    }

    .tweet-footer-btn {
        margin-right: 30px;
    }

    .tweet-footer-btn i, .tweet-footer-btn span {
        color: #657786;
        font-size: 16px;
    }

    .tweet-footer-btn span {
        margin-left: 8px;
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
    .spinner {
        width: 70px;
        text-align: center;
    }
    .spinner > div {
        width: 18px;
        height: 18px;
        background-color: #333;
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }
    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }
    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }
    @-webkit-keyframes sk-bouncedelay {
        0%, 80%, 100% { -webkit-transform: scale(0) }
        40% { -webkit-transform: scale(1.0) }
    }
    @keyframes sk-bouncedelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
        }
    }
    .sidebar {
        border-right: solid 2px #cccccc;
    }
    .text-dark {
        color: #444444;
    }
    .edit-profile-btn {
        border: 1px solid #444444;
    }

    .mt-10 {
        margin-top: -10px
    }

    .tweet-card {
        background: #F5F8FA;
        border: 1px solid #F5F8FA;
        border-radius: 1px;
    }

    .instagram-posts {
        padding-left: 5px;
        padding-right: 5px;
    }

    .instagram-img {
        object-fit: cover;
        width:230px;
        height:230px;
    }

</style>


