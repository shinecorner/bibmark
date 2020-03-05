@extends('front.layouts.app')

@section('head')
    <link rel="stylesheet" href="css/bootstrap-slider.min.css">
    <style>
        .viewport-panel{
            margin-left: 0px;
            margin-right: 0px;
            width: 1429px;
            height: 920px;
            position: relative;
            background-size: cover;
            overflow: hidden;
            z-index: 9;
        }

        .upload-complete {
            display: none;
        }

        .ct-uploaded {
            margin: auto;
            margin-top: 40px;
        }

        .viewport{
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
        }

        .viewport .drop-instructions{
            position: fixed;
            width: 50%;
            height: 50%;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            background: RGBA(47, 64, 80, 0.9);
            color: #FFFFFF;
        }

        .viewport .drop-instructions h3 {
            font-size: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            color: #FFFFFF;
            text-shadow: 0px 1px 3px rgba(255,255,255,0.2);
        }

        .viewport .drop-instructions .fa-arrow-circle-o-down {
            font-size: 100px;
        }


        #xpscreen {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.1);
            z-index: 99999;
        }

        .next-pattern {
            position: absolute;
            right: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -o-transform:  translateY(-50%);
            -ms-transform: translateY(-50%);
            transform:  translateY(-50%);
            cursor: pointer;
        }

        .next-pattern .fa, .prev-pattern .fa {
            font-size: 100px;
            color: rgba(255,255,255,0.4);
            cursor: pointer;
        }

        .prev-pattern {
            position: absolute;
            left: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -o-transform:  translateY(-50%);
            -ms-transform: translateY(-50%);
            transform:  translateY(-50%);
            cursor: pointer;
        }

        .current-model {
            position: absolute;
            width: 50px;
            height: 50px;
            border-radius: 25px;
            border: 3px solid #FFFFFF;
            right: 5px;
            bottom: 5px;
        }

        .current-model .current-model-icon {
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .model-chooser {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 99999;
        }

        .model-chooser-left {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            background: #283A49;
        }

        .model-list {
            list-style: none;
            width: 100%;
            padding: 20px;
            overflow: auto;
        }

        .model-list li {
            width: -moz-calc(20% - 40px) !important;
            /* WebKit */
            width: -webkit-calc(20% - 40px) !important;
            /* Opera */
            width: -o-calc(20% - 40px) !important;
            /* Standard */
            width: calc(20% - 40px) !important;
            float: left;
            position: relative;
            background: #283A49;
            border: 1px solid rgba(200,200,200,0.5);
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin:20px;
            cursor: pointer;
        }

        .model-list li img{
            width: 100%;
            height: auto;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .model-list li p {
            text-align: center;
            color: #FFFFFF;
            cursor: pointer;
        }



        #welcomeMessage .logo-font{
            color: #ED5565;
        }

        .sales-pattern-list {
            list-style: none;
            padding: 0px;
            margin: 0px;
        }

        .sales-pattern-list li {
            width: 33.3333333%;
            float: left;
            position: relative;
        }

        .sales-pattern-list li .circle-texture {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .ct-main, .ct-main * {
            cursor: pointer;
        }

        .rotation-slider-box .slider.control-in {
            bottom: 30px;
        }

        .rotation-slider-box .slider{
            width: 70% !important;
            left: 15% !important;
            bottom: 30px;
            position: absolute;
            z-index: 99999;
            height: 30px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background: rgba(18,63,98,0.1);
            box-shadow: 0px 0px 6px rgba(100,100,100,0.1) inset;
            transition: all 1s ease-in;
        }

        .rotation-slider-box .slider-track{
            background: rgba(0,0,0,0);
            box-shadow: none;
            width: calc(100% - 50px) !important;
            margin-left: 30px;

        }

        .rotation-slider-box .slider-selection {
            background: rgba(0,0,0,0);
            box-shadow: none;
        }

        .rotation-slider-box .slider-handle {
            width: 50px;
            height: 30px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-transform: translateX(-20px);
            -moz-transform: translateX(-20px);
            -o-transform: translateX(-20px);
            -ms-transform: translateX(-20px);
            transform: translateX(-20px);
            margin-top: -10px !important;
            box-shadow: 0px 0px 3px rgba(150,150,150,0.6) inset;
            background: rgba(230,230,230,1);

        }





        .tile-box {
            position: absolute;
            left: 5px;
            top: -70px;
            transition: top 0.5s ease-in,width 0.2s ease-in;
            overflow: hidden;
            width: 370px;
            height: 52px;
            z-index: 9999;
        }

        .tile-box.tile-slider-show {
            top: 5px !important;
        }


        .tile-circle {
            width: 50px;
            height: 50px;
            border-radius: 35px;
            background: #EFEFEF;
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 99999;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.4);
        }

        .tile-circle-outer {
            width: 50px;
            height: 50px;
            border-radius: 35px;
            border: 5px solid #ED5565;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4) inset;

        }

        .tile-qty {
            text-align: center;
            font-size: 26px;
            position: absolute;
            line-height: 1em;
            padding: 0px;
            margin: 0px;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            left: 50%;
            top: 50%;
        }

        .tile-slider-box {
            position: absolute;
            width: 300px;
            top: 9px;

            background: #EFEFEF;
            height: 30px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.4);
            left: 30px;
            transition: all 0.2s ease-in;
        }

        .texture-rotation-box {
            position: absolute;
            width: 300px;
            top: 15px;
            opacity: 0;
            background: #F8FAFB;
            height: 30px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.4);
            left: 30px;
            transition: all 0.5s ease-in;
            z-index: 999;
            overflow: hidden;
        }

        .texture-rotation-box.box-out {
            opacity: 1;
        }

        .texture-rotation-box.box-selected {
            top: 39px;
            height: 150px;
        }


        .advanced-controls {
            position: absolute;
            top: 9px;
            left: 16px;
            width: 30px;
            height: 80px;
            border-radius: 25px;
            background: #ED5565;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            cursor: pointer;
            transition: all 0.5s ease-in;
            z-index: 9995;
            /*
            position: absolute;
            top: 50%;
            left: -35px;
            width: 80px;
            height: 50px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            background: #ED5565;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            cursor: pointer;
            transition: all 0.2s ease-in;
            -webkit-transform:  translateY(-50%);
                -moz-transform: translateY(-50%);
                -o-transform:  translateY(-50%);
                -ms-transform: translateY(-50%);
                transform:  translateY(-50%);
            */
        }

        .advanced-controls:hover {
            top: 15px;
        }

        .advanced-controls.pull-out {
            top: -100px;
        }

        .advanced-controls.selected {
            height: 190px;
        }

        .advanced-controls .fa {
            color: #FFFFFF;
            position: absolute;
            right: 6px;
            bottom: 7px;
            font-size: 20px;
            cursor: pointer;
        }

        /*
        .tile-box:hover {
            width: 470px;
        }

        .tile-box:hover .tile-slider-box{
            left: 30px;
        }
        */




        .btn-upload {
            background: RGBA(237, 85, 101, 1);
            color: #FFFFFF;
            border: none;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            height: 30px;
            width: 30px;
            margin-left: 10px;
        }

        .btn-share {
            background: RGBA(237, 85, 101, 1);
            color: #FFFFFF;
            border: none;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            height: 30px;
            width: 30px;
        }

        .btn-export {
            background: RGBA(237, 85, 101, 1);
            color: #FFFFFF;
            border: none;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            height: 30px;
            width: 30px;
            margin-left: 10px;
        }

        .share-controls {
            position: absolute;
            width: 150px;
            height: 30px;
            top: 14px;
            left: 350px;
            z-index: 9999;
        }


        .tile-slider-box {
            position: relative;
        }

        .tile-slider-box .fa{
            position: absolute;
            right: 12px;
            top: 7px;
            font-size: 16px;
        }

        .tile-slider-box .slider{
            width: 210px;
            top: 4px;
            left: 40px;
        }

        .tile-slider-box .slider-selection {
            background: rgba(0,0,0,0);
            box-shadow: none;
        }

        .tile-slider-box .slider-handle {
            width: 10px;
            height: 20px;
            margin-left: -5px !important;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            background: rgba(230,230,230,1);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .tile-slider-box .slider-track{
            background: rgba(18,63,98,0.2);
            box-shadow: none;
        }


        .texture-rotation-slider-box .slider{
            width: 210px;
            top: 4px;
            left: 40px;
            position: relative;
        }

        .texture-rotation-slider-box .fa{
            position: absolute;
            right: 12px;
            top: 27px;
            font-size: 16px;
        }

        .texture-rotation-slider-box .slider-selection {
            background: rgba(0,0,0,0);
            box-shadow: none;
        }

        .texture-rotation-slider-box .slider-handle {
            width: 10px;
            height: 20px;
            margin-left: -5px !important;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            background: rgba(230,230,230,1);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .texture-rotation-slider-box .slider-track{
            background: rgba(18,63,98,0.2);
            box-shadow: none;
        }

        .texture-h-offset-slider-box {
            position: relative;
        }

        .texture-h-offset-slider-box .slider{
            width: 210px;
            top: 4px;
            left: 40px;
        }

        .texture-h-offset-slider-box .fa{
            position: absolute;
            right: 12px;
            top: 7px;
            font-size: 16px;
        }


        .texture-h-offset-slider-box .slider-selection {
            background: rgba(0,0,0,0);
            box-shadow: none;
        }

        .texture-h-offset-slider-box .slider-handle {
            width: 10px;
            height: 20px;
            margin-left: -5px !important;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            background: rgba(230,230,230,1);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .texture-h-offset-slider-box .slider-track{
            background: rgba(18,63,98,0.2);
            box-shadow: none;
        }

        .texture-v-offset-slider-box {
            position: relative;
        }

        .texture-v-offset-slider-box .slider{
            width: 210px;
            top: 4px;
            left: 40px;
        }

        .texture-v-offset-slider-box .fa{
            position: absolute;
            right: 12px;
            top: 17px;
            font-size: 16px;
        }

        .texture-v-offset-slider-box .slider-selection {
            background: rgba(0,0,0,0);
            box-shadow: none;
        }

        .texture-v-offset-slider-box .slider-handle {
            width: 10px;
            height: 20px;
            margin-left: -5px !important;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.4);
            background: rgba(230,230,230,1);
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .texture-v-offset-slider-box .slider-track{
            background: rgba(18,63,98,0.2);
            box-shadow: none;
        }



        .ct-selected {
            position: absolute;
            top: -200px;
            right: -200px;
            transition: all 1s ease-in;
            cursor: pointer;
        }

        .ct-selected * {
            cursor: pointer;
        }


        .ct-selected.ct-out {
            top: -30px;
            right: -30px;
        }

        .cw-rotate {
            position: absolute;
            bottom: 30px;
            right: 10%;
            z-index: 99999;
            color: #FFFFFF !important;
            background: #ED5565 !important;
        }

        .cw-rotate:hover,.cw-rotate:focus,.cw-rotate:active,.cw-rotate.active {
            background: #ED5565 !important;
        }

        .ccw-rotate:hover,.ccw-rotate:focus,.ccw-rotate:active,.ccw-rotate.active {
            background: #ED5565 !important;
        }

        .ccw-rotate {
            position: absolute;
            bottom: 30px;
            left: 10%;
            z-index: 99999;
            color: #FFFFFF !important;
            background: #ED5565 !important;
        }


        .tutorial-button {
            position: absolute;

            z-index: 99999;
            border: 5px solid #FFFFFF;
            border-radius: 38px;
            color: #FFFFFF;
            font-size: 25px;
            padding: 3px;
            line-height: 1em;
            width: 42px;
            height: 42px;
            background: transparent;
            -webkit-animation: pulse 1.5s infinite ease-in-out;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .tutorial-button i{
            -webkit-animation: pulse 1.5s infinite ease-in-out;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .tutorial-button:focus,.tutorial-button:active {
            outline: none;
        }

        .tutorial-1 .tutorial-button {
            bottom: 50px;
            left: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            margin-left: -25px;
        }

        .tutorial-content {
            position: absolute;
            background: #FFFFFF;
            padding: 20px;
            padding-top: 0px;
            border-radius: 3px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.4);
            width: 400px;
            z-index: 999999;
        }

        .tutorial-1 .tutorial-content {
            bottom: 150px;
            left: 50%;
            margin-left: -200px;
        }

        .tutorial-2 .tutorial-button {
            top: 10px;
            left: 430px;
        }

        .tutorial-2 .tutorial-content {
            top: 100px;
            left: 450px;
        }


        .tutorial-3 .tutorial-button {
            top: 80px;
            left: 40px;

        }

        .tutorial-3 .tutorial-content {
            top: 100px;
            left: 60px;
        }


        .tutorial-4 .tutorial-button {
            top: 50px;
            right: 50px;
        }

        .tutorial-4 .tutorial-content {
            top: 100px;
            right: 100px;
        }



        @-webkit-keyframes pulse {
            0% {
                opacity: 1
            }
            50% {
                opacity: 0.5
            }
        }


        @keyframes pulse {
            0% {
                opacity: 1
            }
            50% {
                opacity: 0.5
            }
        }

        .demo-uploader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 99999;
        }

        .demo-uploader-left {
            position: absolute;
            left: 0px;
            top: 0px;
            width: -moz-calc(100% - 150px) !important;
            /* WebKit */
            width: -webkit-calc(100% - 150px) !important;
            /* Opera */
            width: -o-calc(100% - 150px) !important;
            /* Standard */
            width: calc(100% - 150px) !important;
            height: 100%;
            background: #283A49;
        }

        .uploader-close {
            position: absolute;
            left: 10px;
            top: 10px;
            font-size: 20px;
            color: rgba(255,255,255,0.6);
        }

        .uploader-close:hover {
            color: #FFFFFF;
        }

        .demo-uploader-right {
            position: absolute;
            right: 0px;
            top: 0px;
            width: 150px;
            height: 100%;
            background: #293846;
            overflow: auto;
        }

        .demo-pattern-selector {
            list-style: none;
            padding: 0px;
            margin: 0px;
            width: 150px;
        }

        .demo-pattern-selector li {
            width: 150px;
            height: 150px;
            padding: 25px;
            cursor: pointer;
        }

        .demo-pattern-selector li * {
            cursor: pointer;
        }

        .demo-drop {
            position: absolute;
            height: 80%;
            width: 80%;
            background: #0b2238;
            top: 10%;
            left: 10%;
        }

        .demo-drop-instructions {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .demo-drop-progress {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .demo-drop-done {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
        }

        .demo-drop-done .pattern-change {
            margin: auto;
        }

        .demo-drop-progress .progress {
            width: 300px;
        }


        .demo-drop p.drag-title {
            display: none;
        }

        .demo-drop p.title {
            font-size: 26px;
            color: rgb(223, 228, 237);
        }

        .demo-drop p.title span{
            font-size: 16px;
            color: rgb(223, 228, 237)
        }

        .demo-drop p.caption {
            font-size: 12px;
            color: rgb(128, 149, 168);
        }

        .demo-uploader-right p{
            color: rgb(223, 228, 237);
        }

        #patternInformation .modal-header .circle-texture{
            position: absolute;
            top: -20px;
            left: -50px;
        }

        #patternInformation .modal-header h2 {
            margin-top: 0px;
        }

        .export-download {
            display: none;
        }

        .share-url {
            cursor: text !important;
        }


        @media (max-width: 992px) and (min-width: 768px){

            .viewport-panel{
                margin-left: 0px;
                margin-right: 0px;
                position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                background: url('../images/bg-sm.png') no-repeat;
                background-size: cover;
                overflow: hidden;
            }


            .rotation-slider-box .slider{
                width: 70% !important;

                left: 15% !important;

                bottom: -100px;
                position: absolute;
                z-index: 99999;
                height: 30px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                background: rgba(18,63,98,0.1);
                box-shadow: 0px 0px 6px rgba(100,100,100,0.1) inset;
                transition: all 1s ease-in;
            }
        }


        @media (max-width: 768px) {

            .viewport-panel{
                margin-left: 0px;
                margin-right: 0px;
                position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 100%;
                background: url('../images/bg-sm.png') no-repeat;
                background-size: cover;
                overflow: hidden;
            }

            .tutorial-1 .tutorial-button {
                bottom: 50px;
                left: 50%;
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -o-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                margin-left: -25px;
            }


            .tutorial-1 .tutorial-content {
                bottom: 150px;
                left: 50%;
                margin-left: -200px;
            }

            .tutorial-2 .tutorial-button {
                top: 10px;
                left: 430px;
                display: none;
            }

            .tutorial-2 .tutorial-content {
                top: 100px;
                left: 50%;
                margin-left: -200px;
            }


            .tutorial-3 .tutorial-button {
                top: 80px;
                left: 40px;
                display: none;

            }

            .tutorial-3 .tutorial-content {
                top: 100px;
                left: 50%;
                margin-left: -200px;
            }


            .tutorial-4 .tutorial-button {
                top: 50px;
                right: 50px;
            }

            .tutorial-4 .tutorial-content {
                top: 100px;
                left: 50%;
                margin-left: -200px;
            }

            .cw-rotate {
                position: absolute;
                bottom: 30px;
                right: 10px;
                z-index: 99999;
                color: #FFFFFF !important;
                background: #ED5565 !important;
            }

            .ccw-rotate {
                position: absolute;
                bottom: 30px;
                left: 10px;
                z-index: 99999;
                color: #FFFFFF !important;
                background: #ED5565 !important;
            }

            .rotation-slider-box .slider{
                width: 70% !important;

                left: 15% !important;

                bottom: -100px;
                position: absolute;
                z-index: 99999;
                height: 30px;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                background: rgba(18,63,98,0.1);
                box-shadow: 0px 0px 6px rgba(100,100,100,0.1) inset;
                transition: all 1s ease-in;
            }


            .demo-uploader-left {
                position: absolute;
                left: 0px;
                top: 0px;
                height: -moz-calc(100% - 150px) !important;
                /* WebKit */
                height: -webkit-calc(100% - 150px) !important;
                /* Opera */
                height: -o-calc(100% - 150px) !important;
                /* Standard */
                height: calc(100% - 150px) !important;
                width: 100% !important;
                background: #283A49;
            }

            .demo-uploader-right {
                position: absolute;
                left: 0px;
                bottom: 0px;
                top: auto;
                width: 100%;
                height: 150px;
                background: #293846;
            }

            .demo-pattern-selector {
                list-style: none;
                padding: 0px;
                margin: 0px;
                width: 100%;
                height: 150px;
            }


            .demo-pattern-selector li {
                width: 33%;
                height: 150px;
                padding: 10px;
                cursor: pointer;
                float: left;
            }

            .demo-drop p.title {
                font-size: 20px;
                color: rgb(223, 228, 237);
            }

            .demo-drop p.title span{
                font-size: 14px;
                color: rgb(223, 228, 237)
            }

            .demo-drop p.caption {
                font-size: 10px;
                color: rgb(128, 149, 168);
            }



        }

        #hidden-port {
            position: fixed;
            top: -5000px;
            left: 0px;
            background: #CACACA;
            width: 2048px;
            height: 768px;
        }

    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r69/three.min.js"></script>
    <script src="https://s3.amazonaws.com/com.wrapview/scripts/MTLLoader.js"></script>
    <script src="https://s3.amazonaws.com/com.wrapview/scripts/OBJMTLLoader.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/controls.js"></script>
    <script src="js/viewer.js?t=2"></script>
    <script src="js/studio.js"></script>

@endsection

@section('content')



    <div id="hidden-port">

    </div>

    <div id="" class='row viewport-panel'>
        <div id="viewport" class="viewport">

            <div class='rotation-slider-box'>
                <input class='rotation-slider slider control-out' data-slider-min="-3.14" data-slider-max="3.14" data-slider-step="0.1" data-slider-value="0" data-slider-tooltip="hide" />
            </div>

            <button class='btn btn-circle btn-outline btn-danger cw-rotate animated hidden'  data-placement="top" data-toggle="popover" title="Visualize in 3D" data-content="Rotate the model to see it from all directions."><i class='fa fa-arrow-right'></i></button>
            <button class='btn btn-circle btn-outline btn-danger ccw-rotate animated hidden' data-placement="top" data-toggle="popover" title="Visualize in 3D" data-content="Rotate the model to see it from all directions."><i class='fa fa-arrow-left'></i></button>


        </div>
    </div>

    <div class="imager"></div>
@endsection
