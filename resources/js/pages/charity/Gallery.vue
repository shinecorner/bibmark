<template>
    <modal name="hello-world" :width="600" :height="400">
        <slick
            ref="slick"
            :options="slickOptions">
            <a href="javascript:void(0)" style="padding-top: 90px; padding-left: 160px">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" style="width: 250px; height: 250px" alt="">
            </a>
            <a href="javascript:void(0)" style="padding-top: 90px; padding-left: 160px">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" style="width: 250px; height: 250px" alt="">
            </a>
            <a href="javascript:void(0)" style="padding-top: 90px; padding-left: 160px">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" style="width: 250px; height: 250px" alt="">
            </a>
            <a href="javascript:void(0)" style="padding-top: 90px; padding-left: 160px">
                <img src="https://cdn.zeplin.io/5c6d748d4074579a2d70d638/assets/3D89C00B-0323-46A1-A829-6B4C03D0AC8C.png" style="width: 250px; height: 250px" alt="">
            </a>
        </slick>
        <div class="btn carousel-buttons prev-slide" @click="prev()">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="btn carousel-buttons next-slide" @click="next()">
            <i class="fa fa-angle-right"></i>
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
                nextArrow: false
            },
        };
    },
    methods: {
        show () {
          this.$modal.show('hello-world');
        },
        hide () {
          this.$modal.hide('hello-world');
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

        // Events listeners
        handleAfterChange(event, slick, currentSlide) {
            console.log('handleAfterChange', event, slick, currentSlide);
        },
        handleBeforeChange(event, slick, currentSlide, nextSlide) {
            console.log('handleBeforeChange', event, slick, currentSlide, nextSlide);
        },
        handleBreakpoint(event, slick, breakpoint) {
            console.log('handleBreakpoint', event, slick, breakpoint);
        },
        handleDestroy(event, slick) {
            console.log('handleDestroy', event, slick);
        },
        handleEdge(event, slick, direction) {
            console.log('handleEdge', event, slick, direction);
        },
        handleInit(event, slick) {
            console.log('handleInit', event, slick);
        },
        handleReInit(event, slick) {
            console.log('handleReInit', event, slick);
        },
        handleSetPosition(event, slick) {
            console.log('handleSetPosition', event, slick);
        },
        handleSwipe(event, slick, direction) {
            console.log('handleSwipe', event, slick, direction);
        },
        handleLazyLoaded(event, slick, image, imageSource) {
            console.log('handleLazyLoaded', event, slick, image, imageSource);
        },
        handleLazeLoadError(event, slick, image, imageSource) {
            console.log('handleLazeLoadError', event, slick, image, imageSource);
        },
    },
    mounted() {
        this.show();
    },
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
</style>