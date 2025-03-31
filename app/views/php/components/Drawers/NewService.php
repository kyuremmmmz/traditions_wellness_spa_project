<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Buttons\BackButton;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Headers\DrawerTitle;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Modals\ConfirmationDialog;
use Project\App\Views\Php\Components\Texts\Helper;
use Project\App\Views\Php\Components\Texts\Text;

class NewService
{
    public static function render(): void
    {
        ?>
        <form action="/createService" id="addServiceForm" method="post" enctype="multipart/form-data">
            <div id="AddANewServiceSection" class="pl-[0px] w-full overflow-x-auto pr-[48px] mr-[48px] pt-[48px] ml-[48px] sm:pl-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-[20]">
                <?php BackButton::render('closeAddANewServiceButton'); ?>
                <div class="flex flex-col sm:p-[48px] pr-[48px] mr-[48px] ">
                    <div class="w-full flex flex-col sm:flex-row gap-[100px] pb-[150px]">
                        <section class="flex flex-col gap-[16px] w-[400px] sm:w-[400px]">
                            <?php DrawerTitle::render('Add a new add-on', 'Please enter the following'); ?>
                            <div class="flex flex-col mt-[54px] gap-[16px]">
                                <div class="flex flex-row">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '1. Primary Details'); ?>
                                </div>
                                <?php SecondaryInputField::render('dropdownfield', 'Status', '', ['Archived', 'Active'], '', null, 'service_status', '', '', [], false, 'service_status', 0, '') ?>
                                <?php SecondaryInputField::render('dropdownfield', 'Category', '', ['Massages', 'Body Scrubs', 'Packages'], '', null, 'category', '', '', [], false, 'category', 0, 'When creating services, each category has specific selection rules: \n - Massages allow for optional add-ons. \n - Body Scrubs require a massage selection and permit add-ons. \n - Packages include both massage and body scrub selections, but do not allow add-ons.') ?>
                                <?php SecondaryInputField::render('textfield', 'Service Name', 'Enter Service Name', [], 'service_name_error', null, 'service_name', '', '', [], false, 'service_name') ?>
                                <?php SecondaryInputField::render('textareafield', 'Caption', 'Enter Caption', [], 'service_caption_error', null, 'service_caption', '', '', [], false, 'service_caption', 0, 'This is displayed alongside the service name in menu selections.') ?>
                                <?php SecondaryInputField::render('textareafield', 'Description', 'Enter Description', [], 'service_description_error', null, 'service_description', '', '', [], false, 'service_description', 0, 'This is displayed in the service view.') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[400px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px]">
                                <div class="flex flex-row gap-[8px] sm:mt-[115px] ">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '2. Secondary Details'); ?>
                                    <?php Helper::render('Describe what comes with the service. This will appear as a list of details in the service view.') ?>
                                </div>
                                <?php SecondaryInputField::render('textfield', 'Duration Details', 'Enter Duration Details', [], 'duration_details_error', null, 'duration_details', '', '', [], false, 'duration_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Party Size Details', 'Enter Party Size Details', [], 'party_size_details_error', null, 'party_size_details', '', '', [], false, 'party_size_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], 'massage_details_error', null, 'massage_details', '', '', [], false, 'massage_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Body Scrub Details', [], 'body_scrub_details_error', null, 'body_scrub_details', '', '', [], false, 'body_scrub_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Add-on Details', [], 'addon_details_error', null, 'addon_details', '', '', [], false, 'addon_details') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[400px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '3. Photos'); ?>
                                <?php SecondaryInputField::render('photofield', 'Main Photo', 'Choose a photo', [], 'main_photo_error', null, 'main_photo', '', '', [], false, 'main_photo', 0, 'Must be a 700x700 photo.') ?>
                                <?php SecondaryInputField::render('multiphotofield', 'Slideshow Photos', 'Choose a photo', [], 'slideshow_photos_error', null, 'slideshow_photos', '', '', [], false, 'slideshow_photos', 0, 'Upload up to 5 photos, each with a 700x700 pixel size') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[400px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <div class="flex flex-row gap-[8px] sm:mt-[115px] ">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '4. Showcase Photos'); ?>
                                    <?php Helper::render('The details provided must showcase the service process and/or benefits.') ?>
                                </div>
                                <?php SecondaryInputField::render('photofield', 'Showcase Photo 1', 'Choose a photo', [], 'showcase_photo_1_error', null, 'showcase_photo', '', '', [], false, 'showcase_photo_1', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], 'showcase_headline_1_error', null, 'showcase_headline_1', '', '', [], false, 'showcase_headline_1') ?>
                                <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], 'showcase_caption_1_error', null, 'showcase_caption_1', '', '', [], false, 'showcase_caption_1') ?>
                                <?php SecondaryInputField::render('photofield', 'Showcase Photo 2', 'Choose a photo', [], 'showcase_photo_2_error', null, 'showcase_photo_2', '', '', [], false, 'showcase_photo_2', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], 'showcase_headline_2_error', null, 'showcase_headline_2', '', '', [], false, 'showcase_headline_2') ?>
                                <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], 'showcase_caption_2_error', null, 'showcase_caption_2', '', '', [], false, 'showcase_caption_2') ?>
                                <?php SecondaryInputField::render('photofield', 'Showcase Photo 3', 'Choose a photo', [], 'showcase_photo_3_error', null, 'showcase_photo_3', '', '', [], false, 'showcase_photo_3', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], 'showcase_headline_3_error', null, 'showcase_headline_3', '', '', [], false, 'showcase_headline_3') ?>
                                <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], 'showcase_caption_3_error', null, 'showcase_caption_3', '', '', [], false, 'showcase_caption_3') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[400px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                                <div id="massage_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', [], '', null, 'massage_selection', '', '', [], false, 'massage_selection', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.'); ?></div>
                                <div id="body_scrub_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', [], '', null, 'body_scrub_selection', '', '', [], false, 'body_scrub_selection', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.'); ?></div>
                                <div id="addon_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Supplemental Add-ons', '', [], '', null, 'addon_selection', '', '', [], false, 'addon_selection', 0, 'This determines the add-ons included with the service. You may select one, multiple, or none. If the desired add-on is not listed, you will need to create it.'); ?></div>
                                <?php SecondaryInputField::render('dropdownfield', 'Party Size', '', ['All choices', 'Solo only', 'Duo only', 'Trio only'], '', null, 'party_size', '', '', [], false, 'party_size', 0, 'This locks the party size selection in the chosen setting.') ?>
                            </div>
                        </section>
                        <section class="flex">
                            <div class="flex flex-col gap-[16px] items-start w-[400px] sm:w-[400px] pr-[48px]">
                                <div class="flex flex-row gap-[8px] w-full sm:mt-[115px]">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '6. Price & Duration'); ?>
                                </div>
                                <div class="flex w-full items-center gap-[16px] justify-start">
                                    <p class="leading-none BodyTwo text-onBackgroundTwo min-w-[160px] text-right dark:text-darkOnBackgroundTwo">Price Type</p>
                                    <div class="flex gap-[16px]">
                                        <div class="relative">
                                            <input type="radio" name="price_type" value="fixed" class="hidden peer" id="fixedPriceButton" checked required>
                                            <label for="fixedPriceButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Fixed Price</label>
                                        </div>
                                        <div class="relative">
                                            <input type="radio" name="price_type" value="dynamic" class="hidden peer" id="dynamicPriceButton" required>
                                            <label for="dynamicPriceButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Dynamic Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                <div id="fixedPriceSection" class="flex flex-col gap-[16px] justify-start transition-all transition opacity-100">
                                    <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], 'fixed_price_error', null, 'fixed_price', '', '', [], '', 'fixed_price'); ?>
                                    <?php SecondaryInputField::render('dropdownfield', 'Duration', '', ['1 hour', '1 hour and 30 minutes', '2 hours', '2 hours and 30 minutes', '3 hours', '3 hours and 30 minutes', '4 hours', '4 hours and 30 minutes', '5 hours'], '', null, 'duration', '', '', [], '', 'duration', 0, 'This dictates the estimated duration of the entire service.'); ?>
                                </div>
                                </div>
                                <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                                    <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], 'one_hour_price_error', null, 'one_hour_price', '', '', [], '', 'one_hour_price'); ?>
                                    <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], 'one_hour_thirty_price_error', null, 'one_hour_thirty_price', '', '', [], '', 'one_hour_thirty_price'); ?>
                                    <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], 'two_hour_price_error', null, 'two_hour_price', '', '', [], '', 'two_hour_price'); ?>
                                </div>
                                <div class="flex w-full justify-end mt-[32px] ml-[84px]">
                                    <?php NewPrimaryButton::render('Create Service', 'button', 'openConfirmationModal', '260px', null) ?>
                                </div>
                            </div>
                            <div class="sm:w-[150px] text-background dark:text-darkBackground">Spacer</div>
                        </section>
                    </div>
                </div>
            </div>
            <?php ConfirmationDialog::render('ConfirmAddANewServiceModal', 'Are you sure you want to add this service?', 'confirmAddANewServiceButton', 'cancelAddANewServiceButton', 'submit', 'primary') ?>
            <?php ConfirmationDialog::render('UnsavedAddANewServiceProgressModal', 'Are you sure you want exit? All unsaved changes will be lost.', 'proceedUnsavedAddANewServiceProgressButton', 'closeUnsavedAddANewServiceProgressButton', 'button', 'destructive') ?>
        </form>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/AddNewService/AddNewServiceValidation.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/AddNewService/AddNewServiceSelectionDOM.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/AddNewService/AddNewServiceCategoryListener.js"></script>
        <?php
    }
}