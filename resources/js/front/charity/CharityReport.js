export default {
    data() {
        return {
            navLink: 'Reports',
            linechart: {
                series: [{
                    name: 'Count',
                    data: [70, 20, 50, 68, 12, 45, 55, 66, 22, 11, 38, 89]
                }],
                chartOptions: {
                    colors: ['#FFC73A'],
                    chart: {
                        height: 350,
                        type: 'line',
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    xaxis: {
                        labels: {
                            useHtml: true,
                            formatter: function (value) {
                                return moment(value).format('DD') + "\n" + moment(value).format('ddd');
                            }
                        },
                        categories: ['2020-03-01', '2020-03-02', '2020-03-03', '2020-03-04', '2020-03-05', '2020-03-06', '2020-03-07', '2020-03-08', '2020-03-09', '2020-03-10', '2020-03-11', '2020-03-12'],
                    },
                    title: {
                        text: 'This Month',
                        align: 'left',
                        style: {
                            fontSize: "16px",
                            color: '#666'
                        }
                    },

                    markers: {
                        size: 4,
                        colors: ["#FFC73A"],
                        strokeColors: "#fff",
                        strokeWidth: 2,
                        hover: {
                            size: 7,
                        }
                    },
                    yaxis: {
                        title: {
                            text: '',
                        },
                    }
                },
            },
            donutchart: {
                series: [44, 55, 41, 17, 15],                
                chartOptions: {
                    dataLabels: {
                        enabled: true,
                    },
                    labels: ['Boston, MA', 'New York, NY', 'Chicago, IL', 'Miami, FL', 'Hartford, CT'],
                    legend: {
                        position: 'right',                        
                        height: 230,
                        itemMargin: {
                            horizontal: 5,
                            vertical: 10
                        },
                    }
                },
            }
        };
    },

}