<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Buttons\AddonItemButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Buttons\ServiceItemButton;


class Page
{
    public static function page()
    {
        Sidebar::render();
        WorkingBanner::render();
        ?>
        <main class="flex w-full">
            <?php 
            Sidebar::render();
            WorkingBanner::render()
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                <div>
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Services');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <section class="flex gap-[16px] py-[16px]">
                        <?php 
                        ActionButton::render('addServiceSmall', 'Add a new service', 'openAddANewServiceSectionButton'); 
                        ActionButton::render('plusSmall', 'Add a new add-on', 'openAddANewAddOnSectionButton'); 
                        ?>
                    </section>

                    <section>
                        <div class="border-b border-border flex dark:border-darkBorder h-[30px] overflow-x-auto">
                            <div class="mx-[24px] h-[30px]">
                                <button type="button" id="showAllServices" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">All Services</button>
                                <button type="button" id="showMassages" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Massages</button>
                                <button type="button" id="showBodyScrubs" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Body Scrubs</button>
                                <button type="button" id="showPackages" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Packages</button>
                                <button type="button" id="showAddOns" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Add-ons</button>
                                <button type="button" id="showArchivedServices" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Archived Services</button>
                                <button type="button" id="showArchivedAddOns" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Archived Add-on</button>
                            </div>
                        </div>
                    </section>

                    <div class="h-[640px] relative overflow-x-auto overflow-y-auto w-full">
                        <section id="allServicesSection" class="grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="massagesSection" class="grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <!-- Apply the same changes to other sections -->
                        <section id="bodyScrubsSection" class="grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="packagesSection" class="grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="addOnsSection" class="flex flex-col items-center items-top p-[24px] absolute w-full transition-all duration-300 transform">
                            <?php AddonItemButton::render('Headline', '0')?>
                        </section>
                        <section id="archivedServicesSection" class="grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform">
                        </section>
                        <section id="archivedAddOnsSection" class="flex flex-col items-center items-top p-[24px] absolute w-full transition-all duration-300 transform">
                        </section>
                    </div>
                </div>
            </div>
        </main>

        <!-- Add a new add-on section -->
        <div id="AddANewAddOnSection" class="hidden ml-[0px] w-full overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-0 max-w-[480px]">
            <div class="flex justify-start mb-[48px] min-w-[316px] w-full ml-[-8px] sm:ml-[40px]">
                <button id="closeAddANewAddOnButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                    <div class="w-[24px] h-[24px] flex justify-center items-center">
                        <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                    </div>
                </button>
            </div>
            <div class="w-full flex flex-col gap-[48px] items-center sm:mt-[64px] mt-[0px]">
                <section class="flex flex-col gap-[16px] w-[400px] max-w-full">
                    <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new add-on'); ?>
                    <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                </section>
                <section class="flex flex-col gap-[16px] w-[400px]">
                    <div class="flex flex-col gap-[16px] max-w-[480px] items-end justify-end">
                        <?php SecondaryInputField::render('Name', 'Hot Stone', '', [], '', null, '', '', '', [], false, '', 0, '')?>
                        <?php SecondaryInputField::render('dropdownfield', 'Price', '', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('dropdownfield', 'Status', '', [], '', null, '', '', '', [], false, '')?>
                    </div>
                </section> 
                <section class="flex flex-col gap-[16px] w-[400px] items-end max-w-[400px]">
                    <?php NewPrimaryButton::render('Create add-on', '', 'openConfirmAddANewAddOnModal', '257px', null) ?>
                </section>
            </div>

            <!-- Unsaved add a new add on modal -->
            <div id="UnsavedAddANewAddOnModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="closeUnsavedAddANewAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedUnsavedAddANewAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Confirm add a new add on Modal -->
            <div id="ConfirmAddANewAddOnModal" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col relative">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to add this add-on?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelAddANewAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmAddANewAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

            <!-- Delete Add-on Modal -->
            <div id="DeleteAddOnModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground border p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to delete this add-on? This cannot be undone. It is recommended to archive the add-on instead.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="cancelUpdateCancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedUpdateCancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Confirm Edit Add On Modal -->
            <div id="ConfirmEditAddOnModal" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col relative">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to edit this add-on?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelEditAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmEditAddOnButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add a new service section -->
        <div id="AddANewServiceSection" class="hidden ml-[0px] sm:ml-[48px] w-full overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-[50]">
            <div class="sm:w-[3200px] flex flex-col">
                <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full ml-[-8px]">
                    <button id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
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
                        <?php SecondaryInputField::render('dropdownfield', '*Status', '', ['Archived', 'Active'], '', null, '', '', '', [], false, '', 0, '')?>
                        <?php SecondaryInputField::render('dropdownfield', '*Category', '', ['Massages', 'Body Scrubs', 'Packages'], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', '*Service Name', 'Enter Service Name', [], 'service_name_error', null, 'service_name', '', '', [], false, 'service_name')?>
                        <?php SecondaryInputField::render('textareafield', '*Caption', 'Enter Caption', [], 'service_caption_error', null, 'service_caption_error', '', '', [], false, 'service_caption')?>
                        <?php SecondaryInputField::render('textareafield', '*Description', 'Enter Description', [], 'service_description_error', null, 'service_description_error', '', '', [], false, 'service_description')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '2. Secondary Details'); ?>
                        <?php SecondaryInputField::render('textfield', '*Duration Details', 'Enter Duration Details', [], 'duration_details', null, 'duration_details_error', '', '', [], false, 'duration_details')?>
                        <?php SecondaryInputField::render('textfield', '*Party Size Details', 'Enter Party Size Details', [], 'party_size_details', null, 'party_size_details_error', '', '', [], false, 'party_size_details')?>
                        <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], 'massage_details', null, 'massage_details_error', '', '', [], false, 'massage_details')?>
                        <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Body Scrub Details', [], 'body_scrub_details', null, 'body_scrub_details_error', '', '', [], false, 'body_scrub_details')?>
                        <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Add-on Details', [], 'addon_details', null, 'addon_details_error', '', '', [], false, 'addon_details')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '3. Photos'); ?>
                        <?php SecondaryInputField::render('photofield', '*Main Photo', 'Choose a photo', [], 'main_photo', null, 'main_photo_error', '', '', [], false, 'main_photo', 0, 'Must be a photo with a 1:1 aspect ratio and a maximum file size of 5MB.')?>
                        <?php SecondaryInputField::render('multiphotofield', '*Slideshow Photos', 'Choose a photo', [], 'slideshow_photos', null, 'slideshow_photos_error', '', '', [], false, 'slideshow_photos', 0, 'Upload up to 5 photos, each with a 1:1 aspect ratio and a maximum file size of 5MB.')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col mb-[48px] gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '4. Showcase Photos'); ?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 1', 'Choose a photo', [], 'showcase_photo_1', null, 'showcase_photo_1_error', '', '', [], false, 'showcase_photo_1', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_1', null, 'showcase_headline_1_error', '', '', [], false, 'showcase_headline_1')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_1', null, 'showcase_caption_1_error', '', '', [], false, 'showcase_caption_1')?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 2', 'Choose a photo', [], 'showcase_photo_2', null, 'showcase_photo_2_error', '', '', [], false, 'showcase_photo_2', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_2', null, 'showcase_headline_2_error', '', '', [], false, 'showcase_headline_2')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_2', null, 'showcase_caption_2_error', '', '', [], false, 'showcase_caption_2')?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 3', 'Choose a photo', [], 'showcase_photo_3', null, 'showcase_photo_3_error', '', '', [], false, 'showcase_photo_3', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], 'showcase_headline_3', null, 'showcase_headline_3_error', '', '', [], false, 'showcase_headline_3')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], 'showcase_caption_3', null, 'showcase_caption_3_error', '', '', [], false, 'showcase_caption_3')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col mb-[48px] gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                        <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '', null, '', '', '', [], false, '', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.'); ?>
                        <?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub'], '', null, '', '', '', [], false, '', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.'); ?>
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
                    <div id="fixedPriceSection" class="flex justify-start opacity-100 transition transition-all">
                        <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], 'fixed_price', null, 'fixed_price_error', '', '', [], '', 'fixed_price'); ?>
                    </div>
                    <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                        <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], '1_hour_price', null, '1_hour_price_error', '', '', [], '', '1_hour_price'); ?>
                        <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], '1_hour_30_price', null, '1_hour_30_error', '', '', [], '', '1_hour_30_price'); ?>
                        <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], '2_hours_price', null, '2_hours_price_error', '', '', [], '', '2_hours_price'); ?>
                    </div>
                    <div class="flex w-full justify-end mt-[32px]">
                        <?php NewPrimaryButton::render('Create Service', '', 'openConfirmationModal', '257px', null) ?>
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
                        <?php TextRowContainer::render('Average Rating', '', 'onBackground', 'darkOnBackground', 'average_rating', 'average_rating')?>
                        <?php TextRowContainer::render('Total Reviews', '', 'onBackground', 'darkOnBackground', 'total_reviews', 'total_reviews')?>
                        <?php TextRowContainer::render('Creation Date', '', 'onBackground', 'darkOnBackground', 'last_modified_on', 'last_modified_on')?>
                        <?php TextRowContainer::render('Last Modified on', '', 'onBackground', 'darkOnBackground', 'last_modified_on', 'last_modified_on')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col mt-[115px] gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground mb-[24px]', '1. Primary Details'); ?>
                        <?php SecondaryInputField::render('dropdownfield', '*Status', '', [], '', null, '', '', '', [], false, '', 0, '')?>
                        <?php SecondaryInputField::render('dropdownfield', '*Category', '', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('dropdownfield', '*Service Name', '', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textareafield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false)?>
                        <?php SecondaryInputField::render('textareafield', '*Description', 'Enter Description', [], '', null, '', '', '', [], false)?>
                    </div>
                </section>
                <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '2. Secondary Details'); ?>
                        <?php SecondaryInputField::render('textfield', '*Duration Details', 'Enter Duration Details', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', '*Party Size Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', 'Massage Details', 'Enter Massage Details', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', 'Body Scrub Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', 'Add-On Details', 'Enter Service Details', [], '', null, '', '', '', [], false, '')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[40px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col gap-[16px] items-end">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px] w-[480px] sm:w-[400px]', '3. Photos'); ?>
                        <?php SecondaryInputField::render('photofield', '*Main Photo', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must be a photo with a 1:1 aspect ratio and a maximum file size of 5MB.')?>
                        <?php SecondaryInputField::render('multiphotofield', '*Slideshow Photos', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Upload up to 5 photos, each with a 1:1 aspect ratio and a maximum file size of 5MB.')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col mb-[48px] gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '4. Showcase Photos'); ?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 1', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 2', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('photofield', '*Showcase Photo 3', 'Choose a photo', [], '', null, '', '', '', [], false, '', 0, 'Must have 1:1 Aspect Ratio')?>
                        <?php SecondaryInputField::render('textfield', '*Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                        <?php SecondaryInputField::render('textfield', '*Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                    </div>
                </section>
                <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                    <div class="flex flex-col mb-[48px] gap-[16px]">
                        <?php Text::render('', '', 'BodyOne leading-none text-onBackground dark:text-darkOnBackground sm:mt-[115px] mb-[24px]', '5. Selections'); ?>
                        <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '', null, '', '', '', [], false, '', 0, 'This determines the massage options included with the service. You may select one, multiple, or none. If the desired massage is not listed, you will need to create it.'); ?>
                        <?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub'], '', null, '', '', '', [], false, '', 0, 'This determines the body scrub options included with the service. You may select one, multiple, or none. If the desired body scrub is not listed, you will need to create it.'); ?>
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
                    <div id="fixedPriceSection" class="flex justify-startopacity-100 transition transition-all">
                        <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], '', null, ''); ?>
                    </div>
                    <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-start opacity-0 transition transition-all">
                        <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], '', null, ''); ?>
                        <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], '', null, ''); ?>
                        <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], '', null, ''); ?>
                    </div>
                    <div class="flex w-full justify-end mt-[32px]">
                        <?php NewPrimaryButton::render('Save Changes', '', 'openConfirmEditServiceModal', '257px', null) ?>
                        <?php NewPrimaryButton::render('Create Service', '', 'openDeleteServiceModal', '257px', null) ?>
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
                        <button id="confirmDeleteServiceButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>                    
                    </div>
                </div>
            </div>
        </div>
        
<?php
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
    }
}

Page::page();
