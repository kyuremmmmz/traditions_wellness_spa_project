document.addEventListener('DOMContentLoaded', function () {
    // Get the data from the element with ID 'appointmentData'
    var dataElement = document.getElementById('appointmentData');
    var seriesData = JSON.parse(dataElement.getAttribute('data-series'));

    seriesData = seriesData.map(Number);
    var options = {
        series: seriesData,
        chart: {
            type: 'donut',
            height: 140
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '90%'
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false // Ensure legend is disabled
        },
        labels: ['Completed', 'Awaiting Review', 'Ongoing', 'Upcoming', 'Pending', 'Canceled'],
        colors: ['#15803D', '#32A3FF', '#FDA93C', '#FFEA06', '#71717A', '#D92626']
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
});