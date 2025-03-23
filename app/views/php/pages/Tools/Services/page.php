<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Buttons\AddonItemButton;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
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

        
            <div id="AddANewServiceSection" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto sm:pt-[160px] sm:pl-[10%] overflow-x-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5">
                <div class="w-[2500px] flex flex-col">
                    <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full ml-[-8px]">
                        <button id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        <div class="w-[24px] h-[24px] flex justify-center items-center">
                            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                        </div>
                    </button>
                </div>
                <div class="w-full flex flex-col 2xl:flex-row gap-[48px] 2xl:pb-0 pb-[150px]">
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new service'); ?>
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                        <div class="flex flex-col mt-[48px] gap-[16px]">
                            <?php SecondaryInputField::render('dropdownfield', 'Status', '', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Category', '', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Service Name', '', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textareafield', 'Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textareafield', 'Description', 'Enter Description', [], '', null, '', '', '', [], false, '')?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col gap-[16px]">
                            <?php SecondaryInputField::render('photofield', 'Main Photo', 'Choose a photo', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('multiphotofield', 'Slideshow Photos', 'Choose a photo', [], '', null, '', '', '', [], false, '')?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mb-[48px] gap-[16px]">
                        <?php SecondaryInputField::render('photofield', 'Showcase Photo 1', 'Choose a photo', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('photofield', 'Showcase Photo 2', 'Choose a photo', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('photofield', 'Showcase Photo 3', 'Choose a photo', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Headline', 'Enter Headline', [], '', null, '', '', '', [], false, '')?>
                            <?php SecondaryInputField::render('textfield', 'Caption', 'Enter Caption', [], '', null, '', '', '', [], false, '')?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mb-[48px] gap-[16px]">
                            <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '<p class="leading-none text-onBackgroundTwo CaptionOne">You may select none</p>', null, ''); ?>
                            <?php SecondaryInputField::render('choicesselectionfield', 'Body Scrub Selection', '', ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub'], '', null, ''); ?>
                            <?php SecondaryInputField::render('choicesselectionfield', 'Supplemental Add-ons', '', ['Hot Stone', 'Ear Candling', 'Ventosa'], '', null, ''); ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex items-center gap-[16px] justify-end">
                            <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Customer Type</p>
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
                        <div id="fixedPriceSection" class="flex justify-end transition-all transition opacity-100">
                            <?php SecondaryInputField::render('numberfield', 'Fixed Price', 'Enter price', [], '', null, ''); ?>
                        </div>
                        <div id="dynamicPriceSection" class="flex flex-col gap-[16px] hidden justify-end opacity-0 transition transition-all">
                            <?php SecondaryInputField::render('numberfield', '1 Hour', 'Enter price', [], '', null, ''); ?>
                            <?php SecondaryInputField::render('numberfield', '1 Hour & 30 Minutes', 'Enter price', [], '', null, ''); ?>
                            <?php SecondaryInputField::render('numberfield', '2 Hours', 'Enter price', [], '', null, ''); ?>
                        </div>
                        <div class="flex w-full justify-end mt-[32px]">
                            <?php NewPrimaryButton::render('Create Service', '', 'CreateServiceButton', '257px', null) ?>
                        </div>
                    </section> 
                </div>
            </div>
        


        <!-- OLD PAGE -->
         <!-- OLD PAGE -->
          <!-- OLD PAGE -->
           <!-- OLD PAGE -->
            <!-- OLD PAGE -->
             <!-- OLD PAGE -->
              <!-- OLD PAGE -->
               <!-- OLD PAGE -->

               <!-- OLD PAGE --><!-- OLD PAGE -->
                <!-- OLD PAGE -->
                 <!-- OLD PAGE -->
                  <!-- OLD PAGE -->
                   <!-- OLD PAGE -->
                    <!-- OLD PAGE -->
                     <!-- OLD PAGE -->
                      <!-- OLD PAGE -->
                       <!-- OLD PAGE -->
                        <!-- OLD PAGE -->

                        <!-- OLD PAGE -->
                         <!-- OLD PAGE -->
                          <!-- OLD PAGE -->
                           <!-- OLD PAGE -->
                            <!-- OLD PAGE -->
                             <!-- OLD PAGE -->
                              <!-- OLD PAGE -->
                               <!-- OLD PAGE -->
                                <!-- OLD PAGE -->
                                 <!-- OLD PAGE -->
                                  <!-- OLD PAGE -->
                                   <!-- OLD PAGE -->
                                    <!-- OLD PAGE -->
                                     <!-- OLD PAGE --><!-- OLD PAGE -->
                                      <!-- OLD PAGE -->
                                       <!-- OLD PAGE -->
        </main>
        
<?php
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
    }
}

Page::page();
