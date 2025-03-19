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
        const itemPending = document.getElementById('pending');
        const itemCancelled = document.getElementById('cancelled');
        const itemReview = document.getElementById('review');
        const itemUpcoming = document.getElementById('upcoming');
        const itemOngoing = document.getElementById('ongoing');
        const itemCompleted = document.getElementById('completed');
        const itemTotal = document.getElementById('total');
        itemTotal.innerText = `${item.total}`;
        itemPending.innerText = `${item.pending}`
        itemUpcoming.innerText = `${item.upcoming}`
        itemCompleted.innerText = `${item.completed}`
        itemOngoing.innerText = `${item.ongoing}`
        itemCancelled.innerText = `${item.cancelled}`
        itemReview.innerText = `${item.review}`;

        const series = [
            Number(item.completed || 0),
            Number(item.review || 0),
            Number(item.ongoing || 0),
            Number(item.upcoming || 0),
            Number(item.pending || 0),
            Number(item.cancelled || 0)
        ];

        var options = {
            series: series,
            chart: {
                type: 'donut',
                height: 140,
                background: 'transparent' // Ensure the background is transparent
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '90%',
                        background: 'transparent'
                    },
                    stroke: {
                        show: false,
                        width: 2, // Set the stroke width
                        colors: ['#000000'] // Set the stroke color to black
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
            colors: ['#15803D', '#32A3FF', '#FDA93C', '#FFEA06', '#71717A', '#D92626'],
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    };

    fetchData();
});