class RevenueChart {
    constructor() {
        this.yearSelector = document.getElementById('yearSelector');
        this.monthSelector = document.getElementById('monthSelector');
        this.monthlyYearSelector = document.getElementById('monthlyYearSelector');
        this.weekSelector = document.getElementById('weekSelector');
        this.weeklyMonthSelector = document.getElementById('weeklyMonthSelector');
        this.weeklyYearSelector = document.getElementById('weeklyYearSelector');
        this.viewTypeSelector = document.getElementById('viewTypeSelector');
        
        this.currentViewType = 'weekly';  // Changed from 'yearly' to 'weekly'
        this.charts = {};
        
        this.checkSystemTheme();
        this.initializeOptions();
        this.setupEventListeners();
    }

    checkSystemTheme() {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const hasThemeClass = document.documentElement.classList.contains('dark');
        
        // Only set theme if it hasn't been manually set
        if (!hasThemeClass && prefersDark) {
            document.documentElement.classList.add('dark');
        }
    }

    initializeOptions() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#ffffff' : '#000000';

        // Base options for all charts
        this.baseOptions = {
            chart: {
                height: 350,
                stacked: true,
                foreColor: textColor,
                toolbar: { 
                    show: true,
                    tools: {
                        download: false,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                },
                zoom: { enabled: true },
                background: 'transparent'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                }
            },
            yaxis: {
                title: { 
                    text: 'Revenue (PHP)',
                    style: {
                        color: textColor
                    }
                },
                labels: {
                    formatter: (value) => `₱${value.toLocaleString('en-PH')}`,
                    style: {
                        colors: textColor
                    }
                }
            },
            tooltip: {
                theme: isDark ? 'dark' : 'light',
                y: {
                    formatter: (value) => `₱${value.toLocaleString('en-PH')}`
                }
            },
            colors: ['#006837', '#009444', '#88C540'],
            legend: {
                position: 'right',
                offsetY: 40,
                labels: {
                    colors: textColor
                }
            },
            fill: { opacity: 1 },
            dataLabels: { enabled: false },
            theme: {
                mode: isDark ? 'dark' : 'light'
            }
        };

