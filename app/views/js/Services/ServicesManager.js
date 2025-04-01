document.addEventListener('DOMContentLoaded', function () {
    // Initialize service data fetching and UI components
    const serviceManager = new ServiceManager();
    serviceManager.initialize();
});

class ServiceManager {
    constructor() {
        this.baseUrl = 'http://localhost:8000';
        this.domElements = {
            massagesSection: document.getElementById('massagesSection'),
            bodyScrubsSection: document.getElementById('bodyScrubsSection'),
            packagesSection: document.getElementById('packagesSection'),
            archivedSection: document.getElementById('archivedServicesSection'),
            allServicesSection: document.getElementById('allServicesSection')
        };
        
        // Initialize service renderers
        this.serviceRenderer = new ServiceRenderer(this.domElements);
    }
    
    initialize() {
        // Fetch all needed data
        this.fetchActiveMassages();
        this.fetchActiveBodyScrubs();
        this.fetchActivePackages();
        this.fetchArchivedServices();
        this.fetchAllActiveServices();
        
        // Set up section navigation buttons
        this.setupSectionNavigation();
    }
    
    setupSectionNavigation() {
        const showMassages = document.getElementById('showMassages');
        const showBodyScrubs = document.getElementById('showBodyScrubs');
        const showPackages = document.getElementById('showPackages');
        const showAllActiveServices = document.getElementById('showAllServices');

        if (showMassages) {
            showMassages.addEventListener('click', () => this.fetchActiveMassages());
        }
        if (showBodyScrubs) {
            showBodyScrubs.addEventListener('click', () => this.fetchActiveBodyScrubs());
        }
        if (showPackages) {
            showPackages.addEventListener('click', () => this.fetchActivePackages());
        }
        if (showAllActiveServices) {
            showAllActiveServices.addEventListener('click', () => this.fetchAllActiveServices());
        }
    }
    
    // Data fetching methods
    async fetchActiveMassages() {
        try {
            const response = await fetch(`${this.baseUrl}/fetchActiveMassages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (response.ok) {
                this.serviceRenderer.renderData(data, 'Massages');
            } else {
                console.error('Server error:', data);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }
    
    async fetchActiveBodyScrubs() {
        try {
            const response = await fetch(`${this.baseUrl}/fetchActiveBodyScrubs`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (response.ok) {
                this.serviceRenderer.renderData(data, 'Body Scrubs');
            } else {
                console.error('Server error:', data);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }
    
    async fetchActivePackages() {
        try {
            const response = await fetch(`${this.baseUrl}/fetchActivePackages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (response.ok) {
                this.serviceRenderer.renderData(data, 'Packages');
            } else {
                console.error('Server error:', data);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }
    
    async fetchArchivedServices() {
        try {
            const response = await fetch(`${this.baseUrl}/fetchArchivedServices`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) {
                const text = await response.text();
                throw new Error(`Server error: ${response.status} - ${text}`);
            }
            const data = await response.json();
            this.serviceRenderer.renderArchivedServices(data);
        } catch (error) {
            const targetSection = this.domElements.archivedSection;
            if (targetSection) {
                targetSection.innerHTML = '<p class="text-center text-red-500">Failed to load archived services.</p>';
            }
        }
    }
    
    async fetchAllActiveServices() {
        try {
            const response = await fetch(`${this.baseUrl}/fetchAllActiveServices`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) {
                const text = await response.text();
                throw new Error(`Server error: ${response.status} - ${text}`);
            }
            const data = await response.json();
            this.serviceRenderer.renderActiveServices(data);
        } catch (error) {
            const targetSection = this.domElements.allServicesSection;
            if (targetSection) {
                targetSection.innerHTML = '<p class="text-center text-red-500">Failed to load active services.</p>';
            } else {
                console.error('Target section for all active services not found');
            }
        }
    }
}