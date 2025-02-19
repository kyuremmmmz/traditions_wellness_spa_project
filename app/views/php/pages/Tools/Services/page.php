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
                    <div class="min-w-[316px] w-full max-w-[400px] flex items-center sm:justify-start flex-col">
                        <section class="flex flex-col gap-[12px] min-w-[316px] w-full max-w-[400px]">
                            <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new service');
                            Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                        </section>
                        <section id="newServiceCategory" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out delay-400">
                            <div class="flex items-end">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Category.&nbsp;'); ?>
                                <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'Where does the new service belong?'); ?>
                            </div>
                            <div class="mt-[24px] min-w-[316px] max-w-[400px]">
                                <div class="flex gap-2">
                                    <input type="radio" id="option1" name="radioGroup" class="hidden peer/option1">
                                    <label for="option1"
                                        class="cursor-pointer border-border dark:border-darkBorder rounded-[6px] w-full h-[40px] peer-checked/option1:border-borderHighlight dark:peer-checked/option1:border-darkBorderHighlight border-[2px] transition-all flex items-center pl-[12px]">
                                        <?php IconChoice::render('defaultSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface'); ?>
                                        <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface pl-[12px]', 'Category Name'); ?>
                                    </label>
                                </div>
                            </div>
                        </section>

                        <section id="newServiceName" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out" data-step="2" hidden>
                            <div class="flex items-end">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Name.&nbsp;'); ?>
                                <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What is it called?'); ?>
                            </div>
                            <div id="input-container">
                                <div class="mt-[24px]" id="input-field-1">
                                    <?php GlobalInputField::render('serviceNameInputField', 'Service Name', 'text', '', ''); ?>
                                </div>
                            </div>
                        </section>

                        <section id="newServiceDescription" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out" data-step="3" hidden>
                            <div class="flex items-end">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Description.&nbsp;');
                                Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What are its details?'); ?>
                            </div>
                            <div class="mt-[24px] min-w-[316px] max-w-[400px]">
                                <?php Text::render('', '', 'CaptionOne w-full text-onSurface dark:text-darkOnSurface', 'This is optional but you may provide a list of short descriptions. It should follow the order below.'); ?>
                                <ul class="CaptionOne text-onSurface dark:text-darkOnSurface">
                                    <li>• Duration <em>(1 hour, 1 hour and 30 minutes, etc.)</em></li>
                                    <li>• Choice <em>(Any choice of..., Hilot or Swedish Massage) </em></li>
                                    <li>• Add-ons <em>(With Ventosa, Ear Candling, etc.) </em></li>
                                    <li>• Number of clients <em>(For one person, For two people, etc.)</em></li>
                                </ul>
                            </div>
                            <div id="input-container-list" class="mt-[24px]">
                                <?php
                                // Initially render one input field
                                GlobalInputField::render('', 'Short Description 1', 'text', '', '');
                                ?>
                            </div>
                            <button id="add-short-description" type="button" class="w-full h-[45px] px-[12px] border-dashed bg-background flex items-center text-left dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo rounded-[6px] autofill:bg-background dark:autofill:bg-background hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                <?php IconChoice::render('plusBoxVerySmall', '[16px]', '[16px]', '', 'onBackgroundTwo', 'darkOnBackgroundTwo');
                                Text::render('', '', 'BodyOne pl-[12px] leading-none text-onBackgroundTwo dark:text-onBackgroundTwo', 'Add a new description'); ?>
                            </button>
                        </section>

                        <section id="newServicePrice" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out" data-step="4" hidden>
                            <div class="flex items-end">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Price.&nbsp;');
                                Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'How much does it cost?'); ?>
                            </div>
                            <div class="mt-[24px] w-full">
                                <?php Text::render('', '', 'CaptionOne w-full text-onSurface dark:text-darkOnSurface', 'You can leave this blank if the price of the new service is affected by choice of duration, add-ons, and etc..'); ?>
                            </div>
                            <div class="mt-[24px]">
                                <?php GlobalInputField::render('', 'Price', 'number', '', ''); ?>
                        </section>

                        <section id="newServicePreview" class="mt-[64px] opacity-0 translate-y-4 transition-all duration-500 ease-in-out" data-step="5" hidden>
                            <div class="flex items-end">
                                <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Preview.&nbsp;'); ?>
                            </div>
                            <div class="mt-[24px] w-full">
                                <?php Text::render('', '', 'CaptionOne w-full text-onSurface dark:text-darkOnSurface min-w-[316px] max-w-[400px]', 'Your new service will appear like this in your $categoryName Category.'); ?>
                            </div>
                            <div class="mt-[24px]">
                                <div class="border-borderHighlight dark:border-darkBorderHighlight border-[2px] rounded-[6px] bg-background dark:bg-darkBackground p-[32px]  min-w-[316px] max-w-[400px]">
                                    <div class="flex justify-between">
                                        <?php Text::render('', '', 'BodyMediumTwo leading-none text-onBackground dark:text-darkOnBackground', '$serviceName');
                                        Text::render('', '', 'BodyMediumTwo leading-none text-onBackground dark:text-darkOnBackground', '$priceOfService'); ?>
                                    </div>
                                    <div class="flex flex-col">
                                        <ul class="CaptionOne text-onSurface dark:text-darkOnSurface mt-[16px]">
                                            <li>• $shortDescription1</em></li>
                                            <li>• ganto itsura kapag may description siya</em></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-[24px]">
                                <div class="border-borderHighlight dark:border-darkBorderHighlight border-[2px] rounded-[6px] bg-background dark:bg-darkBackground flex justify-between items-center h-[40px]  min-w-[316px] max-w-[400px] px-[12px]">
                                    <?php Text::render('', '', 'BodyTwo leading-none text-onBackground dark:text-darkOnBackground', 'gantokapagwala');
                                    Text::render('', '', 'BodyMediumTwo leading-none text-onBackground dark:text-darkOnBackground', '$priceOfService'); ?>
                                </div>
                            </div>
                            <div class="mt-[64px] mb-[150px] w-full flex justify-center translate-y-4 transition-all duration-500 ease-in-out">
                                <?php PrimaryButton::render("Create service", "submit", "[56px]", "", "", "", "Create service"); ?>
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
            <?php Sidebar::render(); ?>
        </main>
<?php
    }
}

Page::page();
