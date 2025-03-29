class ServicesSelectionLoader {
    constructor() {
        this.allServicesSection = document.getElementById('allServicesSection');
        this.massagesSection = document.getElementById('massagesSection');
        this.bodyScrubsSection = document.getElementById('bodyScrubsSection');
        this.packagesSection = document.getElementById('packagesSection');
        this.archivedServicesSection = document.getElementById('archivedServicesSection');

        this.sections = {
            'all': this.allServicesSection,
            'massages': this.massagesSection,
            'bodyScrubs': this.bodyScrubsSection,
            'packages': this.packagesSection,
            'archivedServices': this.archivedServicesSection
        };

        this.init();
    }

    async init() {
        await this.loadServices();
        this.setupEventListeners();
    }

    async loadServices() {
        try {
            const response = await fetch('http://localhost:8000/store', { method: 'GET' });
            const result = await response.json();
            const services = result.data;
            Object.values(this.sections).forEach(section => {
                section.innerHTML = '';
            });

            // Populate sections with services
            services.forEach(service => {
                const serviceElement = this.createServiceElement(service);
                this.allServicesSection.appendChild(serviceElement);
            });
        } catch (error) {
            console.error('Error loading services:', error);
            this.showError('Failed to load services. Please try again later.');
        }
    }

    createServiceElement(service) {
        const element = document.createElement('div');
        element.className = 'service-item';
        element.innerHTML = `
            <button class="w-[365px] h-[84px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]">
                <div class="w-[64px]">
                    <img src='${service.main_photo}' class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary">
                </div>
                <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                    <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${service.serviceName}</p>
                    <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none h-[13px] w-full truncate">${service.description || 'No description available'}</p>
                    <div class="flex gap-[8px] w-full items-center">
                        <div class="flex gap-[4px]">
                            <p class="CaptionOne text-onBackground lea₱ding-none dark:text-darkOnBackground truncate">${service.rating || '0.0'}</p>
                            <?php IconChoice::render('star', '[10px]', '[10px]', '', 'orange', 'orange')?>
                        </div>
                        <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none w-full text-left">₱${service.price || '0.00'}</p>
                    </div>
                </div>
            </button>
        `;
        return element;
    }
    showError(message) {
        // Implement error display logic here
        console.error(message);
    }

    setupEventListeners() {
        //  any necessary event listeners here
    }
}

// Initialize the loader when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ServicesSelectionLoader();
});