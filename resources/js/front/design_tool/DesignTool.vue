<template>
    <div>
        <div id="hidden-port">

        </div>

        <div id="" class='row viewport-panel'>
            <div id="viewport" class="viewport">

            </div>
        </div>

        <div id="" class='row viewport-overlay'>
            <div class="col-3 full-height">
                <ul class="layerList">
                    <li class="layerListItem" v-bind:class="{'selected':layerIndex === selectedLayerIndex}" v-for="(layer, layerIndex) in layers">

                        <div v-if="layer.type === 'image'">
                            <div class="image-icon" @click="selectLayer(layerIndex)">
                                <img v-bind:src="layer.path" alt="">
                            </div>
                            <div v-if="layerIndex === selectedLayerIndex">
                                <div class="rotate-layer">
                                    <input type="range" min="-3.14" max="3.14" step="0.1" value="0" class="rotate-layer-slider" v-bind:id="'rotate-layer-slider-'+layerIndex" v-model="layer.angle">
                                </div>

                                <div class="scale-layer">
                                    <input type="range" v-bind:min="layer.min.width" v-bind:max="layer.max.width" step="1" class="scale-layer-slider" v-bind:id="'scale-layer-slider-'+layerIndex" :value="layer.width" @change="updateLayerScale">
                                </div>
                                <div class="clearfix">
                                <div class="color-swatch-dropdown dropdown">
                                    <button class="color-swatch dropdown-toggle" v-bind:style="{ background: layer.color !== ''?layer.color.hex:'transparent' }" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img v-show="layer.color === ''" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                    </button>
                                    <div class="dropdown-menu color-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <form onsubmit="return false;">
                                            <color-picker :value="layer.color" @input="updateLayerColor" />
                                            <button @click="layer.color = ''" class="btn btn-block btn-primary">Remove Color</button>
                                        </form>
                                    </div>
                                </div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-6 viewport-controller" @mousedown="mouseDown" @mouseup="mouseUp" @mousemove="mouseMove" >
                <div class="rotate-object">
                    <input type="range" min="-3.14" max="3.14" step="0.1" value="0" class="rotate-slider" id="rotate-slider" v-model="rotation">
                </div>
            </div>
            <div class="col-3 full-height">
                <h1>Let's Design</h1>
                <div id="leftControl">
                    <div class="card">
                        <div class="card-header" id="baseTemplate">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#baseTemplateCollapse" aria-expanded="true" aria-controls="baseTemplateCollapse">
                                    Base Template
                                </button>
                            </h5>
                        </div>

                        <div id="baseTemplateCollapse" class="collapse show" aria-labelledby="baseTemplate" data-parent="#leftControl">
                            <div class="card-body">
                                <ul class="control-list">
                                    <li>
                                        <div class="dropdown">
                                            <label>Template: </label>
                                            <button class="control-dropdown-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Custom
                                            </button>
                                            <div class="dropdown-menu control-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <ul class="component-list clearfix">
                                                    <li>
                                                        A
                                                    </li>
                                                    <li>
                                                        A
                                                    </li>
                                                    <li>
                                                        A
                                                    </li>
                                                    <li>
                                                        A
                                                    </li>
                                                    <li>
                                                        A
                                                    </li>
                                                    <li>
                                                        A
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Cover All Image: </label>
                                        <div class="image-swatch" v-bind:style="{background: cover_image !== null?('url('+cover_image+') no-repeat center center'):'transparent'}">
                                            <img v-show="cover_image === null" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                        </div>
                                    </li>
                                    <li>
                                        <label>Front Panel Color: </label>
                                        <div class="image-swatch">

                                        </div>
                                        <div class="color-swatch-dropdown dropdown">
                                            <button class="color-swatch dropdown-toggle" v-bind:style="{ background: front_color !== ''?front_color.hex:'transparent' }" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img v-show="front_color === ''" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                            </button>
                                            <div class="dropdown-menu color-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form onsubmit="return false;">
                                                    <color-picker v-model="front_color" />
                                                    <button @click="removeColor('front_color')" class="btn btn-block btn-primary">Remove Color</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Back Panel Color: </label>
                                        <div class="image-swatch">

                                        </div>
                                        <div class="color-swatch-dropdown dropdown">
                                            <button class="color-swatch dropdown-toggle" v-bind:style="{ background: back_color !== ''?back_color.hex:'transparent' }" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img v-show="back_color === ''" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                            </button>
                                            <div class="dropdown-menu color-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form onsubmit="return false;">
                                                    <color-picker v-model="back_color" />
                                                    <button @click="removeColor('back_color')" class="btn btn-block btn-primary">Remove Color</button>

                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Left Sleeve Color: </label>
                                        <div class="image-swatch">

                                        </div>
                                        <div class="color-swatch-dropdown dropdown">
                                            <button class="color-swatch dropdown-toggle" v-bind:style="{ background: left_sleeve_color !== ''?left_sleeve_color.hex:'transparent' }" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img v-show="left_sleeve_color === ''" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                            </button>
                                            <div class="dropdown-menu color-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form onsubmit="return false;">
                                                    <color-picker v-model="left_sleeve_color" />
                                                    <button @click="removeColor('left_sleeve_color')" class="btn btn-block btn-primary">Remove Color</button>

                                                </form>

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Right Sleeve Color: </label>
                                        <div class="image-swatch">

                                        </div>
                                        <div class="color-swatch-dropdown dropdown">
                                            <button class="color-swatch dropdown-toggle" v-bind:style="{ background: right_sleeve_color !== ''?right_sleeve_color.hex:'transparent' }" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img v-show="right_sleeve_color === ''" src="https://combibmark.s3.amazonaws.com/assets/art/transparent-bg.png" />
                                            </button>
                                            <div class="dropdown-menu color-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form onsubmit="return false;">
                                                    <color-picker v-model="right_sleeve_color" />
                                                    <button @click="removeColor('right_sleeve_color')" class="btn btn-block btn-primary">Remove Color</button>

                                                </form>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Art
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#leftControl">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="featured-tab" data-toggle="tab" href="#featured" role="tab" aria-controls="featured" aria-selected="true">Featured</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="clipart-tab" data-toggle="tab" href="#clipart" role="tab" aria-controls="clipart" aria-selected="false">Clipart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="upload-art-tab" data-toggle="tab" href="#upload-art" role="tab" aria-controls="upload-art" aria-selected="false">Upload</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                                        <ul class="component-list clearfix">
                                            <li v-for="artwork in art.featured">
                                                <div class="dropup">
                                                    <button type="button" class="component-button dropdown-toggle" data-boundary="viewport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img class="component-icon" v-bind:src="artwork.path" alt="">
                                                    </button>
                                                    <div class="component-dropdown-mennu dropdown-menu">
                                                        <ul class="action-list clearfix">
                                                            <li @click="insertLayer(artwork,component.key)" v-for="(component,componentIndex) in components">
                                                                {{component.name}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>


                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="clipart" role="tabpanel" aria-labelledby="clipart-tab">
                                        <ul class="component-list">
                                            <li>B</li>
                                            <li>B</li>
                                            <li>B</li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="upload-art" role="tabpanel" aria-labelledby="upload-art-tab">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Text
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#leftControl">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>


    </div>
</template>

<script src="./design_tool.js"></script>
<style scoped>
    @import "design_tool.scss"
</style>
