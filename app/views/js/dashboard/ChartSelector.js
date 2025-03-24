class ChartSelector {
    constructor() {
        this.viewTypeSelector = document.getElementById('viewTypeSelector');
        this.weeklyFilters = document.getElementById('weeklyFilters');
        this.monthlyFilters = document.getElementById('monthlyFilters');
        this.yearlyFilters = document.getElementById('yearlyFilters');
        
        this.weeklyChart = document.getElementById('weeklyChart');
        this.monthlyChart = document.getElementById('monthlyChart');
        this.yearlyChart = document.getElementById('stackedColumnChart');
        
        this.setupEventListeners();
        this.updateVisibleFilters();
    }
    
    setupEventListeners() {
        this.viewTypeSelector.addEventListener('change', () => this.updateVisibleFilters());
    }
    
    updateVisibleFilters() {
        const viewType = this.viewTypeSelector.value;
        
        // Hide all filters and charts first
        this.weeklyFilters.style.display = 'none';
        this.monthlyFilters.style.display = 'none';
        this.yearlyFilters.style.display = 'none';
        
        this.weeklyChart.style.display = 'none';
        this.monthlyChart.style.display = 'none';
        this.yearlyChart.style.display = 'none';
        
        // Show the appropriate filters and chart based on selection
        switch(viewType) {
            case 'weekly':
                this.weeklyFilters.style.display = 'flex';
                this.weeklyChart.style.display = 'block';
                break;
            case 'monthly':
                this.monthlyFilters.style.display = 'flex';
                this.monthlyChart.style.display = 'block';
                break;
            case 'yearly':
                this.yearlyFilters.style.display = 'flex';
                this.yearlyChart.style.display = 'block';
                break;
        }
        
        // Trigger event for charts to update
        const event = new CustomEvent('viewTypeChanged', { detail: { viewType } });
        document.dispatchEvent(event);
    }
}

// Initialize the selector when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ChartSelector();
});