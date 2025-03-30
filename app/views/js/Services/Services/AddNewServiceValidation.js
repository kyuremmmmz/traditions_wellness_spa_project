document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addServiceForm");
    const categorySelect = document.getElementById("category");
    const fixedPriceRadio = document.getElementById("fixedPriceButton");
    const dynamicPriceRadio = document.getElementById("dynamicPriceButton");
    const fixedPriceSection = document.getElementById("fixedPriceSection");
    const dynamicPriceSection = document.getElementById("dynamicPriceSection");
    const elements = {
        serviceName: {
            element: document.getElementById("service_name"),
            errorElement: document.getElementById("service_name_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Name is required.";
                if (trimmedValue.length > 30) return "Name must not exceed 30 characters.";
            }
        },
        serviceCaption: {
            element: document.getElementById("service_caption"),
            errorElement: document.getElementById("service_caption_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 40) return "Caption must not exceed 40 characters.";
            }
        },
        serviceDescription: {
            element: document.getElementById("service_description"),
            errorElement: document.getElementById("service_description_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Description is required.";
                if (trimmedValue.length > 100) return "Description must be at least 100 characters.";
            }
        },
        serviceDurationDetails: {
            element: document.getElementById("duration_details"),
            errorElement: document.getElementById("duration_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Duration details are required.";
                if (trimmedValue.length > 70) return "Duration details must not exceed 70 characters.";
            }
        },
        servicePartySizeDetails: {
            element: document.getElementById("party_size_details"),
            errorElement: document.getElementById("party_size_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Party Size details are required.";
                if (trimmedValue.length > 70) return "Party size details must not exceed 70 characters.";
            }
        },
        serviceMassageDetails: {
            element: document.getElementById("massage_details"),
            errorElement: document.getElementById("massage_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Massage details are required.";
                if (trimmedValue.length > 70) return "Massage details must not exceed 70 characters.";
            }        
        },
        serviceBodyScrubDetails: {
            element: document.getElementById("body_scrub_details"),
            errorElement: document.getElementById("body_scrub_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Body scrub details are required.";
                if (trimmedValue.length > 70) return "Body scrub details must not exceed 70 characters.";
            }        
        },
        serviceAddOnDetails: {
            element: document.getElementById("addon_details"),
            errorElement: document.getElementById("addon_details_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue.length > 70) return "Add-on details must not exceed 70 characters.";
            }        
        },
        serviceHeadline1: {
            element: document.getElementById("showcase_headline_1"),
            errorElement: document.getElementById("showcase_headline_1_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            } 
        },
        serviceHeadline2: {
            element: document.getElementById("showcase_headline_2"),
            errorElement: document.getElementById("showcase_headline_2_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            }         
        },
        serviceHeadline3: {
            element: document.getElementById("showcase_headline_3"),
            errorElement: document.getElementById("showcase_headline_3_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Headline is required.";
                if (trimmedValue.length > 30) return "Headline must not exceed 30 characters.";
            }        
         },
        serviceCaption1: {
            element: document.getElementById("showcase_caption_1"),
            errorElement: document.getElementById("showcase_caption_1_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }         
        },
        serviceCaption2: {
            element: document.getElementById("showcase_caption_2"),
            errorElement: document.getElementById("showcase_caption_2_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }          
        },
        serviceCaption3: {
            element: document.getElementById("showcase_caption_3"),
            errorElement: document.getElementById("showcase_caption_3_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
                if (trimmedValue === "") return "Caption is required.";
                if (trimmedValue.length > 100) return "Caption must not exceed 100 characters.";
            }
        },
        serviceOneHourPrice: {
            element: document.getElementById("one_hour_price"),
            errorElement: document.getElementById("one_hour_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
        
                if (trimmedValue === "") {
                    return "Price is required.";
                }
        
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) {
                    return "Price cannot contain leading zeros.";
                }
        
                const price = parseInt(trimmedValue, 10);
        
                if (isNaN(price)) {
                    return "Price must be a number.";
                }
        
                if (price < 50 || price > 3000) {
                    return "Price must be between 50 and 3000.";
                }
        
                return true; 
            }
        },
        serviceOneHourThirtyPrice: {
            element: document.getElementById("one_hour_thirty_price"),
            errorElement: document.getElementById("one_hour_thirty_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
        
                if (trimmedValue === "") {
                    return "Price is required.";
                }
        
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) {
                    return "Price cannot contain leading zeros.";
                }
        
                const price = parseInt(trimmedValue, 10);
        
                if (isNaN(price)) {
                    return "Price must be a number.";
                }
        
                if (price < 50 || price > 3000) {
                    return "Price must be between 50 and 3000.";
                }
        
                return true; 
            }
        },
        serviceTwoHourPrice: {
            element: document.getElementById("two_hour_price"),
            errorElement: document.getElementById("two_hour_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
        
                if (trimmedValue === "") {
                    return "Price is required.";
                }
        
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) {
                    return "Price cannot contain leading zeros.";
                }
        
                const price = parseInt(trimmedValue, 10);
        
                if (isNaN(price)) {
                    return "Price must be a number.";
                }
        
                if (price < 50 || price > 3000) {
                    return "Price must be between 50 and 3000.";
                }
        
                return true; 
            }
        },
        serviceFixedPrice: {
            element: document.getElementById("fixed_price"),
            errorElement: document.getElementById("fixed_price_error"),
            handler: (value) => {
                const trimmedValue = value.trim();
        
                if (trimmedValue === "") {
                    return "Price is required.";
                }
        
                if (!/^[1-9][0-9]*$/.test(trimmedValue)) {
                    return "Price cannot contain leading zeros.";
                }
        
                const price = parseInt(trimmedValue, 10);
        
                if (isNaN(price)) {
                    return "Price must be a number.";
                }
        
                if (price < 50 || price > 3000) {
                    return "Price must be between 50 and 3000.";
                }
        
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

    let initialValidationDone = false; // Flag to track initial validation

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
    
        // Check if the field has been interacted with (focused and blurred)
        if (validElements[field].interacted && trimmedValue === "") {
            errors[field] = "This field is required."; // Or a more specific message
        } else if (trimmedValue !== "") {
            // Run validation only if the field is not empty
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

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        let isValid = true;

        Object.keys(validElements).forEach(field => {
            validateField(field);
            if (errors[field]) {
                isValid = false;
            }
        });

        if (isValid) {
            const massageSelections = document.querySelectorAll('input[name="massage_selection[]"]');
            const bodyScrubSelections = document.querySelectorAll('input[name="body_scrub_selection[]"]');
            const addonSelections = document.querySelectorAll('input[name="addon_selection[]"]');

            const selectedMassages = Array.from(massageSelections).filter(cb => cb.checked).map(cb => cb.value);
            const selectedBodyScrubs = Array.from(bodyScrubSelections).filter(cb => cb.checked).map(cb => cb.value);
            const selectedAddons = Array.from(addonSelections).filter(cb => cb.checked).map(cb => cb.value);
            const statusValue = document.querySelector('select[name="service_status"]').value;

            const createHiddenInput = (name, value) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                return input;
            };

            // Add selected values as hidden inputs
            form.appendChild(createHiddenInput('status', statusValue));
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
        if (fixedPriceRadio.checked) {
            fixedPriceSection.style.display = "flex";
            dynamicPriceSection.style.display = "none";
            fixedPriceSection.style.opacity = 1;
            dynamicPriceSection.style.opacity = 0;
        } else {
            fixedPriceSection.style.display = "none";
            dynamicPriceSection.style.display = "flex";
            fixedPriceSection.style.opacity = 0;
            dynamicPriceSection.style.opacity = 1;
    
            // Reset fixed price field, errors, and interaction
            elements.serviceFixedPrice.element.value = "";
            delete errors.serviceFixedPrice;
            elements.serviceFixedPrice.errorElement.textContent = "";
            elements.serviceFixedPrice.interacted = false; // Reset interaction
        }
    
        // Trigger input event to re-validate fields based on visibility
        Object.keys(elements).filter(key => key.startsWith('service')).forEach(key => {
            if(elements[key].element) {
                elements[key].element.dispatchEvent(new Event('input'));
            }
        });
    }

    fixedPriceRadio.addEventListener("change", updatePriceVisibility);
    dynamicPriceRadio.addEventListener("change", updatePriceVisibility);

    updatePriceVisibility();

    
});