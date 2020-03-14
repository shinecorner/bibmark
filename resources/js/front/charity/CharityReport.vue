<template>
  <charity-common :activeLink="navLink">
    <template v-slot:charity-content>
      <div class="row">
        <div class="clearfix col-md-12">
            <div class="caption">
                <span class="donation">Logo Count</span>
            </div>
        </div>
        <div class="clearfix col-md-12">
            <div>
                <apexchart type="line" height="350" :options="linechart.chartOptions" :series="linechart.series"></apexchart>
            </div>
        </div>    
      </div>
      <div class="row">
        <div class="clearfix col-md-12">
            <div class="caption">
                <span class="donation">Hot Spots</span>
            </div>
        </div>
        <div class="clearfix col-md-12">
            <div>
                <apexchart type="donut" height="300" :options="donutchart.chartOptions" :series="donutchart.series"></apexchart>
            </div>
        </div>    
      </div>       
      <div class="row">
        <div class="col-md-12">
          <div class="caption">
            <span class="donation">Campaign Overview</span>
          </div>

          <div class="table-responsive">
            <table class="table text-center table-striped table-bordered mb-0">
              <thead class="rectangle-header bg-yellow">
                <tr>
                  <th>Name</th>
                  <th>Monthly</th>
                  <th>Yearly</th>
                  <th>Lifetime</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Starbucks</td>
                  <td>5,000</td>
                  <td>1.2 Million</td>
                  <td>7 Million</td>
                  <td>Active</td>
                </tr>
                <tr>
                  <td>Holiday Starbucks</td>
                  <td>12,000</td>
                  <td>2.5 Million</td>
                  <td>12 Million</td>
                  <td>Ended</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </template>
  </charity-common>
</template>

<script src="./CharityReport.js"></script>

<style lang="scss" scoped>
.caption {
  padding-left: 0px;
}

.caption span {
  margin-bottom: 10px;
  display: block;
}

.donation {
  font-size: 25px;
  font-family: HelveticaNeue, sans-serif;
  font-weight: bold;
  // color: #FFC73A;
}

.total {
  font-size: 19px;
}

.table-row {
  text-align: center;
  vertical-align: middle;
}

.rectangle-header {
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
