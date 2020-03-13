<template>
    <div>
        <div class="card" id="input-form">
            <div class="card-body pb-2">
                
                    <div class="row">
                        <label for="staticEmail" class="col-sm-2 form-label">Name</label>
                            <div class="col-sm-10">
                                {{user.name}}
                            </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-2 form-label">Email</label>
                            <div class="col-sm-10">
                                {{user.email}}
                            </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-2 form-label">Phone</label>
                            <div class="col-sm-10">
                                {{user.phone}}
                            </div>
                    </div>
                
            </div>
        </div>

        <div class="text-right mt-3">            
            <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;">Back</button>
        </div>
    </div>
</template>

<script src="./UserShow.js"></script>