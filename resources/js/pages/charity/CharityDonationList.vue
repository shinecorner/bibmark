<template>
    <charity-common :activeLink="navLink">
        <template v-slot:charity-content>
            <div class="caption pb-4">
                <span class="donation">Donation History</span>
            </div>

            <div class="table-responsive">
                <table class="table text-center table-striped table-bordered mb-0" style="width: 97%">
                    <thead class="rectangle-header bg-yellow">
                        <tr>
                            <th>Name</th>
                            <th>Paid On</th>
                            <th>Donation</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Alex Green</td>
                            <td> December 6, 2019 </td>
                            <td> $75 </td>
                            <td> Completed </td>
                        </tr>
                        <tr>
                            <td> Robin Iantosca </td>
                            <td> October 27, 2019 </td>
                            <td> $25 </td>
                            <td> Completed </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </charity-common>
</template>

<script src="./CharityDonationList.js"></script>

<style lang="scss" scoped>
    .caption {
        padding-left: 0px;
    }

    .caption span {
        margin-bottom: 18px;
        display: block;
    }

    .donation {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #FFC73A;
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

    .table-responsive {
        padding-right: 22px;
    }
</style>