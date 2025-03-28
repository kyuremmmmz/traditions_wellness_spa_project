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
            ?>
            <?php WorkingBanner::render(); ?>
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
                        ActionButton::render('plusSmall', 'Add a therapist', 'openAddANewServiceSectionButton', 'button');
                        SearchField::render('Search Therapist', '')
                        ?>
                    </section>

                    <div class="border border-border border-[1px] w-full max-w-[1362px] dark:border-darkBorder rounded-[6px] overflow-x-auto">
                        <table class="bg-background w-full max-w-[1362px] dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr class="w-full p-0 m-0" style="margin: 0; padding: 0;">
                                <td class="flex flex-col w-full p-0 m-0">
                                    <section class="p-[48px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5">
                                        <?php
                                        SecondaryInputField::render('dropdownfield', 'Filter status by', '', ['All', 'Active', 'Inactive']);
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
                                <?php SecondaryInputField::render('textfield', 'First Name', 'Enter First Name', [], 'first_name_error', null, 'first_name', '', '', [], '', 'first_name') ?>
                                <?php SecondaryInputField::render('textfield', 'Last Name', 'Enter Last Name', [], 'last_name_error', null, 'last_name', '', '', [], '', 'last_name') ?>
                                <?php SecondaryInputField::render('dropdownfield', 'Gender', '', ['Male', 'Female', 'Others'], '', null, 'gender', '', '', [], '', 'gender') ?>
                                <?php SecondaryInputField::render('dropdownfield', 'Status', '', ['Active', 'Inactive'], '', null, 'status', '', '', [], '', 'status') ?>
                                <?php SecondaryInputField::render('textfield', 'Email', 'Enter Email', [], 'email_error', null, 'email', '', '', [], '', 'email') ?>
                            </div>
                            <div class="w-[400px] flex justify-center">
                                <?php ActionButton::render('plusSmall', 'Add a therapist', 'addTherapistButton', 'submit'); ?>
                                <button type="submit" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Submit</button>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Unsaved Progress Modal -->
                <div id="UnsavedProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                    <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                        <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                        <div class="flex gap-[16px] justify-end mt-[48px]">
                            <button type="button" id="closeUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                            <button type="button" id="proceedUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
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

        <!-- Update Modal-->
        <form action="/updateTherapist" method="post">
            <div id="updateTherapistModal" class="sm:pt-[80px] pt-[48px] fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full transition-all duration-300 opacity-0 z-[200]">
                <div class="mx-auto p-[48px] border flex flex-col border-border dark:border-darkBorder w-full max-w-[500px] rounded-[6px] bg-background dark:bg-darkBackground transform transition-all duration-300 opacity-100 scale-95">
                    <div class="flex flex-col gap-[48px]">
                        <section class="flex flex-col justify-start gap-[8px]">
                            <div class="flex justify-start pb-[24px]">
                                <button type="button" id="closeUpdateModal" class="relative right-2 transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                    <div class="w-[24px] h-[24px] flex justify-center items-center">
                                        <?php IconChoice::render('exitSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                                    </div>
                                </button>
                            </div>
                            <p class="leading-none HeaderTwo text-onBackground dark:text-darkOnBackground">Update Therapist</p>
                            <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Modify therapist information below.</p>
                        </section>
                        <div class="flex justify-end items-end">
                            <div class="flex flex-col justify-start sm:justify-center gap-[16px] w-[480px]">
                                <input type="hidden" id="therapistId" name="id">
                                <?php
                                SecondaryInputField::render('textfield', 'First Name', 'Enter first name', [], '', null, 'therapistFirstName', '', '', [], false, 'first_name');
                                SecondaryInputField::render('textfield', 'Last Name', 'Enter last name', [], '', null, 'therapistLastName', '', '', [], false, 'last_name');
                                SecondaryInputField::render('textfield', 'Email', 'Enter email', [], '', null, 'therapistEmail', '', '', [], false, 'email');
                                SecondaryInputField::render('dropdownfield', 'Gender', 'Select gender', ['Male', 'Female'], '', null, 'therapistGender', '', '', [], false, 'gender');
                                SecondaryInputField::render('dropdownfield', 'Status', 'Select status', ['Active', 'Inactive'], '', null, 'therapistStatus', '', '', [], false, 'status');
                                ?>
                            </div>
                        </div>
                        <div class="flex w-full">
                            <div class="flex flex-col gap-[16px] w-full justify-center items-center mt-[32px]">
                                <button type="button" id="openSaveChangesTherapistModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Save Changes</button>
                                <button type="button" id="openDeleteTherapistModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-destructive dark:text-destructive hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Delete Therapist</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unsaved update therapist progress modal -->
            <div id="DeleteTherapistModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to delete this therapist? This cannot be undone.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="closeDeleteTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedDeleteTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Unsaved update therapist modal -->
            <div id="UnsavedEditTherapistModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit? All unsaved changes will be lost.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="closeUnsavedEditTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="button" id="proceedUnsavedEditTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Confirm update therapist Modal -->
            <div id="SaveChangesTherapistModal" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col relative">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to update the details of this therapist?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelSaveChangesTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmSaveChangesTherapistButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

        </form>

        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Therapists/TherapistsDom.js"></script>

<?php
    }
}

Page::page();
