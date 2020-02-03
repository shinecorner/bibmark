<template>
    <div>
        <table  class="table table-striped table-bordered">
            <thead class="rectangle-header">
                <tr>
                    <th>Credit Card Number</th>
                    <th>Billed Month</th>
                    <th>Paid On</th>
                    <th>Amount Paid</th>
                    <th>Status</th>
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

.table-row {
    text-align: center;
}

.rectangle-header {
    background-color: #ffc600;
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

</style>
