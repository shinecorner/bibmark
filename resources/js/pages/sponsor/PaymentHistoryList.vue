<template>
    <div class="table-responsive pt-5">
        <table class="table table-striped table-bordered">
            <thead class="rectangle-header">
                <tr>
                    <th class="label">Credit Card Number</th>
                    <th class="label">Billed Month</th>
                    <th class="label">Paid On</th>
                    <th class="label">Amount Paid</th>
                    <th class="label">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-row" v-for="(history,i) in history" :key="i">
                    <td>{{history.Last4}}</td>
                    <td>{{history.MonthYear}}</td>
                    <td>{{history.TransactionDate}}</td>
                    <td>${{history.Amount | formatPrice}}</td>
                    <td>{{history.Status | capitalize }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            history: {
                type: Object,
                require: true
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            },
            formatPrice: function(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>

<style lang="scss" scoped>
@import '~@/_variables.scss';
.table-row {
    font-family: $font-family-helvetica-neue;
    text-align: center;
    font-size: 20px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    color: #444444;
}

.rectangle-header {
    background-color: #ffc600;
    font-family: $font-family-helvetica-neue;
    font-size: 20px;
    font-weight: 600 !important;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: normal;
    text-align: center;
    color: #444444;

    tr {
        th {
            font-weight: 500 !important;
            font-size: 22px;
        }
    }
}
.table {
    width: 97%;
}

</style>
