class ServicesSelectionLoader {
    constructor() {
        this.allServicesSection = document.getElementById('allServicesSection');
        this.massagesSection = document.getElementById('massagesSection');
        this.bodyScrubsSection = document.getElementById('bodyScrubsSection');
        this.packagesSection = document.getElementById('packagesSection');
        this.addOnsSection = document.getElementById('addOnsSection');
        this.archivedServicesSection = document.getElementById('archivedServicesSection');
        this.archivedAddOnsSection = document.getElementById('archivedAddOnsSection');

        this.sections = {
            'all': this.allServicesSection,
            'massages': this.massagesSection,
            'bodyScrubs': this.bodyScrubsSection,
            'packages': this.packagesSection,
            'addOns': this.addOnsSection,
            'archivedServices': this.archivedServicesSection,
            'archivedAddOns': this.archivedAddOnsSection
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

            // Clear existing content
            Object.values(this.sections).forEach(section => {
                section.innerHTML = '';
            });

            // Populate sections with services
            services.forEach(service => {
                const serviceElement = this.createServiceElement(service);
                
                // Add to appropriate section based on service type
                if (service.type === 'addon') {
                    if (service.archived) {
                        this.archivedAddOnsSection.appendChild(this.createAddonElement(service));
                    } else {
                        this.addOnsSection.appendChild(this.createAddonElement(service));
                    }
                } else {
                    // Add to all services section
                    this.allServicesSection.appendChild(serviceElement);

                    // Add to specific category section
                    switch(service.category?.toLowerCase()) {
                        case 'massage':
                            this.massagesSection.appendChild(serviceElement.cloneNode(true));
                            break;
                        case 'body scrub':
                            this.bodyScrubsSection.appendChild(serviceElement.cloneNode(true));
                            break;
                        case 'package':
                            this.packagesSection.appendChild(serviceElement.cloneNode(true));
                            break;
                    }

                    // If archived, add to archived section
                    if (service.archived) {
                        this.archivedServicesSection.appendChild(serviceElement.cloneNode(true));
                    }
                }
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
                    <img src='SAMPLE KAILANGAN PA TO LAGYAN' class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary">
                </div>
                <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                    <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${service.serviceName}</p>
                    <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none h-[13px] w-full truncate">${service.description || 'No description available'}</p>
                    <div class="flex gap-[8px] w-full">
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

    createAddonElement(addon) {
        const element = document.createElement('div');
        element.className = 'addon-item';
        element.innerHTML = `
            <button class="w-full bg-white rounded-[16px] shadow flex items-center justify-between p-[24px] hover:bg-gray-50 transition-all duration-300">
                <h3 class="text-[20px] font-semibold">${addon.serviceName}</h3>
                <span class="text-[16px] font-semibold">₱${addon.price || '0.00'}</span>
            </button>
        `;
        return element;
    }

    showError(message) {
        // Implement error display logic here
        console.error(message);
    }

    setupEventListeners() {
        // Add any necessary event listeners here
    }
}

// Initialize the loader when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ServicesSelectionLoader();
});