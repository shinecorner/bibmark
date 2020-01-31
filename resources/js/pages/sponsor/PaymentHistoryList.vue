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
                    <td>{{history.Amount}}</td>
                    <td>{{history.Status}}</td>
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
