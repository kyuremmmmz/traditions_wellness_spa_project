document.addEventListener('DOMContentLoaded', function () {
    // Define base URL and DOM elements
    let baseUrl = 'http://localhost:8000';
    let massagesSection = document.getElementById('massagesSection');
    let bodyScrubsSection = document.getElementById('bodyScrubsSection');
    let packagesSection = document.getElementById('packagesSection');
    let archived = document.getElementById('archivedServicesSection');

    // Debug DOM elements
    console.log('Massages section:', massagesSection);
    console.log('Body Scrubs section:', bodyScrubsSection);
    console.log('Packages section:', packagesSection);
    console.log('Archived section element:', archived);
    const fetchData = async (category) => {
        try {
            const response = await fetch(`${baseUrl}/findCategory/${encodeURIComponent(category)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            if (response.ok) {
                renderData(data, category);
            } else {
                console.error('Server error:', data);
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    };

    const fetchDataAsArchived = async () => {
        try {
            const response = await fetch(`${baseUrl}/findArchives`, {
                method: 'GET',
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
            console.log('Fetched archived data:', data);
            renderServices(data);
        } catch (error) {
            console.error('Fetch error:', error);
            let targetSection = archived;
            if (targetSection) {
                targetSection.innerHTML = '<p class="text-center text-red-500">Failed to load archived services.</p>';
            }
        }
    };

    // Render archived services (restored to original map design)
    const renderServices = (data) => {
        let targetSection = archived;
        if (!targetSection) {
            console.error('Error: #archivedServicesSection not found in the DOM.');
            return;
        }
        targetSection.innerHTML = '';
        if (data.length === 0) {
            targetSection.innerHTML = '<p class="text-center">No services found.</p>';
            return;
        }
        targetSection.innerHTML = data.map((item) => {
            return `
                <div>
                    <button class="w-[365px] h-[84px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]">
                        <div class="w-[64px]">
                            <img src="${item.main_photo || 'default-image.jpg'}" class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary" alt="${item.serviceName}">
                        </div>
                        <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                            <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${item.serviceName}</p>
                            <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none h-[13px] w-full truncate">${item.description || 'No description available'}</p>
                            <div class="flex gap-[8px] w-full">
                                <div class="flex gap-[4px]">
                                    <p class="CaptionOne text-onBackground leading-none dark:text-darkOnBackground truncate">${item.rating || '0.0'}</p>
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="orange" stroke="orange">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                </div>
                                <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none w-full text-left">₱${item.price || '0.00'}</p>
                            </div>
                        </div>
                    </button>
                </div>
            `;
        }).join('');
    };
    const renderData = (data, category) => {
        let targetSection;
        if (category === 'Massages') targetSection = massagesSection;
        else if (category === 'Body Scrubs') targetSection = bodyScrubsSection;
        else if (category === 'Packages') targetSection = packagesSection;
        else return;
        if (!targetSection) {
            console.error(`Error: Target section for ${category} not found in the DOM.`);
            return;
        }
        targetSection.innerHTML = '';
        if (data.length === 0) {
            targetSection.innerHTML = '<p class="text-center">No services found.</p>';
            return;
        }
        data.forEach(item => {
            const element = document.createElement('div');
            element.className = 'service-item';
            element.innerHTML = `
                <button class="w-[365px] h-[84px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]">
                    <div class="w-[64px]">
                        <img src="${item.main_photo || 'default-image.jpg'}" class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary" alt="${item.serviceName}">
                    </div>
                    <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                        <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">${item.serviceName}</p>
                        <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none h-[13px] w-full truncate">${item.description || 'No description available'}</p>
                        <div class="flex gap-[8px] w-full">
                            <div class="flex gap-[4px]">
                                <p class="CaptionOne text-onBackground leading-none dark:text-darkOnBackground truncate">${item.rating || '0.0'}</p>
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="orange" stroke="orange">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </div>
                            <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none w-full text-left">₱${item.price || '0.00'}</p>
                        </div>
                    </div>
                </button>
            `;
            targetSection.appendChild(element);
        });
    };

    const sectionDecisions = () => {
        const showMassages = document.getElementById('showMassages');
        const showBodyScrubs = document.getElementById('showBodyScrubs');
        const showPackages = document.getElementById('showPackages');
        const showAddOns = document.getElementById('showAddOns');
        const showArchivedServices = document.getElementById('showArchivedServices');
        const showArchivedAddOns = document.getElementById('showArchivedAddOns');

        console.log('Tab buttons:', { showMassages, showBodyScrubs, showPackages, showAddOns, showArchivedServices, showArchivedAddOns });
        if (showMassages) showMassages.addEventListener('click', () => fetchData('Massages'));
        if (showBodyScrubs) showBodyScrubs.addEventListener('click', () => fetchData('Body Scrubs'));
        if (showPackages) showPackages.addEventListener('click', () => fetchData('Packages'));
        if (showAddOns) showAddOns.addEventListener('click', () => fetchData('Add Ons'));
        if (showArchivedServices) showArchivedServices.addEventListener('click', () => fetchDataAsArchived());
        if (showArchivedAddOns) showArchivedAddOns.addEventListener('click', () => fetchData('Archived Add Ons'));
    };

    sectionDecisions();
    fetchDataAsArchived();
});