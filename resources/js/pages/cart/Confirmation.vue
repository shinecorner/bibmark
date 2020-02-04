<template>
    <div class="cart">
        <div class="text-center mt-3"><h4>Your order is being processed ...</h4></div>
        <div class="d-flex justify-content-center">
            <div class="svg-box text-center">
                <svg class="circular green-stroke">
                    <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                </svg>
                <svg class="checkmark green-stroke">
                    <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)">
                        <path class="checkmark__check" fill="none" d="M616.306,283.025L634.087,300.805L673.361,261.53"/>
                    </g>
                </svg>
            </div>
        </div>
        <!-- <div class="d-flex justify-content-center">
            <h3>Payment for this order failed</h3>
            <div class="svg-box">
                <svg class="circular red-stroke">
                    <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                </svg>
                <svg class="cross red-stroke">
                    <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-502.652,-204.518)">
                        <path class="first-line" d="M634.087,300.805L673.361,261.53" fill="none"/>
                    </g>
                    <g transform="matrix(-1.28587e-16,-0.79961,0.79961,-1.28587e-16,-204.752,543.031)">
                        <path class="second-line" d="M634.087,300.805L673.361,261.53"/>
                    </g>
                </svg>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
    name: 'confirmation',
    data() {
        return {
            //shipping: JSON.parse(localStorage.getItem('shipping')),
            //card: {}
            shipping: this.$store.state.shipping
        }
    },
    methods: {
        name() {
            
        }
    },
    computed: {
        card() {
            return this.$store.state.card
        }
    },
}
</script>
<style scoped>
.shipping{
    font-family: sf-pro-text;
    font-size: 18px;
    font-weight: normal;
    font-style: normal;
    font-stretch: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #000000;
    margin-bottom: 7px;
    margin-top: 7px;
    color:#22AE73
}
.svg-box {
    display:inline-block;
    position: relative;
    width:150px;
}

.green-stroke {
    stroke:#7CB342;
}

.red-stroke {
    stroke: #FF6245;
}

.yellow-stroke {
    stroke: #FFC107;
}


.circular circle.path {
    stroke-dasharray: 330;
    stroke-dashoffset: 0;
    stroke-linecap: round;
    opacity: 0.4;
    animation: 0.7s draw-circle ease-out;
}

/*------- Checkmark ---------*/
.checkmark{
	stroke-width: 6.25;
    stroke-linecap: round;
	position:absolute;
    top: 56px;
    left: 49px;
    width: 52px;
    height: 40px;
}

.checkmark path {
    animation: 1s draw-check ease-out;
}

@keyframes draw-circle {
    0% {
        stroke-dasharray: 0,330;
        stroke-dashoffset: 0;
        opacity: 1;
    }

    80% {
        stroke-dasharray: 330,330;
        stroke-dashoffset: 0;
        opacity: 1;
    }

    100%{
        opacity: 0.4;
    }
}

@keyframes draw-check {
    0% {
        stroke-dasharray: 49,80;
        stroke-dashoffset: 48;
        opacity: 0;
    }

    50% {
        stroke-dasharray: 49,80;
        stroke-dashoffset: 48;
        opacity: 1;
    }

    100% {
        stroke-dasharray: 130,80;
        stroke-dashoffset: 48;
    }
}

/*---------- Cross ----------*/

.cross {
    stroke-width:6.25;
    stroke-linecap: round;
    position: absolute;
    top: 54px;
    left: 54px;
    width: 40px;
    height: 40px;
}

.cross .first-line {
    animation: 0.7s draw-first-line ease-out;
}

.cross .second-line {
    animation: 0.7s draw-second-line ease-out;
}

@keyframes draw-first-line {
    0% {
        stroke-dasharray: 0,56;
        stroke-dashoffset: 0;
    }

    50% {
        stroke-dasharray: 0,56;
        stroke-dashoffset: 0;
    }

    100% {
        stroke-dasharray: 56,330;
        stroke-dashoffset: 0;
    }
}

@keyframes draw-second-line {
    0% {
        stroke-dasharray: 0,55;
        stroke-dashoffset: 1;
    }

    50% {
        stroke-dasharray: 0,55;
        stroke-dashoffset: 1;
    }

    100% {
        stroke-dasharray: 55,0;
        stroke-dashoffset: 70;
    }
}

.alert-sign {
    stroke-width:6.25;
    stroke-linecap: round;
    position: absolute;
    top: 40px;
    left: 68px;
    width: 15px;
    height: 70px;
    animation: 0.5s alert-sign-bounce cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.alert-sign .dot {
    stroke:none;
    fill: #FFC107;
}

@keyframes alert-sign-bounce {
    0% {
        transform: scale(0);
        opacity: 0;
    }

    50% {
        transform: scale(0);
        opacity: 1;
    }

    100% {
        transform: scale(1);
    }
}
</style>



