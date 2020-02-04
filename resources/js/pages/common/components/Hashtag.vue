<template>
    <input @keyup="prepareHashtags" ref="hashtag" type="text">
</template>
<script>
    export default {
        name: "hash-tag",
        props: [
            'value'
        ],
        methods: {
            prepareHashtags: function (e) {
                let sanitized = e.target.value;
                if (sanitized) {
                    sanitized = sanitized
                        .trim()
                        .split(',').map(item => {
                            if (item.indexOf('#') < 0){
                                return '#' + item.trim();
                            } else {
                                return item.trim();
                            }
                        })
                        .join(', ');
                    this.$refs.hashtag.value = sanitized;
                    this.$emit('input', sanitized);
                }
            },
        }
    }
</script>
