<template>
    <div>        
        <div class="card" id="input-form">
            <div class="card-body pb-2">
                <form id="validation-form" v-on:submit="save">
                    <div class="form-group">                        
                        <label class="form-label">Password</label>                        
                        <input v-model="password" v-validate="'required'" name="password" type="password" placeholder="Password" ref="password" class="form-control" data-vv-as="password" v-bind:class="{ 'is-invalid': errors.has('password') }"/>
                        <label id="password-error" class="error jquery-validation-error small form-text invalid-feedback" for="password">{{ errors.first('password') }}</label>
                        <!-- <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password" v-model="password"> -->
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input v-validate="'required|confirmed:password'" name="password_confirmation" type="password" placeholder="Password, Again" data-vv-as="Confirm Password" class="form-control" v-bind:class="{ 'is-invalid': errors.has('password_confirmation') }"/>
                        <label id="password_confirmation-error" class="error jquery-validation-error small form-text invalid-feedback" for="password_confirmation">{{ errors.first('password_confirmation') }}</label>
                    </div>                    
                </form>
            </div>
        </div>

        <div class="text-right mt-3">
            <button type="submit" :disabled="errors.any()" class="btn btn-primary ladda-button" data-style="expand-left" v-on:click="save">Save changes</button>&nbsp;
            <button type="button" class="btn btn-default" onclick="window.history.go(-1); return false;">Cancel</button>
        </div>
    </div>
</template>

<script src="./UserChangePassword.js"></script>