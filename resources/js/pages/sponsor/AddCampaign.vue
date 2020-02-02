<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <form id="validation-form">
                <div class="row add-campaign-row input-form ">
                    <div class="col-12">
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2"><span class="campaign">Campaigns</span></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2"><span class="caption">Create New Campaign</span></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="campaignName">Campaign Name</label></div>
                            <div class="right-side2">
                                <input id="campaignName" name="campaignName" type="text" v-model="campaign.name">
                                <div class="w-50"></div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="logo">Logo</label></div>
                            <div class="right-side2">
                                <img id="logo" alt="logo" class="logo" :src="logoUrl">
                                <input ref="logo" id="imageProfile" v-on:change="selectLogo" type="file"/>
                                <label class="input-label" for="imageProfile">Choose File</label>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="budget">Budget</label></div>
                            <div class="right-side2"><input id="budget" type="text"/></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label>Logo Size & Price</label></div>
                            <div class="right-side2">
                                <div class="col-7 pl-0 pr-0">
                                    <table class="table table-striped table-bordered">
                                        <thead class="rectangle-header">
                                        <tr>
                                            <th width="180px">Size</th>
                                            <th width="180px">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="table-row" v-for="(size, index) in sizes">
                                            <td>{{size.size}}</td>
                                            <td>{{size.price}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-5 col-7 pl-0 pr-0">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th>&nbsp</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="table-row" v-for="(size, index) in sizes">
                                            <td style="float:left">
                                                <div class="col custom-control custom-checkbox mid-checkbox"
                                                     style="display: inline-block; width:30px">
                                                    <input type="checkbox" class="custom-control-input" :id="index">
                                                    <label class="custom-control-label" :for="index"></label>
                                                </div>
                                                <input type="range" min="1" max="100" value="50" class="slider"
                                                       style="width:150px; position: relative; top:-5px"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="hashtags">Hashtags</label></div>
                            <div class="right-side2">
                                <div class="row w-100">
                                    <div class="col"><input id="hashtags" type="text"/></div>
                                    <div class="w-100"></div>
                                    <div class="col mt-1">
                                        <button type="button" class="btn btn-info btn-circle yellow"><i
                                            class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="hashtags">Geo Target</label></div>
                            <div class="right-side2">
                                <div class="row w-100">
                                    <div class="col custom-control custom-checkbox mid-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="1">
                                        <label class="custom-control-label" for="1">National Campaign</label>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col custom-control custom-checkbox mid-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="2">
                                        <label class="custom-control-label" for="2">Boston</label>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col mt-1">
                                        <button type="button" class="btn btn-info btn-circle yellow"
                                                @click="$modal.show('add-geo-target-modal')">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <span class="button-caption"> Add New Target Audience</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label>Filter Questions</label></div>
                            <div class="right-side2">
                                <div class="row w-100">
                                    <div class="col">Are there any companies you do not <br>want to be on the same shirt
                                        with you?
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col"><input type="text" placeholder="Search"/></div>
                                    <div class="w-100"></div>
                                    <div class="col">
                                        <div class="row ml-0 mt-2 mb-2 px-2 py-2 company-select-container">
                                            <div class="mx-1 mb-2 company-selected-list row">
                                                <div class="col-2 mx-2 my-2" v-for="n in 3">
                                                    <img width="45px" src="/img/companies/cocacola.png"/>
                                                    <button type="button" class="btn btn-info btn-circle small red"><i
                                                        class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-2 mb-2" v-for="n in 20">
                                                <img width="80px" src="/img/companies/cocacola.png"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col">Are there any specific age ranges that <br>you would like to execute?
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col">
                                        <select class="form-control form-control-lg">
                                            <option>Test 1</option>
                                            <option>Test 2</option>
                                            <option>Test 3</option>
                                        </select>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col">Are there any organizations you do not<br> wish to sponsor?</div>
                                    <div class="w-100"></div>
                                    <div class="col"><input type="text" placeholder="Search"/></div>
                                    <div class="w-100"></div>
                                    <div class="col mt-2">
                                        <select class="form-control form-control-lg">
                                            <option>Test 1</option>
                                            <option>Test 2</option>
                                            <option>Test 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label>Status</label></div>
                            <div class="right-side2">
                                <div class="row w-100">
                                    <div class="col">
                                        <label class="switch">
                                            <input type="checkbox" class="default"/>
                                            <span class="toggle-slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2">
                                <button class="save-btn btn-primary" type="button" @click.stop="save">Save</button>
                                <button class="save-btn ml-4" type="button">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Modal -->
            <modal
                name="add-geo-target-modal"
                transition="nice-modal-fade"
                width="620"
                height="450"
                :delay="100"
                scrollable
                classes="v--modal radius-modal"
            >
                <span class="close-button topright" @click="$modal.hide('add-geo-target-modal')">&times;</span>

                <div class="add-target-modal">
                    <div class="row w-90 my-5" style="margin-left: 50px; margin-right: 50px">
                        <div class="col mb-2 text-center" >
                            <span class="title">Target Audience</span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mb-0">
                            <input id="target-name" type="text" value="Newyork" style="width: 96%; margin-left: 10px; margin-right: 10px"/>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mb-2">
                            <table class="table table-borderless mb-0">
                                <thead class="rectangle-header">
                                <tr>
                                    <th width="50%">Zip Code</th>
                                    <th width="50%">Radius</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="table-row" v-for="n in 2">
                                    <td class="px-0 py-0"><input type="text" placeholder="Zip Code"/></td>
                                    <td class="px-0 py-0">
                                        <select class="form-control form-control-lg">
                                        <option>10  Miles</option>
                                        <option>20  Miles</option>
                                        <option>30  Miles</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info btn-circle yellow ml-2">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button class="save-btn btn-primary mr-2" >Save</button>
                        </div>

                    </div>
                </div>
            </modal>
            <!--end modal-->
        </template>
    </sponsor-common>
</template>

<script src="./AddCampaign.js"></script>

<style lang="scss" scoped>
    .table {
        padding-left: 154px !important;
    }

    .caption {
        font-weight: bold;
        font-size: 17px;
    }

    .campaign {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #ffc600;
    }

    .total {
        font-size: 19px;
    }

    .table-row {
        text-align: center;
        vertical-align: middle;
    }

    .rectangle-header {
        background-color: #ffc600;
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

    .company-select-container {
        border: solid 2px rgba(212, 212, 212, 0.89);
        border-radius: 5px;
        max-height: 180px;
        overflow: auto;
    }

    .company-selected-list {
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.07);
        width: 100%;
        height: 80px;
    }

    .add-target-modal {
        .title {
            font-family: HelveticaNeue, sans-serif;
            font-size: 34px;
            font-weight: 500;
            color: #444444;
            margin-bottom: 0;
        }

        .table{
            padding-left: 0px !important;
            border-collapse: separate;
            border-spacing: 10px 10px;
        }

        input[type="text"], select {
            border: solid 2px rgba(212, 212, 212, 0.89);
            padding: 13px 11px;
            font-size: 20px;
            font-family: HelveticaNeue, sans-serif;
            font-weight: normal;
            color: #444444;
            width: 100%;
            height: 48px;
        }

        .save-btn {
            size: 28px;
            color: #444444;
            width: 100px;
            height: 33px;
            background-color: white;
            border-radius: 3px;
            border: 1px solid black;
            font-weight: bold;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: center;
            align-items: center;
            align-self: center;
            margin-top: 30px;
            float: right;
        }
    }

    .close-button {
        border: none;
        display: inline-block;
        padding: 8px 16px;
        vertical-align: middle;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        background-color: inherit;
        text-align: center;
        cursor: pointer;
        white-space: nowrap;
        font-size:40px;
        font-weight: 100;
    }

    .topright {
        position: absolute;
        right: -5px;
        top: -15px;
    }

    .is-invalid {
        border-color: #d9534f !important;
    }

    form {
        display: flex;
        flex-direction: column;
    }
</style>
