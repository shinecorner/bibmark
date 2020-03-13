<template>
    <div>
        <div>
            <div class="media align-items-center py-3 mb-3">
                <div class="media-body">
                    <a v-bind:href="asset.id + '/edit'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
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
                            <td>{{ asset.id }}</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>{{ asset.name }}</td>
                        </tr>
                        <tr>
                            <td>File name:</td>
                            <td><img style="width: 80px; height: 80px; object-fit: contain;" v-bind:src="asset.filename" v-if="asset.filename" /></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td>{{ asset.type }}</td>
                        </tr>
                        <tr>
                            <td>Rate:</td>
                            <td>{{ asset.rate }}</td>
                        </tr>
                        <tr>
                            <td>Rate:</td>
                            <td>{{ asset.cap }}</td>
                        </tr>
                        <tr>
                            <td>Rate:</td>
                            <td>{{ asset.cap_perc }}</td>
                        </tr>
                        <tr>
                            <td>Created At:</td>
                            <td>{{ asset.created_at | moment("YYYY-MM-DD") }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script src="./AssetShow.js"></script>