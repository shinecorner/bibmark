<template>
    <div>
        <div class="card" id="input-form">
            <div class="card-body pb-2">
                <form id="validation-form">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="input-name" v-model="sponsor.name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hashtags</label>
                        <input @keyup="onHashtagChange" type="text" class="form-control" name="input-name" ref="hashtag" v-model="sponsor.hashtags">
                    </div>
                    <div class="form-group media" style="min-height:1px">

                        <div class="ui-bg-cover" style="width: 80px;height: 80px;">
                            <img id="logo-image" style="width: 100%; height: 100%; object-fit: contain;" v-bind:src="sponsor.logo" alt="logo" v-if="sponsor.logo || logo" />
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">
                                Logo image:
                            </label>
                            <label class="custom-file mt-3">
                                <input type="file" class="custom-file-input" id="logo-input" ref="file1" v-on:change="selectLogo">
                                <span class="custom-file-label"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group media" style="min-height:1px">
                        <div class="ui-bg-cover" style="width: 80px;height: 80px;">
                            <img id="background-image" style="width: 100%; height: 100%; object-fit: contain;" v-bind:src="sponsor.background_image" alt="background" v-if="sponsor.background_image || background" />
                        </div>
                        <div class="media-body ml-3">
                            <label class="form-label">
                                Background image:
                            </label>
                            <label class="custom-file mt-3">
                                <input type="file" class="custom-file-input" id="background-input" ref="file2" v-on:change="selectBackground">
                                <span class="custom-file-label"></span>
                            </label>
                        </div>
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

<script src="./SponsorEdit.js"></script>