<template>
    <sponsor-common :sponsor="sponsor" :activeLink="navLink">
        <template v-slot:setting-content>
            <span class="history">Payment History</span>
            <div class="table">
                <payment-history-list v-bind:history="history"></payment-history-list>
            </div>
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

.sponsor-common {
    .table {
        padding-left: 153px !important;
    }

    .history {
        font-size: 25px;
        font-family: HelveticaNeue, sans-serif;
        font-weight: bold;
        color: #ffc600;
        margin-bottom: 60px;
        padding-left: 153px;
    }
}
</style>
