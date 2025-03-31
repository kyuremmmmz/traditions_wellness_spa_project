const UpdateServiceDOM = {
    elements: {
        form: () => document.getElementById('UpdateServiceForm'),
        // Openers
        openConfirmUpdate: () => document.getElementById('openConfirmUpdateServiceModal'),
        openUnsavedChanges: () => document.getElementById('openUnsavedUpdateServiceModal'),
        openDelete: () => document.getElementById('openDeleteUpdateServiceModal'),
        // Modals
        confirmModal: () => document.getElementById('ConfirmUpdateServiceModal'),
        unsavedModal: () => document.getElementById('UnsavedUpdateServiceModal'),
        deleteModal: () => document.getElementById('DeleteUpdateServiceModal'),
        // Confirmation buttons
        cancelConfirm: () => document.getElementById('cancelUpdateService'),
        proceedConfirm: () => document.getElementById('proceedUpdateService'),
        // Unsaved changes buttons
        cancelUnsaved: () => document.getElementById('cancelUnsavedUpdateService'),
        proceedUnsaved: () => document.getElementById('proceedUnsavedUpdateService'),
        // Delete buttons
        cancelDelete: () => document.getElementById('cancelDeleteUpdateService'),
        proceedDelete: () => document.getElementById('proceedDeleteUpdateService'),
        // Close button
        closeButton: () => document.getElementById('exitUpdateService'),
        drawer: () => document.getElementById('UpdateServiceSection')
    },

    isDirty: false,

    handlers: {
        submit(e) {
            e.preventDefault();
            if (window.UpdateServiceValidation.validateForm()) {
                UpdateServiceDOM.openConfirmationDialog();
            }
        },

        cancel() {
            UpdateServiceDOM.closeConfirmationDialog();
        },

        proceed() {
            UpdateServiceDOM.elements.form().submit();
        },

        close() {
            if (UpdateServiceDOM.hasUnsavedChanges()) {
                UpdateServiceDOM.openUnsavedChangesModal();
            } else {
                UpdateServiceDOM.closeDrawer();
            }
        },

        cancelUnsavedChanges() {
            UpdateServiceDOM.closeUnsavedChangesModal();
        },

        proceedUnsavedChanges() {
            UpdateServiceDOM.resetFieldsToEmpty();
            UpdateServiceDOM.closeDrawer();
            UpdateServiceDOM.closeUnsavedChangesModal();
        },

        cancelDelete() {
            UpdateServiceDOM.closeDeleteModal();
        },

        proceedDelete() {
            const form = UpdateServiceDOM.elements.form();
            const ServiceId = form?.querySelector('input[name="update_service_id"]')?.value;
        
            fetch('http://localhost:8000/deleteService', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ Service_id: ServiceId })
            })
            .then(() => location.reload())
            .catch(error => console.error("Error deleting add-on:", error));
        },
        
        openUnsavedChanges() {
            UpdateServiceDOM.openUnsavedChangesModal();
        },

        openDelete() {
            UpdateServiceDOM.openDeleteModal();
        }
    },

    init() {
        const { 
            form, cancelConfirm, proceedConfirm, closeButton, 
            cancelUnsaved, proceedUnsaved, cancelDelete, proceedDelete,
            openConfirmUpdate, openUnsavedChanges, openDelete
        } = this.elements;

        form()?.addEventListener('submit', this.handlers.submit);
        cancelConfirm()?.addEventListener('click', this.handlers.cancel);
        proceedConfirm()?.addEventListener('click', this.handlers.proceed);
        closeButton()?.addEventListener('click', this.handlers.close);
        cancelUnsaved()?.addEventListener('click', this.handlers.cancelUnsavedChanges);
        proceedUnsaved()?.addEventListener('click', this.handlers.proceedUnsavedChanges);
        cancelDelete()?.addEventListener('click', this.handlers.cancelDelete);
        proceedDelete()?.addEventListener('click', this.handlers.proceedDelete);

        // Modal openers
        openConfirmUpdate()?.addEventListener('click', this.handlers.openConfirmUpdate);
        openUnsavedChanges()?.addEventListener('click', this.handlers.openUnsavedChanges);
        openDelete()?.addEventListener('click', this.handlers.openDelete);

        const fixedPriceButton = form().querySelector('#updateFixedPriceButton');
        const dynamicPriceButton = form().querySelector('#updateDynamicPriceButton');
        if (fixedPriceButton && dynamicPriceButton) {
            fixedPriceButton.addEventListener('change', () => this.updatePriceSectionVisibility());
            dynamicPriceButton.addEventListener('change', () => this.updatePriceSectionVisibility());
            // Initialize visibility
            this.updatePriceSectionVisibility();
        }
        
        this.attachInputChangeListeners();

        // Initialize category selection handler
        this.categorySelectionHandler.init();
    },

    openConfirmationDialog() {
        this.elements.confirmModal()?.classList.remove('hidden');
    },

    closeConfirmationDialog() {
        this.elements.confirmModal()?.classList.add('hidden');
    },

    closeDrawer() {
        this.elements.drawer()?.classList.add("translate-x-full");
        this.elements.drawer()?.classList.remove("translate-x-0");
    },

    openUnsavedChangesModal() {
        this.elements.unsavedModal()?.classList.remove('hidden');
    },

    closeUnsavedChangesModal() {
        this.elements.unsavedModal()?.classList.add('hidden');
    },

    openDeleteModal() {
        this.elements.deleteModal()?.classList.remove('hidden');
    },

    closeDeleteModal() {
        this.elements.deleteModal()?.classList.add('hidden');
    },

    hasUnsavedChanges() {
        return this.isDirty;
    },

    attachInputChangeListeners() {
        const inputs = this.elements.form()?.querySelectorAll('input, textarea, select') || [];
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                this.isDirty = true;
            });
        });
    },

    populateServiceDrawer(serviceData) {
        const form = this.elements.form();
        if (!form) {
            console.error('Update service form not found');
            return;
        }

        // Set category first to ensure proper sections are loaded
        if (serviceData.category) {
            const categoryDropdown = form.querySelector('[name="update_category"]');
            if (categoryDropdown) {
                // Find and set the category option
                for (let i = 0; i < categoryDropdown.options.length; i++) {
                    if (categoryDropdown.options[i].text === serviceData.category) {
                        categoryDropdown.selectedIndex = i;
                        // Trigger category change to load appropriate sections
                        const event = new Event('change');
                        categoryDropdown.dispatchEvent(event);
                        break;
                    }
                }
            }
        }

        // Map camelCase properties to snake_case form fields
        const fieldMappings = {
            'id': 'update_service_id',
            'name': 'update_service_name',
            'description': 'update_description',
            'fixedPrice': 'update_fixed_price',
            'status': 'update_status',
            'caption': 'update_caption',
            'durationDetails': 'update_duration_details',
            'partySizeDetails': 'update_party_size_details',
            'massageDetails': 'update_massage_details',
            'bodyScrubDetails': 'update_body_scrub_details',
            'addOnsDetails': 'update_addon_details',
            'headline1': 'update_headline1',
            'caption1': 'update_caption1',
            'headline2': 'update_headline2',
            'caption2': 'update_caption2',
            'headline3': 'update_headline3',
            'caption3': 'update_caption3',
            'partySize': 'update_party_size',
            'oneHourPrice': 'update_one_hour_price',
            'oneHourThirtyPrice': 'update_one_hour_thirty_price',
            'twoHourPrice': 'update_two_hour_price'
        };
        
        // Set form values based on mapping
        Object.entries(fieldMappings).forEach(([dataKey, formField]) => {
            if (serviceData[dataKey] !== undefined) {
                this.setFieldValue(formField, serviceData[dataKey]);
            }
        });
        
        // Handle price type radio buttons
        if (serviceData.oneHourPrice || serviceData.oneHourThirtyPrice || serviceData.twoHourPrice) {
            // Use dynamic pricing
            const dynamicPriceButton = form.querySelector('#updateDynamicPriceButton');
            if (dynamicPriceButton) {
                dynamicPriceButton.checked = true;
                this.updatePriceSectionVisibility();
            }
        } else {
            // Use fixed pricing
            const fixedPriceButton = form.querySelector('#updateFixedPriceButton');
            if (fixedPriceButton) {
                fixedPriceButton.checked = true;
                this.updatePriceSectionVisibility();
            }
        }
        
        // Handle category selection
        if (serviceData.category) {
            const categoryDropdown = form.querySelector('[name="update_category"]');
            if (categoryDropdown) {
                // Find the option that matches the category
                for (let i = 0; i < categoryDropdown.options.length; i++) {
                    if (categoryDropdown.options[i].text === serviceData.category) {
                        categoryDropdown.selectedIndex = i;
                        break;
                    }
                }
            }
        }
        
        // Handle complex selection fields using populateSelectionField
        const selectionMappings = [
            { dataKey: 'massageSelection', fieldName: 'update_massage_selection' },
            { dataKey: 'bodyScrubSelection', fieldName: 'update_body_scrub_selection' },
            { dataKey: 'supplementalAddOns', fieldName: 'update_addon_selection' }
        ];
    
        // Use setTimeout to ensure DOM updates are complete
        setTimeout(() => {
            selectionMappings.forEach(mapping => {
                if (serviceData[mapping.dataKey]) {
                    this.populateSelectionField(mapping.fieldName, serviceData[mapping.dataKey]);
                }
            });
        }, 100);

    if (window.PhotoHandler) {
            // Clean up slideshow data
            if (serviceData.slideShowPhotos === 'No files uploaded') {
                serviceData.slideShowPhotos = null;
            }
            window.PhotoHandler.handleServicePhotos(serviceData, form);
        }
        
        // Reset dirty state since we just populated the form
        this.isDirty = false;

        // Trigger category-based selection setup
        const categoryDropdown = form.querySelector('[name="update_category"]');
        if (categoryDropdown) {
            this.categorySelectionHandler.setupCategoryVisibility(categoryDropdown.value);
        }
    },

    // Also add this to your resetFieldsToEmpty method if you have one
    resetFieldsToEmpty() {
        const form = this.elements.form();
        if (!form) return;
        
        // Reset all form fields
        form.reset();
        
        // Reset photo displays if PhotoHandler exists
        if (window.PhotoHandler) {
            window.PhotoHandler.resetPhotoDisplays(form);
        }
    },

    setFieldValue(fieldName, value) {
        const form = this.elements.form();
        const element = form.querySelector(`[name="${fieldName}"]`);
        if (element) {
            // Skip setting value for file inputs as it's not allowed for security reasons
            if (element.type === 'file') {
                console.log(`File input field ${fieldName} detected, skipping value assignment`);
                return;
            }
            element.value = value || '';
            console.log(`Set ${fieldName} to ${value}`);
        } else {
            console.warn(`Form field ${fieldName} not found`);
        }
    },

    populateSelectionField(fieldName, value) {
        if (!value) return;
        
        console.log(`Attempting to populate selection field ${fieldName} with value`, value);
        
        try {
            const form = this.elements.form();
            if (!form) {
                console.error('Form not found');
                return;
            }
            
            const container = document.getElementById(`${fieldName}_wrapper`);
            if (!container) {
                console.warn(`Selection container for ${fieldName} not found`);
                return;
            }
            
            // Ensure container is visible before populating
            container.style.display = 'block';

            // Parse the value into an array if it isn't already
            let selectedValues = [];
            if (Array.isArray(value)) {
                selectedValues = value;
            } else if (typeof value === 'string') {
                // Handle comma-separated strings
                selectedValues = value.split(',').map(v => v.trim());
            }
            
            console.log('Processed selected values:', selectedValues);
            
            // Get all checkboxes in the container
            const checkboxes = container.querySelectorAll('input[type="checkbox"]');
            console.log(`Found ${checkboxes.length} checkboxes for ${fieldName}`);
            
            // First uncheck all checkboxes
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });

            // Then check only the matching ones
            checkboxes.forEach(checkbox => {
                const checkboxValue = checkbox.value.trim();
                console.log(`Checking checkbox with value: "${checkboxValue}"`);
                
                const isChecked = selectedValues.some(selectedValue => {
                    // Direct comparison of trimmed values
                    return selectedValue.trim() === checkboxValue;
                });
                
                if (isChecked) {
                    console.log(`MATCH FOUND - Selecting checkbox with value: "${checkboxValue}"`);
                    checkbox.checked = true;
                    // Trigger change event to update UI
                    const event = new Event('change', { bubbles: true });
                    checkbox.dispatchEvent(event);
                }
            });
        } catch (error) {
            console.error(`Error populating selection field ${fieldName}:`, error);
        }
    },

    updatePriceSectionVisibility() {
        const form = this.elements.form();
        const fixedPriceButton = form.querySelector('#updateFixedPriceButton');
        const dynamicPriceButton = form.querySelector('#updateDynamicPriceButton');
        const fixedPriceSection = document.getElementById('updateFixedPriceSection');
        const dynamicPriceSection = document.getElementById('updateDynamicPriceSection');
        
        if (!fixedPriceButton || !dynamicPriceButton || !fixedPriceSection || !dynamicPriceSection) {
            console.error('Missing price UI elements');
            return;
        }
        
        if (fixedPriceButton.checked) {
            fixedPriceSection.classList.remove('hidden');
            fixedPriceSection.style.opacity = '1';
            dynamicPriceSection.classList.add('hidden');
            dynamicPriceSection.style.opacity = '0';
        } else if (dynamicPriceButton.checked) {
            fixedPriceSection.classList.add('hidden');
            fixedPriceSection.style.opacity = '0';
            dynamicPriceSection.classList.remove('hidden');
            dynamicPriceSection.style.opacity = '1';
        }
    },

    // Category Selection Handler
    categorySelectionHandler: {
        addOnSection: null,
        massageSectionWrapper: null,
        bodyScrubSectionWrapper: null,
        categoryDropdown: null,
        massageSection: null,
        bodyScrubSection: null,

        init() {
            const form = UpdateServiceDOM.elements.form();
            if (!form) return;

            this.categoryDropdown = form.querySelector('[name="update_category"]');
            this.addOnSection = document.getElementById('update_addon_selection');
            this.massageSectionWrapper = document.getElementById('update_massage_selection_wrapper');
            this.bodyScrubSectionWrapper = document.getElementById('update_body_scrub_selection_wrapper');
            this.addOnSectionWrapper = document.getElementById('update_addon_selection_wrapper');
            this.massageSection = document.getElementById('update_massage_selection');
            this.bodyScrubSection = document.getElementById('update_body_scrub_selection');

            if (this.categoryDropdown) {
                this.categoryDropdown.addEventListener('change', this.handleCategoryChange.bind(this));
            }
        },

        handleCategoryChange(event) {
            const selectedCategory = event.target.value;
            this.setupCategoryVisibility(selectedCategory);
        },

        setupCategoryVisibility(selectedCategory) {
            // Reset all sections first
            this.addOnSectionWrapper.classList.add('hidden');
            this.massageSectionWrapper.classList.add('hidden');
            this.bodyScrubSectionWrapper.classList.add('hidden');

            // Reset section contents
            this.massageSection.innerHTML = '';
            this.bodyScrubSection.innerHTML = '';
            this.addOnSection.innerHTML = '';

            // Set visibility based on category
            if (selectedCategory === 'Packages') {
                this.massageSectionWrapper.classList.remove('hidden');
                this.bodyScrubSectionWrapper.classList.remove('hidden');
            } else if (selectedCategory === 'Body Scrubs') {
                this.addOnSectionWrapper.classList.remove('hidden');
                this.massageSectionWrapper.classList.remove('hidden');
            } else if (selectedCategory === 'Massages') {
                this.addOnSectionWrapper.classList.remove('hidden');
            }

            // Load selections based on category
            this.loadSelectionsByCategoryType(selectedCategory);
        },

        async loadSelectionsByCategoryType(category) {
            try {
                switch(category) {
                    case 'Packages':
                        await this.loadActiveMassages();
                        await this.loadActiveBodyScrubs();
                        break;
                    case 'Body Scrubs':
                        await this.loadActiveMassages();
                        await this.loadActiveAddOns();
                        break;
                    case 'Massages':
                        await this.loadActiveAddOns();
                        break;
                    default:
                        console.warn('Unknown category:', category);
                }
            } catch (error) {
                console.error('Error loading selections:', error);
            }
        },

        async loadActiveAddOns() {
            try {
                const response = await fetch('/fetchActiveAddons', { method: 'POST' });
                const result = await response.json();
        
                if (result && result.status === 'success' && result.data && result.data.length > 0) {
                    this.createCheckboxes(result.data, this.addOnSection, 'update_addon_selection');
                } else {
                    this.showEmptyMessage(this.addOnSection, 'No add-ons available.');
                }
            } catch (error) {
                this.showError('Failed to load active add-ons.', this.addOnSection);
            }
        },

        async loadActiveMassages() {
            try {
                const response = await fetch('/fetchActiveMassages', { method: 'POST' });
                const result = await response.json();

                if (result && result.length > 0) {
                    this.createCheckboxes(result, this.massageSection, 'update_massage_selection');
                } else {
                    this.showEmptyMessage(this.massageSection, 'No massages available.');
                }
            } catch (error) {
                this.showError('Failed to load active massages.', this.massageSection);
            }
        },

        async loadActiveBodyScrubs() {
            try {
                const response = await fetch('/fetchActiveBodyScrubs', { method: 'POST' });
                const result = await response.json();

                if (result && result.length > 0) {
                    this.createCheckboxes(result, this.bodyScrubSection, 'update_body_scrub_selection');
                } else {
                    this.showEmptyMessage(this.bodyScrubSection, 'No body scrubs available yet.');
                }
            } catch (error) {
                this.showError('Failed to load active body scrubs.', this.bodyScrubSection);
            }
        },

        createCheckboxes(items, section, namePrefix) {
            if (!section) {
                console.error("section is null");
                return;
            }
            
            // Clear existing checkboxes first
            section.innerHTML = '';
            
            items.forEach(item => {
                let itemName = item.serviceName;
                if (namePrefix === 'update_addon_selection' && item.name) {
                    itemName = item.name;
                }
        
                if (item && itemName) {
                    const replace = itemName.replace(/ /g, '_').toLowerCase();
                    const checkboxId = `${namePrefix}_${replace}`;
        
                    // Skip if checkbox already exists
                    if (document.getElementById(checkboxId)) {
                        console.log(`Skipping duplicate checkbox for ${itemName}`);
                        return;
                    }
        
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'relative';
                    itemDiv.id = namePrefix;
        
                    const input = document.createElement('input');
                    input.type = 'checkbox';
                    input.name = `${namePrefix}[]`;
                    input.value = itemName;
                    input.className = 'peer hidden';
                    input.id = checkboxId;
        
                    const label = document.createElement('label');
                    label.htmlFor = checkboxId;
                    label.className = 'BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center px-[12px] h-[36px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface w-full';
                    label.textContent = itemName;
        
                    itemDiv.appendChild(input);
                    itemDiv.appendChild(label);
                    section.appendChild(itemDiv);
                } else {
                    console.warn(`Skipping item due to missing ${namePrefix === 'update_addon_selection' ? 'name' : 'serviceName'} property:`, item);
                }
            });
        },

        showError(message, section) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400';
            errorDiv.textContent = message;
            section.innerHTML = '';
            section.appendChild(errorDiv);
        },

        showEmptyMessage(section, message) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-400';
            emptyDiv.textContent = message;
            section.innerHTML = '';
            section.appendChild(emptyDiv);
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    UpdateServiceDOM.init();
});

window.UpdateServiceDOM = UpdateServiceDOM;