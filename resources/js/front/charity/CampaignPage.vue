<template>
    <charity-common :charity="charity" :activeLink="navLink">
        <template v-slot:charity-content>
            <div class="caption">
                <span class="campaign">Campaigns</span>
                <span class="total">Total Logo Uploaded: 19M</span>
            </div>

            <div class="table">
                <div>
                    <table id="campaign-list" class="table table-striped table-bordered mb-0">
                        <thead class="rectangle-header bg-yellow">
                            <tr>
                                <th>Campaign Name</th>
                                <th>Logo</th>
                                <th>Budget</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row" v-for="campaign in finalCampaigns">
                            <td>{{campaign.name}}</td>
                            <td><img :src="campaign.logo" width="50px"></td>
                            <td>{{campaign.budget}}</td>
                            <td>{{campaign.status ? 'Acitve' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-circle black"><i
                                    class="fa fa-pen" @click='editCampaign(campaign.id)'></i></button>
                                <button type="button" class="btn btn-info btn-circle red"><i
                                    class="fa fa-minus" @click='removeCampaign(campaign.id)'></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="caption">
                <button @click='addCampaign' type="button"
                        class="btn btn-info btn-circle bg-yellow"><i
                    class="fa fa-plus"></i></button>
            </div>
        </template>
    </charity-common>
</template>

<script src="./CampaignPage.js"></script>

<style lang="scss" scoped>
    .table {
        padding-left: 154px !important;
    }

    .caption {
        padding-left: 154px;
    }

    .caption span {
        margin-bottom: 18px;
        display: block;
    }

    .campaign {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #000000;
    }

    .total {
        font-size: 19px;
    }

    .table-row {
        text-align: center;
        vertical-align: middle;
    }

    .rectangle-header {
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



</style>
