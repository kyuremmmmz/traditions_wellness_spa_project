<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Buttons\ActionButtons;
use Project\App\Views\Php\Components\Buttons\LazyRowButtons;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Drawers\NewAddOn;
use Project\App\Views\Php\Components\Drawers\UpdateAddOn;
use Project\App\Views\Php\Components\Headers\PageTitle;
use Project\App\Views\Php\Components\Sections\LazyGrid;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <?php
            Sidebar::render();
            WorkingBanner::render();
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                <div>
                    <?php PageTitle::render('servicesMedium', 'Services') ?>
                    <section class="flex gap-[16px] py-[16px]">
                        <?php ActionButtons::render([['id' => 'openAddANewServiceSectionButton', 'content' => '+ Add a new service'],['id' => 'openAddANewAddOnSectionButton', 'content' => '+ Add a new add-on']]); ?>
                    </section>
                    <section>
                        <?php LazyRowButtons::render([['showAllServices', 'All Services'], ['showMassages', 'Massages'], ['showBodyScrubs', 'Body Scrubs'], ['showPackages', 'Packages'], ['showAddOns', 'Add-ons'], ['showArchivedServices', 'Archived Services'], ['showArchivedAddOns', 'Archived Add-on']]); ?>
                    </section>
                    <section>
                        <?php LazyGrid::render([['allServices', true],['massages', true], ['bodyScrubs', true], ['packages', true], ['addOns', true], ['archivedServices', true], ['archivedAddOns', true]]); ?>
                    </section>
                </div>
            </div>
        </main>

        <?php NewAddOn::render(); ?>
        <?php UpdateAddOn::render(); ?>
        
        <!-- Unsaved add a new add on modal -->
            
        



        <form action="/createService" method="post" enctype="multipart/form-data">
            <!-- Add a new service section -->
            <div id="AddANewServiceSection" class=" ml-[0px] sm:ml-[48px] w-full overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-[50]">
                <div class="sm:w-[3200px] flex flex-col">
                    <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full ml-[-8px]">
                        <button type="button" id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    <div class="w-full flex flex-col sm:flex-row gap-[100px] mt-[0px] sm:mt-[48px] 2xl:pb-0">
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new service'); ?>
                            <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following. Fields labeled with * are required.'); ?>
                            <div class="flex flex-col mt-[48px] gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '1. Primary Details'); ?>
                                <?php SecondaryInputField::render('dropdownfield', '*Status', '', ['Archived', 'Active'], '', null, '', '', '', [], false, 'status', 0, '') ?>
                                <?php SecondaryInputField::render('dropdownfield', '*Category', '', ['Massages', 'Body Scrubs', 'Packages'], '', null, 'category', '', '', [], false, 'category') ?>
                                <?php SecondaryInputField::render('textfield', '*Service Name', 'Enter Service Name', [], 'service_name_error', null, 'service_name', '', '', [], false, 'service_name') ?>
                                <?php SecondaryInputField::render('textareafield', '*Caption', 'Enter Caption', [], 'service_caption_error', null, 'service_caption', '', '', [], false, 'service_caption') ?>
                                <?php SecondaryInputField::render('textareafield', '*Description', 'Enter Description', [], 'service_description_error', null, 'service_description', '', '', [], false, 'service_description') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '2. Secondary Details'); ?>
                                <?php SecondaryInputField::render('textfield', '*Duration Details', 'Enter Duration Details', [], 'duration_details_error', null, 'duration_details', '', '', [], false, 'duration_details') ?>
                                <?php SecondaryInputField::render('textfield', '*Party Size Details', 'Enter Party Size Details', [], 'party_size_details_error', null, 'party_size_details', '', '', [], false, 'party_size_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], 'massage_details_error', null, 'massage_details', '', '', [], false, 'massage_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Body Scrub Details', [], 'body_scrub_details_error', null, 'body_scrub_details', '', '', [], false, 'body_scrub_details') ?>
                                <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Add-on Details', [], 'addon_details_error', null, 'addon_details', '', '', [], false, 'addon_details') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '3. Photos'); ?>
                                <?php SecondaryInputField::render('photofield', '*Main Photo', 'Choose a photo', [], 'main_photo_error', null, 'main_photo', '', '', [], false, 'main_photo', 0, 'Must be a photo with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                                <?php SecondaryInputField::render('multiphotofield', '*Slideshow Photos', 'Choose a photo', [], 'slideshow_photos_error', null, 'slideshow_photos', '', '', [], false, 'slideshow_photos', 0, 'Upload up to 5 photos, each with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '4. Showcase Photos'); ?>
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 1', 'Choose a photo', [], 'showcase_photo_1_error', null, 'showcase_photo', '', '', [], false, 'showcase_photo_1', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_1_error', null, 'showcase_headline_1', '', '', [], false, 'showcase_headline_1') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_1_error', null, 'showcase_caption_1', '', '', [], false, 'showcase_caption_1') ?>
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 2', 'Choose a photo', [], 'showcase_photo_2_error', null, 'showcase_photo_2', '', '', [], false, 'showcase_photo_2', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_2_error', null, 'showcase_headline_2', '', '', [], false, 'showcase_headline_2') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_2_error', null, 'showcase_caption_2', '', '', [], false, 'showcase_caption_2') ?>
                                <?php SecondaryInputField::render('photofield', '*Showcase Photo 3', 'Choose a photo', [], 'showcase_photo_3_error', null, 'showcase_photo_3', '', '', [], false, 'showcase_photo_3', 0, 'Must have 1:1 Aspect Ratio') ?>
                                <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_3_error', null, 'showcase_headline_3', '', '', [], false, 'showcase_headline_3') ?>
                                <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_3_error', null, 'showcase_caption_3', '', '', [], false, 'showcase_caption_3') ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                            <div class="flex flex-col mb-[48px] gap-[16px]">
                                <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                                <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '', null, 'massage_selection', '', '', [], false, 'massage_selection', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.'); ?>
                                <?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub'], '', null, 'body_scrub_selection', '', '', [], false, 'body_scrub_selection', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.'); ?>
                                <?php SecondaryInputField::render('choicesselectionfield', 'Supplemental Add-ons', '', ['Hot Stone', 'Ear Candling', 'Ventosa'], '', null, 'addon_selection', '', '', [], false, 'addon_selection', 0, 'This determines the add-ons included with the service. You may select one, multiple, or none. If the desired add-on is not listed, you will need to create it.'); ?>
                            </div>
                        </section>
                        <section class="flex flex-col gap-[16px] items-end w-[480px] sm:w-[400px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground w-[480px] sm:w-[400px] dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Price'); ?>
                            <div class="flex items-center gap-[16px] justify-end">
                                <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Price Type</p>
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
                            <div id="fixedPriceSection" class="flex justify-start transition-all transition opacity-100">
                                <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], 'fixed_price_error', null, 'fixed_price', '', '', [], '', 'fixed_price'); ?>
                            </div>
                            <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                                <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], '1_hour_price_error', null, '1_hour_price', '', '', [], '', '1_hour_price'); ?>
                                <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], '1_hour_30_price_error', null, '1_hour_30_price', '', '', [], '', '1_hour_30_price'); ?>
                                <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], '2_hours_price_error', null, '2_hours_price', '', '', [], '', '2_hours_price'); ?>
                            </div>
                            <div class="flex w-full justify-end mt-[32px]">
                                <?php NewPrimaryButton::render('Create Service', 'button', 'openConfirmationModal', '257px', null) ?>
                            </div>
                        </section>
                    </div>
                    <!-- Unsaved add a new service progress modal -->
                    <div id="UnsavedAddANewServiceProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                        <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] mb-[48px] flex flex-col gap-[24px]">
                            <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this section? All unsaved changes will be lost.</p>
                            <div class="flex gap-[16px] justify-end mt-[48px]">
                                <button type="button" id="closeUnsavedAddANewServiceProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                                <button id="proceedUnsavedAddANewServiceProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm add a new service Modal -->
                    <div id="ConfirmAddANewServiceModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                        <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col mb-[48px]">
                            <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to add this service?</p>
                            <div class="flex gap-[16px] justify-end mt-[48px]">
                                <button type="button" id="cancelAddANewServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                                <button type="submit" id="confirmAddANewServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Update service section -->
        <div id="UpdateServiceSection" class="hidden ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto sm:pt-[160px] sm:pl-[10%] overflow-x-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start w-full transform translate-x-full transition-transform duration-300 ease-in-out z-[52]">
            <div class="sm:w-[3200px] flex flex-col">
                <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full ml-[-8px]">
                    <button id="closeUpdateServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        <div class="w-[24px] h-[24px] flex justify-center items-center">
                            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                        </div>
                    </button>
                </div>
                <div class="w-full flex flex-col sm:flex-row gap-[100px] 2xl:pb-0 pb-[150px]">
                    <section class="flex flex-col gap-[40px] w-[300px] sm:w-[300px]">
                        <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Update service'); ?>
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'You may modify the following.'); ?>
                        <div class="flex flex-col gap-[16px]">
                            <?php TextRowContainer::render('Average Rating', '', 'onBackground', 'darkOnBackground', 'average_rating', 'average_rating') ?>
                            <?php TextRowContainer::render('Total Reviews', '', 'onBackground', 'darkOnBackground', 'total_reviews', 'total_reviews') ?>
                            <?php TextRowContainer::render('Creation Date', '', 'onBackground', 'darkOnBackground', 'last_modified_on', 'last_modified_on') ?>
                            <?php TextRowContainer::render('Last Modified on', '', 'onBackground', 'darkOnBackground', 'last_modified_on', 'last_modified_on') ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mt-[115px] gap-[16px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '1. Primary Details'); ?>
                            <?php SecondaryInputField::render('dropdownfield', '*Status', '', [], '', null, '', '', '', [], false, '', 0, '') ?>
                            <?php SecondaryInputField::render('dropdownfield', '*Category', '', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('dropdownfield', '*Service Name', '', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textareafield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false) ?>
                            <?php SecondaryInputField::render('textareafield', '*Description', 'Enter Description', [], '', null, '', '', '', [], false) ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col gap-[16px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '2. Secondary Details'); ?>
                            <?php SecondaryInputField::render('textfield', '*Duration Details', 'Enter Duration Details', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', '*Party Size Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '') ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col gap-[16px] items-end">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px] w-[480px] sm:w-[400px]', '3. Photos'); ?>
                            <?php SecondaryInputField::render('photofield', '*Main Photo', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must be a photo with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                            <?php SecondaryInputField::render('multiphotofield', '*Slideshow Photos', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Upload up to 5 photos, each with a 1:1 aspect ratio and a maximum file size of 5MB.') ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mb-[48px] gap-[16px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '4. Showcase Photos'); ?>
                            <?php SecondaryInputField::render('photofield', '*Showcase Photo 1', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio') ?>
                            <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('photofield', '*Showcase Photo 2', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio') ?>
                            <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('photofield', '*Showcase Photo 3', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio') ?>
                            <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '') ?>
                            <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '') ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mb-[48px] gap-[16px]">
                            <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                            <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '', null, '', '', '', [], false, '', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.', 'disabled'); ?>
                            <?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub'], '', null, '', '', '', [], false, '', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.', 'disabled'); ?>
                            <?php SecondaryInputField::render('choicesselectionfield', 'Supplemental Add-ons', '', ['Hot Stone', 'Ear Candling', 'Ventosa'], '', null, '', '', '', [], false, '', 0, 'This determines the add-ons included with the service. You may select one, multiple, or none. If the desired add-on is not listed, you will need to create it.'); ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] items-end w-[480px] sm:w-[400px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground w-[480px] sm:w-[400px] dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Price'); ?>
                        <div class="flex items-center gap-[16px] justify-end">
                            <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Price Type</p>
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
                        <div id="fixedPriceSection" class="flex transition-all transition justify-startopacity-100">
                            <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], '', null, ''); ?>
                        </div>
                        <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                            <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], '', null, ''); ?>
                            <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], '', null, ''); ?>
                            <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], '', null, ''); ?>
                        </div>
                        <div class="flex w-full justify-end mt-[32px]">
                            <?php NewPrimaryButton::render('Save Changes', '', 'openConfirmEditServiceModal', '257px', null) ?>
                            <?php NewPrimaryButton::render('Delete Service', '', 'openDeleteServiceModal', '257px', null) ?>
                        </div>
                    </section>
                </div>

                <!-- Unsaved edit service progress modal -->
                <div id="UnsavedEditServiceProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="closeUnsavedEditServiceProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button id="proceedUnsavedAddANewServiceProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                        </div>
                    </div>
                </div>

                <!-- Confirm edit service Modal -->
                <div id="ConfirmEditServiceModal" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col relative">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to edit this service?</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="cancelEditServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button type="submit" id="confirmEditServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                        </div>
                    </div>
                </div>

                <!-- Delete service Modal -->
                <div id="DeleteServiceModal" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col relative">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to delete this service? This cannot be undone. It is recommended to archive the service instead.</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="cancelDeleteServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button type="button" id="confirmDeleteServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/ServicesValidation.js"></script>
            <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/ServicesSelectionLoader.js"></script>
            <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/Addons/AddOnsSelectionLoader.js"></script>
            <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/SelectionBehavior.js"></script>
    <?php
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
    }
}

Page::page();
