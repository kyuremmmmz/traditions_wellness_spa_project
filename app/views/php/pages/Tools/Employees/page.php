<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Table\TherapistsTable;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SearchField;



class Page
{


    public static function page()
    {
        ?>
        <main class="flex w-full">
            <?php
            Sidebar::render();
            WorkingBanner::render()
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] pl-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen w-full">
                <div class="max-w-full flex flex-col sm:px-[48px] items-start overflow-x-auto">
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('employeesSmall', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Therapists');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <section class="flex gap-[16px] py-[16px]">
                        <?php
                        ActionButton::render('plusSmall', 'Add a therapist', 'openAddANewServiceSectionButton');
                        SearchField::render('Search Therapist', '')
                        ?>
                    </section>

                    <div class="border border-border border-[1px] w-full max-w-[1362px] dark:border-darkBorder rounded-[6px] overflow-x-auto">
                        <table class="bg-background w-full max-w-[1362px] dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr class="p-0 m-0 w-full" style="margin: 0; padding: 0;">
                                <td class="p-0 m-0 flex flex-col w-full">
                                    <section class="p-[48px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5">
                                        <?php
                                        SecondaryInputField::render('dropdownfield', 'Filter status by', '', ['All','Active', 'Inactive']);
                                        ?>
                                    </section>
                                    <section>
                                        <?php TherapistsTable::render('therapistTable', '');
                                        ?>
                                    </section>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
            <form id="addATherapistForm" method="POST" action="/addTherapist">
                <div id="addAServiceSection" class="ml-[0px] w-full overflow-x-auto max-w-full sm:pl-[96px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-center sm:pt-[160px] transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-0">
                    <div class="flex justify-start mb-[48px] w-[400px]">
                        <button type="button" id="closeAddATherapistSectionButton" class="relative right-1 sm:right-2 transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>  
                    <div class="flex flex-col sm:flex-row gap-[48px] 2xl:pb-0 pb-[150px] max-w-full items-center justify-center">
                        <section class="flex flex-col gap-[16px] w-[400px] sm:w-[400px] items-end">
                            <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground w-[400px]', 'Add a therapist'); ?>
                            <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[400px]', 'Please enter the following.'); ?>
                            <div class="my-[48px] flex flex-col gap-[16px]">
                                <?php SecondaryInputField::render('textfield', 'First Name', 'Enter First Name', [], 'firstNameError', null, 'first_name', '', '' , [], '' , 'first_name')?>
                                <?php SecondaryInputField::render('textfield', 'Last Name', 'Enter Last Name', [], 'lastNameError', null, 'last_name', '', '' , [], '' , 'last_name')?>
                                <?php SecondaryInputField::render('textfield', 'Gender', '', ['Male', 'Female', 'Others'], '', null, 'gender', '', '' , [], '' , 'gender')?>
                                <?php SecondaryInputField::render('textfield', 'Status', '', ['Active', 'Inactive'], '', null, 'status', '', '' , [], '' , 'status')?>
                                <?php SecondaryInputField::render('textfield', 'Email', 'Enter Email', [], '', null, 'email', '', '' , [], '' , 'email')?>
                            </div>
                            <div class="w-[400px] flex justify-center"><?php ActionButton::render('plusSmall', 'Add a therapist', 'addTherapistButton', '', 'primary', 'onPrimary');?></div>
                        </section>
                    </div> 
                </div>
                <!-- Unsaved Progress Modal -->
                <div id="UnsavedProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="closeUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button id="proceedUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                        </div>
                    </div>
                </div>

                <!-- Confirm Appointment Modal -->
                <div id="ConfirmAddAServiceModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to add this therapist?</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="cancelButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button type="submit" id="confirmButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Therapists/TherapistsDom.js"></script>

        <?php
    }
}

Page::page();
