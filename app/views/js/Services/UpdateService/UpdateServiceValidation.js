document.addEventListener("DOMContentLoaded", function () {
    // Input IDs that require validation - explicitly removing update_duration
    const inputIds = [
        'update_status',
        'update_category',
        'update_service_name',
        'update_caption',
        'update_description',
        'update_duration_details',
        'update_party_size_details',
        'update_main_photo',
        'update_showcase_photo1',
        'update_headline1',
        'update_caption1',
        'update_showcase_photo2',
        'update_headline2',
        'update_caption2',
        'update_showcase_photo3',
        'update_headline3',
        'update_caption3'
        // Removed: update_duration
    ];

    const form = document.getElementById("UpdateServiceForm");
    const submitButton = document.getElementById('openConfirmUpdateServiceModal');
    const categorySelect = document.getElementById("update_category");
    const fixedPriceRadio = document.getElementById("updateFixedPriceButton");
    const dynamicPriceRadio = document.getElementById("updateDynamicPriceButton");
    const fixedPriceSection = document.getElementById("updateFixedPriceSection");
    const dynamicPriceSection = document.getElementById("updateDynamicPriceSection");
    
    // Remove the duration field from the elements object
    const elements = {
        serviceName: {
            element: document.getElementById("update_service_name"),
            errorElement: document.getElementById("update_service_name_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Name is required.";
                if (trimmedValue.length > 30) return "Name must not exceed 30 characters.";
            }
        },
        serviceCaption: {
            element: document.getElementById("update_caption"),
            errorElement: document.getElementById("update_caption_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 40) return "Caption must not exceed 40 characters.";
            }
        },
        serviceDescription: {
            element: document.getElementById("update_description"),
            errorElement: document.getElementById("update_description_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Description is required.";
                if (trimmedValue.length > 100) return "Description must be at least 100 characters.";
            }
        },
        serviceDurationDetails: {
            element: document.getElementById("update_duration_details"),
            errorElement: document.getElementById("update_duration_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Duration details are required.";
                if (trimmedValue.length > 70) return "Duration details must not exceed 70 characters.";
            }
        },
        servicePartySizeDetails: {
            element: document.getElementById("update_party_size_details"),
            errorElement: document.getElementById("update_party_size_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Party Size details are required.";
                if (trimmedValue.length > 70) return "Party size details must not exceed 70 characters.";
            }
        },
        serviceMassageDetails: {
            element: document.getElementById("update_massage_details"),
            errorElement: document.getElementById("update_massage_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Massage details are required.";
                if (trimmedValue.length > 70) return "Massage details must not exceed 70 characters.";
            }        
        },
        serviceBodyScrubDetails: {
            element: document.getElementById("update_body_scrub_details"),
            errorElement: document.getElementById("update_body_scrub_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Body scrub details are required.";
                if (trimmedValue.length > 70) return "Body scrub details must not exceed 70 characters.";
            }        
        },
        serviceAddOnDetails: {
            element: document.getElementById("update_addon_details"),
            errorElement: document.getElementById("update_addon_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue.length > 70) return "Add-on details must not exceed 70 characters.";
            }        
        },
        serviceHeadline1: {
            element: document.getElementById("update_headline1"),
            errorElement: document.getElementById("update_headline1_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            } 
        },
        serviceHeadline2: {
            element: document.getElementById("update_headline2"),
            errorElement: document.getElementById("update_headline2_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            }         
        },
        serviceHeadline3: {
            element: document.getElementById("update_headline3"),
            errorElement: document.getElementById("update_headline3_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            }        
        },
        serviceCaption1: {
            element: document.getElementById("update_caption1"),
            errorElement: document.getElementById("update_caption1_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }         
        },
        serviceCaption2: {
            element: document.getElementById("update_caption2"),
            errorElement: document.getElementById("update_caption2_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }          
        },
        serviceCaption3: {
            element: document.getElementById("update_caption3"),
            errorElement: document.getElementById("update_caption3_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }
        },
        serviceOneHourPrice: {
            element: document.getElementById("update_one_hour_price"),
            errorElement: document.getElementById("update_one_hour_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Price is required.";
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) return "Price cannot contain leading zeros.";
                const price = parseInt(trimmedValue, 10);
                if (isNaN(price)) return "Price must be a number.";
                if (price < 50 || price > 3000) return "Price must be between 50 and 3000.";
                return true;
            }
        },
        serviceOneHourThirtyPrice: {
            element: document.getElementById("update_one_hour_thirty_price"),
            errorElement: document.getElementById("update_one_hour_thirty_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Price is required.";
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) return "Price cannot contain leading zeros.";
                const price = parseInt(trimmedValue, 10);
                if (isNaN(price)) return "Price must be a number.";
                if (price < 50 || price > 3000) return "Price must be between 50 and 3000.";
                return true;
            }
        },
        serviceTwoHourPrice: {
            element: document.getElementById("update_two_hour_price"),
            errorElement: document.getElementById("update_two_hour_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Price is required.";
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) return "Price cannot contain leading zeros.";
                const price = parseInt(trimmedValue, 10);
                if (isNaN(price)) return "Price must be a number.";
                if (price < 50 || price > 3000) return "Price must be between 50 and 3000.";
                return true;
            }
        },
        serviceFixedPrice: {
            element: document.getElementById("update_fixed_price"),
            errorElement: document.getElementById("update_fixed_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Price is required.";
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) return "Price cannot contain leading zeros.";
                const price = parseInt(trimmedValue, 10);
                if (isNaN(price)) return "Price must be a number.";
                if (price < 50 || price > 3000) return "Price must be between 50 and 3000.";
                return true;
            }
        }
    };

    const errors = {};
    const validElements = {};

    function checkElementExistence(field) {
        if (elements[field].element && elements[field].errorElement) {
            validElements[field] = elements[field];
            return true;
        } else {
            console.error(`Element or error element not found for field: ${field}`);
            return false;
        }
    }

    let initialValidationDone = false;

    function validateField(field) {
        if (!validElements[field]) return;
        
        // Skip validation for hidden parent elements
        const parentElement = validElements[field].element.parentElement;
        if (parentElement.style.display === "none") {
            delete errors[field];
            validElements[field].errorElement.textContent = "";
            return;
        }
    
        const value = validElements[field].element.value;
        const trimmedValue = value.trim();
    
        // Skip required validation for add-on details
        if (field === 'serviceAddOnDetails') {
            if (trimmedValue !== "") {
                const validationMessage = validElements[field].handler(value);
                if (validationMessage !== true) {
                    errors[field] = validationMessage;
                } else {
                    delete errors[field];
                }
            } else {
                delete errors[field];
            }
        }
        // Apply normal validation for other fields
        else if (validElements[field].interacted && trimmedValue === "") {
            errors[field] = "This field is required.";
        } else if (trimmedValue !== "") {
            const validationMessage = validElements[field].handler(value);
            if (validationMessage !== true) {
                errors[field] = validationMessage;
            } else {
                delete errors[field];
            }
        } else {
            delete errors[field];
        }
    
        if (initialValidationDone) {
            displayErrors();
        }
    }
    
    Object.keys(elements).forEach(field => {
        if (checkElementExistence(field)) {
            validElements[field].element.addEventListener("focus", () => {
                validElements[field].interacted = true;
            });
    
            validElements[field].element.addEventListener("blur", () => {
                validateField(field);
                if (!initialValidationDone) {
                    initialValidationDone = true;
                    displayErrors();
                }
            });
    
            validElements[field].element.addEventListener("input", () => {
                delete errors[field];
                validElements[field].errorElement.textContent = "";
                validateField(field);
            });
        }
    });

    function displayErrors() {
        Object.keys(validElements).forEach(field => {
            validElements[field].errorElement.textContent = errors[field] || "";
        });
    }

    // Function to validate all fields and display errors
    function validateAllFields() {
        console.log("Starting validation...");
        
        // Force all fields to be "interacted with" to show all errors
        Object.keys(validElements).forEach(field => {
            validElements[field].interacted = true;
            validateField(field);
        });
        
        displayErrors();

        // Validate price fields based on selected price type
        let priceError = false;
        if (fixedPriceRadio.checked) {
            if (!elements.serviceFixedPrice.element.value.trim()) {
                console.log('Error: Fixed price is required');
                errors['serviceFixedPrice'] = "Fixed price is required";
                priceError = true;
            }
        } else if (dynamicPriceRadio.checked) {
            const oneHourPrice = elements.serviceOneHourPrice.element.value.trim();
            const oneHourThirtyPrice = elements.serviceOneHourThirtyPrice.element.value.trim();
            const twoHourPrice = elements.serviceTwoHourPrice.element.value.trim();
            
            if (!oneHourPrice) {
                console.log('Error: 1 Hour price is required');
                errors['serviceOneHourPrice'] = "1 Hour price is required";
                priceError = true;
            }
            if (!oneHourThirtyPrice) {
                console.log('Error: 1 Hour & 30 Minutes price is required');
                errors['serviceOneHourThirtyPrice'] = "1 Hour & 30 Minutes price is required";
                priceError = true;
            }
            if (!twoHourPrice) {
                console.log('Error: 2 Hours price is required');
                errors['serviceTwoHourPrice'] = "2 Hours price is required";
                priceError = true;
            }
        }
        
        displayErrors();
        
        const hasErrors = Object.keys(errors).length > 0 || priceError;
        console.log("Validation complete. Errors found:", hasErrors);
        if (hasErrors) {
            console.log("Error fields:", Object.keys(errors));
        }
        
        return !hasErrors;
    }

    // Add a click handler to the submit button
    submitButton.addEventListener("click", function(event) {
        console.log("Submit button clicked - validating form");
        event.preventDefault();
        
        // Run validation - this will mark all fields as interacted with
        const isValid = validateAllFields();
        console.log(`Form validation result: ${isValid ? 'VALID' : 'INVALID'}`);
        
        if (isValid) {
            console.log("Validation passed - opening confirmation modal");
            // Open the confirmation modal if validation passes
            if (typeof UpdateServiceDOM !== 'undefined' && UpdateServiceDOM.openConfirmUpdateModal) {
                UpdateServiceDOM.openConfirmUpdateModal();
            } else {
                console.error("UpdateServiceDOM is not defined or doesn't have openConfirmUpdateModal method");
                // Fallback - try to show modal directly
                const modal = document.getElementById('ConfirmUpdateServiceModal');
                if (modal) {
                    modal.classList.remove('hidden');
                } else {
                    console.error("Could not find confirmation modal element");
                }
            }
        } else {
            console.log("Validation failed - not showing confirmation modal");
        }
    });

    // Update the submit handler
    document.addEventListener('DOMContentLoaded', function() {
        const confirmButton = document.getElementById('proceedUpdateService');
        if (confirmButton) {
            confirmButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const form = document.getElementById('UpdateServiceForm');
                if (!form) {
                    console.error('Could not find form');
                    return;
                }
                
                // Get category value
                const category = form.querySelector('[name="update_category"]').value;
                
                // Clear any existing selection inputs
                form.querySelectorAll('input[name^="selected_"]').forEach(el => el.remove());
                
                // Add selections based on category
                if (category === 'Packages') {
                    addSelectedValues(form, 'update_massage_selection', 'selected_massages[]');
                    addSelectedValues(form, 'update_body_scrub_selection', 'selected_body_scrubs[]');
                } else if (category === 'Body Scrubs') {
                    addSelectedValues(form, 'update_massage_selection', 'selected_massages[]');
                    addSelectedValues(form, 'update_addon_selection', 'selected_addons[]');
                } else if (category === 'Massages') {
                    addSelectedValues(form, 'update_addon_selection', 'selected_addons[]');
                }
                
                // Log form data before submission
                console.log('Form data before submission:', new FormData(form));
                
                // Submit the form after a brief delay to ensure all inputs are added
                setTimeout(() => {
                    form.submit();
                }, 100);
            });
        }
    });
    
    // Add this new helper function
    function addSelectedValues(form, checkboxName, hiddenInputName) {
        const wrapper = document.getElementById(`${checkboxName}_wrapper`);
        if (!wrapper || wrapper.classList.contains('hidden')) {
            return;
        }
        
        const checkboxes = wrapper.querySelectorAll(`input[name="${checkboxName}[]"]:checked`);
        console.log(`Found ${checkboxes.length} checked checkboxes for ${checkboxName}`);
        
        checkboxes.forEach(checkbox => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = hiddenInputName;
            hiddenInput.value = checkbox.value;
            form.appendChild(hiddenInput);
            console.log(`Added hidden input: ${hiddenInputName} = ${checkbox.value}`);
        });
    }

    categorySelect.addEventListener("change", function () {
        const selectedCategory = categorySelect.value;
        const massageField = elements.serviceMassageDetails.element.parentElement;
        const bodyScrubField = elements.serviceBodyScrubDetails.element.parentElement;
        const addonField = elements.serviceAddOnDetails.element.parentElement;

        if (selectedCategory === "Massages") {
            massageField.style.display = "none";
            bodyScrubField.style.display = "none";
            addonField.style.display = "";
        } else if (selectedCategory === "Body Scrubs") {
            massageField.style.display = "";
            bodyScrubField.style.display = "none";
            addonField.style.display = "";
        } else if (selectedCategory === "Packages") {
            massageField.style.display = "";
            bodyScrubField.style.display = "";
            addonField.style.display = "none";
        } else {
            massageField.style.display = "";
            bodyScrubField.style.display = "";
            addonField.style.display = "";
        }
    });

    categorySelect.dispatchEvent(new Event("change"));

    function updatePriceVisibility() {
        // Find the duration field directly without relying on elements object
        const durationField = document.getElementById("update_duration");
        
        if (fixedPriceRadio.checked) {
            // Show fixed price section, hide dynamic
            fixedPriceSection.style.display = "flex";
            dynamicPriceSection.style.display = "none";
            fixedPriceSection.style.opacity = 1;
            dynamicPriceSection.style.opacity = 0;
            
            // Enable fixed price field
            elements.serviceFixedPrice.element.disabled = false;
            
            // Clear any existing errors
            delete errors.serviceOneHourPrice;
            delete errors.serviceOneHourThirtyPrice;
            delete errors.serviceTwoHourPrice;
            elements.serviceOneHourPrice.errorElement.textContent = "";
            elements.serviceOneHourThirtyPrice.errorElement.textContent = "";
            elements.serviceTwoHourPrice.errorElement.textContent = "";
        } else {
            // Show dynamic price section, hide fixed
            fixedPriceSection.style.display = "none";
            dynamicPriceSection.style.display = "flex";
            fixedPriceSection.style.opacity = 0;
            dynamicPriceSection.style.opacity = 1;
            
            // Disable fixed price field
            elements.serviceFixedPrice.element.disabled = true;
            elements.serviceFixedPrice.element.value = "";
            
            // Clear any existing errors
            delete errors.serviceFixedPrice;
            elements.serviceFixedPrice.errorElement.textContent = "";
        }
        
        // Reset interacted state for price fields
        elements.serviceFixedPrice.interacted = false;
        elements.serviceOneHourPrice.interacted = false;
        elements.serviceOneHourThirtyPrice.interacted = false;
        elements.serviceTwoHourPrice.interacted = false;
        
        // Trigger input event on all service fields to update validation
        Object.keys(elements).filter(key => key.startsWith('service')).forEach(key => {
            if(elements[key].element) {
                elements[key].element.dispatchEvent(new Event('input'));
            }
        });
    }

    // Initialize price visibility on page load
    if (fixedPriceRadio && dynamicPriceRadio && fixedPriceSection && dynamicPriceSection) {
        fixedPriceRadio.addEventListener("change", updatePriceVisibility);
        dynamicPriceRadio.addEventListener("change", updatePriceVisibility);
        
        // Set initial state without validation
        updatePriceVisibility();
    } else {
        console.error('Price visibility elements not found');
    }

    function validateForm() {
        let isValid = true;
        
        // First check standard input fields
        inputIds.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                // Skip validation for hidden fields
                if (input.type === 'hidden') return;
                
                // Skip validation for input elements whose parent is hidden
                const parent = input.parentElement;
                if (parent && parent.style.display === 'none') return;
                
                if (input.type === 'file') {
                    if (!input.files || input.files.length === 0) {
                        console.log(`Validation failed - Missing file: ${id}`);
                        isValid = false;
                    }
                } else if (typeof input.value === 'string' && !input.value.trim()) {
                    console.log(`Validation failed - Empty field: ${id}`);
                    isValid = false;
                }
            }
        });

        // Handle price validation based on price type
        if (fixedPriceRadio.checked) {
            // Fixed price is required
            const fixedPriceField = document.getElementById('update_fixed_price');
            if (fixedPriceField && !fixedPriceField.value.trim()) {
                console.log('Validation failed - Fixed price is required');
                isValid = false;
            }
        } else if (dynamicPriceRadio.checked) {
            // In dynamic price mode, all three price fields are required
            const oneHourPrice = document.getElementById('update_one_hour_price');
            const oneHourThirtyPrice = document.getElementById('update_one_hour_thirty_price');
            const twoHourPrice = document.getElementById('update_two_hour_price');
            
            if (oneHourPrice && !oneHourPrice.value.trim()) {
                console.log('Validation failed - 1 Hour price is required');
                isValid = false;
            }
            if (oneHourThirtyPrice && !oneHourThirtyPrice.value.trim()) {
                console.log('Validation failed - 1 Hour & 30 Minutes price is required');
                isValid = false;
            }
            if (twoHourPrice && !twoHourPrice.value.trim()) {
                console.log('Validation failed - 2 Hours price is required');
                isValid = false;
            }
        }

        console.log(`Form validation result: ${isValid ? 'VALID' : 'INVALID'}`);
        
        // Update submit button state
        if (submitButton) {
            submitButton.disabled = !isValid;
        }
        
        return isValid;
    }

    // Reset validation state - useful when reopening the drawer
    function resetValidation() {
        Object.keys(validElements).forEach(field => {
            validElements[field].interacted = false;
            delete errors[field];
            validElements[field].errorElement.textContent = "";
        });
    }

    // Add event listener for drawer opened event
    document.addEventListener('serviceDrawerOpened', function() {
        resetValidation();
        setTimeout(updatePriceVisibility, 50);
    });
    
    // Make the validation function globally accessible
    window.UpdateServiceValidation = {
        validateForm: validateAllFields,
        resetValidation: resetValidation
    };
});