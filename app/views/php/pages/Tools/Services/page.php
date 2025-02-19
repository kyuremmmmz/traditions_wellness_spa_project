<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {

?>
        <main class="flex w-full">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                <div id="topSection">
                    <section class="flex h-[50px]">
                        <button class="w-[50px] h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] pl-[8px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Services');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>


                    <section class="flex mt-[24px]">
                        <button id="addANewServiceButton" class="w-[200px] h-[42px] flex justify-start items-center pl-[12px] bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover rounded-[6px] transition-all">
                            <?php IconChoice::render('plusSmall', '[16px]', '[16px]', '', 'onPrimary', 'darkOnPrimary');
                            Text::render('', '', 'BodyTwo leading-none text-onPrimary dark:text-darkOnPrimary pl-[12px]', 'Add a new service'); ?>
                        </button>
                    </section>


                    <section class="flex mt-[24px]">
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo mb-[24px]', 'Overview'); ?>
                    </section>
                </div>

                <div class="categorySection">
                    <div class="w-[316px] flex flex-col items-center h-[346px] border-border dark:border-darkBorder border-[1px] bg-surface dark:bg-darkSurface rounded-[6px]">
                        <button id="openCategory" class="flex justify-between transition-all items-center w-full h-[40px] pl-[12px] rounded-tr-[6px] rounded-tl-[6px] border-b-[1px] border-border dark:border-darkBorder bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="flex items-center">
                                <?php IconChoice::render('defaultSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                Text::render('', '', 'BodyMediumTwo text-left text-onSurface dark:text-darkOnSurface leading-none w-[240px] pl-[12px]', 'Category Name'); ?>
                            </div>
                            <?php IconChoice::render('chevronRightSmall', '[6px] rotate-180 mr-[12px]', '[10px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <button id="openAddANewCategoryModal" class="flex transition-all justify-center items-center m-[16px] w-[282px] h-[32px] rounded-[6px] border-[1px] border-border border-dashed dark:border-darkBorder bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <?php IconChoice::render('plusBoxVerySmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                            Text::render('', '', 'CaptionMediumOne text-left text-onSurface dark:text-darkOnSurface leading-none pl-[12px]', 'Add a new category'); ?>
                        </button>
                        <p id="test">dadas</p>
                    </div>
                </div>
                <form method="post" action="/createCategory">
                    <div id="addANewCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
                        <div class="bg-background dark:bg-darkBackground p-[48px] border-border border-[1px] dark:border-darkBorder flex flex-col justify-between rounded-[6px] w-[364px] sm:w-[496px] h-[600px]">
                            <div>
                                <div class="w-full flex justify-end mb-[48px]">
                                    <button id="closeAddANewCategoryModal" class="cursor-pointer w-[16px] h-[16px] ">
                                        <?php IconChoice::render('exitSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface'); ?>
                                    </button>
                                </div>
                                <?php Text::render('', '', 'HeaderTwo m-0 p-0 leading-none text-left text-onBackground dark:text-darkOnBackground', 'Add a new category');
                                Text::render('', '', 'BodyTwo m-0 p-0  my-[16px] leading-none text-left text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.');
                                GlobalInputField::render('categoryNameField', 'Category Name', 'text', '', ''); ?>
                            </div>
                            <div class="flex justify-center gap-2">
                                <?php PrimaryButton::render('Create', 'submit'); ?>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="addANewServiceSection" class="sm:ml-[48px] ml-[0px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full">
                        <button id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    <div class=" w-full flex sm:items-start flex-col">
                        <section class="flex flex-col gap-[12px] min-w-[316px] w-full justify-center sm:justify-start">
                            <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new service');
                            Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                        </section>
                        <section id="newServiceCategory" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start">
                            <div class="flex items-end w-full max-w-[400px]">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Category.&nbsp;'); ?>
                                <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'Where does the new service belong?'); ?>
                            </div>
                            <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]">
                                <div class="flex gap-2 min-w-[316px] w-full max-w-[400px]" >
                                    <input type="radio" id="option1" name="radioGroup" class="hidden peer/option1">
                                    <label for="option1"
                                        class="cursor-pointer border-border dark:border-darkBorder rounded-[6px] w-full h-[40px] peer-checked/option1:border-borderHighlight dark:peer-checked/option1:border-darkBorderHighlight border-[2px] transition-all flex items-center pl-[12px]">
                                        <?php IconChoice::render('defaultSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface'); ?>
                                        <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface pl-[12px]', 'Category Name'); ?>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section id="newServiceName" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                            <div class="flex items-end w-full max-w-[400px]">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Name.&nbsp;'); ?>
                                <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What is it called?'); ?>
                            </div>
                            <div id="input-container" class="w-full flex justify-center sm:justify-start">
                                <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]" id="input-field-1">
                                    <?php GlobalInputField::render('serviceNameInputField', 'Service Name', 'text', 'newServiceNameInputField', ''); ?>
                                </div>
                            </div>
                        </section>

                        <section id="newServiceDescription" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="3" hidden>
                            <div class="flex items-end w-full max-w-[400px]">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Description.&nbsp;');
                                Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What are its details? (Optional)');?>
                            </div>
                            <div class="mt-[24px] min-w-[316px] max-w-[400px]">
                                <?php Text::render('', '', 'CaptionOne w-full text-onSurface dark:text-darkOnSurface', 'You may provide a list of short descriptions. It should follow the order below.'); ?>
                                <ul class="CaptionOne text-onSurface dark:text-darkOnSurface">
                                    <li>• Duration <em>(1 hour, 1 hour and 30 minutes, etc.)</em></li>
                                    <li>• Choice <em>(Any choice of..., Hilot or Swedish Massage) </em></li>
                                    <li>• Add-ons <em>(With Ventosa, Ear Candling, etc.) </em></li>
                                    <li>• Number of clients <em>(For one person, For two people, etc.)</em></li>
                                </ul>
                            </div>
                            <div id="input-container-list" class="mt-[24px] w-full flex flex-col items-center sm:items-start">
                                <?php 
                                // Initially render one input field
                                GlobalInputField::render('newShortDescription1', 'Short Description 1', 'text', 'newServiceShortDescriptionInputField1', ''); 
                                ?>
                            </div>
                            <button id="add-short-description" type="button" class="w-full h-[45px] max-w-[400px] min-w-[316px] px-[12px] border-dashed bg-background flex items-center text-left dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo rounded-[6px] autofill:bg-background dark:autofill:bg-background hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                <?php IconChoice::render('plusBoxVerySmall', '[16px]', '[16px]', '', 'onBackgroundTwo', 'darkOnBackgroundTwo');
                                Text::render('', '', 'BodyOne pl-[12px] leading-none text-onBackgroundTwo dark:text-onBackgroundTwo', 'Add a new description'); ?>
                            </button>
                        </section>

                        <section id="newServicePrice" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out flex flex-col w-full items-center sm:items-start" data-step="4" hidden>
                            <div class="flex items-end w-full max-w-[400px]">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Price.&nbsp;');
                                Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'How much does it cost?'); ?>
                            </div>
                            <div class="mt-[24px] w-full max-w-[400px]">
                                <?php 
                                // Simply render the input field with validation attributes
                                GlobalInputField::render('newServicePriceInputField', 'Price', 'number', 'servicePriceInputField', '', 'min="0" max="5000" step="1"','validate-price-number'
                                ); 
                                ?>
                            </div>
                        </section>

                        <section id="newServicePreview" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out flex flex-col w-full items-center sm:items-start" data-step="5" hidden>
                            <div class="flex items-end w-full max-w-[400px]">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Confirmation.&nbsp;'); ?>
                            </div>
                            <div class="mt-[24px] w-full max-w-[400px]">
                                <?php Text::render('', '', 'CaptionOne w-full text-onSurface dark:text-darkOnSurface min-w-[316px] max-w-[400px]', 'Please review your new service details before creating it.'); ?>
                            </div>
                            <div class="mt-[64px] mb-[150px] w-full flex justify-center translate-y-4 transition-all duration-500 ease-in-out max-w-[400px]">      
                                <?php PrimaryButton::render("Review details", "button", "", "", "", "", null, null, null, "openConfirmationModal"); ?>
                            </div>
                        </section>
                    </div>
                </div>

                <div id="categoryDetailsSection" class="fixed sm:ml-[48px] sm:px-[20%] px-[48px] inset-0 bg-background flex flex-col mt-[48px] sm:mt-[160px] w-full dark:bg-darkBackground transform translate-x-full transition-transform duration-300 ease-in-out z-4">
                    <div class="w-full flex justify-start mb-[48px]">
                        <button id="closeCategoryDetails" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    <div class="">
                        <?php Text::render('', '', 'HeaderTwo text-onBackground dark:text-onBackground text-left leading-none', 'Category Name'); ?>
                    </div>
                </div>
            </div>
            <!-- Add Confirmation Modal -->
            <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[1000]">
                <div class="bg-background dark:bg-darkBackground p-[48px] border-border border-[1px] dark:border-darkBorder flex flex-col justify-between rounded-[6px] w-[364px] sm:w-[496px] z-[60]">
                    <div>
                        <div class="w-full flex justify-end mb-[48px]">
                            <button id="closeConfirmationModal" class="cursor-pointer w-[16px] h-[16px]">
                                <?php IconChoice::render('exitSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');?>
                            </button>
                        </div>
                        <?php Text::render('', '', 'HeaderTwo m-0 p-0 leading-none text-left text-onBackground dark:text-darkOnBackground mb-[16px]', 'Confirm new service');
                        Text::render('', '', 'BodyTwo m-0 p-0 leading-none text-left text-onBackgroundTwo dark:text-darkOnBackgroundTwo mb-[32px]', 'Please review the details below.');?>
                        
                        <!-- Move the preview card here -->
                        <div id="servicePreviewCard" class="w-full">
                            <div class="border-borderHighlight dark:border-darkBorderHighlight border-[2px] rounded-[6px] bg-background dark:bg-darkBackground p-[32px]">
                                <div class="flex justify-between">
                                    <span id="previewServiceName" class="BodyMediumTwo leading-none text-onBackground dark:text-darkOnBackground">Service Name</span>
                                    <span id="previewServicePrice" class="BodyMediumTwo leading-none text-onBackground dark:text-darkOnBackground">₱0.00</span>
                                </div>
                                <div class="flex flex-col">
                                    <ul class="CaptionOne text-onSurface dark:text-darkOnSurface mt-[16px]">
                                        <li id="previewShortDescription"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center gap-2 mt-[48px]">
                        <?php PrimaryButton::render("Create service", "submit"); ?>
                    </div>
                </div>
            </div>

            <?php Sidebar::render(); ?>
        </main>
        <script>
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
                        updatePreview();
                        checkButtonVisibility();
                    }
                });

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
                                    }
                                });

                                // Remove maxlength attribute from initial input
                                const firstInput = document.getElementById('newServiceShortDescriptionInputField1');
                                if (firstInput) {
                                    firstInput.removeAttribute('maxlength');
                                }

                                // Update the addButton event listener to remove maxlength from new inputs
                                addButton.addEventListener("click", function () {
                                    if (fieldCount < 7) {
                        // Get the actual next number by counting existing fields + 1
                        const existingFields = inputContainer.querySelectorAll('.short-description-input').length;
                        const nextNumber = existingFields + 2;
                        
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
                            <button type="button" class="remove-button absolute top-[22px] right-[10px] transform -translate-y-1/2 w-[30px] h-[30px] flex items-center justify-center hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface text-onBackgroundTwo dark:text-darkOnBackgroundTwo rounded-full transition">
                                <svg width="10" height="10" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                    <path d="M13 1L1 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 1L13 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <p class='MiniOne my-[8px] w-[316px] h-[14px] mx-[5px] text-destructive dark:text-darkDestructive'>&nbsp;</p
                        `;

                        inputContainer.appendChild(newInput);
                        
                        // Trigger reflow and add transition classes
                        setTimeout(() => {
                            newInput.classList.add("transition-all", "duration-300", "ease-in-out");
                            newInput.classList.remove("opacity-0", "translate-y-4");
                        }, 50);

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
                    });
                }

                if (closeConfirmationModal) {
                    closeConfirmationModal.addEventListener("click", function() {
                        confirmationModal.classList.add("hidden");
                        document.body.classList.remove("overflow-hidden");
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

                // Function to update preview
                function updatePreview() {
                    previewServiceName.textContent = serviceNameInput.value || "Service Name";
                    
                    // Count existing fields for accurate field count
                    fieldCount = inputContainer.querySelectorAll('.FieldContainer, #newServiceShortDescriptionInputField1').length;
                    
                    // Collect all short descriptions, including the first one
                    let descriptions = [];
                    
                    // Get the first input field (it's outside FieldContainer)
                    const firstInput = document.getElementById('newServiceShortDescriptionInputField1');
                    if (firstInput && firstInput.value.trim()) {
                        descriptions.push(`• ${firstInput.value.trim()}`);
                    }
                    
                    // Get the rest of the inputs
                    const additionalInputs = inputContainer.querySelectorAll('.short-description-input');
                    additionalInputs.forEach(input => {
                        if (input.value.trim() && input.id !== 'newServiceShortDescriptionInputField1') {
                            descriptions.push(`• ${input.value.trim()}`);
                        }
                    });

                    // Set HTML content - empty if no descriptions
                    previewShortDescription.innerHTML = descriptions.length > 0 
                        ? descriptions.join("") 
                        : "";
                    
                    let price = parseFloat(servicePriceInput.value);
                    previewServicePrice.textContent = price ? `₱${price.toLocaleString("en-PH", { minimumFractionDigits: 2 })}` : "₱0.00";
                    
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
        </script>
        <?php
    }
}

Page::page();
