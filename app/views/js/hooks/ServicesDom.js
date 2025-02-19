document.addEventListener("DOMContentLoaded", function () {
    const openModalButton = document.getElementById("openAddANewCategoryModal");
    const closeModalButton = document.getElementById("closeAddANewCategoryModal");
    const categoryModal = document.getElementById("addANewCategoryModal");
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
    let fieldCount = 1; // Start from 1 since one field is already present

    addButton.addEventListener("click", function () {
        if (fieldCount != 6) {
            fieldCount++; // Increment the field count
            const newInput = document.createElement("div");
            newInput.classList.add("relative", "FieldContainer", "min-w-[316px]", "max-w-[400px]", "mb-[24px]"); // Keep consistent spacing

            newInput.innerHTML = `
                            <input type="text" name="short_description_${fieldCount}" placeholder=" " 
                                class="short-description-input peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-darkBorderHighlight focus:ring-borderHighlight dark:focus:ring-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] autofill:bg-background dark:autofill:bg-background" />
                            
                            <label for="short_description_${fieldCount}" 
                                class="transition-all ease-in-out absolute BodyOne left-[7px] top-0 transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
                                peer-placeholder-shown:translate-y-[10px] peer-placeholder-shown:BodyOne
                                peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne
                                peer-[&:not(:placeholder-shown)]:MiniOne peer-[&:not(:placeholder-shown)]:-translate-y-1 dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left">
                                Short Description ${fieldCount}
                            </label>
                            <button type="button" class="remove-button absolute top-1/2 right-[10px] transform -translate-y-1/2 w-[30px] h-[30px] flex items-center justify-center hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface text-onBackgroundTwo dark:text-darkOnBackgroundTwo rounded-full transition">
                                <svg width="10" height="10" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                    <path d="M13 1L1 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 1L13 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        `;

            inputContainer.appendChild(newInput);
            trackInputCompletion(); // Ensure the new input is validated
            if (fieldCount == 6) addButton.style.display = "none";

            // Add event listener to the remove button
            const removeButton = newInput.querySelector(".remove-button");
            removeButton.addEventListener("click", function () {
                newInput.remove(); // Remove the input field
                fieldCount--; // Decrement field count

                // Show the add button again if fields are below 6
                if (fieldCount < 6) {
                    addButton.style.display = "flexbox";
                }
            });
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
                inputField.classList.add('border-borderHighlight', 'dark:border-darkBorderHighlight'); // Add the borderHighlight class if not empty
            } else {
                inputField.classList.remove('border-borderHighlight', 'dark:border-darkBorderHighlight');
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
        }
    };

    // Function to track input completion and move to the next section
    const trackInputCompletion = () => {
        const currentSection = sections[currentStep];
        const inputs = currentSection.querySelectorAll("input, select, textarea"); // Track all inputs

        let allInputsFilled = true;

        inputs.forEach(input => {
            if (!input.value.trim() && !input.checked) {
                allInputsFilled = false;
            }
        });

        if (allInputsFilled) {
            currentStep++;
            revealNextSection(currentStep);
        }
    };

    // ✅ Event Delegation for Input Tracking
    document.getElementById("addANewServiceSection").addEventListener("input", function () {
        trackInputCompletion();
    });

    // Initially, reveal the first section
    revealNextSection(currentStep);
});