<template>
    <charity-common :charity="charity" :activeLink="navLink">
        <template v-slot:charity-content>
            <form id="validation-form">
                <div class="row add-campaign-row input-form ">
                    <div class="col-12">
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2"><span class="campaign text-yellow">Campaigns</span></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2"><span class="caption">Create New Campaign</span></div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="name">Campaign Name</label></div>
                            <div class="right-side2">
                                <div class="w-100 add-input-group">
                                    <input id="name" name="name" type="text" v-model="campaign.name" class="w-80">
                                </div>
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
                            <div class="right-side2">
                                <div class="w-100 add-input-group">
                                    <input id="budget" name="budget" v-model="campaign.budget" type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label for="budget">Logo Width</label></div>
                            <div class="right-side2">
                                <div class="w-100 add-input-group">                                    
                                    <logo-width :value="campaign.logo_width" v-model="campaign.logo_width"></logo-width>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"><label>Hashtags</label></div>
                            <div class="right-side2">
                                <div class="row w-100">
                                    <div class="col">                                        
                                        <hash-tag :value="campaign.hashtags" v-model="campaign.hashtags"></hash-tag>
                                    </div>
                                    <div class="w-100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">                            
                            <div class="left-side2"><label>Geo Target</label></div>
                            <div class="right-side2">                                
                                <div class="row w-100">
                                    <template
                                        v-if="mainGeoTargets.length > 0"
                                        v-for="(target, index) in mainGeoTargets">
                                        <div class="col custom-control custom-checkbox mid-checkbox">
                                            <input type="checkbox" class="custom-control-input" :id="`target-${index}`"
                                                   v-model="target.status">
                                            <label
                                                v-on:mouseover="displayButton(index)"
                                                v-on:mouseleave="hideButton()"
                                                class="custom-control-label"
                                                :for="`target-${index}`"

                                            >
                                                {{target.name}}
                                                <button v-if="displayGeoEditIndex===index"
                                                        type="button"
                                                        class="ml-2 btn btn-info btn-circle black"
                                                        @click.prevent="editGeoTarget(target, index)"
                                                ><i
                                                    class="fa fa-pen"></i></button>
                                            </label>
                                        </div>
                                        <div class="w-100"></div>
                                    </template>
                                    <div class="w-100"></div>
                                    <div class="row w-100">
                                        <span class="jquery-validation-error small form-text invalid-feedback">{{addGeoTargetError}}}</span>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col mt-1">
                                        <button type="button" class="btn btn-info btn-circle bg-yellow"
                                                @click="showAddGeoTargetModal">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <span class="button-caption" @click="showAddGeoTargetModal" style="cursor: pointer"> Add New Target Audience</span>
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
                                            <input type="checkbox" class="default" v-model="campaign.status"/>
                                            <span class="toggle-slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-wrap">
                            <div class="left-side2"></div>
                            <div class="right-side2">
                                <button class="save-btn bg-yellow" type="button" @click.stop="save" style="font-size:18px">Save</button>
                                <button class="save-btn ml-2 bg-white" type="button" style="font-size:18px" @click="cancel()">Cancel</button>
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
                height="auto"
                :delay="100"
                classes="v--modal radius-modal"
            >
                <span class="close-button topright" @click="$modal.hide('add-geo-target-modal')">&times;</span>

                <div class="add-target-modal">
                    <form id="add-target-validation-form">
                        <div class="row w-90 my-5"
                             style="margin-left: 50px; margin-right: 50px; max-height: 500px; overflow:auto">
                            <div class="col mb-2 text-center">
                                <span class="title">Target Audience</span>
                            </div>
                            <div class="w-100"></div>
                            <div class="col mb-0">
                                <input id="targetname" name="targetname" type="text" v-model="tempGeoTarget.name"
                                       style="width: 96%; margin-left: 10px; margin-right: 10px"/>
                            </div>
                            <div class="w-100"></div>
                            <div class="col mb-2">
                                <table class="table table-borderless mb-0">
                                    <thead class="rectangle-header bg-yellow">
                                    <tr>
                                        <th width="50%">Zip Code</th>
                                        <th width="50%">Radius</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="table-row" v-for="zipcode in tempGeoTarget.zipcodes">
                                        <td class="px-0 py-0">
                                            <input type="text" name="zipcode" placeholder="Zip Code"
                                                   v-model="zipcode.zipcode"/></td>
                                        <td class="px-0 py-0">
                                            <select class="form-control form-control-lg" name="radius"
                                                    v-model="zipcode.radius">
                                                <option value="10">10 Miles</option>
                                                <option value="20">20 Miles</option>
                                                <option value="30">30 Miles</option>
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-info btn-circle bg-yellow ml-2"
                                        @click="addGeoZipcode">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <div v-if="addGeoTargetError" class="is-invalid ml-2 mt-1 text-danger"
                                     v-html="addGeoTargetError"></div>
                                <button type="button" class="save-btn mr-2 bg-yellow" @click="saveGeoTarget" style="font-size:18px">Save
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </modal>
            <!--end modal-->
        </template>
    </charity-common>
</template>

<script src="./AddCampaign.js"></script>

<style lang="scss" scoped>
    @import '~@/_variables.scss';

    .table {
        padding-left: 154px !important;
    }

    .caption {
        font-weight: bold;
        font-size: 17px;
    }

    .campaign {
        font-size: 25px;
        font-family: $font-family-helvetica-neue, sans-serif;
        font-weight: bold;
    }

    .total {
        font-size: 19px;
    }

    .table-row {
        text-align: center;
        vertical-align: middle;
    }

    .rectangle-header {
        font-family: $font-family-helvetica-neue;
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
        border: solid 2px #f2f2f2;
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
            font-family: $font-family-helvetica-neue, sans-serif;
            font-size: 34px;
            font-weight: 500;
            color: #444444;
            margin-bottom: 0;
        }

        .table {
            padding-left: 0px !important;
            border-collapse: separate;
            border-spacing: 10px 10px;
        }

        .table th {
            font-family: $font-family-helvetica-neue, sans-serif;
        }

        input[type="text"], select {
            border: solid 2px #f2f2f2;
            padding: 13px 11px;
            font-size: 20px;
            font-family: $font-family-helvetica-neue, sans-serif;
            font-weight: normal;
            color: #444444;
            width: 100%;
            height: 48px;
        }

        .save-btn {
            size: 18px !important;;
            color: #444444;
            width: 100px;
            height: 35px;
            font-family: $font-family-helvetica-neue, sans-serif;
            border-radius: 3px;
            border: 1px solid  #f2f2f2;
            font-weight: normal;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: center;
            align-items: center;
            align-self: center;
            float: right;
            margin-top:20px;
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
        font-size: 40px;
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

    .bootbox-yellow .btn.btn-primary {
            background-color: $line-yellow !important;
    }
</style>
