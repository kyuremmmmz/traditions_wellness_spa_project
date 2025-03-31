class AddOnsSelectionLoader {
    constructor() {
        this.addOnsSection = document.getElementById('addOnsSection');
        this.archivedAddOnsSection = document.getElementById('archivedAddOnsSection');

        this.sections = {
            'addOns': this.addOnsSection,
            'archivedAddOns': this.archivedAddOnsSection
        };

        this.init();
    }

    async init() {
        await this.loadAddOns();
        this.setupEventListeners();
    }

    async loadAddOns() {
        try {
            const response = await fetch('http://localhost:8000/addons', { method: 'GET' });
            const result = await response.json();
            const addOns = result.data;
            
            Object.values(this.sections).forEach(section => {
                section.innerHTML = '';
            });
    
            let activeAddOnsCount = 0;
            let archivedAddOnsCount = 0;
            addOns.forEach(addOn => {
                const addOnElement = this.createAddOnElement(addOn);
                if (addOn.status === 'Archived' || addOn.is_archived) {
                    this.archivedAddOnsSection.appendChild(addOnElement);
                    archivedAddOnsCount++;
                } else {
                    this.addOnsSection.appendChild(addOnElement);
                    activeAddOnsCount++;
                }
            });
            if (activeAddOnsCount === 0) {
                this.addOnsSection.innerHTML = '<p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none">No active add-ons available.</p>';
            }
            if (archivedAddOnsCount === 0) {
                this.archivedAddOnsSection.innerHTML = '<p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none">No archived add-ons available.</p>';
            }

        } catch (error) {
            console.error('Error loading add-ons:', error);
            console.error('Error details:', {
                message: error.message,
                stack: error.stack
            });
            this.showError('Failed to load add-ons. Please try again later.');
        }
    }

    createAddOnElement(addOn) {
        const element = document.createElement('div');
        element.className = 'service-item';
        element.innerHTML = `
            <button class="addon-btn w-[365px] border border-border dark:border-darkBorder flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]"
                    data-addon-id="${addOn.id || ''}"
                    data-addon-name="${addOn.name || ''}"
                    data-addon-price="${addOn.price || '0.00'}"
                    data-addon-status="${addOn.status || (addOn.is_archived ? 'Archived' : 'Active')}">
                <div class="flex flex-col gap-[8px] w-[365px] h-full justify-center items-start">
                    <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${addOn.name}</p>
                    <div class="flex gap-[8px] w-full items-center">
                        <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none">₱${addOn.price || '0.00'}</p>
                    </div>
                </div>
            </button>
        `;
        return element;
    }

    showError(message) {
        console.error(message);
        Object.values(this.sections).forEach(section => {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400';
            errorDiv.textContent = message;
            section.innerHTML = '';
            section.appendChild(errorDiv);
        });
    }

    setupEventListeners() {
        const addonButtons = document.querySelectorAll('.addon-btn');
        addonButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Extract addon data from button
                const addonData = {
                    id: button.getAttribute('data-addon-id'),
                    name: button.getAttribute('data-addon-name'),
                    price: button.getAttribute('data-addon-price'),
                    status: button.getAttribute('data-addon-status')
                };
    
                // Populate the drawer
                this.populateDrawer(addonData);
    
                // Open the drawer
                const drawer = document.getElementById('UpdateAddOnSection');
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    drawer.classList.remove('translate-x-full');
                    drawer.classList.add('translate-x-0');
                }, 100);
            });
        });
    }
    
    // New method to populate the drawer
    populateDrawer(addonData) {
        const form = document.getElementById('UpdateAddOnForm');
        // Assuming input names match the PHP form
        form.querySelector('[name="update_addon_id"]').value = addonData.id || '';
        form.querySelector('[name="update_name"]').value = addonData.name || '';
        form.querySelector('[name="update_price"]').value = addonData.price || '';
        form.querySelector('[name="update_status"]').value = addonData.status || 'Active';
    
    }
}

// Initialize the loader when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AddOnsSelectionLoader();
});