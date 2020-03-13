<template>
    <input @keyup="prepareLogoWidth" @focus="setCursorPosition" class="logowidth" name="logo_width" :value="value" ref="logo_width" type="text">
</template>
<script>
    export default {
        name: "logo-width",
        props: [
            'value'
        ],
        methods: {
            prepareLogoWidth: function (e) {
                let sanitized = e.target.value;
                if (sanitized) {
                    sanitized = sanitized.replace(/"/g, '') + '"';
                    if(sanitized == '"'){
                        this.$refs.logo_width.value = '';
                        this.$refs.logo_width.selectionEnd = 0
                        this.$emit('input', '');
                    }
                    else{
                        this.$refs.logo_width.value = sanitized;
                        this.$refs.logo_width.selectionEnd = (sanitized.length - 1)
                        this.$emit('input', sanitized);
                    }
                }
            },
            setCursorPosition: function (e) {
                this.$refs.logo_width.selectionEnd = 0
            }
        },        
    }
</script>
<style lang="scss">
.charity-common .right-side2 input[type="text"].logowidth{
    width: 120px;
}
</style>
