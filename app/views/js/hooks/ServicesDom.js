document.addEventListener("DOMContentLoaded", function () {
    if (window.location.pathname !== '/services') {
        return;
    }
    
    // Add New Service Section handlers
    const openAddServiceButton = document.getElementById("openAddANewServiceSectionButton");
    const openAddOnButton = document.getElementById("openAddANewAddOnSectionButton");
    const addNewAddOnSection = document.getElementById("AddANewAddOnSection");
    const closeAddNewAddOnButton = document.getElementById("closeAddANewAddOnButton");
    const confirmAddOnModal = document.getElementById("ConfirmAddANewAddOnModal");
    const openConfirmAddOnModal = document.querySelector("#openConfirmAddANewAddOnModal");
    let hasAddOnChanges = false;

    // Track changes in all input fields for add-on section
    if (addNewAddOnSection) {
        const addOnInputs = addNewAddOnSection.querySelectorAll('input, textarea, select');
        addOnInputs.forEach(input => {
            input.addEventListener('change', () => {
                hasAddOnChanges = true;
            });
            input.addEventListener('input', () => {
                hasAddOnChanges = true;
            });
        });
    }

    // Modify the open handlers to add history state
    if (openAddServiceButton) {
        openAddServiceButton.addEventListener("click", function () {
            history.pushState(null, '', window.location.pathname);
            addNewServiceSection.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
            setTimeout(() => {
                addNewServiceSection.classList.remove("translate-x-full");
            }, 100);
        });
    }

    // Open Add-On section
    if (openAddOnButton) {        
        openAddOnButton.addEventListener("click", function () {
            history.pushState(null, '', window.location.pathname);
            addNewAddOnSection.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
            setTimeout(() => {
                addNewAddOnSection.classList.remove("translate-x-full");
            }, 100);
        });
    }

    // Close Add-On section
    if (closeAddNewAddOnButton) {
        closeAddNewAddOnButton.addEventListener("click", function () {
            addNewAddOnSection.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
            hasAddOnChanges = false;
            setTimeout(() => {
                addNewAddOnSection.classList.add("hidden");
            }, 200);
        });
    }

    // Open confirmation modal for add-on
    if (openConfirmAddOnModal) {
        openConfirmAddOnModal.addEventListener("click", function () {
            confirmAddOnModal.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
            // Scroll to top when modal opens
            addNewAddOnSection.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        });
    }

    // Close modal when clicking outside
    if (confirmAddOnModal) {
        confirmAddOnModal.addEventListener("click", function (event) {
            if (event.target === confirmAddOnModal) {
                confirmAddOnModal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }
        });
    }
    const addNewServiceSection = document.getElementById("AddANewServiceSection");
    const closeAddNewServiceButton = document.getElementById("closeAddANewServiceButton");
    const unsavedProgressModal = document.getElementById("UnsavedAddANewServiceProgressModal");
    const closeUnsavedProgressButton = document.getElementById("closeUnsavedAddANewServiceProgressButton");
    const proceedUnsavedProgressButton = document.getElementById("proceedUnsavedAddANewServiceProgressButton");
    const confirmModal = document.getElementById("ConfirmAddANewServiceModal");
    let hasChanges = false;

    // Track changes in all input fields
    const inputs = addNewServiceSection.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('change', () => {
            hasChanges = true;
        });
        input.addEventListener('input', () => {
            hasChanges = true;
        });
    });

    function closeAddNewService() {
        if (hasChanges) {
            unsavedProgressModal.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
        } else {
            addNewServiceSection.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
            const form = addNewServiceSection.querySelector('form');
            if (form) form.reset();
            hasChanges = false;
            setTimeout(() => {
                addNewServiceSection.classList.add("hidden");
            }, 300);
        }
    }

    // Remove duplicate event listener and use the closeAddNewService function
    if (closeAddNewServiceButton) {
        closeAddNewServiceButton.addEventListener("click", closeAddNewService);
    }

    // Handle unsaved progress modal buttons
    if (closeUnsavedProgressButton) {
        closeUnsavedProgressButton.addEventListener("click", () => {
            unsavedProgressModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        });
    }

    // Handle unsaved progress modal buttons
    if (proceedUnsavedProgressButton) {
        proceedUnsavedProgressButton.addEventListener("click", () => {
            unsavedProgressModal.classList.add("hidden");
            addNewServiceSection.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
            
            // Reset all input fields
            const allInputs = addNewServiceSection.querySelectorAll('input, textarea, select');
            allInputs.forEach(input => {
                input.value = '';
                input.classList.remove('border-borderHighlight', 'dark:border-darkBorderHighlight');
            });
            
            // Reset any error messages
            const errorMessages = addNewServiceSection.querySelectorAll('.text-destructive');
            errorMessages.forEach(error => {
                error.innerHTML = '&nbsp;';
            });
            
            // Reset form if it exists
            const form = addNewServiceSection.querySelector('form');
            if (form) {
                form.reset();
                // Reset any preview elements if they exist
                const previewElements = form.querySelectorAll('[id^="preview"]');
                previewElements.forEach(element => {
                    element.textContent = '';
                });
            }
            
            hasChanges = false;
        });
    }

    // Close modals when clicking outside
    unsavedProgressModal.addEventListener("click", (event) => {
        if (event.target === unsavedProgressModal) {
            unsavedProgressModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }
    });

    confirmModal.addEventListener("click", (event) => {
        if (event.target === confirmModal) {
            confirmModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }
    });

    // Add near the top of your DOMContentLoaded event handler
    window.addEventListener('popstate', function(event) {
        if (hasChanges && !addNewServiceSection.classList.contains('translate-x-full')) {
            event.preventDefault();
            history.pushState(null, '', window.location.pathname);
            unsavedProgressModal.classList.remove("hidden");
            document.body.classList.add("overflow-hidden");
        }
    });
    
    // Add near the other modal handlers
    const createServiceButton = document.getElementById("openConfirmationModal");
    const cancelAddNewServiceButton = document.getElementById("cancelAddANewServiceButton");
    const confirmAddNewServiceButton = document.getElementById("confirmAddANewServiceButton");

    if (createServiceButton) {
        createServiceButton.addEventListener("click", () => {
            confirmModal.classList.remove("hidden");
            // First store the current scroll position
            document.body.classList.add("overflow-hidden");
            // Scroll to top when modal opens
            addNewServiceSection.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
            addNewServiceSection.classList.remove("overflow-y-auto");
            addNewServiceSection.classList.remove("overflow-x-auto");
            document.body.classList.add("overflow-hidden");
        });
    }

    if (cancelAddNewServiceButton) {
        cancelAddNewServiceButton.addEventListener("click", () => {
            confirmModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            addNewServiceSection.classList.add("overflow-y-auto");
            addNewServiceSection.classList.add("overflow-x-auto");
        });
    }

    if (confirmAddNewServiceButton) {
        confirmAddNewServiceButton.addEventListener("click", () => {
            confirmModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            addNewServiceSection.classList.add("overflow-y-auto");
            addNewServiceSection.classList.add("overflow-x-auto");
            // Form submission will happen automatically since it's a submit button
        });
    }

    // Services tab navigation
    const tabButtons = {
        allServices: document.getElementById("showAllServices"),
        massages: document.getElementById("showMassages"),
        bodyScrubs: document.getElementById("showBodyScrubs"),
        packages: document.getElementById("showPackages"),
        addOns: document.getElementById("showAddOns"),
        archivedServices: document.getElementById("showArchivedServices"),
        archivedAddOns: document.getElementById("showArchivedAddOns")
    };

    const tabSections = {
        allServices: document.getElementById("allServicesSection"),
        massages: document.getElementById("massagesSection"),
        bodyScrubs: document.getElementById("bodyScrubsSection"),
        packages: document.getElementById("packagesSection"),
        addOns: document.getElementById("addOnsSection"),
        archivedServices: document.getElementById("archivedServicesSection"),
        archivedAddOns: document.getElementById("archivedAddOnsSection")
    };

    let activeTab = "allServices"; // Default active tab

    // Function to get slide direction
    const getSlideDirection = (currentTab, newTab) => {
        const tabOrder = Object.keys(tabButtons);
        const currentIndex = tabOrder.indexOf(currentTab);
        const newIndex = tabOrder.indexOf(newTab);
        return newIndex > currentIndex ? 'right' : 'left';
    };

    // Function to set active tab
    const setActiveTab = (tabName) => {
        const currentTab = activeTab;
        const direction = getSlideDirection(currentTab, tabName);

        // Remove active class from all buttons
        Object.keys(tabButtons).forEach(name => {
            tabButtons[name].classList.remove("text-primary", "dark:text-darkPrimary", "border-b-[5px]", "border-primary", "dark:border-darkPrimary");
        });

        // Add active class to selected button
        tabButtons[tabName].classList.add("text-primary", "dark:text-darkPrimary", "border-b-[5px]", "border-primary", "dark:border-darkPrimary");

        // Animate sections
        Object.keys(tabSections).forEach(name => {
            const section = tabSections[name];
            if (name === tabName) {
                // Prepare new section for animation
                section.classList.remove('hidden');
                section.style.transform = `translateX(${direction === 'right' ? '100%' : '-100%'})`;
                section.style.opacity = '0';
                
                // Force reflow
                section.offsetHeight;
                
                // Slide in
                section.style.transform = 'translateX(0)';
                section.style.opacity = '1';
            } else if (name === currentTab) {
                // Slide out current section
                section.style.transform = `translateX(${direction === 'right' ? '-100%' : '100%'})`;
                section.style.opacity = '0';
                setTimeout(() => {
                    section.classList.add('hidden');
                }, 300);
            } else {
                section.classList.add('hidden');
            }
        });

        activeTab = tabName;
    };

    // Initialize tab navigation
    Object.keys(tabButtons).forEach(tabName => {
        if (tabButtons[tabName]) {
            tabButtons[tabName].addEventListener('click', () => {
                setActiveTab(tabName);
            });
        }
    });

    // Set initial active tab
    setActiveTab('allServices');

    // Price type toggle functionality
    const fixedPriceButton = document.getElementById("fixedPriceButton");
    const dynamicPriceButton = document.getElementById("dynamicPriceButton");
    const fixedPriceSection = document.getElementById("fixedPriceSection");
    const dynamicPriceSection = document.getElementById("dynamicPriceSection");

    if (fixedPriceButton && dynamicPriceButton) {
        // Set initial state
        fixedPriceSection.style.display = "flex";
        fixedPriceSection.classList.add("opacity-100");
        dynamicPriceSection.style.display = "none";
        fixedPriceButton.classList.add('border-primary', 'dark:border-darkPrimary');

        fixedPriceButton.addEventListener("click", function() {
            fixedPriceButton.classList.add('border-primary', 'dark:border-darkPrimary');
            dynamicPriceButton.classList.remove('border-primary', 'dark:border-darkPrimary');
            dynamicPriceSection.classList.remove("opacity-100");
            dynamicPriceSection.classList.add("opacity-0");
            setTimeout(() => {
                dynamicPriceSection.style.display = "none";
                fixedPriceSection.style.display = "flex";
                fixedPriceSection.classList.remove("opacity-0");
                fixedPriceSection.classList.add("opacity-100");
            }, 300);
        });

        dynamicPriceButton.addEventListener("click", function() {
            dynamicPriceButton.classList.add('border-primary', 'dark:border-darkPrimary');
            fixedPriceButton.classList.remove('border-primary', 'dark:border-darkPrimary');
            fixedPriceSection.classList.remove("opacity-100");
            fixedPriceSection.classList.add("opacity-0");
            setTimeout(() => {
                fixedPriceSection.style.display = "none";
                dynamicPriceSection.style.display = "flex";
                dynamicPriceSection.classList.remove("opacity-0");
                dynamicPriceSection.classList.add("opacity-100");
            }, 300);
        });
    }
});