        // Yearly chart options
        this.yearlyOptions = {
            ...this.baseOptions,
            series: [{
                name: 'Massages',
                data: Array(12).fill(0)
            }, {
                name: 'Body Scrubs',
                data: Array(12).fill(0)
            }, {
                name: 'Packages',
                data: Array(12).fill(0)
            }],
            chart: {
                ...this.baseOptions.chart,
                type: 'bar'
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    style: {
                        colors: Array(12).fill(textColor)
                    }
                }
            }
        };

        // Monthly chart options
        this.monthlyOptions = {
            ...this.baseOptions,
            series: [{
                name: 'Massages',
                data: Array(31).fill(0)
            }, {
                name: 'Body Scrubs',
                data: Array(31).fill(0)
            }, {
                name: 'Packages',
                data: Array(31).fill(0)
            }],
            chart: {
                ...this.baseOptions.chart,
                type: 'bar'
            },
            xaxis: {
                categories: Array.from({length: 31}, (_, i) => (i + 1).toString()),
                labels: {
                    style: {
                        colors: Array(31).fill(textColor)
                    }
                }
            }
        };

        // Weekly chart options
        this.weeklyOptions = {
            ...this.baseOptions,
            series: [{
                name: 'Massages',
                data: Array(7).fill(0)
            }, {
                name: 'Body Scrubs',
                data: Array(7).fill(0)
            }, {
                name: 'Packages',
                data: Array(7).fill(0)
            }],
            chart: {
                ...this.baseOptions.chart,
                type: 'bar'
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                labels: {
                    style: {
                        colors: Array(7).fill(textColor)
                    }
                }
            }
        };
    }

    setupEventListeners() {
        // Year selector for yearly view
        this.yearSelector.addEventListener('change', () => this.fetchAndUpdateData('yearly'));
        
        // Month and year selectors for monthly view
        this.monthSelector.addEventListener('change', () => this.fetchAndUpdateData('monthly'));
        this.monthlyYearSelector.addEventListener('change', () => this.fetchAndUpdateData('monthly'));
        
        // Week, month, and year selectors for weekly view
        this.weekSelector.addEventListener('change', () => this.fetchAndUpdateData('weekly'));
        this.weeklyMonthSelector.addEventListener('change', () => this.fetchAndUpdateData('weekly'));
        this.weeklyYearSelector.addEventListener('change', () => this.fetchAndUpdateData('weekly'));
        
        // Listen for view type changes
        this.viewTypeSelector.addEventListener('change', () => {
            this.currentViewType = this.viewTypeSelector.value;
            this.updateChartVisibility(this.currentViewType);
            this.fetchAndUpdateData(this.currentViewType);
        });
        
        document.addEventListener('DOMContentLoaded', () => this.init());
    }

    // Add this new method to handle chart visibility
    updateChartVisibility(viewType) {
        // Hide all charts first
        document.querySelector("#weeklyChart").style.display = 'none';
        document.querySelector("#monthlyChart").style.display = 'none';
        document.querySelector("#stackedColumnChart").style.display = 'none';
        
        // Hide all revenue and popular service info
        document.querySelector("#weekly_revenue_info").style.display = 'none';
        document.querySelector("#monthly_revenue_info").style.display = 'none';
        document.querySelector("#yearly_revenue_info").style.display = 'none';
        document.querySelector("#weekly_popular_info").style.display = 'none';
        document.querySelector("#monthly_popular_info").style.display = 'none';
        document.querySelector("#yearly_popular_info").style.display = 'none';
        
        // Show only the selected chart and info
        switch(viewType) {
            case 'weekly':
                document.querySelector("#weeklyChart").style.display = 'block';
                document.querySelector("#weekly_revenue_info").style.display = 'flex';
                document.querySelector("#weekly_popular_info").style.display = 'flex';
                break;
            case 'monthly':
                document.querySelector("#monthlyChart").style.display = 'block';
                document.querySelector("#monthly_revenue_info").style.display = 'flex';
                document.querySelector("#monthly_popular_info").style.display = 'flex';
                break;
            case 'yearly':
                document.querySelector("#stackedColumnChart").style.display = 'block';
                document.querySelector("#yearly_revenue_info").style.display = 'flex';
                document.querySelector("#yearly_popular_info").style.display = 'flex';
                break;
        }
        
        // Force a resize event after changing visibility
        setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
            if (this.charts[viewType]) {
                this.charts[viewType].render();
            }
        }, 50);
    }

    init() {
        // Make all chart containers visible temporarily for initialization
        document.querySelector("#weeklyChart").style.display = 'block';
        document.querySelector("#monthlyChart").style.display = 'block';
        document.querySelector("#stackedColumnChart").style.display = 'block';
        
        // Initialize all three charts
        this.charts.yearly = new ApexCharts(document.querySelector("#stackedColumnChart"), this.yearlyOptions);
        this.charts.monthly = new ApexCharts(document.querySelector("#monthlyChart"), this.monthlyOptions);
        this.charts.weekly = new ApexCharts(document.querySelector("#weeklyChart"), this.weeklyOptions);
        
        // Render all charts
        this.charts.yearly.render();
        this.charts.monthly.render();
        this.charts.weekly.render();
        
        this.setupThemeObserver();
        
        setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
            
            setTimeout(() => {
                this.updateChartVisibility(this.currentViewType);
                
                // Changed from 'yearly' to 'weekly'
                this.fetchAndUpdateData('weekly');
            }, 50);
        }, 300);
    }

    async fetchAndUpdateData(viewType = null) {
        if (!viewType) viewType = this.currentViewType;
        
        try {
            let url = '';
            let sampleData = {};
            
            switch(viewType) {
                case 'weekly':
                    const week = this.weekSelector.value;
                    const weeklyMonth = this.weeklyMonthSelector.value;
                    const weeklyYear = this.weeklyYearSelector.value;
                    url = `/getWeeklyRevenue/${weeklyYear}/${weeklyMonth}/${week}`;
                    sampleData = {
                        massages: [8000, 7500, 9000, 8500, 10000, 12000, 11000],
                        body_scrubs: [4000, 3800, 4500, 4200, 5000, 6000, 5500],
                        packages: [6000, 5800, 6500, 6200, 7000, 8000, 7500]
                    };
                    break;
                    
                case 'monthly':
                    const month = this.monthSelector.value;
                    const monthlyYear = this.monthlyYearSelector.value;
                    url = `/getMonthlyRevenue/${monthlyYear}/${month}`;
                    
                    // Create sample data with appropriate number of days for the month
                    const daysInMonth = new Date(monthlyYear, month, 0).getDate();
                    sampleData = {
                        massages: Array.from({length: daysInMonth}, () => Math.floor(Math.random() * 3000) + 1000),
                        body_scrubs: Array.from({length: daysInMonth}, () => Math.floor(Math.random() * 1500) + 500),
                        packages: Array.from({length: daysInMonth}, () => Math.floor(Math.random() * 2000) + 800)
                    };
                    break;
                    
                case 'yearly':
                default:
                    const year = this.yearSelector.value;
                    url = `/getYearlyRevenue/${year}`;
                    sampleData = {
                        massages: [45000, 52000, 48000, 55000, 49000, 51000, 54000, 48000, 52000, 50000, 53000, 56000],
                        body_scrubs: [25000, 28000, 26000, 29000, 27000, 28000, 30000, 27000, 29000, 28000, 30000, 31000],
                        packages: [35000, 38000, 36000, 39000, 37000, 38000, 40000, 37000, 39000, 38000, 40000, 41000]
                    };
                    break;
            }
            
            const response = await fetch(url);
            if (!response.ok) throw new Error('Failed to fetch data');
            const data = await response.json();
            this.updateChartData(viewType, data);
        } catch (error) {
            console.error(`Error fetching ${viewType} revenue data:`, error);
            // Use sample data as fallback
            this.updateChartData(viewType, sampleData);
        }
    }

    updateChartData(viewType, data) {
        if (!this.charts[viewType]) return;
        
        let newSeries = [];
        let categories = [];
        let totalRevenue = 0;
        
        switch(viewType) {
            case 'weekly':
                newSeries = this.charts.weekly.w.config.series.map(series => {
                    const seriesData = data[series.name.toLowerCase().replace(' ', '_')] || Array(7).fill(0);
                    totalRevenue += seriesData.reduce((a, b) => a + b, 0);
                    return {
                        name: series.name,
                        data: seriesData
                    };
                });
                break;
                
            case 'monthly':
                const month = this.monthSelector.value;
                const year = this.monthlyYearSelector.value;
                const daysInMonth = new Date(year, month, 0).getDate();
                
                categories = Array.from({length: daysInMonth}, (_, i) => (i + 1).toString());
                
                newSeries = this.charts.monthly.w.config.series.map(series => {
                    const seriesData = data[series.name.toLowerCase().replace(' ', '_')] || Array(daysInMonth).fill(0);
                    totalRevenue += seriesData.reduce((a, b) => a + b, 0);
                    return {
                        name: series.name,
                        data: seriesData
                    };
                });
                
                this.charts.monthly.updateOptions({
                    xaxis: {
                        categories: categories
                    }
                });
                break;
                
            case 'yearly':
            default:
                newSeries = this.charts.yearly.w.config.series.map(series => {
                    const seriesData = data[series.name.toLowerCase().replace(' ', '_')] || Array(12).fill(0);
                    totalRevenue += seriesData.reduce((a, b) => a + b, 0);
                    return {
                        name: series.name,
                        data: seriesData
                    };
                });
                break;
        }
        
        // Update the revenue text
        const revenueElement = document.getElementById(`${viewType}_revenue`);
        if (revenueElement) {
            revenueElement.textContent = `₱${totalRevenue.toLocaleString('en-PH')}`;
        }
        
        this.charts[viewType].updateSeries(newSeries);
    }

    setupThemeObserver() {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'class') {
                    this.updateTheme();
                }
            });
        });

        observer.observe(document.documentElement, {
            attributes: true
        });
    }

    updateTheme() {
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#E5E5E5' : '#1F2937';
        
        // Update theme for all charts
        Object.values(this.charts).forEach(chart => {
            chart.updateOptions({
                chart: {
                    foreColor: textColor
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: Array(31).fill(textColor) // Use 31 as max (for monthly view)
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: [textColor]
                        }
                    },
                    title: {
                        style: {
                            color: textColor
                        }
                    }
                },
                legend: {
                    labels: {
                        colors: [textColor]
                    }
                },
                theme: {
                    mode: isDark ? 'dark' : 'light'
                }
            }, true);
        });
    }
}

new RevenueChart();