class AppointmentForm {
    constructor() {
        this.openButton = document.getElementById("openBookAnAppointmentButton");
        this.section = document.getElementById("bookAnAppointmentSection");
        this.closeButton = document.getElementById("closeBookAnAppointmentButton");
        this.unsavedModal = document.getElementById("UnsavedProgressModal");
        this.cancelButton = document.getElementById("closeUnsavedProgressButton");
        this.proceedButton = document.getElementById("proceedUnsavedProgressButton");
        this.bookButton = document.getElementById("BookButton");
        this.confirmModal = document.getElementById("ConfirmAppointmentModal");
        this.cancelAppointmentButton = document.getElementById("cancelAppointmentButton");
        this.confirmAppointmentButton = document.getElementById("confirmAppointmentButton");
        this.newGuestCustomerButton = document.getElementById("newGuestCustomerButton");
        this.existingCustomerButton = document.getElementById("existingCustomerButton");
        this.existingCustomerSection = document.getElementById("existingCustomerSection");
        this.newGuestCustomerSection = document.getElementById("newGuestCustomerSection");
        this.hasUnsavedChanges = false;
        this.updateModal = document.getElementById("updateModal");

        
        // Tab navigation elements
        this.tabButtons = {
            summary: document.getElementById("showSummary"),
            serviceBooked: document.getElementById("showServiceBooked"),
            assignment: document.getElementById("showAssignment"),
            payment: document.getElementById("showPayment")
        };
        
        this.tabSections = {
            summary: document.getElementById("summarySection"),
            serviceBooked: document.getElementById("serviceBookedSection"),
            assignment: document.getElementById("assignmentSection"),
            payment: document.getElementById("paymentSection")
        };
        
        this.activeTab = "summary"; // Default active tab

        // Set default section visibility
        this.newGuestCustomerSection.style.display = "flex";
        this.newGuestCustomerSection.classList.add("opacity-100");
        this.existingCustomerSection.style.display = "none";

        // Update form modals
        this.updateUnsavedModal = document.getElementById("UpdateUnsavedProgressModal");
        this.closeUpdateUnsavedButton = document.getElementById("closeUpdateUnsavedProgressButton");
        this.proceedUpdateUnsavedButton = document.getElementById("proceedUpdateUnsavedProgressButton");
        
        this.updateConfirmModal = document.getElementById("UpdateConfirmModal");
        this.cancelUpdateButton = document.getElementById("cancelUpdateButton");
        this.confirmUpdateButton = document.getElementById("confirmUpdateButton");
        
        this.finishAppointmentModal = document.getElementById("FinishAppointmentModal");
        this.cancelFinishButton = document.getElementById("cancelFinishButton");
        this.confirmFinishButton = document.getElementById("confirmFinishButton");
        
        // Update form buttons
        this.closeModalButton = document.getElementById("closeModal");
        this.saveModalButton = document.getElementById("saveModal");
        this.finishAppointmentButton = document.getElementById("finishappointment");
        this.cancelAppointmentButton = document.getElementById("cancelAppointment");
        
        this.hasUpdateChanges = false;

        this.initializeEventListeners();
        this.initializeUpdateFormEventListeners(); // Add this line
    }

