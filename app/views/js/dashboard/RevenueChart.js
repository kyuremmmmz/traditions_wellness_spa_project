document.addEventListener('DOMContentLoaded', () => {
    const yearSelector = document.getElementById('yearSelector');
    const monthSelector = document.getElementById('monthSelector');
    const monthlyYearSelector = document.getElementById('monthlyYearSelector');
    const weekSelector = document.getElementById('weekSelector');
    const weeklyMonthSelector = document.getElementById('weeklyMonthSelector');
    const weeklyYearSelector = document.getElementById('weeklyYearSelector');
    const viewTypeSelector = document.getElementById('viewTypeSelector');
    const weekly_caption = document.getElementById('weekly_caption');
    let currentViewType = 'weekly';
    const charts = {};
    const fetchByCateg = async () => {
        const response = await fetch('http://localhost:8000/getAllWeeks');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Massages, 10)) : [];
    };

    const fetchByBodyScrub = async () => {
        const response = await fetch('http://localhost:8000/getAllBodyScrubs');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.BodyScrub, 10)) : [];
    };

    const fetchByPackages = async () => {
        const response = await fetch('http://localhost:8000/getAllPackages');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Packages, 10)) : [];
    };

    const fetchByMassages = async () => {
        const response = await fetch('http://localhost:8000/getMassagesByMonthMassages');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Massages, 10)) : [];
    };

    const getMassagesByMonthBodyScrub = async () => {
        const response = await fetch('http://localhost:8000/getMassagesByMonthBodyScrub');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.BodyScrub, 10)) : [];
    };

    const getMassagesByMonthPackages = async () => {
        const response = await fetch('http://localhost:8000/getMassagesByMonthPackages');
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Packages, 10)) : [];
    };

    const getAll = async (params) => {
        const response = await fetch(`http://localhost:8000/getAllCategories/${params}`);
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Massages, 10)) : [];
    };

    const getAllBodyScrubs = async (params) => {
        const response = await fetch(`http://localhost:8000/getAllCategories/${params}`);
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Body_Scrubs, 10)) : [];
    };

    const getAllPackages = async (params) => {
        const response = await fetch(`http://localhost:8000/getAllCategories/${params}`);
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Packages, 10)) : [];
    };
    const getAllMassagesByMonths = async (params) => {
        const response = await fetch(`http://localhost:8000/getAllCategoriesByMonth/${params}`);
        const jsonData = await response.json();
        console.log(jsonData);
        return response.ok ? jsonData[0].map(item => parseInt(item.Massages, 10)) : [];
    };





    let data = {};
    const renderCharts = async (weekNum) => {
        const weeklyMassages = await getAll(weekNum);
        const weeklyBodyScrub = await getAllBodyScrubs(weekNum);
        const weeklyPackages = await getAllPackages(weekNum);
        data = {
            weekly: {
                massages: weeklyMassages,
                body_scrubs: weeklyBodyScrub,
                packages: weeklyPackages
            },
        };

        charts.weekly.updateSeries([
            { name: 'Massages', data: data.weekly.massages },
            { name: 'Body Scrubs', data: data.weekly.body_scrubs },
            { name: 'Packages', data: data.weekly.packages }
        ]);

        await charts.weekly.render();
    };

    const renderChartmonths = async (selectedMonth) => {
        const chartData = await getAllMassagesByMonths(selectedMonth);

        if (chartData) {
            if (charts && charts.monthly) {
                charts.monthly.updateSeries([
                    { name: 'Massages', data: chartData.massages },
                    { name: 'Body Scrubs', data: chartData.body_scrubs },
                    { name: 'Packages', data: chartData.packages }
                ]);
                charts.monthly.render();
            } else {
                console.error('Chart not initialized!');
            }
        }
    };

    monthSelector.addEventListener('change', () => {
        const selectedMonth = monthSelector.value;
        console.log(selectedMonth);
        renderChartmonths(selectedMonth);
    });

    weekSelector.addEventListener('change', () => {
        const selectedWeek = weekSelector.value;
        renderCharts(selectedWeek);
    });


    const initializeData = async () => {
        const weeklyPackages = await fetchByPackages();
        const weeklyMassages = await fetchByCateg();
        const weeklyBodyScrub = await fetchByBodyScrub();
        const monthlyMassages = await fetchByMassages();
        const getMassagesByBodyScrub = await getMassagesByMonthBodyScrub()
        const getMassagesByMonthPackage = await getMassagesByMonthPackages();
        data = {
            weekly: {
                massages: weeklyMassages,
                body_scrubs: weeklyBodyScrub,
                packages: weeklyPackages
            },
            monthly: {
                massages: monthlyMassages,
                body_scrubs: getMassagesByBodyScrub,
                packages: getMassagesByMonthPackage,
            },
            yearly:{
                massages: monthlyMassages,
                body_scrubs: getMassagesByBodyScrub,
                packages: getMassagesByMonthPackage,
            }
        };

        charts.weekly = new ApexCharts(document.querySelector("#weeklyChart"), {
            ...baseOptions, xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
        });

        await charts.render();
        setupEvents();
    };

    




    const baseOptions = {
        chart: { type: 'bar', height: 350, stacked: true },
        colors: ['#006837', '#009444', '#88C540'],
        yaxis: { labels: { enabled:false } },
        tooltip: { y: { formatter: (val) => `₱${val.toLocaleString('en-PH')}` } },
        legend: { position: 'right' },
        dataLabels: { enabled: false },
        series: [{ name: 'Massages', data: [] }, { name: 'Body Scrubs', data: [] }, { name: 'Packages', data: [] }],
        xaxis: {
            labels: {
                enabled:false
            }
        }
    };

    const currentYear = new Date().getFullYear();
    const years = Array.from({ length: currentYear - 2020 }, (_, i) => 2021 + i);

    charts.yearly = new ApexCharts(document.querySelector("#stackedColumnChart"), {
        ...baseOptions,
        xaxis: { categories: years }
    });

    charts.monthly = new ApexCharts(document.querySelector("#monthlyChart"), {
        ...baseOptions, xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] }
    });
    charts.weekly = new ApexCharts(document.querySelector("#weeklyChart"), {
        ...baseOptions, xaxis: {
            categories: ['Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            labels: { enabled: false }
        }
    });

    Object.values(charts).forEach(chart => chart.render());
    setupEvents();
    updateChart('weekly');

    function setupEvents() {
        viewTypeSelector.addEventListener('change', () => {
            currentViewType = viewTypeSelector.value;
            updateChart(currentViewType);
        });
        yearSelector.addEventListener('change', () => updateChart('yearly'));
        monthlyYearSelector.addEventListener('change', () => updateChart('monthly'));
        weekSelector.addEventListener('change', () => updateChart('weekly'));
        weeklyMonthSelector.addEventListener('change', () => updateChart('weekly'));
        weeklyYearSelector.addEventListener('change', () => updateChart('weekly'));
    }

    async function updateChart(viewType) {
        const chart = charts[viewType];
        let chartData;

        try {
            chartData = await new Promise((resolve) => {
                setTimeout(() => resolve(data[viewType]), 500);
            });

            if (viewType === 'monthly') {
                const days = new Date(monthlyYearSelector.value || 2025, monthSelector.value || 1, 0).getDate();
                chart.updateOptions({ xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] } });
            }

            if (viewType === 'daily') {
                const days = new Date(monthlyYearSelector.value || 2025, monthSelector.value || 1, 0).getDate();
                chart.updateOptions({ xaxis: { categories: Array(days).fill(0).map((_, i) => i + 1) } });
            }

            chart.updateSeries([
                { name: 'Massages', data: chartData.massages },
                { name: 'Body Scrubs', data: chartData.body_scrubs },
                { name: 'Packages', data: chartData.packages || [] }
            ]);

            const fetchData = async () => {
                const response = await fetch('http://localhost:8000/getTotalRevenueAsWeek');
                let total = await response.json();
                if (response.ok) {
                    console.log(total);
                    document.getElementById(`${viewType}_revenue`).textContent = `₱${Number(total[0].price).toLocaleString('en-PH')}`;
                }
            }
            fetchData();
            ['weekly', 'monthly', 'yearly'].forEach(type => {
                document.getElementById(`${type}Chart`).style.display = type === viewType ? 'block' : 'none';
                document.getElementById(`${type}_revenue_info`).style.display = type === viewType ? 'flex' : 'none';
                document.getElementById(`${type}_popular_info`).style.display = type === viewType ? 'flex' : 'none';
            });
        } catch (error) {
            console.error(`Error fetching ${viewType} data from ${url}:`, error);
            chart.updateSeries([
                { name: 'Massages', data: data[viewType].massages },
                { name: 'Body Scrubs', data: data[viewType].body_scrubs },
                { name: 'Packages', data: data[viewType].packages || [] }
            ]);
        }
    }
    initializeData();

});