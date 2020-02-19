<template>
    <modal name="gallery" :width="1200" :height="600">
        <p class="text-right close-modal">
            <a href="javascript:void(0)" v-on:click="hideModal">
                <i class="fa fa-times"></i>
            </a>
        </p>
        <slick
            ref="slick"
            :options="slickOptions">
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
            <a class="gallery-img" href="javascript:void(0)" :style="{ paddingTop: imagePaddingTop + 'px', paddingLeft: imagePaddingLeft + 'px' }">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" :style="{ height: imageHeight + 'px', width: imageWidth + 'px' }" alt="">
            </a>
        </slick>
        <div class="btn carousel-buttons prev-slide" @click="prev()">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="btn carousel-buttons next-slide" @click="next()">
            <i class="fa fa-angle-right"></i>
        </div>
        <div class="text-center range-controls">
            <input type="range" class="custom-range" v-model="sliderVal" @change="applyZoom" style="width: 200px; color: white;"> <i class="fa fa-plus-circle pl-2"></i>
        </div>
    </modal>
</template>

<script>
import Slick from 'vue-slick';

export default {
    components: { Slick },
    data() {
        return {
            slickOptions: {
                slidesToShow: 1,
                prevArrow: false,
                nextArrow: false,
            },
            sliderVal: "",
            imageHeight: 250,
            imageWidth: 250,
            imagePaddingTop: 100,
            imagePaddingLeft: 470,
        };
    },
    props: ['bus'],
    methods: {
        showModal () {
          this.$modal.show('gallery');
        },
        hideModal () {
          this.$modal.hide('gallery');
        },
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },

        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },
        applyZoom() {
            this.imageHeight = (2 * this.sliderVal) + 250;
            this.imageWidth = (2 * this.sliderVal) + 250;

            this.imagePaddingTop = 150 - (this.sliderVal);
            this.imagePaddingLeft = 460 - (this.sliderVal);
        },
    },
    mounted() {
        this.$root.$on('showGalleryModalEvent', () => {
            this.showModal()
        })
    }
}
</script>

<style  lang="scss" scoped>
    .carousel-buttons {
        top: 35%;
        z-index: 9;
        width: 134px;
        height: 149px;
        color: #717171;
        font-size: 42px;
        position: absolute;
        font-weight: lighter;
        text-align: center;
    }

    .carousel-buttons + .prev-slide {
        left: 0px;
    }

    .carousel-buttons + .next-slide {
        right: 0px;
    }
    /* Special styling for WebKit/Blink */
    input[type=range]::-webkit-slider-thumb {
        background: #ffffff;
        border: 1px solid #CCCCCC;
    }

    /* All the same stuff for Firefox */
    input[type=range]::-moz-range-thumb {
        background: #ffffff;
        border: 1px solid #CCCCCC;
    }

    /* All the same stuff for IE */
    input[type=range]::-ms-thumb {
        background: #ffffff;
        border: 1px solid #CCCCCC;
    }
    .range-controls {
        position: absolute;
        bottom: 20px;
        left: 42%;
    }

    .close-modal {
        font-size: 30px;
        color: #717171;
        padding-right: 20px;
        padding-top: 10px;

        a {
            color: #717171;
        }
    }
    .fa-plus-circle {
        color: #D1D1D3;
        font-size: 14px;
    }
    .gallery-img {
        outline : none;
        img {
            outline : none;
        }
    }
</style>