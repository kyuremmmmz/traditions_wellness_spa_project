class ServiceRenderer {
    constructor(domElements) {
        this.domElements = domElements;
    }
    
    renderArchivedServices(data) {
        const targetSection = this.domElements.archivedSection;
        if (!targetSection) return;
        
        targetSection.innerHTML = '';
        if (data.length === 0) {
            targetSection.innerHTML = '<p class="text-center text-onBackgroundTwo dark:text-darkOnBackgroundTwo">No services found.</p>';
            return;
        }
        
        targetSection.innerHTML = data.map((item) => this.createServiceCardHTML(item)).join('');
        this.addEventListenersToButtons(targetSection);
    }
    
    renderActiveServices(data) {
        const targetSection = this.domElements.allServicesSection;
        if (!targetSection) return;
        
        targetSection.innerHTML = '';
        if (data.length === 0) {
            targetSection.innerHTML = '<p class="text-center text-onBackgroundTwo dark:text-darkOnBackgroundTwo">No services found.</p>';
            return;
        }
        
        targetSection.innerHTML = data.map((item) => this.createServiceCardHTML(item)).join('');
        this.addEventListenersToButtons(targetSection);
    }
    
    renderData(data, category) {
        let targetSection;
        if (category === 'Massages') targetSection = this.domElements.massagesSection;
        else if (category === 'Body Scrubs') targetSection = this.domElements.bodyScrubsSection;
        else if (category === 'Packages') targetSection = this.domElements.packagesSection;
        else return;
        
        if (!targetSection) {
            console.error(`Error: Target section for ${category} not found in the DOM.`);
            return;
        }
        
        targetSection.innerHTML = '';
        if (data.length === 0) {
            category = category.toLowerCase();
            targetSection.innerHTML = `<p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none">No active ${category} services found.</p>`;
            return;
        }
        
        data.forEach(item => {
            const element = document.createElement('div');
            element.className = 'service-item';
            element.innerHTML = this.createServiceCardHTML(item);
            targetSection.appendChild(element);
        });
        
        this.addEventListenersToButtons(targetSection);
    }
    
    addEventListenersToButtons(container) {
        container.querySelectorAll('.service-btn').forEach(button => {
            button.addEventListener('click', () => {
                const serviceData = {};
                // Extract all data attributes
                Object.keys(button.dataset).forEach(key => {
                    if (key.startsWith('service')) {
                        // Convert from data-service-name to just name
                        const propName = key.replace('service', '').charAt(0).toLowerCase() + key.replace('service', '').slice(1);
                        serviceData[propName] = button.dataset[key];
                    }
                });
                
                // Use the existing UpdateServiceDOM instead of formHandler
                window.UpdateServiceDOM.populateServiceDrawer(serviceData);
                const drawer = document.getElementById('UpdateServiceSection');
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    drawer.classList.remove('translate-x-full');
                    drawer.classList.add('translate-x-0');
                }, 100);
            });
        });
    }
    
    createServiceCardHTML(item) {
        return `
            <div>
                <button class="service-btn w-[365px] h-[84px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]"
                        data-service-id="${item.id || ''}"
                        data-service-name="${item.serviceName || ''}"
                        data-service-description="${item.description || ''}"
                        data-service-fixed-price="${item.fixed_price || '0.00'}"
                        data-service-rating="${item.rating || '0.0'}"
                        data-service-category="${item.category || ''}"
                        data-service-status="${item.status || ''}"
                        data-service-main-photo="${item.main_photo || 'default-image.jpg'}"
                        data-service-caption="${item.caption || ''}"
                        data-service-duration-details="${item.duration_details || ''}"
                        data-service-party-size-details="${item.party_size_details || ''}"
                        data-service-massage-details="${item.massage_details || ''}"
                        data-service-body-scrub-details="${item.body_scrub_details || ''}"
                        data-service-add-ons-details="${item.add_ons_details || ''}"
                        data-service-slide-show-photos="${item.slide_show_photos || ''}"
                        data-service-showcase-photo1="${item.showcase_photo1 || ''}"
                        data-service-headline1="${item.headline1 || ''}"
                        data-service-caption1="${item.caption1 || ''}"
                        data-service-showcase-photo2="${item.showcase_photo2 || ''}"
                        data-service-headline2="${item.headline2 || ''}"
                        data-service-caption2="${item.caption2 || ''}"
                        data-service-showcase-photo3="${item.showcase_photo3 || ''}"
                        data-service-headline3="${item.headline3 || ''}"
                        data-service-caption3="${item.caption3 || ''}"
                        data-service-massage-selection="${item.massage_selection || ''}"
                        data-service-body-scrub-selection="${item.body_scrub_selection || ''}"
                        data-service-supplemental-add-ons="${item.supplemental_add_ons || ''}"
                        data-service-party-size="${item.party_size || ''}"
                        data-service-one-hour-price="${item.one_hour_price || '0.00'}"
                        data-service-one-hour-thirty-price="${item.one_hour_thirty_price || '0.00'}"
                        data-service-two-hour-price="${item.two_hour_price || '0.00'}">
                    <div class="w-[64px]">
                        <img src="${item.main_photo || 'default-image.jpg'}" class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary" alt="${item.serviceName}">
                    </div>
                    <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                        <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${item.serviceName}</p>
                        <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none h-[13px] w-full truncate">${item.description || 'No description available'}</p>
                        <div class="flex gap-[8px] w-full">
                            <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none w-full text-left">₱${item.fixed_price || '0.00'}</p>
                        </div>
                    </div>
                </button>
            </div>
        `;
    }
}