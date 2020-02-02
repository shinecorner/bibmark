<template>
    <div>
        <div>
            <div class="media align-items-center py-3 mb-3">
                <div class="media-body">
                    <a v-bind:href="sponsor.id + '/edit'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                    <a href="javascript:history.back()" class="btn btn-default btn-sm">Back</a>&nbsp;
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table user-view-table m-0">
                    <tbody>
                        <tr>
                            <td>ID:</td>
                            <td>{{ sponsor.id }}</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>{{ sponsor.name }}</td>
                        </tr>
                        <tr>
                            <td>Hashtags:</td>
                            <td>{{ sponsor.hashtags }}</td>
                        </tr>
                        <tr>
                            <td>Logo Image:</td>
                            <td><img style="width: 80px; height: 80px; object-fit: contain;" v-bind:src="sponsor.logo" v-if="sponsor.logo" /></td>
                        </tr>
                        <tr>
                            <td>Background Image:</td>
                            <td><img style="width: 80px; height: 80px; object-fit: contain;" v-bind:src="sponsor.background_image" v-if="sponsor.background_image" /></td>
                        </tr>
                        <tr>
                            <td>Balance:</td>
                            <td>{{ sponsor.balance }}</td>
                        </tr>
                        <tr>
                            <td>Budget:</td>
                            <td>{{ sponsor.budget }}</td>
                        </tr>
                        <tr>
                            <td>Created At:</td>
                            <td>{{ sponsor.created_at | moment("YYYY-MM-DD") }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script src="./SponsorShow.js"></script>
