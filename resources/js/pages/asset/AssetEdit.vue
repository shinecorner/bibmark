<template>
    <div>
        <div class="card" id="input-form">
            <div class="card-body pb-2">
                <form id="validation-form">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" required name="input-name" v-model="asset.name">
                    </div>
                    <div class="form-group media" style="min-height:1px">
                        <div class="ui-bg-cover" style="width: 100px;height: 100px;">
                            <img id="logo-image" style="width: 100%; height: 100%; object-fit: contain;" v-bind:src="asset.filename" alt="logo" v-if="asset.filename || filename" />
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">
                                File Name:
                            </label>
                            <label class="custom-file mt-3">
                                <input type="file" class="custom-file-input" id="logo-input" ref="file1" v-on:change="selectLogo">
                                <span class="custom-file-label"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <input type="text" class="form-control" required name="input-type" v-model="asset.type">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Rate</label>
                        <input type="text" class="form-control" required name="input-rate" v-model="asset.rate">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cap</label>
                        <input type="text" class="form-control" required name="input-cap" v-model="asset.cap">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cap Perc</label>
                        <input type="text" class="form-control" required name="input-cap_perc" v-model="asset.cap_perc">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select asset type</label>
                        <select class="form-control" v-model="asset.assetable_id">
                            <option selected>Choose...</option>
                            <option value="1">Charity</option>
                            <option value="2">Sponsor</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-right mt-3">
            <button type="button" class="btn btn-primary ladda-button" data-style="expand-left" v-on:click="save">Save changes</button>&nbsp;
            <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;">Cancel</button>
        </div>
    </div>
</template>
<script src="./AssetEdit.js"></script>