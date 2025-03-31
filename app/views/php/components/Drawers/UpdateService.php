<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Buttons\BackButton;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Headers\DrawerTitle;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Modals\ConfirmationDialog;
use Project\App\Views\Php\Components\Texts\Helper;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;

class UpdateService
{
    public static function render(): void
    {
        ?>
        <form action="/updateService" method="post" id="UpdateServiceForm" onsubmit="return UpdateServiceValidation.validateForm(event)">
            <div id="UpdateServiceSection" class="pl-[0px] w-full overflow-x-auto pr-[48px] mr-[48px] pt-[48px] ml-[48px] sm:pl-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-[20]">
                <?php BackButton::render('exitUpdateService'); ?>
                <div class="flex flex-col sm:p-[48px]  pr-[48px] mr-[48px] ">
                <div class="w-full flex flex-col sm:flex-row gap-[100px] pb-[150px]">
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <?php DrawerTitle::render('Update Service', 'You may modify the following.'); ?>
                            <div class="flex flex-col mt-[54px] gap-[16px]">
                                <div class="flex flex-row">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '1. Primary Details'); ?>
                                </div>                                
                                <?php SecondaryInputField::render('dropdownfield', 'Status', '', ['Archived', 'Active'], 'update_status_error', null, 'update_status', '',  '', [], false, 'update_status', 0) ?>
                                <?php SecondaryInputField::render('dropdownfield', 'Category', '', ['Massages', 'Body Scrubs', 'Packages'], '', null, 'update_category', '', '', [], true, 'update_category', 0, 'Category cannot be changed') ?>
                                <?php SecondaryInputField::render('textfield', 'Service Name', 'Enter Service Name', [], 'update_service_name_error', null, 'update_service_name', '', '', [], false, 'update_service_name', 0) ?>
                                <?php SecondaryInputField::render('textareafield', 'Caption', 'Enter Caption', [], 'update_caption_error', null, 'update_caption', '', '', [], false, 'update_caption', 0, 'This is displayed alongside the service name in menu selections.') ?>
                                <?php SecondaryInputField::render('textareafield', 'Description', 'Enter Description', [], 'update_description_error', null, 'update_description', '', '', [], false, 'update_description', 0, 'This is displayed in the service view.') ?>
                                <?php SecondaryInputField::render('hidden', '', '', [], '', null, 'update_service_id', '', '', [], false, 'update_service_id') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px]">
                                <div class="flex flex-row gap-[8px] sm:mt-[115px] ">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '2. Secondary Details'); ?>
                                    <?php Helper::render('Describe what comes with the service. This will appear as a list of details in the service view.') ?>
                                </div>                                
                                <?php SecondaryInputField::render('textfield', 'Duration Details', 'Enter Duration Details', [], 'update_duration_details_error', null, 'update_duration_details', '', '', [], false, 'update_duration_details', 0)?>
                                <?php SecondaryInputField::render('textfield', 'Party Size Details', 'Enter Service Details', [], 'update_party_size_details_error', null, 'update_party_size_details', '', '', [], false, 'update_party_size_details', 0) ?>
                                <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], 'update_massage_details_error', null, 'update_massage_details', '', '', [], false, 'update_massage_details', 0) ?>
                                <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Service Details', [], 'update_body_scrub_details_error', null, 'update_body_scrub_details', '', '', [], false, 'update_body_scrub_details', 0) ?>
                                <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Service Details', [], 'update_addon_details_error', null, 'update_addon_details', '', '', [], false, 'update_addon_details', 0) ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px] items-end">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px] w-[480px] sm:w-[400px]', '3. Photos'); ?>
                                <?php SecondaryInputField::render('photofield', '*Main Photo', 'Choose a photo', [], 'update_main_photo_error', null, 'update_main_photo', '', '', [], false, 'update_main_photo', 0, 'Must be a photo with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                                <?php SecondaryInputField::render('multiphotofield', '*Slideshow Photos', 'Choose a photo', [], 'update_slideshow_photos_error', null, 'update_slideshow_photos', '', '', [], false, 'update_slideshow_photos', 0, 'Upload up to 5 photos, each with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <div class="flex flex-row gap-[8px] sm:mt-[115px] ">
                                    <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '4. Showcase Photos'); ?>
                                    <?php Helper::render('The details provided must showcase the service process and/or benefits.') ?>
                                </div>                                
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 1', 'Choose a photo', [], 'update_showcase_photo1_error', null, 'update_showcase_photo1', '', '', [], false, 'update_showcase_photo1', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'update_headline1_error', null, 'update_headline1', '', '', [], false, 'update_headline1', 0, 'update_headline1') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'update_caption1_error', null, 'update_caption1', '', '', [], false, 'update_caption1', 0, 'update_caption1') ?>
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 2', 'Choose a photo', [], 'update_showcase_photo2_error', null, 'update_showcase_photo2', '', '', [], false, 'update_showcase_photo2', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'update_headline2_error', null, 'update_headline2', '', '', [], false, 'update_headline2', 0, 'update_headline2') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'update_caption2_error', null, 'update_caption2', '', '', [], false, 'update_caption2', 0, 'update_caption2') ?>
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 3', 'Choose a photo', [], 'update_showcase_photo3_error', null, 'update_showcase_photo3', '', '', [], false, 'update_showcase_photo3', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'update_headline3_error', null, 'update_headline3', '', '', [], false, 'update_headline3', 0, 'update_headline3') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'update_caption3_error', null, 'update_caption3', '', '', [], false, 'update_caption3', 0, 'update_caption3') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                                <div id="update_massage_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', [], '', null, 'update_massage_selection', '', '', [], false, 'update_massage_selection', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.'); ?></div>
                                <div id="update_body_scrub_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', [], '', null, 'update_body_scrub_selection', '', '', [], false, 'update_body_scrub_selection', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.'); ?></div>
                                <div id="update_addon_selection_wrapper"><?php SecondaryInputField::render('choicesselectionfield', 'Supplemental Add-ons', '', [], '', null, 'update_addon_selection', '', '', [], false, 'update_addon_selection', 0, 'This determines the add-ons included with the service. You may select one, multiple, or none. If the desired add-on is not listed, you will need to create it.'); ?></div>
                                <?php SecondaryInputField::render('dropdownfield', 'Party Size', '', ['All choices', 'Solo only', 'Duo only', 'Trio only'], '', null, 'update_party_size', '', '', [], false, 'update_party_size', 0, 'This locks the party size selection in the chosen setting.') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] items-end w-[480px] sm:w-[400px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground w-[480px] sm:w-[400px] dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Price'); ?>
                            <div class="flex items-center gap-[16px] justify-end">
                                <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Price Type</p>
                                <div class="flex gap-[16px]">
                                    <div class="relative">
                                        <input type="radio" name="price_type" value="fixed" class="hidden peer" id="updateFixedPriceButton" checked required>
                                        <label for="fixedPriceButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Fixed Price</label>
                                    </div>
                                    <div class="relative">
                                        <input type="radio" name="price_type" value="dynamic" class="hidden peer" id="updateDynamicPriceButton" required>
                                        <label for="dynamicPriceButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Dynamic Price</label>
                                    </div>
                                </div>
                            </div>
                            <div id="updateFixedPriceSection" class="flex transition-all transition justify-startopacity-100">
                                <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], 'update_fixed_price_error', null, 'update_fixed_price', '', '', [], '', 'update_fixed_price' ); ?>
                            </div>
                            <div id="updateDynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                                <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], 'update_one_hour_price_error', null, 'update_one_hour_price', '', '', [], '', 'update_one_hour_price'); ?>
                                <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], 'update_one_hour_thirty_price_error', null, 'update_one_hour_thirty_price', '', '', [], '', 'update_one_hour_thirty_price'); ?>
                                <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], 'update_two_hour_price_error', null, 'update_two_hour_price', '', '', [], '', 'update_two_hour_price'); ?>
                            </div>
                            <div class="flex w-full justify-end mt-[32px]">
                                <?php NewPrimaryButton::render('Save Changes', '', 'openConfirmEditServiceModal', '257px', null) ?>
                                <?php NewPrimaryButton::render('Delete Service', '', 'openDeleteServiceModal', '257px', null) ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <?php ConfirmationDialog::render('ConfirmUpdateServiceModal', 'Are you sure you want to update this service?', 'proceedUpdateService', 'cancelUpdateService', 'submit', 'primary') ?>
            <?php ConfirmationDialog::render('UnsavedUpdateServiceModal', 'Are you sure you want exit? All unsaved changes will be lost.', 'proceedUnsavedUpdateService', 'cancelUnsavedUpdateService', 'button', 'destructive') ?>
            <?php ConfirmationDialog::render('DeleteUpdateServiceModal', 'Are you sure you want to delete this service? It is recommended instead to archive it.', 'proceedDeleteUpdateService', 'cancelDeleteUpdateService', 'button', 'destructive') ?>
        </form>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/UpdateService/UpdateServicePhotoHandler.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/UpdateService/UpdateServiceValidation.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/UpdateService/UpdateServiceDOM.js"></script>
        <?php
    }
}