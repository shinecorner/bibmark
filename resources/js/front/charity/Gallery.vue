<template>
    <modal name="gallery" :width="1468" :height="953">
        <p class="text-right close-modal">
            <a href="javascript:void(0)" v-on:click="hideModal">
                <i class="fas fa-times icon"></i>
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
        <div class="row justify-content-center slider-controls">
            <div class="col-md-3 text-right">
                <input type="range" class="slider" v-model="sliderVal" @change="applyZoom">
            </div>
        </div>
        <a href="javascript:void(0)" class="zoom-in"  @click="zoomIn">
            <i class="fa fa-plus-circle"></i>
        </a>
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
            sliderVal: 50,
            imageHeight: 600,
            imageWidth: 600,
            imagePaddingTop: 0,
            imagePaddingLeft: 400,
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
        zoomIn() {
            this.sliderVal = parseInt(this.sliderVal) + 1;

            if (this.sliderVal >= 100) {
                this.sliderVal = 100;
            }

            if (this.sliderVal <= 0) {
                this.sliderVal = 0;
            }

            this.applyZoom();
        },
        applyZoom() {            
            this.imageHeight = (this.sliderVal * 4) + 350;
            this.imageWidth = (this.sliderVal * 4) + 350;

            this.imagePaddingLeft = 540 - (this.sliderVal * 2.2);
            this.imagePaddingTop = 120 - (this.sliderVal * 2.4);

            if (this.imagePaddingTop <= 0) {
                this.imagePaddingTop = 0;
            }
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
        color: #D4D4D4;
        font-size: 100px;
        position: absolute;
        font-weight: 100;
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
        background: #fff;
        width: 32px;
        height: 32px;
        border: 1px solid #CCCCCC;
    }

    /* All the same stuff for Firefox */
    input[type=range]::-moz-range-thumb {
        background: #ffffff;
        width: 32px;
        height: 32px;
        border: 1px solid #CCCCCC;
    }

    /* All the same stuff for IE */
    input[type=range]::-ms-thumb {
        background: #ffffff;
        width: 32px;
        height: 32px;
        border: 1px solid #CCCCCC;
    }
    .range-controls {
        position: absolute;
        bottom: 20px;
        left: 42%;
        width: 321px;
    }

    .close-modal {
        font-size: 60px;
        color: #717171;
        padding-right: 21px;
        padding-top: 21px;
        font-weight: 100;
        a {
            color: #717171;
        }
    }
    .gallery-img {
        outline : none;
        img {
            outline : none;
        }
    }
    .slider {
        width: 321px;
        height: 5px;
    }
    .icon {
        color: #D4D4D4;
    }
    .slider-controls {
        position: absolute;
        bottom: 50px;
        left: 30%;
    }
    .zoom-in {
        position: absolute;
        bottom: 45px;
        left: 62%;
        color: #c2c2c2;
        i {
            width: 32px;
            height: 32px;
            border: 1px solid #CCCCCC;
            border-radius: 100%;
            font-size: 30px;
        }
    }
</style>