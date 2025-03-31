class AddNewServiceSelectionDOM {
    constructor() {
        this.addOnSection = document.getElementById('addon_selection');
        this.massageSection = document.getElementById('massage_selection');
        this.bodyScrubSection = document.getElementById('body_scrub_selection');
        this.categorySelect = document.getElementById('category');
        this.init();
    }

    async init() {
        await this.loadActiveAddOns();
        await this.loadActiveMassages();
        await this.loadActiveBodyScrubs();
        this.setupCategoryChangeListeners();
    }

    setupCategoryChangeListeners() {
        if (this.categorySelect) {
            this.categorySelect.addEventListener('change', () => {
                this.resetCheckboxes();
                this.loadActiveMassages();
                this.loadActiveBodyScrubs();
                this.loadActiveAddOns();
            });
        }
    }

    resetCheckboxes() {
        this.massageSection.innerHTML = '';
        this.bodyScrubSection.innerHTML = '';
        this.addOnSection.innerHTML = '';
    }

    async loadActiveAddOns() {
        try {
            const response = await fetch('/fetchActiveAddons', { method: 'POST' });
            const result = await response.json();
    
            console.log("Addons results:", result);
    
            if (result && result.status === 'success' && result.data && result.data.length > 0) {
                this.createCheckboxes(result.data, this.addOnSection, 'addon_selection'); // Access result.data
            } else {
                this.showEmptyMessage(this.addOnSection, 'No add-ons available.');
            }
        } catch (error) {
            this.showError('Failed to load active add-ons.', this.addOnSection);
        }
    }

    async loadActiveMassages() {
        try {
            const response = await fetch('/fetchActiveMassages', { method: 'POST' });
            const result = await response.json();

            if (result && result.length > 0) {
                this.createCheckboxes(result, this.massageSection, 'massage_selection');
            } else {
                this.showEmptyMessage(this.massageSection, 'No massages available.');
            }

        } catch (error) {
            this.showError('Failed to load active massages.', this.massageSection);
        }
    }

    async loadActiveBodyScrubs() {
        try {
            const response = await fetch('/fetchActiveBodyScrubs', { method: 'POST' });
            const result = await response.json();
            
            console.log(result);

            if (result && result.length > 0) {
                this.createCheckboxes(result, this.bodyScrubSection, 'body_scrub_selection');
            } else {
                this.showEmptyMessage(this.bodyScrubSection, 'No body scrubs available yet.');
            }
        } catch (error) {
            console.error(error);
            this.showError('Failed to load active body scrubs.', this.bodyScrubSection);
        }
    }

    createCheckboxes(items, section, namePrefix) {
        console.log("createCheckboxes called with:", items, section, namePrefix);
        if(!section){
            console.error("section is null");
        }
        items.forEach(item => {
            console.log("Processing item:", item);
            let itemName = item.serviceName;
            if (namePrefix === 'addon_selection' && item.name) {
                itemName = item.name;
            }

            if (item && itemName) {
                const replace = itemName.replace(/ /g, '_').toLowerCase();

                const itemDiv = document.createElement('div');
                itemDiv.className = 'relative';
                itemDiv.id = namePrefix;

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.name = `${namePrefix}[]`;
                input.value = itemName;
                input.className = 'peer hidden';
                input.id = `${namePrefix}_${replace}`;

                const label = document.createElement('label');
                label.htmlFor = `${namePrefix}_${replace}`;
                label.className = 'BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center px-[12px] h-[36px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface w-full';
                label.textContent = itemName;

                itemDiv.appendChild(input);
                itemDiv.appendChild(label);
                section.appendChild(itemDiv);
            } else {
                console.warn(`Skipping item due to missing ${namePrefix === 'addon_selection' ? 'name' : 'serviceName'} property:`, item);
            }
        });
    }

    showError(message, section) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400';
        errorDiv.textContent = message;
        section.innerHTML = '';
        section.appendChild(errorDiv);
    }
    showEmptyMessage(section, message) {
        const emptyDiv = document.createElement('div');
        emptyDiv.className = 'p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-400';
        emptyDiv.textContent = message;
        section.innerHTML = '';
        section.appendChild(emptyDiv);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new AddNewServiceSelectionDOM();
});