    // Add these new methods
    trackUpdateFormChanges() {
        const updateForm = document.querySelector('form[action="/updateAppointment"]');
        const inputs = updateForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            ['input', 'change'].forEach(eventType => {
                input.addEventListener(eventType, () => {
                    this.hasUpdateChanges = true;
                });
            });
        });
    }
        
    showUpdateModal() {
        const updateModal = this.updateModal;
        const modalContent = updateModal.querySelector('div:first-child');
        
        // First show the modal
        updateModal.classList.remove("hidden");
        updateModal.offsetHeight; // Force reflow
        updateModal.classList.remove("opacity-0");
        updateModal.classList.add("opacity-100");
        
        // Then animate the content
        modalContent.classList.remove("opacity-0", "scale-95");
        modalContent.classList.add("opacity-100", "scale-100");
        
        // Reset to summary tab
        this.setActiveTab("summary");
    }

    handleUpdateClose() {
        if (this.hasUpdateChanges) {
            this.showUpdateUnsavedModal();
        } else {
            const updateModal = this.updateModal;
            const modalContent = updateModal.querySelector('div:first-child');
            
            updateModal.classList.remove("opacity-100");
            updateModal.classList.add("opacity-0");
            modalContent.classList.remove("scale-100");
            modalContent.classList.add("scale-95");
            
            setTimeout(() => {
                updateModal.classList.add("hidden");
                this.setActiveTab("summary"); // Reset to summary tab
            }, 300);
            this.hasUpdateChanges = false;
        }
    }

    handleUpdateProceed() {
        const updateModal = this.updateModal;
        const modalContent = updateModal.querySelector('div');
        
        updateModal.classList.add("opacity-0");
        modalContent.classList.add("opacity-0", "scale-95");
        
        setTimeout(() => {
            updateModal.classList.add("hidden");
            this.setActiveTab("summary"); // Reset to summary tab
        }, 300);
        this.resetUpdateFields();
        this.hideUpdateUnsavedModal();
        this.hasUpdateChanges = false;
    }

    showUpdateUnsavedModal() {
        this.updateUnsavedModal.classList.remove("hidden");
    }

    hideUpdateUnsavedModal() {
        this.updateUnsavedModal.classList.add("hidden");
    }

    closeUpdateForm() {
        this.updateModal.classList.add("hidden");
        this.hasUpdateChanges = false;
    }

    // Update form modal listeners
    initializeUpdateFormEventListeners() {
        this.closeModalButton.addEventListener("click", () => this.handleUpdateClose());
        
        // Update unsaved progress modal
        this.closeUpdateUnsavedButton.addEventListener("click", () => this.hideUpdateUnsavedModal());
        this.proceedUpdateUnsavedButton.addEventListener("click", () => this.handleUpdateProceed());
        
        // Track changes in update form
        this.trackUpdateFormChanges();

        // Add save modal button listener to show confirmation modal
        this.saveModalButton.addEventListener("click", () => {
            this.updateConfirmModal.classList.remove("hidden");
        });

        // Add cancel button listener for update confirmation modal
        this.cancelUpdateButton.addEventListener("click", () => {
            this.updateConfirmModal.classList.add("hidden");
        });

        // Add confirm update button listener to submit the form
        this.confirmUpdateButton.addEventListener("click", () => {
            const updateForm = document.querySelector('form[action="/updateAppointment"]');
            updateForm.submit();
        });
        
        // Track changes in update form
        this.trackUpdateFormChanges();
    }

    resetUpdateFields() {
        const updateForm = document.querySelector('form[action="/updateAppointment"]');
        const inputs = updateForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else if (input.tagName.toLowerCase() === 'select') {
                input.selectedIndex = 0;
            } else {
                input.value = '';
            }
        });
        this.hasUpdateChanges = false;

    // Add new elements
    this.searchInput = document.getElementById('search_customer');
    this.searchResults = document.getElementById('searchResults');
    this.selectedCustomerInfo = document.getElementById('selectedCustomerInfo');
    this.resetCustomerButton = document.getElementById('resetCustomerSelection');
    this.existingCustomerId = document.getElementById('existingCustomerId');
    
    this.initializeEventListeners();
    }
    
    initializeEventListeners() {
        this.openButton.addEventListener("click", () => this.openForm());
        this.closeButton.addEventListener("click", () => this.handleClose());
        this.cancelButton.addEventListener("click", () => this.hideModal());
        this.proceedButton.addEventListener("click", () => this.handleProceed());
        this.bookButton.addEventListener("click", (e) => {
            e.preventDefault();
            // Let AppointmentValidation handle the validation and modal display
            // Do not show confirmation modal here
        });
        this.cancelAppointmentButton.addEventListener("click", () => this.hideConfirmModal());
        this.confirmAppointmentButton.addEventListener("click", () => this.handleConfirmAppointment());
        this.trackFormChanges();

        // Add customer search related listeners
        if (this.searchInput) {
            this.searchInput.addEventListener('input', debounce(() => this.handleCustomerSearch(), 300));
        }
        
        if (this.resetCustomerButton) {
            this.resetCustomerButton.addEventListener('click', () => this.resetCustomerSelection());
        }

        // Add event listeners for customer type buttons
        this.newGuestCustomerButton.addEventListener("click", () => {
            this.newGuestCustomerButton.classList.add('border-primary', 'dark:border-darkPrimary');
            this.existingCustomerButton.classList.remove('border-primary', 'dark:border-darkPrimary');
            this.existingCustomerSection.classList.remove("opacity-100");
            this.existingCustomerSection.classList.add("opacity-0");
            setTimeout(() => {
                this.existingCustomerSection.style.display = "none";
                this.newGuestCustomerSection.style.display = "flex";
                this.newGuestCustomerSection.classList.remove("opacity-0");
                this.newGuestCustomerSection.classList.add("opacity-100");
            }, 300);
        });

        this.existingCustomerButton.addEventListener("click", () => {
            this.existingCustomerButton.classList.add('border-primary', 'dark:border-darkPrimary');
            this.newGuestCustomerButton.classList.remove('border-primary', 'dark:border-darkPrimary');
            this.newGuestCustomerSection.classList.remove("opacity-100");
            this.newGuestCustomerSection.classList.add("opacity-0");
            setTimeout(() => {
                this.newGuestCustomerSection.style.display = "none";
                this.existingCustomerSection.style.display = "flex";
                this.existingCustomerSection.classList.remove("opacity-0");
                this.existingCustomerSection.classList.add("opacity-100");
            }, 300);
        });
        
        // Initialize tab navigation
        this.initializeTabNavigation();
    }
    
    initializeTabNavigation() {
        // Set initial active tab
        this.setActiveTab("summary");
        
        // Add click event listeners to tab buttons
        Object.keys(this.tabButtons).forEach(tabName => {
            this.tabButtons[tabName].addEventListener("click", () => {
                this.setActiveTab(tabName);
            });
        });
    }
    
    setActiveTab(tabName) {
        const currentTab = this.activeTab;
        const direction = this.getSlideDirection(currentTab, tabName);
        
        // Remove active class from all buttons
        Object.keys(this.tabButtons).forEach(name => {
            this.tabButtons[name].classList.remove("text-primary", "dark:text-darkPrimary", "border-b-[5px]", "border-primary", "dark:border-darkPrimary");
        });
        
        // Add active class to selected button
        this.tabButtons[tabName].classList.add("text-primary", "dark:text-darkPrimary", "border-b-[5px]", "border-primary", "dark:border-darkPrimary");

        // Animate sections
        Object.keys(this.tabSections).forEach(name => {
            const section = this.tabSections[name];
            if (name === tabName) {
                // Prepare new section for animation
                section.classList.remove('hidden');
                section.style.transform = `translateX(${direction === 'right' ? '100%' : '-100%'})`;
                
                // Force reflow
                section.offsetHeight;
                
                // Slide in
                section.style.transform = 'translateX(0)';
            } else if (name === currentTab) {
                // Slide out current section
                section.style.transform = `translateX(${direction === 'right' ? '-100%' : '100%'})`;
                
                // Hide after animation
                setTimeout(() => {
                    section.classList.add('hidden');
                    section.style.transform = '';
                }, 300);
            } else {
                // Hide other sections
                section.classList.add('hidden');
                section.style.transform = '';
            }
        });
        
        this.activeTab = tabName;
    }

    getSlideDirection(currentTab, newTab) {
        const tabOrder = ['summary', 'serviceBooked', 'assignment', 'payment'];
        const currentIndex = tabOrder.indexOf(currentTab);
        const newIndex = tabOrder.indexOf(newTab);
        return newIndex > currentIndex ? 'right' : 'left';
    }

    showConfirmModal() {
        // This method should only be called after validation passes
        this.confirmModal.classList.remove("hidden");
    }

    hideConfirmModal() {
        this.confirmModal.classList.add("hidden");
    }

    handleConfirmAppointment() {
        const form = document.getElementById('appointmentForm');
        if (form) {
            // Get the validation instance
            const validation = form.validation;
            if (validation && validation.validateForm()) {
                // Only submit if validation passes
                const submitEvent = new Event('submit', {
                    bubbles: true,
                    cancelable: true
                });
                Object.defineProperty(submitEvent, 'submitter', {
                    value: document.getElementById('confirmAppointmentButton'),
                    enumerable: true
                });
                form.dispatchEvent(submitEvent);
            }
        }
    }

    trackFormChanges() {
        const inputs = this.section.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            ['input', 'change'].forEach(eventType => {
                input.addEventListener(eventType, () => {
                    this.hasUnsavedChanges = true;
                });
            });
        });
    }

    openForm() {
        this.section.classList.remove("translate-x-full");
        document.body.classList.add("overflow-hidden");
        this.hasUnsavedChanges = false;
    }

    handleClose() {
        if (this.hasUnsavedChanges) {
            this.showModal();
        } else {
            this.closeForm();
        }
    }

    handleProceed() {
        this.resetFields();
        this.hideModal();
        this.closeForm();
    }

    resetFields() {
        const inputs = this.section.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else if (input.tagName.toLowerCase() === 'select') {
                input.selectedIndex = 0;
            } else {
                input.value = '';
            }
        });
    }

    showModal() {
        this.unsavedModal.classList.remove("hidden");
    }

    hideModal() {
        this.unsavedModal.classList.add("hidden");
    }

    closeForm() {
        this.section.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");
        this.hasUnsavedChanges = false;
    }

    // Update form modal listeners
    initializeUpdateFormEventListeners() {
        this.closeModalButton.addEventListener("click", () => this.handleUpdateClose());
        
        // Update unsaved progress modal
        this.closeUpdateUnsavedButton.addEventListener("click", () => this.hideUpdateUnsavedModal());
        this.proceedUpdateUnsavedButton.addEventListener("click", () => this.handleUpdateProceed());
        
        // Track changes in update form
        this.trackUpdateFormChanges();

        // Add save modal button listener to show confirmation modal
        this.saveModalButton.addEventListener("click", () => {
            this.updateConfirmModal.classList.remove("hidden");
        });

        // Add cancel button listener for update confirmation modal
        this.cancelUpdateButton.addEventListener("click", () => {
            this.updateConfirmModal.classList.add("hidden");
        });

        // Add confirm update button listener to submit the form
        this.confirmUpdateButton.addEventListener("click", () => {
            const updateForm = document.querySelector('form[action="/updateAppointment"]');
            updateForm.submit();
        });
        
        // Track changes in update form
        this.trackUpdateFormChanges();
    }

    async handleCustomerSearch() {
        const searchTerm = this.searchInput.value.trim();
        if (searchTerm.length < 2) {
            this.searchResults.innerHTML = '';
            this.searchResults.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch('/searchCustomer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ search: searchTerm })
            });

            const customers = await response.json();
            this.displaySearchResults(customers);
        } catch (error) {
            console.error('Error searching customers:', error);
        }
    }

    displaySearchResults(customers) {
        this.searchResults.innerHTML = '';
        this.searchResults.classList.remove('hidden');
        
        if (customers.length === 0) {
            this.searchResults.innerHTML = `
                <div class="p-4 text-onBackgroundTwo dark:text-darkOnBackgroundTwo">
                    No customers found
                </div>
            `;
            return;
        }

        customers.forEach(customer => {
            const resultDiv = document.createElement('div');
            resultDiv.className = 'p-4 cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface border-b border-borderTwo dark:border-darkBorderTwo';
            resultDiv.innerHTML = `
                <div class="BodyTwo text-onBackground dark:text-darkOnBackground">
                    ${customer.first_name} ${customer.last_name}
                </div>
                <div class="CaptionTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">
                    ${customer.email}
                </div>
            `;

            resultDiv.addEventListener('click', () => this.selectCustomer(customer));
            this.searchResults.appendChild(resultDiv);
        });
    }

    selectCustomer(customer) {
        this.searchResults.classList.add('hidden');
        this.searchInput.value = `${customer.first_name} ${customer.last_name}`;
        this.existingCustomerId.value = customer.id;
        
        // Update customer info display
        const nameElement = this.selectedCustomerInfo.querySelector('[data-field="Customer Name"]');
        const genderElement = this.selectedCustomerInfo.querySelector('[data-field="Gender"]');
        const emailElement = this.selectedCustomerInfo.querySelector('[data-field="Email"]');
        
        if (nameElement) nameElement.textContent = `${customer.first_name} ${customer.last_name}`;
        if (genderElement) genderElement.textContent = customer.gender;
        if (emailElement) emailElement.textContent = customer.email;

        this.selectedCustomerInfo.classList.remove('hidden');
    }

    resetCustomerSelection() {
        this.searchInput.value = '';
        this.existingCustomerId.value = '';
        this.selectedCustomerInfo.classList.add('hidden');
        this.searchResults.classList.add('hidden');
    }
}

// Debounce utility function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
document.addEventListener("DOMContentLoaded", () => {
    new AppointmentForm();
});
