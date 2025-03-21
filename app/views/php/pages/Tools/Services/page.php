<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\SelectField;
use Project\App\Views\Php\Components\Inputs\SearchField;
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

        <div class="overflow-auto flex flex-col mt-[104px] sm:mt-[160px] md:justify-center items-center w-full">
            <form class="flex flex-col gap-12" action="/createService" method="POST">
                <div class="flex flex-col gap-2">
                    <?php
                    Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Create a Service');
                    Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Details');
                    ?>
                </div>

                <div class="flex flex-col">
                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[0px]', 'Category');
                    $categories = ['Massage', 'Body Scrub', 'Stone Massage'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[0px]">
                        <?php SelectField::render($categories, 'Category', 'categoryService', 'Select a category'); ?>
                    </div>

                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Service Name');
                    $services = ['Bamboossage Massage', 'Body Scrub', 'Stone Massage'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[0px]">
                        <?php SelectField::render($services, 'Service Name', 'serviceName', 'Select a service'); ?>
                    </div>

                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Caption');
                    $captions = ['Relaxing Experience', 'Deep Cleansing', 'Rejuvenating Touch'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[48px]">
                        <?php SelectField::render($captions, 'Caption', 'captionName', 'Select a caption'); ?>
                    </div>

                    <div class="flex flex-col gap-[24px] pb-[48px] w-full">
                        <?php Text::render('', '', 'text-[16px] font-[500] dark:text-white', 'Description'); ?>
                        <textarea name="description" placeholder="Enter your message..."
                            class="w-full h-[150px] border border-gray-400 rounded-md px-4 py-3 
                                   bg-transparent text-onBackground dark:text-white focus:outline-none resize-none"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <?php

?>
        <main class="flex w-full">
            <?php 
            Sidebar::render();
            WorkingBanner::render()
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
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

                    <div class="sm:h-[351px] relative overflow-hidden">
                        <section id="allServicesSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="massagesSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="bodyScrubsSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="packagesSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                            <?php ServiceItemButton::render('', 'headline', 'description', 'rating', 'price', 'id');?>
                        </section>
                        <section id="addOnsSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                        </section>
                        <section id="archivedServicesSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
                        </section>
                        <section id="archivedAddOnsSection" class="flex flex-col sm:flex-row items-top p-[24px] absolute w-full transition-all duration-300 transform">
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
                            <?php SecondaryInputField::render('choicesselectionfield', 'Massage Selection', '', ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish'], '<p class="text-onBackgroundTwo leading-none CaptionOne">You may select none</p>', null, ''); ?>
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
                        <div id="fixedPriceSection" class="flex justify-end opacity-100 transition transition-all">
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
        <main class="flex hidden w-full">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                <div id="topSection">
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[8px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Services');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>


                    <section class="flex mt-[24px]">
                        <button id="addANewServiceButton" class="min-w-[200px] min-h-[42px] flex justify-start items-center pl-[12px] bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover rounded-[6px] transition-all">
                            <?php IconChoice::render('addServiceSmall', '[16px]', '[16px]', '', 'onPrimary', 'darkOnPrimary');
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
                        <p id="test">No there's no services yet</p>
                    </div>
                </div>
                <div id="addANewCategoryModal" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full">
                        <button id="closeAddANewCategoryModal" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    
                        <div class="w-full flex sm:items-start flex-col">
                            <section class="flex flex-col gap-[12px] min-w-[316px] w-full justify-center sm:justify-start">
                                <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new category');
                                Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                            </section>
                            <section class="mt-[64px] translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                                <div class="flex items-end w-full max-w-[400px]">
                                    <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Name.&nbsp;'); ?>
                                    <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What is it called?'); ?>
                                </div>
                                <div class="w-full flex justify-center sm:justify-start">
                                    <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]">
                                        <?php GlobalInputField::render('categoryNameField', 'Service Name', 'text', '', ''); ?>
                                    </div>
                                </div>
                            </section>
                            <section class="mt-[64px] translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                                <div class="flex items-end w-full max-w-[400px]">
                                    <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Icon.&nbsp;'); ?>
                                    <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', ''); ?>
                                </div>
                                <div class="w-full flex justify-center sm:justify-start">
                                    <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]">
                                        <?php GlobalInputField::render('categoryNameField', 'Service Name', 'text', '', ''); ?>
                                    </div>
                                </div>
                            </section>
                            <div class="flex justify-center gap-2 mt-[48px]">
                                 <?php NewPrimaryButton::render('Book', '', 'BookButton', '257px', null) ?>
                            </div>
                        </div>
                    
                </div>
                
                <!-- Add a new service -->
                <div id="addANewServiceSection" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full">
                        <button type="button" id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
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
                            <div class="mt-[64px] mb-[150px] w-full flex justify-center translate-y-4 transition-all duration-500 ease-in-out max-w-[400px]">      
                                <?php PrimaryButton::render("Create Service", "button", "", "", "", "", null, null, null, "openConfirmationModal"); ?>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- Category Details -->
                <div id="categoryDetailsSection" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <div class="w-full flex justify-start mb-[48px]">
                        <button id="closeCategoryDetails" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    <div class="">
                        <?php Text::render('', '', 'HeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', '$CategoryName'); ?>
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
                        <div class="flex flex-col w-full sm:items-start">
                            <section class="flex flex-col gap-[12px] min-w-[316px] w-full justify-center sm:justify-start">
                                <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new service');
                                Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                            </section>
                            <section id="newServiceCategory" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start">
                                <div class="flex items-end w-full max-w-[400px]">
                                    <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Category.&nbsp;'); ?>
                                    <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'Where does the new service belong?'); ?>
                                </div>
                                <div id="radioContainer">
                                </div>
                            </section>

                            <section id="newServiceName" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                                <div class="flex items-end w-full max-w-[400px]">
                                    <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Name.&nbsp;'); ?>
                                    <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What is it called?'); ?>
                                </div>
                                <div id="input-container" class="flex justify-center w-full sm:justify-start">
                                    <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]" id="input-field-1">
                                        <?php GlobalInputField::render('serviceNameInputField', 'Service Name', 'text', 'newServiceNameInputField', ''); ?>
                                    </div>
                                </div>
                            </section>

                            <section id="newServiceDescription" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="3" hidden>
                                <div class="flex items-end w-full max-w-[400px]">
                                    <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Description.&nbsp;');
                                    Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What are its details? (Optional)'); ?>
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
                                    GlobalInputField::render(
                                        'newServicePriceInputField',
                                        'Price',
                                        'number',
                                        'servicePriceInputField',
                                        '',
                                        'min="0" max="5000" step="1"',
                                        'validate-price-number'
                                    );
                                    ?>
                                </div>
                            </section>

                            <section id="newServicePreview" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out flex flex-col w-full items-center sm:items-start" data-step="5" hidden>
                                <div class="mt-[64px] mb-[150px] w-full flex justify-center translate-y-4 transition-all duration-500 ease-in-out max-w-[400px]">
                                    <?php PrimaryButton::render("Create Service", "button", "", "", "", "", null, null, null, "openConfirmationModal"); ?>
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
                            <?php Text::render('', '', 'HeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Category Name'); ?>
                        </div>
                    </div>
                    <!-- Add Confirmation Modal -->
                    <div id="confirmationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[1000]">
                        <div class="bg-background dark:bg-darkBackground p-[48px] border-border border-[1px] dark:border-darkBorder flex flex-col justify-between rounded-[6px] w-[364px] sm:w-[496px] z-[60]">
                            <div>
                                <div class="w-full flex justify-end mb-[48px]">
                                    <button type="button" id="closeConfirmationModal" class="cursor-pointer w-[16px] h-[16px]">
                                        <?php IconChoice::render('exitSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface'); ?>
                                    </button>
                                </div>
                                <?php Text::render('', '', 'HeaderTwo m-0 p-0 leading-none text-left text-onBackground dark:text-darkOnBackground mb-[16px]', 'Confirm new service');
                                Text::render('', '', 'BodyTwo m-0 p-0 leading-none text-left text-onBackgroundTwo dark:text-darkOnBackgroundTwo mb-[32px]', 'Please review the details below.'); ?>

                                <!-- Move the preview card here -->
                                <div id="servicePreviewCard" class="border-borderHighlight dark:border-darkBorderHighlight w-full border-[2px] rounded-[6px] bg-background dark:bg-darkBackground p-[32px]">
                                    <div class="flex justify-between">
                                        <div id="hiddenContainer">
                                        </div>
                                        <div id="hiddenContainer2">
                                        </div>
                                        <span id="previewServiceName" class="leading-none BodyMediumTwo text-onBackground dark:text-darkOnBackground">Service Name</span>
                                        <span id="previewServicePrice" class="leading-none BodyMediumTwo text-onBackground dark:text-darkOnBackground">₱0.00</span>
                                    </div>
                                    <p id="previewShortDescription" class="flex flex-col CaptionOne text-onSurface dark:text-darkOnSurface mt-[16px]" style="word-break: break-word;"></p>
                                </div>
                            </div>
                            <div class="flex justify-center gap-2 mt-[48px]">
                                <?php PrimaryButton::render("Confirm", "submit"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php Sidebar::render(); ?>
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
