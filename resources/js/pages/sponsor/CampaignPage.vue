<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <div class="caption">
                <span class="campaign">Campaigns</span>
                <span class="total">Total Logo Uploaded: 19M</span>
            </div>

            <div class="table">
                <div>
                    <table class="table table-striped table-bordered">
                        <thead class="rectangle-header">
                        <tr>
                            <th>Campaign Name</th>
                            <th>Logo</th>
                            <th>Logo Budget</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row" v-for="campaign in campaigns">
                            <td>{{campaign.name}}</td>
                            <td><img :src="campaign.logo" width="50px"></td>
                            <td>{{campaign.budget}}</td>
                            <td>{{campaign.status}}</td>
                            <td>
                                <a href="#" class="round-button black">[]</a>
                                <a href="#" class="round-button red">-</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="caption">
                <a :href="`/sponsors/${sponsor.id}/campaign/add`" class="round-button yellow">+</a>
            </div>
        </template>
    </sponsor-common>
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



</style>
