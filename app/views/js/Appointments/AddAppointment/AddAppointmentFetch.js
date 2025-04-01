document.addEventListener("DOMContentLoaded", () => {
    // Main dropdowns
    const serviceDropdown = document.querySelector('select[name="service_booked"]');
    const durationDropdown = document.querySelector('select[name="duration"]');
    const partySizeDropdown = document.querySelector('select[name="party_size"]');
    
    // Selection dropdowns
    const massageDropdown = document.querySelector('select[name="massage_selection"]');
    const bodyScrubDropdown = document.querySelector('select[name="body_scrub_selection"]');
     
    // Store data
    let servicesData = [];
    let addonsData = [];
    let massageOptions = [];
    let bodyScrubOptions = [];

    // Get addons container
    const addonsContainer = document.getElementById('addons_container');
    console.log('Addons container exists:', !!addonsContainer);

    async function fetchData() {
        try {
            const response = await fetch('http://localhost:8000/store', { method: 'GET' });
            const json = await response.json();
            if (json.data && Array.isArray(json.data)) {
                console.log('Fetched services data:', json.data);
                servicesData = json.data;
                
                // Extract unique massage and body scrub options from data
                extractSelectionOptions(servicesData);
                
                // Render service dropdown
                renderServiceDropdown(servicesData);
                
                // Set initial options based on first service
                if (servicesData.length > 0) {
                    updateDurationOptions(servicesData[0]);
                    updatePartySizeOptions(servicesData[0]);
                    updateMassageOptions(servicesData[0]);
                    updateBodyScrubOptions(servicesData[0]);
                    
                    // Also update addons for the first service
                    updateAddonOptions(servicesData[0]);
                }
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
    
    // Function to fetch addons data
    async function fetchAddonsData() {
        try {
            // Changed from relative path to full URL for consistency
            const response = await fetch('http://localhost:8000/fetchActiveAddons', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            
            console.log('Addon fetch response status:', response.status);
            const result = await response.json();
            
            console.log('Addon fetch result:', result);
            
            if (result.status === 'success' && Array.isArray(result.data)) {
                console.log('Fetched active addons:', result.data);
                addonsData = result.data;
                return result.data;
            }
            return [];
        } catch (error) {
            console.error('Error fetching addons:', error);
            return [];
        }
    }
    
    function extractSelectionOptions(services) {
        // Extract unique massage options
        const uniqueMassages = new Set();
        services.forEach(service => {
            if (service.massage_selection) {
                const massages = service.massage_selection.split(',').map(m => m.trim());
                massages.forEach(massage => uniqueMassages.add(massage));
            }
        });
        massageOptions = Array.from(uniqueMassages);
        
        // Extract unique body scrub options
        const uniqueScrubs = new Set();
        services.forEach(service => {
            if (service.body_scrub_selection) {
                const scrubs = service.body_scrub_selection.split(',').map(s => s.trim());
                scrubs.forEach(scrub => uniqueScrubs.add(scrub));
            }
        });
        bodyScrubOptions = Array.from(uniqueScrubs);
        
        console.log('Extracted massage options:', massageOptions);
        console.log('Extracted body scrub options:', bodyScrubOptions);
    }

    function renderServiceDropdown(items) {
        serviceDropdown.innerHTML = '';
        
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.serviceName;
            serviceDropdown.appendChild(option);
        });
    }
    
    function updateDurationOptions(service) {
        durationDropdown.innerHTML = '';
        
        if (service.one_hour_price > 0 || service.one_hour_thirty_price > 0 || service.two_hour_price > 0) {
            // Dynamic pricing - use standard durations
            console.log('Using dynamic durations for service:', service.serviceName);
            
            if (service.one_hour_price > 0) {
                addOption(durationDropdown, '1 hour', '1 hour');
            }
            
            if (service.one_hour_thirty_price > 0) {
                addOption(durationDropdown, '1 hour and 30 minutes', '1 hour and 30 minutes');
            }
            
            if (service.two_hour_price > 0) {
                addOption(durationDropdown, '2 hours', '2 hours');
            }
        } else {
            // Fixed pricing - use the duration from the service data
            console.log('Using fixed duration for service:', service.serviceName);
            addOption(durationDropdown, service.duration, service.duration);
        }
        
        // Trigger change event
        durationDropdown.dispatchEvent(new Event('change'));
    }
    
    function updatePartySizeOptions(service) {
        partySizeDropdown.innerHTML = '';
        
        const partySizeValue = service.party_size;
        console.log('Setting party size options based on:', partySizeValue);
        
        if (partySizeValue === 'All choices') {
            addOption(partySizeDropdown, 'Solo', 'Solo');
            addOption(partySizeDropdown, 'Duo', 'Duo');
            addOption(partySizeDropdown, 'Trio', 'Trio');
        } else if (partySizeValue === 'Solo only') {
            addOption(partySizeDropdown, 'Solo', 'Solo');
        } else if (partySizeValue === 'Duo only') {
            addOption(partySizeDropdown, 'Duo', 'Duo');
        } else if (partySizeValue === 'Trio only') {
            addOption(partySizeDropdown, 'Trio', 'Trio');
        } else {
            // Default to all choices if value is unexpected
            console.warn('Unexpected party_size value:', partySizeValue);
            addOption(partySizeDropdown, 'Solo', 'Solo');
            addOption(partySizeDropdown, 'Duo', 'Duo');
            addOption(partySizeDropdown, 'Trio', 'Trio');
        }
        
        // Trigger change event
        partySizeDropdown.dispatchEvent(new Event('change'));
    }
    
    function updateMassageOptions(service) {
        massageDropdown.innerHTML = '';
        
        if (service.massage_selection) {
            // Enable the dropdown
            enableDropdown(massageDropdown);
            
            // Add massage options from the service
            const massages = service.massage_selection.split(',').map(m => m.trim());
            
            // Add a default "Select option" as first option
            addOption(massageDropdown, '', 'Select Massage');
            
            // Add all available massage options for this service
            massages.forEach(massage => {
                addOption(massageDropdown, massage, massage);
            });
            
            console.log('Enabled massage selection with options:', massages);
        } else {
            // Disable the dropdown and set "Not included"
            disableDropdown(massageDropdown, 'Only for packages & scrubs');
            console.log('Disabled massage selection - not available for this service');
        }
    }
    
    function updateBodyScrubOptions(service) {
        bodyScrubDropdown.innerHTML = '';
        
        if (service.body_scrub_selection) {
            // Enable the dropdown
            enableDropdown(bodyScrubDropdown);
            
            // Add body scrub options from the service
            const scrubs = service.body_scrub_selection.split(',').map(s => s.trim());
            
            // Add a default "Select option" as first option
            addOption(bodyScrubDropdown, '', 'Select Body Scrub');
            
            // Add all available scrub options for this service
            scrubs.forEach(scrub => {
                addOption(bodyScrubDropdown, scrub, scrub);
            });
            
            console.log('Enabled body scrub selection with options:', scrubs);
        } else {
            // Disable the dropdown and set "Not included"
            disableDropdown(bodyScrubDropdown, 'Only for packages');
            console.log('Disabled body scrub selection - not available for this service');
        }
    }
    
    function enableDropdown(dropdown) {
        dropdown.disabled = false;
        dropdown.classList.remove('opacity-70');
        dropdown.classList.remove('cursor-not-allowed');
    }
    
    function disableDropdown(dropdown, message) {
        dropdown.innerHTML = '';
        const option = document.createElement('option');
        option.value = '';
        option.textContent = message;
        dropdown.appendChild(option);
        
        dropdown.disabled = true;
        dropdown.classList.add('opacity-70');
        dropdown.classList.add('cursor-not-allowed');
    }
    
    function addOption(selectElement, value, text) {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = text;
        selectElement.appendChild(option);
    }

    // Function to update addon checkboxes based on selected service
    function updateAddonOptions(service) {
        console.log('Updating addons for service:', service);
        
        if (!addonsContainer) {
            console.error('Addons container not found in the DOM');
            return;
        }
        
        if (!service) {
            console.error('No service provided to updateAddonOptions');
            return;
        }
        
        // Clear existing content
        addonsContainer.innerHTML = '';
        
        // Check if this is a package (disables addons)
        const isPackage = service.category === 'Packages';
        console.log('Is package:', isPackage);
        
        // Check if service has supplemental addons (pre-selected but disabled)
        const hasSupplementalAddons = service.supplemental_add_ons && service.supplemental_add_ons !== null && service.supplemental_add_ons !== '';
        console.log('Has supplemental addons:', hasSupplementalAddons);
        
        let supplementalAddons = [];
        
        if (hasSupplementalAddons) {
            // Parse the supplemental addons
            if (typeof service.supplemental_add_ons === 'string') {
                supplementalAddons = service.supplemental_add_ons.split(',').map(addon => addon.trim());
            } else if (Array.isArray(service.supplemental_add_ons)) {
                supplementalAddons = service.supplemental_add_ons.map(addon => addon.trim());
            }
            console.log('Supplemental addons:', supplementalAddons);
        }
        
        // Define package-specific add-ons (could be stored in a database or API in production)
        const packageAddons = {
            'Traditional Package': ['Hot Stone', 'Ventosa'],
            'Signature Package': ['Hot Stone', 'Ear Candling', 'Express Massage'],
            'Premium Package': ['Hot Stone', 'Champissage', 'Ventosa', 'Ear Candling'],
            // Add more packages as needed
        };
        
        // If it's a package or has supplemental addons, display included add-ons
        if (isPackage || hasSupplementalAddons) {
            // Create a title element
            const titleElement = document.createElement('div');
            titleElement.className = 'text-primary dark:text-darkPrimary BodyTwo ml-[16px] mt-[24px]';
            
            if (isPackage) {
                titleElement.textContent = 'This package includes:';
            } else if (hasSupplementalAddons) {
                titleElement.textContent = 'This service includes:';
            }
            
            addonsContainer.appendChild(titleElement);
            
            let addonsToShow = [];
            
            // Get add-ons to display based on source
            if (hasSupplementalAddons && supplementalAddons.length > 0) {
                addonsToShow = supplementalAddons;
            } else if (isPackage && packageAddons[service.serviceName]) {
                addonsToShow = packageAddons[service.serviceName];
            }
            
            // Display the add-ons
            if (addonsToShow.length > 0) {
                const addonsList = document.createElement('div');
                addonsList.className = 'flex flex-col gap-[8px]';
                
                addonsToShow.forEach(addonName => {
                    const addon = addonsData.find(a => a.name === addonName);
                    
                    // Create an add-on item even if we don't have pricing data
                    const addonItem = document.createElement('div');
                    addonItem.className = 'flex items-center gap-[16px] text-onBackground dark:text-darkOnBackground BodyTwo  leading-none ml-[16px]';
                    
                    const checkIcon = document.createElement('span');
                    checkIcon.className = 'text-primary dark:text-darkPrimary BodyTwo ml-[13px] leading-none';
                    checkIcon.innerHTML = '✓';
                    
                    const addonText = document.createElement('span');
                    addonText.textContent = addonName;
                    
                    addonItem.appendChild(addonText);
                    
                    // If we have pricing information, add it
                    if (addon) {
                        const priceText = document.createElement('span');
                        priceText.className = 'text-primary dark:text-darkPrimary BodyTwo leading-none';
                        priceText.textContent = '₱' + addon.price;
                        addonItem.appendChild(priceText);
                    }
                    
                    addonsList.appendChild(addonItem);
                });
                
                addonsContainer.appendChild(addonsList);
            } else {
                // Fallback message if no specific add-ons are defined
                const packageInfo = document.createElement('div');
                packageInfo.className = 'text-onBackground dark:text-darkOnBackground mt-2';
                packageInfo.textContent = 'All necessary add-ons are included in this package price.';
                addonsContainer.appendChild(packageInfo);
            }
            
            // Disable the container
            addonsContainer.classList.add('opacity-70');
            
            return; // Don't continue to add checkboxes
        } else {
            // Enable the container
            addonsContainer.classList.remove('opacity-70');
        }
        
        // For regular services, don't add a title - just display the add-on checkboxes
        console.log('Rendering addons, count:', addonsData.length);
        
        // Create and append each addon checkbox
        if (addonsData.length > 0) {
            const checkboxContainer = document.createElement('div');
            checkboxContainer.className = 'flex flex-col gap-[12px]';
            addonsContainer.appendChild(checkboxContainer);
            
            addonsData.forEach(addon => {
                console.log('Creating addon element for:', addon.name);
                
                // Create the checkbox wrapper
                const itemDiv = document.createElement('div');
                itemDiv.className = 'flex items-center gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px]';
                
                // Create checkbox input
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'addons[]';
                checkbox.value = addon.name;
                checkbox.className = 'w-[16px] h-[16px] bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo accent-primary dark:accent-darkPrimary rounded-[4px]';
                checkbox.id = 'addon_' + addon.name.replace(/\s+/g, '_').toLowerCase();
                
                // Create content container
                const contentDiv = document.createElement('div');
                contentDiv.className = 'flex flex-col gap-[8px]';
                
                // Add addon name
                const nameP = document.createElement('p');
                nameP.className = 'leading-none BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground';
                nameP.textContent = addon.name;
                
                // Add details container
                const detailsDiv = document.createElement('div');
                detailsDiv.className = 'flex gap-[8px]';
                
                // Add duration text
                const durationP = document.createElement('p');
                durationP.className = 'leading-none CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo';
                durationP.textContent = '+ 30 minutes'; // Assuming standard duration
                
                // Add price text
                const priceP = document.createElement('p');
                priceP.className = 'leading-none CaptionOne text-primary dark:text-darkPrimary';
                priceP.textContent = '₱' + addon.price;
                
                // Assemble the elements
                detailsDiv.appendChild(durationP);
                detailsDiv.appendChild(priceP);
                contentDiv.appendChild(nameP);
                contentDiv.appendChild(detailsDiv);
                itemDiv.appendChild(checkbox);
                itemDiv.appendChild(contentDiv);
                
                // Add to container
                checkboxContainer.appendChild(itemDiv);
            });
        } else {
            // If no addons available, show message
            const noAddonsMsg = document.createElement('p');
            noAddonsMsg.className = 'text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-center p-4';
            noAddonsMsg.textContent = 'No add-ons available';
            addonsContainer.appendChild(noAddonsMsg);
        }
    }

    // Add event listener for service selection change
    if (serviceDropdown) {
        serviceDropdown.addEventListener('change', function() {
            const selectedServiceId = parseInt(this.value);
            console.log('Service selection changed to ID:', selectedServiceId);
            
            const selectedService = servicesData.find(service => service.id === selectedServiceId);
            
            if (selectedService) {
                updateDurationOptions(selectedService);
                updatePartySizeOptions(selectedService);
                updateMassageOptions(selectedService);
                updateBodyScrubOptions(selectedService);
                updateAddonOptions(selectedService);
            } else {
                console.error('Selected service not found in servicesData');
            }
        });
    } else {
        console.error('Service dropdown not found');
    }

    // Initialize addon section
    async function initializeAddonSection() {
        console.log('Initializing addon section');
        
        // Fetch addons data
        addonsData = await fetchAddonsData();
        console.log('Addon initialization complete, found addons:', addonsData.length);
        
        // Update addons for current selected service if available
        if (serviceDropdown && servicesData.length > 0) {
            const selectedServiceId = parseInt(serviceDropdown.value);
            const selectedService = servicesData.find(service => service.id === selectedServiceId);
            if (selectedService) {
                updateAddonOptions(selectedService);
            }
        }
    }

    // Initial data fetch
    fetchData().then(() => {
        // After services are loaded, initialize addons
        initializeAddonSection();
    });
});