class AppointmentValidation {
    constructor() {
        this.form = document.getElementById('appointmentForm');
        this.bookButton = document.getElementById('BookButton');
        this.confirmAppointmentButton = document.getElementById('confirmAppointmentButton');
        this.errorFields = new Map();

        if (!this.form) {
            console.error('Appointment form not found');
            return;
        }

        // Store validation instance on the form element
        this.form.validation = this;

        // Prevent browser's default validation
        this.form.setAttribute('novalidate', true);

        // Initialize error fields mapping
        const fields = {
            'source_of_booking': 'source_of_booking_error',
            'first_name': 'first_name_error',
            'last_name': 'last_name_error',
            'gender': 'gender_error',
            'customer_email': 'customer_email_error',
            'service_booked': 'service_booked_error',
            'date': 'date_error',
            'start_time': 'start_time_error'
        };

        // Set up error fields and their elements
        for (const [fieldName, errorKey] of Object.entries(fields)) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            const errorElement = document.getElementById(errorKey);

            if (field && errorElement) {
                this.errorFields.set(fieldName, {
                    element: field,
                    errorElement,
                    hasError: false
                });

                // Clear error on input
                field.addEventListener('input', () => this.clearError(fieldName));

                // Add blur event for immediate validation
                field.addEventListener('blur', () => {
                    if (!field.value.trim()) {
                        this.setError(fieldName, `${fieldName.replace(/_/g, ' ')} is required`);
                    } else if (fieldName === 'customer_email' && !this.isValidEmail(field.value)) {
                        this.setError(fieldName, 'Please enter a valid email address');
                    }
                });
            } else {
                console.warn(`Field or error element not found for ${fieldName}`);
            }
        }

        // Initialize form submission handler
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));

        // Book button click handler
        if (this.bookButton) {
            this.bookButton.addEventListener('click', (e) => {
                e.preventDefault();
                const isValid = this.validateForm();
                if (isValid) {
                    const confirmModal = document.getElementById('ConfirmAppointmentModal');
                    if (confirmModal) {
                        confirmModal.classList.remove('hidden');
                    }
                }
            });
        }

        // Confirm appointment button handler
        if (this.confirmAppointmentButton) {
            this.confirmAppointmentButton.addEventListener('click', () => {
                if (this.form && this.validateForm()) {
                    this.form.dispatchEvent(new Event('submit'));
                }
            });
        }

        // Customer type radio buttons change handler
        const customerTypeRadios = document.querySelectorAll('input[name="customer_type"]');
        customerTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const customerTypeError = document.getElementById('customerTypeError');
                if (customerTypeError) {
                    customerTypeError.textContent = '';
                    customerTypeError.classList.add('hidden');
                }
                this.validateForm();
            });
        });
    }

    validateForm(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        let hasErrors = false;

        // Clear all previous errors first
        for (const field of this.errorFields.values()) {
            this.clearError(field.element.name);
        }

        // Show error messages immediately
        const showError = (fieldName, message) => {
            this.setError(fieldName, message);
            // Try different error element ID formats
            let errorElement = document.getElementById(`${fieldName}Error`);
            if (!errorElement) {
                // Try with first letter capitalized
                errorElement = document.getElementById(`${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)}Error`);
            }
            if (!errorElement) {
                // Try with original field name
                errorElement = document.getElementById(`${fieldName}_error`);
            }
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            } else {
                console.warn(`Error element not found for ${fieldName}`);
            }
        };

        // Prevent default browser validation
        if (this.form) {
            this.form.setAttribute('novalidate', 'true');
        }

        // Hide confirmation modal at the start of validation
        const confirmModal = document.getElementById('ConfirmAppointmentModal');
        if (confirmModal) {
            confirmModal.classList.add('hidden');
        }

        // Source of Booking validation
        const sourceOfBooking = document.querySelector('[name="source_of_booking"]');
        if (!sourceOfBooking || !sourceOfBooking.value.trim()) {
            showError('source_of_booking', 'Source of booking is required');
            hasErrors = true;
        }

        // Customer Type validation
        const customerType = document.querySelector('input[name="customer_type"]:checked');
        const customerTypeError = document.getElementById('customerTypeError');
        if (!customerType) {
            if (customerTypeError) {
                customerTypeError.textContent = 'Please select a customer type';
                customerTypeError.classList.remove('hidden');
                hasErrors = true;
            }
        } else {
            if (customerTypeError) {
                customerTypeError.textContent = '';
                customerTypeError.classList.add('hidden');
            }

            if (customerType.value === 'new_guest') {
                // Validate required fields for new guest
                const requiredFields = {
                    'first_name': 'First name',
                    'last_name': 'Last name',
                    
                    'customer_email': 'Email'
                };

                for (const [fieldName, label] of Object.entries(requiredFields)) {
                    const field = this.errorFields.get(fieldName);
                    if (field && !field.element.value.trim()) {
                        showError(fieldName, `${label} is required`);
                        hasErrors = true;
                    }
                }

                // Email validation
                const emailField = this.errorFields.get('customer_email');
                if (emailField && emailField.element.value && !this.isValidEmail(emailField.element.value)) {
                    showError('customer_email', 'Please enter a valid email address');
                    hasErrors = true;
                }
            } else if (customerType.value === 'existing') {
                // Validate existing customer selection
                const existingCustomerId = document.querySelector('[name="existing_customer_id"]');
                const existingCustomerError = document.getElementById('existingCustomerError');
                if (!existingCustomerId || !existingCustomerId.value) {
                    if (existingCustomerError) {
                        existingCustomerError.textContent = 'Please select an existing customer';
                        existingCustomerError.classList.remove('hidden');
                        hasErrors = true;
                    }
                } else if (existingCustomerError) {
                    existingCustomerError.textContent = '';
                    existingCustomerError.classList.add('hidden');
                }
            }
        }

        // Service details validation
        const requiredServiceFields = {
            'service_booked': 'Service',
            'date': 'Date',
            'start_time': 'Start time'
        };

        for (const [fieldName, label] of Object.entries(requiredServiceFields)) {
            const field = this.errorFields.get(fieldName);
            if (field && !field.element.value) {
                showError(fieldName, `${label} is required`);
                hasErrors = true;
            }
        }

        // Update the book button state
        this.updateBookButtonState();

        // Only show confirmation modal if there are no errors and it's a book button click
        if (!hasErrors && !e && this.bookButton === document.activeElement) {
            const confirmModal = document.getElementById('ConfirmAppointmentModal');
            if (confirmModal) {
                confirmModal.classList.remove('hidden');
            }
        }

        return !hasErrors;
    }



    clearError(fieldName) {
        const field = this.errorFields.get(fieldName);
        if (field) {
            field.hasError = false;
            field.errorElement.textContent = '';
            field.errorElement.classList.add('hidden');
            field.element.classList.remove('border-red-500');
        }
        this.updateBookButtonState();
    }

    setError(fieldName, message) {
        const field = this.errorFields.get(fieldName);
        if (field) {
            field.hasError = true;
            field.errorElement.textContent = message;
            field.errorElement.classList.remove('hidden');
            field.element.classList.add('border-red-500');
        }
        this.updateBookButtonState();
    }

    updateBookButtonState() {
        const hasErrors = Array.from(this.errorFields.values()).some(field => field.hasError);
        if (this.bookButton) {
            this.bookButton.disabled = hasErrors;
            this.bookButton.classList.toggle('opacity-50', hasErrors);
        }
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
}

// Initialize the form validation when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AppointmentValidation();
});