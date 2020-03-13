<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <span class="history">Payment History</span>
            <payment-history-list v-bind:history="history"></payment-history-list>
        </template>
    </sponsor-common>
</template>

<script>
    export default {
        data() {
            return {
                navLink: 'Payment History'
            };
        },
        props: {
            history: {
                type: Object,
                require: true
            },
            sponsor: {
                type: Object,
                require: true
            }
        },
        methods: {
        }
    }
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';
.sponsor-common {

    .history {
        font-size: 25px;
        font-family: $font-family-helvetica-neue;
        font-weight: bold;
        color: #ffc600;
        margin-bottom: 60px;
    }
}
</style>
