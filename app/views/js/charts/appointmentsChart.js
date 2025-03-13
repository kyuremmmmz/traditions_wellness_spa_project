document.addEventListener('DOMContentLoaded', function () {
    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/getAllTotal');
        let json = await response.json();
        if (response.ok) {
            console.log(json);
            renderData(json[0]);
        }
    };

    function renderData(item) {
        console.log(item.pending);
        const series = [
            Number(item.completed || 0),
            Number(item.confirmed || 0),
            Number(item.ongoing || 0),
            Number(item.upcoming || 0),
            Number(item.pending || 0),
            Number(item.cancelled || 0)
        ];

        var options = {
            series: series,
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
                show: false
            },
            labels: ['Completed', 'Awaiting Review', 'Ongoing', 'Upcoming', 'Pending', 'Canceled'],
            colors: ['#15803D', '#32A3FF', '#FDA93C', '#FFEA06', '#71717A', '#D92626']
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    };

    fetchData();
});