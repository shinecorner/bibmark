<template>
    <charity-common :activeLink="navLink">
        <template v-slot:charity-content>
            <div class="caption pb-4">
                <span class="donation">Order Gallery</span>
            </div>
            <!-- I think we should pass images to gallery component and selected image -->
            <!--
                <gallery images="images"></gallery>
             -->
            <gallery></gallery>

            <div class="gallery pb-5">
                <div class="row">
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:void(0)" v-on:click="showModal()">
                            <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </charity-common>
</template>

<script src="./CharityOrderList.js"></script>

<style lang="scss" scoped>
    .table {
        padding-left: 154px !important;
    }

    .caption {
        padding-left: 0px;
    }

    .caption span {
        margin-bottom: 18px;
        display: block;
    }

    .donation {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #FFC73A;
    }

    .total {
        font-size: 19px;
    }

    .table-row {
        text-align: center;
        vertical-align: middle;
    }

    .rectangle-header {
        font-family: HelveticaNeue;
        font-size: 22px;
        font-weight: 500;
        font-stretch: normal;
        font-style: normal;
        line-height: normal;
        letter-spacing: normal;
        text-align: center;
        color: #444444;
    }

    .gallery {
        margin-left: -50px;
    }
</style>
