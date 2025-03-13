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

        // Set default section visibility
        this.newGuestCustomerSection.style.display = "flex";
        this.existingCustomerSection.style.display = "none";

        this.initializeEventListeners();
    }

    initializeEventListeners() {
        this.openButton.addEventListener("click", () => this.openForm());
        this.closeButton.addEventListener("click", () => this.handleClose());
        this.cancelButton.addEventListener("click", () => this.hideModal());
        this.proceedButton.addEventListener("click", () => this.handleProceed());
        this.bookButton.addEventListener("click", () => this.showConfirmModal());
        this.cancelAppointmentButton.addEventListener("click", () => this.hideConfirmModal());
        this.confirmAppointmentButton.addEventListener("click", () => this.handleConfirmAppointment());
        this.trackFormChanges();

        // Add event listeners for customer type buttons
        this.newGuestCustomerButton.addEventListener("click", () => {
            this.existingCustomerSection.style.display = "none";
            this.newGuestCustomerSection.style.display = "flex";
        });

        this.existingCustomerButton.addEventListener("click", () => {
            this.existingCustomerSection.style.display = "flex";
            this.newGuestCustomerSection.style.display = "none";
        });
    }

    showConfirmModal() {
        this.confirmModal.classList.remove("hidden");
    }

    hideConfirmModal() {
        this.confirmModal.classList.add("hidden");
    }

    handleConfirmAppointment() {
        // Here you can add the logic to submit the form or make an API call
        this.hideConfirmModal();
        this.resetFields();
        this.closeForm();
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
}

document.addEventListener("DOMContentLoaded", () => {
    new AppointmentForm();
});