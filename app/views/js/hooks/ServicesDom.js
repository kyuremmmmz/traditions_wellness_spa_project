document.addEventListener("DOMContentLoaded", function () {
    const openModalButton = document.getElementById("openAddANewCategorySection");
    const closeModalButton = document.getElementById("closeAddANewCategorySection");
    const categoryModal = document.getElementById("addANewCategorySection");
    const main = document.getElementById("main");

    // Open modal
    openModalButton.addEventListener("click", function () {
        categoryModal.classList.remove("hidden");
    });

    // Close modal
    closeModalButton.addEventListener("click", function () {
        categoryModal.classList.add("hidden");
    });

    // Close modal when clicking outside
    categoryModal.addEventListener("click", function (event) {
        if (event.target === categoryModal) {
            categoryModal.classList.add("hidden");
        }
    });

    const openCategoryButton = document.getElementById("openCategory");
    const closeCategoryButton = document.getElementById("closeCategoryDetails");
    const categoryDetailsSection = document.getElementById("categoryDetailsSection");

    openCategoryButton.addEventListener("click", function () {
        categoryDetailsSection.classList.remove("translate-x-full");
    });

    closeCategoryButton.addEventListener("click", function () {
        categoryDetailsSection.classList.add("translate-x-full");
    });

    const addANewServiceButton = document.getElementById("addANewServiceButton");
    const addANewServiceSection = document.getElementById("addANewServiceSection");
    const closeAddANewServiceButton = document.getElementById("closeAddANewServiceButton")
    
    addANewServiceButton.addEventListener("click", function () {
        addANewServiceSection.classList.remove("translate-x-full");
        document.body.classList.add("overflow-hidden");  // Disable body scrolling
    });

    closeAddANewServiceButton.addEventListener("click", function () {
        addANewServiceSection.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");  // Disable body scrolling

    });


    const inputContainer = document.getElementById("input-container-list");
    const addButton = document.getElementById("add-short-description");
    let fieldCount = 0; // Start from 0 since no fields are initially present

    // Check initial button visibility
    const checkButtonVisibility = () => {
        if (fieldCount >= 6) {
            addButton.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                addButton.style.display = "none";
            }, 300); // Match the transition duration
        } else {
            addButton.style.display = "flex";
            setTimeout(() => {
                addButton.classList.remove('opacity-0', 'translate-y-4');
            }, 50);
        }
    };

    // Add transition classes to the button
    addButton.classList.add('transition-all', 'duration-300', 'ease-in-out');

    // Call checkButtonVisibility initially
    checkButtonVisibility();

    // Add event delegation for remove buttons
    inputContainer.addEventListener("click", function(event) {
        if (event.target.closest(".remove-button")) {
            const inputField = event.target.closest(".FieldContainer");
            inputField.remove();
            fieldCount--;
            renumberFields(); // Call renumberFields to update the numbering
            updatePreview();
            checkButtonVisibility();
        }
    });

    // Function to renumber fields
    function renumberFields() {
        const fields = inputContainer.querySelectorAll('.FieldContainer');
        fields.forEach((field, index) => {
            const input = field.querySelector('.short-description-input');
            const label = field.querySelector('label');
            const newNumber = index + 1; // Start numbering from 1

            input.name = `short_description_${newNumber}`;
            input.id = `newServiceShortDescriptionInputField${newNumber}`;
            label.setAttribute('for', `short_description_${newNumber}`);
            label.textContent = `Short Description ${newNumber}`;
        });
    }

    // Add event delegation for input validation
    inputContainer.addEventListener("input", function(event) {
        if (event.target.classList.contains("short-description-input")) {
            const maxLength = 45;
            const input = event.target;
            const value = input.value;
            const errorMessage = input.parentElement.querySelector('.text-destructive');
            
            if (value.length >= maxLength) {
                errorMessage.textContent = 'Maximum ' + maxLength + ' characters allowed';
                input.classList.add('border-destructive', 'dark:border-darkDestructive');
                input.classList.remove('border-borderHighlight', 'dark:border-darkBorderHighlight');
                if (value.length > maxLength) {
                    input.value = value.slice(0, maxLength);
                }
            } else {
                input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                errorMessage.innerHTML = "&nbsp;";
            }
            updatePreview();
            checkFormValidity(); // Ensure form validity is checked after input changes
        }
    });

                    // Remove maxlength attribute from initial input
                    const firstInput = document.getElementById('newServiceShortDescriptionInputField1');
                    if (firstInput) {
                        firstInput.removeAttribute('maxlength');
                    }

                    // Update the addButton event listener to remove maxlength from new inputs
                    addButton.addEventListener("click", function () {
                        if (fieldCount < 6) { // Adjusted to match the maximum field count
                            // Get the actual next number by counting existing fields
                            const existingFields = inputContainer.querySelectorAll('.short-description-input').length;
                            const nextNumber = existingFields + 1; // Start numbering from 1
                            
                            const newInput = document.createElement("div");
                            newInput.classList.add("relative", "FieldContainer", "min-w-[316px]", "max-w-[400px]", "w-full", "opacity-0", "translate-y-4");
                            
                            newInput.innerHTML = `
                                <input type="text" name="short_description_${nextNumber}" placeholder=" " id="newServiceShortDescriptionInputField${nextNumber}"
                                    class="short-description-input peer w-full min-w-[316px] max-w-[400px] h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-darkBorderHighlight focus:ring-borderHighlight dark:focus:ring-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] autofill:bg-background dark:autofill:bg-background transition-all duration-300" />
                                
                                <label for="short_description_${nextNumber}" 
                                    class="transition-all ease-in-out absolute BodyOne left-[7px] top-0 transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
                                    peer-placeholder-shown:translate-y-[10px] peer-placeholder-shown:BodyOne
                                    peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne
                                    peer-[&:not(:placeholder-shown)]:MiniOne peer-[&:not(:placeholder-shown)]:-translate-y-1 dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left">
                                    Short Description ${nextNumber}
                                </label>
                                <button type="button" class="remove-button absolute top-[22px] right-[10px] transform -translate-y-1/2 w-[30px] h-[30px] flex items-center justify-center bg-background bg-opacity-50 dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface text-onBackgroundTwo dark:text-darkOnBackgroundTwo rounded-full transition">
                                    <svg width="10" height="10" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                        <path d="M13 1L1 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1 1L13 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <p class='MiniOne my-[8px] w-[316px] h-[14px] mx-[5px] text-destructive dark:text-darkDestructive'>&nbsp;</p>
                            `;
                            
                            inputContainer.appendChild(newInput);
                            
                            // Trigger reflow and add transition classes
                            setTimeout(() => {
                                newInput.classList.add("transition-all", "duration-300", "ease-in-out");
                                newInput.classList.remove("opacity-0", "translate-y-4");
                            }, 50);
                            
                            fieldCount++; // Increment field count
                            trackInputCompletion();
                            updatePreview();
                            checkButtonVisibility();
                        }
                    });

    // ✅ Event Delegation for Input Focus and Blur
    inputContainer.addEventListener("focusin", function (event) {
        if (event.target.classList.contains("short-description-input")) {
            event.target.classList.remove("borderHighlight"); // Remove highlight class
        }
    });

    inputContainer.addEventListener("focusout", function (event) {
        if (event.target.classList.contains("short-description-input")) {
            if (event.target.value.trim() !== "") {
                event.target.classList.add("border-borderHighlight", "dark:border-darkBorderHighlight");
            } else {
                event.target.classList.remove("border-borderHighlight", "dark:border-darkBorderHighlight");
            }
        }
    });

    // Handle focus and blur events for inputFields
    const inputFields = document.querySelectorAll('#addANewServiceSection input');
    inputFields.forEach(inputField => {
        // On focus, remove the highlight and add active border style
        inputField.addEventListener('focus', function () {
            inputField.classList.remove('borderHighlight'); // Remove the highlight class
        });

        inputField.addEventListener('blur', function () {
            // Check if the input field is not empty
            if (inputField.value.trim() !== "") {
                inputField.classList.add('border-borderHighlight', 'dark:border-borderHighlight'); // Add the borderHighlight class if not empty
            } else {
                inputField.classList.remove('border-borderHighlight', 'dark:border-borderHighlight');
            }
        });
    });
    

    const sections = document.querySelectorAll("#addANewServiceSection section");
    let currentStep = 1; // Start from the first section

    // Function to reveal the next section
    const revealNextSection = (step) => {
        if (step < sections.length) {
            const section = sections[step];
            section.classList.remove("opacity-0", "translate-y-4");
            section.classList.add("opacity-100", "translate-y-0");
            section.removeAttribute("hidden");

            // If it's step 5, perform updatePreview()
            if (step === 5) {
                setTimeout(() => {
                    updatePreview();
                    checkButtonVisibility();
                }, 0);
            }
        }
    };

    // Function to track input completion and move to the next section
    const trackInputCompletion = () => {
        const currentSection = sections[currentStep];
        const inputs = currentSection.querySelectorAll("input, select, textarea");
        
        let allInputsFilled = true;

        inputs.forEach(input => {
            if (!input.value.trim() && !input.checked) {
                allInputsFilled = false;
            }
        });

        if (allInputsFilled) {
            if (currentStep === 2) {
                // Show both steps 3 and 4 simultaneously
                revealNextSection(3);
                revealNextSection(4);
                currentStep = 4;
            } else {
                currentStep++;
                revealNextSection(currentStep);
            }
        }
    };

    // ✅ Event Delegation for Input Tracking
    document.getElementById("addANewServiceSection").addEventListener("input", function () {
        trackInputCompletion();
        updatePreview(); // Update preview as user types
    });

    document.querySelectorAll("#addANewServiceSection input").forEach(input => {
        input.addEventListener("input", updatePreview);
    });

    // Initially, reveal the first section
    revealNextSection(currentStep);

    // Get input elements
    const serviceNameInput = document.getElementById("newServiceNameInputField");
    const servicePriceInput = document.getElementById("servicePriceInputField");
    const confirmationModal = document.getElementById("confirmationModal");
    const openConfirmationModal = document.querySelector("#openConfirmationModal");
    const closeConfirmationModal = document.getElementById("closeConfirmationModal");

    // Add Confirmation Modal Handlers
    if (openConfirmationModal) {
        openConfirmationModal.addEventListener("click", function() {
            updatePreview(); // Update preview before showing
            confirmationModal.classList.remove("hidden");
            document.body.classList.add("overflow-hidden", "flex");
            checkFormValidity(); // Check form validity when opening the modal
        });
    }

    if (closeConfirmationModal) {
        closeConfirmationModal.addEventListener("click", function() {
            confirmationModal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            checkFormValidity(); // Check form validity when closing the modal
        });
    }

    // Close modal when clicking outside
    if (confirmationModal) {
        confirmationModal.addEventListener("click", function(event) {
            if (event.target === confirmationModal) {
                confirmationModal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }
        });
    }

    // Add price input validation
    servicePriceInput.addEventListener('input', function() {
        let value = this.value;
        const errorElement = document.querySelector('[data-error="newServicePriceError"]');
        
        // Check for invalid input
        if (value === '' || isNaN(value)) {
            errorElement.textContent = 'Please enter a valid number';
            this.classList.add('border-error', 'dark:border-darkError');
            return;
        }

        value = parseFloat(value);
        if (value > 5000) {
            errorElement.textContent = 'Price cannot exceed ₱5,000';
            this.classList.add('border-error', 'dark:border-darkError');
            this.value = 5000;
        } else if (value < 0) {
            errorElement.textContent = 'Price cannot be negative';
            this.classList.add('border-error', 'dark:border-darkError');
            this.value = 0;
        } else {
            errorElement.textContent = '';
            this.classList.remove('border-error', 'dark:border-darkError');
        }
        updatePreview();
    });

    // Add blur event to validate empty field
    servicePriceInput.addEventListener('blur', function() {
        const errorElement = document.querySelector('[data-error="newServicePriceError"]');
        if (this.value.trim() === '') {
            errorElement.textContent = 'Please enter a price';
            this.classList.add('border-error', 'dark:border-darkError');
        }
    });

    const shortDescriptionInputs = document.querySelectorAll(".short-description-input"); // Collect all short description inputs


    // Get preview elements
    const previewServiceName = document.getElementById("previewServiceName");
    const previewServicePrice = document.getElementById("previewServicePrice");
    const previewShortDescription = document.getElementById("previewShortDescription");
    const hiddencontainer = document.getElementById('hiddenContainer');
    // Function to update preview
    function updatePreview() {
        let serviceName = previewServiceName.textContent = serviceNameInput.value || "Service Name";
        
        // Count existing fields for accurate field count
        fieldCount = inputContainer.querySelectorAll('.FieldContainer').length;
        
        // Collect all short descriptions
        let descriptions = [];
        
        // Get all the inputs
        const additionalInputs = inputContainer.querySelectorAll('.short-description-input');
        additionalInputs.forEach(input => {
            if (input.value.trim()) {
                descriptions.push(`• ${input.value.trim()}`);
            }
        });

        // Set HTML content - empty if no descriptions
        if (descriptions.length > 0) {
            previewShortDescription.innerHTML = descriptions.join("<br>");  // Use <br> to ensure each description is on a new line
            previewShortDescription.classList.remove("hidden"); // Show the element if it has content
            document.getElementById("servicePreviewCard").style.padding = "32px"; // Set padding for non-empty descriptions
        } else {
            previewShortDescription.innerHTML = "";
            previewShortDescription.classList.add("hidden"); // Hide the element if it's empty
            document.getElementById("servicePreviewCard").style.padding = "12px"; // Set padding for empty descriptions
        }
        
        let price = parseFloat(servicePriceInput.value);
        let priceFinal  = previewServicePrice.textContent = price ? `₱${price.toLocaleString("en-PH", { minimumFractionDigits: 2 })}` : "₱0.00";
        hiddencontainer.innerHTML = `
        <input type="hidden" name="serviceName" value="${serviceName}">
        <input type="hidden" name="price" value="${priceFinal}">
        <input type="hidden" name="descriptions" value="${previewShortDescription.innerHTML}">
        `;
        checkButtonVisibility();
    }

    // Remove this duplicate initialization
    // revealNextSection(currentStep);
    
    // Add this new function
    function checkAndHideButton() {
        const actualFieldCount = inputContainer.querySelectorAll('.FieldContainer').length;
        if (actualFieldCount >= 6) {
            addButton.style.display = "none";
        }
    }

    // Call it initially and after preview updates
    checkAndHideButton();
    setInterval(checkAndHideButton, 100); // Check periodically

        openConfirmationModal.addEventListener("click", function() {
            updatePreview(); // Update preview before showing
            confirmationModal.classList.remove("hidden");
        });

        closeConfirmationModal.addEventListener("click", function() {
            confirmationModal.classList.add("hidden");
        });

        // Close modal when clicking outside
        confirmationModal.addEventListener("click", function(event) {
            if (event.target === confirmationModal) {
                confirmationModal.classList.add("hidden");
            }
        });

        const reviewDetailsButton = document.querySelector("#openConfirmationModal");

        // Function to check form validity
        function checkFormValidity() {
            let isValid = true;

            // Check if any required input field is empty
            const inputs = document.querySelectorAll("#addANewServiceSection input:not(.short-description-input)");
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    isValid = false;
                }
            });

            // Check for any error messages, including short description errors
            const errorMessages = document.querySelectorAll(".text-destructive");
            errorMessages.forEach(error => {
                if (error.textContent.trim() !== "") {
                    isValid = false;
                }
            });

            // Check short description inputs for errors only
            const shortDescriptionInputs = document.querySelectorAll(".short-description-input");
            shortDescriptionInputs.forEach(input => {
                const errorMessage = input.parentElement.querySelector('.text-destructive');
                if (errorMessage && errorMessage.textContent.trim() !== "") {
                    isValid = false;
                }
                // Ensure maxlength validation is enforced
                if (input.value.length > 45) {
                    isValid = false;
                }
            });

            // Enable or disable the button based on validity
            if (isValid) {
                reviewDetailsButton.removeAttribute("disabled");
                reviewDetailsButton.classList.remove("opacity-50", "cursor-not-allowed");
            } else {
                reviewDetailsButton.setAttribute("disabled", "true");
                reviewDetailsButton.classList.add("opacity-50", "cursor-not-allowed");
            }
        }

        // Call checkFormValidity on input and blur events
        document.querySelectorAll("#addANewServiceSection input").forEach(input => {
            input.addEventListener("input", checkFormValidity);
            input.addEventListener("blur", checkFormValidity);
        });

        // Initial check
        checkFormValidity();
});