<template>
    <charity-common :charity="charity" type="full">
        <template v-slot:charity-content>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 sidebar">
                        <div class="text-center">
                            <img class="rounded-circle img-fluid" :src="charity.logo" width="200" alt="">
                            <h4 class="pt-3">{{ charity.name }}</h4>
                            <p class="text-left">
                                {{ charity.bio }}
                            </p>
                            <p class="text-left">                                
                                <a class="text-dark" href="">{{ charity.website }}</a>
                                <br>
                                <a class="text-dark" v-if="charity.instagram" :href="charity.instagram"><i class="fab fa-instagram"></i></a>
                                <a class="text-dark" v-if="charity.facebook" :href="charity.facebook"><i class="fab fa-facebook-square"></i></a>
                                <a class="text-dark" v-if="charity.twitter" :href="charity.twitter"><i class="fab fa-twitter"></i></a>
                            </p>
                            <!-- <p class="text-left">
                                <button class="btn btn-sm edit-profile-btn">Edit profile</button>
                            </p> -->
                        </div>
                    </div>
                    <div class="col-md-5 mt-10">                        
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="spinner" v-if="loadingInstagrams">
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
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <div class="spinner" v-if="loadingTweets">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row event-container" v-bind:key="tweet.id" v-for="tweet in tweets">
                            <div class="row header">
                                <div class="col-md-2">
                                    <div class="header-logo">                                        
                                        <a href=""><img :src="tweet.profile_image_url" alt=""></a>                                        
                                    </div>
                                </div>
                                <div class="col-md-10 header-detail">
                                    <h3>
                                        <a class="charity-name" href="">
                                            {{ tweet.username }}                                            
                                        </a>
                                        <div class="charity-meta">
                                            <span> @{{ tweet.screen_name }}</span>
                                            <span class="separator"><i class="fa fa-circle"></i></span>
                                            <span>{{ tweet.date | twitterDateFormat }}</span>
                                        </div>
                                        <div class="summary">{{ tweet.description }}</div>
                                    </h3>
                                </div>
                            </div>
                            <div class ="row content">
                                <div class="col-md-2"></div>
                                <div class="col-md-10 header-detail">
                                    <img :src="tweet.profile_banner_url" width="400" alt="">
                                </div>
                            </div>
                            <!-- <div class="tweet-footer">
                                <a class="tweet-footer-btn">
                                    <i class="fas fa-comment-alt"></i><span> 0</span>
                                </a>
                                <a class="tweet-footer-btn">
                                    <i class="fas fa-retweet"></i><span> {{ tweet.retweet_count }}</span>
                                </a>
                                <a class="tweet-footer-btn">
                                    <i class="far fa-heart"></i><span> {{ tweet.favorite_count }}</span>
                                </a>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-10 content">
                                    <img src="/img/demo-image.png" alt="" width="100%">
                                </div>
                            </div> -->
                        </div>    
                    </div>
                </div>
            </div>
        </template>
    </charity-common>
</template>

<script src="./CharityIndex.js"></script>

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
        margin-bottom: 15px;
        overflow: hidden;
        padding: 0;
        position: relative;        
        // font-family: $font-family-helvetica-neue;
        font-size: 13px;
        background-color: #192734;        
        border-radius: 15px;
    }
    
    .event-container .header{
        font-size: 15px;
        font-weight: 700;
        // height: 60px;
        margin: 5px auto;
        overflow: hidden;
        padding: 5px 0 0;
        position: relative;
    }
    .event-container .header .header-logo img{
        border-radius: 100px;
        float: left;
        height: 50px;
        width: 50px;
        margin: -2px 10px 0 0;
        -o-object-fit: cover;
        object-fit: cover;
    }
    .event-container .header .header-detail{
        
    }
    .event-container .header .header-detail h3{
        color: #fff;        
        font-size: 15px;
    }
    .event-container .header .header-detail h3 a.charity-name{
        color: #fff;
        font-weight: 700;
        font-size: 17px;
    }
    .event-container .header .header-detail h3 .charity-meta{
        display: inline-block;
        color: #7e8e9c;      
        font-size: 17px;
        font-weight: 400;        
    }
    .event-container .header .header-detail h3 .separator{
        font-size: 4px;
        position: relative;
        top: -2px;
        margin: 0 3px;       
    }    
    .event-container .header .header-detail h3 .summary{
        margin: 5px 0 5px 0;
        line-height: 1.1rem;
    }
    .event-container .content img{
        // border-radius: 100px;        
        vertical-align: middle;
        border-style: none;
        border-radius: 15px;
        width: 95%;
        margin: 0 10px 10px 10px;
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


