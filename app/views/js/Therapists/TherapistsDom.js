
document.addEventListener('DOMContentLoaded', function() {
    class TherapistsManager {
        constructor() {
            // Initialize elements
            this.addServiceSection = document.getElementById('addAServiceSection');
            this.openAddServiceButton = document.getElementById('openAddANewServiceSectionButton');
            this.closeAddServiceButton = document.getElementById('closeAddATherapistSectionButton');
            this.addTherapistForm = document.getElementById('addATherapistForm');
            this.addTherapistButton = document.getElementById('addTherapistButton');
            
            // Initialize modals and their buttons
            this.unsavedModal = document.getElementById('UnsavedProgressModal');
            this.closeUnsavedButton = document.getElementById('closeUnsavedProgressButton');
            this.proceedUnsavedButton = document.getElementById('proceedUnsavedProgressButton');
            
            this.confirmModal = document.getElementById('ConfirmAddAServiceModal');
            this.cancelConfirmButton = document.getElementById('cancelButton');
            this.confirmButton = document.getElementById('confirmButton');
            
            // Track form state
            this.initialFormState = {};
            this.hasChanges = false;
            
            // Initialize event listeners
            this.initializeEventListeners();
            this.captureInitialFormState();
        }

        initializeEventListeners() {
            // Section listeners
            this.openAddServiceButton?.addEventListener('click', () => this.openAddServiceSection());
            this.closeAddServiceButton?.addEventListener('click', () => this.handleCloseSection());
            
            // Form input listeners
            this.addTherapistForm?.addEventListener('input', () => this.checkFormChanges());
            this.addTherapistButton?.addEventListener('click', (e) => this.handleAddTherapist(e));
            
            // Unsaved changes modal listeners
            this.closeUnsavedButton?.addEventListener('click', () => this.hideUnsavedModal());
            this.proceedUnsavedButton?.addEventListener('click', () => this.handleProceedWithoutSaving());
            
            // Confirm modal listeners
            this.cancelConfirmButton?.addEventListener('click', () => this.hideConfirmModal());
            this.confirmButton?.addEventListener('click', () => this.submitForm());
        }

        captureInitialFormState() {
            const formInputs = this.addTherapistForm?.querySelectorAll('input, select');
            formInputs?.forEach(input => {
                this.initialFormState[input.id] = input.value;
            });
        }

        checkFormChanges() {
            const formInputs = this.addTherapistForm?.querySelectorAll('input, select');
            this.hasChanges = false;

            formInputs?.forEach(input => {
                if (input.value !== this.initialFormState[input.id]) {
                    this.hasChanges = true;
                }
            });
        }

        resetForm() {
            this.addTherapistForm?.reset();
            this.captureInitialFormState();
            this.hasChanges = false;
        }

        handleCloseSection() {
            if (this.hasChanges) {
                this.showUnsavedModal();
            } else {
                this.closeAddServiceSection();
            }
        }

        handleAddTherapist(e) {
            e.preventDefault();
            if (this.validateForm()) {
                this.showConfirmModal();
            }
        }

        validateForm() {
            // Validation logic
        }

        // Modal management
        showUnsavedModal() {
            this.unsavedModal?.classList.remove('hidden');
        }

        hideUnsavedModal() {
            this.unsavedModal?.classList.add('hidden');
        }

        showConfirmModal() {
            this.confirmModal?.classList.remove('hidden');
        }

        hideConfirmModal() {
            this.confirmModal?.classList.add('hidden');
        }

        // Section management
        openAddServiceSection() {
            this.addServiceSection?.classList.remove('translate-x-full');
            document.body.classList.add('overflow-hidden');
            this.resetForm();
        }

        closeAddServiceSection() {
            this.addServiceSection?.classList.add('translate-x-full');
            document.body.classList.remove('overflow-hidden');
            this.resetForm();
        }

        handleProceedWithoutSaving() {
            this.hideUnsavedModal();
            this.closeAddServiceSection();
        }

        submitForm() {
            this.addTherapistForm?.submit();
        }
    }

    // Initialize the manager
    const therapistsManager = new TherapistsManager();
});