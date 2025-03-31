document.addEventListener("DOMContentLoaded", function () {
    // Add this array definition
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
        'update_caption3',
        'update_price_type'
    ];

    const form = document.getElementById("UpdateServiceForm");
    const submitButton = document.getElementById('openConfirmEditServiceModal');
    const categorySelect = document.getElementById("update_category");
    const fixedPriceRadio = document.getElementById("updateFixedPriceButton");
    const dynamicPriceRadio = document.getElementById("updateDynamicPriceButton");
    const fixedPriceSection = document.getElementById("updateFixedPriceSection");
    const dynamicPriceSection = document.getElementById("updateDynamicPriceSection");
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

    // Update the form submit handler
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        
        // Perform validation
        const isValid = validateForm();
        
        if (isValid) {
            const massageSelections = document.querySelectorAll('input[name="update_massage_selection[]"]');
            const bodyScrubSelections = document.querySelectorAll('input[name="update_body_scrub_selection[]"]');
            const addonSelections = document.querySelectorAll('input[name="update_addon_selection[]"]');

            const selectedMassages = Array.from(massageSelections).filter(cb => cb.checked).map(cb => cb.value);
            const selectedBodyScrubs = Array.from(bodyScrubSelections).filter(cb => cb.checked).map(cb => cb.value);
            const selectedAddons = Array.from(addonSelections).filter(cb => cb.checked).map(cb => cb.value);
            const statusValue = document.querySelector('select[name="update_status"]').value;

            const createHiddenInput = (name, value) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            };

            form.appendChild(createHiddenInput('status', statusValue));
            
            if (fixedPriceRadio.checked) {
                form.appendChild(createHiddenInput('duration', elements.serviceDurationDetails.element.value));
            } else {
                const durationInput = form.querySelector('input[name="duration"]');
                if (durationInput) {
                    durationInput.remove();
                }
            }
            
            selectedMassages.forEach(value => {
                form.appendChild(createHiddenInput('selected_massages[]', value));
            });
            selectedBodyScrubs.forEach(value => {
                form.appendChild(createHiddenInput('selected_body_scrubs[]', value));
            });
            selectedAddons.forEach(value => {
                form.appendChild(createHiddenInput('selected_addons[]', value));
            });

            form.submit();
        }
    });

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
        const durationField = elements.serviceDurationDetails.element;
        const durationParent = durationField.parentElement;
        
        if (fixedPriceRadio.checked) {
            fixedPriceSection.style.display = "flex";
            dynamicPriceSection.style.display = "none";
            fixedPriceSection.style.opacity = 1;
            dynamicPriceSection.style.opacity = 0;
            durationParent.style.display = "";
            
            if (durationField.dataset.originalValue) {
                durationField.value = durationField.dataset.originalValue;
            }
            
            elements.serviceFixedPrice.element.disabled = false;
        } else {
            fixedPriceSection.style.display = "none";
            dynamicPriceSection.style.display = "flex";
            fixedPriceSection.style.opacity = 0;
            dynamicPriceSection.style.opacity = 1;
            durationParent.style.display = "none";
            
            durationField.dataset.originalValue = durationField.value;
            durationField.value = "";
            
            elements.serviceFixedPrice.element.disabled = true;
            delete errors.serviceFixedPrice;
            elements.serviceFixedPrice.errorElement.textContent = "";
        }
    
        elements.serviceFixedPrice.element.value = "";
        elements.serviceFixedPrice.interacted = false;
    
        Object.keys(elements).filter(key => key.startsWith('service')).forEach(key => {
            if(elements[key].element) {
                elements[key].element.dispatchEvent(new Event('input'));
            }
        });
    
        // Instead of calling validateForm(), use:
        validateForm();
    }

    // Initialize price visibility on load
    document.addEventListener('DOMContentLoaded', function() {
        if (fixedPriceRadio && dynamicPriceRadio && fixedPriceSection && dynamicPriceSection) {
            fixedPriceRadio.addEventListener("change", updatePriceVisibility);
            dynamicPriceRadio.addEventListener("change", updatePriceVisibility);
            
            // Force initial state based on checked radio button
            if (fixedPriceRadio.checked) {
                fixedPriceSection.style.display = "flex";
                dynamicPriceSection.style.display = "none";
                elements.serviceFixedPrice.element.disabled = false;
            } else {
                fixedPriceSection.style.display = "none";
                dynamicPriceSection.style.display = "flex";
                elements.serviceFixedPrice.element.disabled = true;
            }
            
            updatePriceVisibility();
        } else {
            console.error('Price visibility elements not found');
        }
    });

    function validateForm() {
        let isValid = true;
        inputIds.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                if (input.type === 'file') {
                    if (!input.files || input.files.length === 0) {
                        isValid = false;
                    }
                } else if (typeof input.value === 'string' && !input.value.trim()) {
                    isValid = false;
                }
            }
        });
        submitButton.disabled = !isValid;
    }

    validateForm();
});