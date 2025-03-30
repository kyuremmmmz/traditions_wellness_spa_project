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
            const activeAddOns = result.data;

            this.createCheckboxes(activeAddOns, this.addOnSection, 'addon_selection');
        } catch (error) {
            console.error('Error loading active add-ons:', error);
            this.showError('Failed to load active add-ons.', this.addOnSection);
        }
    }

    async loadActiveMassages() {
        try {
            const response = await fetch('/fetchActiveMassages', { method: 'POST' });
            const result = await response.json();
            const activeMassages = result.data;

            console.log("Active massages:", activeMassages);
            this.createCheckboxes(activeMassages, this.massageSection, 'massage_selection');
        } catch (error) {
            // ...
        }
    }

    async loadActiveBodyScrubs() {
        try {
            const response = await fetch('/fetchActiveBodyScrubs', { method: 'POST' });
            const result = await response.json();
            const activeBodyScrubs = result.data;

            console.log("Active body scrubs:", activeBodyScrubs);
            this.createCheckboxes(activeBodyScrubs, this.bodyScrubSection, 'body_scrub_selection');
        } catch (error) {
            // ...
        }
    }

    createCheckboxes(items, section, namePrefix) {
        items.forEach(item => {
            let itemName = item.serviceName; // Default
            if (namePrefix === 'addon_selection' && item.name) {
                itemName = item.name; // Use name for addons
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
}

document.addEventListener('DOMContentLoaded', () => {
    new AddNewServiceSelectionDOM();
});