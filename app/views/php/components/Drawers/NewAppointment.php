<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\DefaultCheckBox\CheckBoxDefault;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;

class NewAppointment
{
    public static function render(?string $className = null): void
    {
        $completedCount = '5';
        $awaitingReviewCount = '3';
        $ongoingCount = '9';
        $upcomingCount = '5';
        $pendingCount = '2';
        $cancelledCount = '2';
        $total = $completedCount + $awaitingReviewCount + $ongoingCount + $upcomingCount + $pendingCount + $cancelledCount;

        // id = SourceOfBooking
        $sourceOfBookingOptions = [
            ['value' => 'call', 'label' => 'Call'],
            ['value' => 'messenger', 'label' => 'Messenger'],
            ['value' => 'walk_in', 'label' => 'Walk-in']
        ]; // name = source_of_booking
        // id = SearchCustomerName
        $SearchedCustomerName = ''; // name = search_customer_name
        $SearchedGender = ''; // name = searched_gender
        $SearchedEmail = ''; // name = searched_email
        // id = GenderOptions
        $GenderOption = ['Male', 'Female', 'Other']; // name = gender
        // id = ServiceBookedOptions
        $ServiceBookedOptions = ['Service 1', 'Service 2', 'Service 3']; // name = service_booked
        $ServiceBookedOptionsError = '';
        // id = DurationOptions
        $DurationOptions = ['1 Hour', '1 Hour and 30 minutes', '2 Hours']; // name = duration
        $DurationOptionsError = '';
        // id = PartySizeOptions
        $PartySizeOptions = [
            ['quantity' => 'Solo', 'price' => '1000'],
            ['quantity' => 'Duo', 'price' => '1800'],
            ['quantity' => 'Group', 'price' => '2500']
        ]; // name = party_size
        $PartySizeOptionsError = '';
        // id = MassageOptions
        $MassageOptions = ['Bamboossage', 'Dagdagay', 'Hilot', 'Swedish']; // name = massage_selection
        $MassageOptionsError = '';
        // id = BodyScrubOptions
        $BodyScrubOptions = ['Coffee Scrub', 'Milk Whitening Scrub', 'Shea and Butter Scrub']; // name = body_scrub_selection
        $BodyScrubOptionsError = '';


        $TimeError = ''; // name = start_time
        // id = FinalValidationMessage
        $FinalValidationMessage = 'Please fill in all the fields.'; // name = final_validation_message
        $FinalDuration = '1 hour and 30 minutes';
        $FinalEndTIme = '2:30 PM';
        $FinalDurationMessage = "The appointment will last for " . $FinalDuration . "."; // name = final_duration_message
        $FinalEndTimeMessage = "It will end at " . $FinalEndTIme . "."; // name = final_end_time_message
        // id = FinalTotal
        $FinalTotal = '2000';
        $FinalTotalMessage = 'Total: ₱' . $FinalTotal; // name = final_total_message


        ?>
        <form id="appointmentForm" method="POST" action="/appointCustomer">
            <div id="bookAnAppointmentSection" class="ml-[0px] w-full justify-start items-start overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-0">
                <div class="flex justify-start ml-[-8px] mb-[48px] 2xl:mb-[0px] sm:ml-[40px]">
                    <button type="button" id="closeBookAnAppointmentButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        <div class="w-[24px] h-[24px] flex justify-center items-center">
                            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                        </div>
                    </button>
                </div>
                <div class="max-w-full 2xl:justify-center w-full sm:p-[48px] pb-[150px] 2xl:pb-0 2xl:h-full items-center flex flex-col 2xl:flex-row gap-[24px] 2xl:pb-0">
                    <section class="flex flex-col gap-[16px] w-[480px] justify-end">
                        <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground w-[480px] dark:text-darkOnBackground', 'Book an appointment'); ?>
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo w-[480px] dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                        <div class="flex flex-col mt-[48px] gap-[16px]">
                            <?php SecondaryInputField::render(
                                'dropdownfield',
                                'Source of Booking',
                                'Select Source of Booking',
                                array_map(function ($option) {
                                    return [
                                        'label' => $option['label'],
                                        'value' => $option['value']
                                    ];
                                }, $sourceOfBookingOptions),
                                'source_of_booking_error',
                                null,
                                'source_of_booking',
                                '',
                                '',
                                [],
                                false,
                                'source_of_booking'
                            ) ?>
                            <div class="flex items-center gap-[16px] justify-end">
                                <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">Customer Type</p>
                                <div class="flex gap-[16px]">
                                    <div class="relative">
                                        <input type="radio" name="customer_type" value="new_guest" class="hidden peer" id="newGuestCustomerButton" checked required>
                                        <label for="newGuestCustomerButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">New Guest</label>
                                    </div>
                                    <div class="relative">
                                        <input type="radio" name="customer_type" value="existing" class="hidden peer" id="existingCustomerButton" required>
                                        <label for="existingCustomerButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Existing</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="existingCustomerSection" class="flex flex-col my-[48px] gap-[16px] items-end transition-opacity duration-300 ease-in-out" style="display: none;">
                            <div class="mb-[24px] w-full">
                                <?php SecondaryInputField::render(
                                    'searchfield',
                                    'Search Customer',
                                    'Enter Name or Email',
                                    [],
                                    'search_customer_error' ?? '',
                                    null,
                                    'search',
                                    '',
                                    '',
                                    [],
                                    false,
                                    'search_customer',
                                    0
                                ) ?>
                            </div>
                            <!-- Search Results Container -->
                            <div id="hiddenValue">
                            </div>
                            <div class=" rounded-xl bg-primary hover:bg-slate-500 cursor-pointer w-[325px]" id="wrapper">
                                <ul class="hover:bg-slate-400" id="suggestions">
                                    <li id="li"></li>
                                </ul>
                            </div>

                            <!-- Selected Customer Info (initially hidden) -->
                            <div id="selectedCustomerInfo" class="hidden w-full">
                                <?php TextRowContainer::render('Customer Name', $SearchedCustomerName ?? '', 'onBackground', 'darkOnBackground') ?>
                                <?php TextRowContainer::render('Gender', $SearchedGender ?? '', 'onBackground', 'darkOnBackground', '', 'gender') ?>
                                <?php TextRowContainer::render('Email', $SearchedEmail ?? '', 'onBackground', 'darkOnBackground') ?>

                                <!-- Reset Button -->
                                <button type="button" id="resetCustomerSelection" class="mt-4 px-4 py-2 BodyTwo text-destructive dark:text-darkDestructive bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                    Reset Selection
                                </button>
                            </div>
                            <input type="hidden" name="existing_customer_id" id="existingCustomerId" value="<?php echo $SearchedCustomerId ?? ''; ?>">
                        </div>
                        <div id="newGuestCustomerSection" class="flex flex-col my-[48px] gap-[16px] transition-opacity duration-300 ease-in-out" style="display: none;">
                            <?php SecondaryInputField::render('textfield', 'First Name', 'Enter First Name', [], 'first_name_error' ?? '', null, 'FirstName', '', '', [], false, 'first_name') ?>
                            <?php SecondaryInputField::render('textfield', 'Last Name', 'Enter Last Name', [], 'last_name_error' ?? '', null, 'LastName', '', '', [], false, 'last_name') ?>
                            <?php SecondaryInputField::render('dropdownfield', 'Gender', 'Select Gender', $GenderOption, 'gender_error' ?? '', null, 'GenderOptions', '', '', [], false, 'gender') ?>
                            <?php SecondaryInputField::render('emailfield', 'Email', 'Enter Email', [], 'customer_email_error' ?? '', null, 'CustomerEmail', '', '', [], false, 'customer_email') ?>

                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] items-end">
                        <div class="flex flex-col gap-[16px]">
                            <?php SecondaryInputField::render('dropdownServicefield', 'Service Booked', 'Select Service Booked', [], 'service_booked_error', null, 'select', '', '', [], false, 'service_booked') ?>
                            <?php SecondaryInputField::render('dropdownfield', 'Duration', 'Select Duration', $DurationOptions, $DurationOptionsError, null, 'DurationOptions', '', '', ['1hr', '2hrs', '1hr30mins'], false, 'duration') ?>
                            <?php SecondaryInputField::render('dropdownfield', 'Party Size', 'Select Party Size', [], $PartySizeOptionsError, null, 'PartySizeOptions', '', '', $PartySizeOptions, false, 'party_size') ?>
                            <?php SecondaryInputField::render('dropdownfield', 'Massage Selection', 'Select Massage', $MassageOptions, $MassageOptionsError, null, 'MassageOptions', '', '', [], false, 'massage_selection') ?>
                            <?php SecondaryInputField::render('dropdownfield', 'Body Scrub Selection', 'Select Body Scrub', $BodyScrubOptions, $BodyScrubOptionsError, null, 'BodyScrubOptions', '', '', [], false, 'body_scrub_selection') ?>
                            <?php SecondaryInputField::render('checkboxwithpricefield', 'Addons', '', [], '', null, 'addons', '', '', [], false, 'addons', 0 ) ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] items-end">
                        <div class="flex flex-col mb-[48px] gap-[16px] items-end">
                            <?php SecondaryInputField::render('datefield', 'Date', '', [], 'date_error', null, 'Date', '', '', [], false, 'date') ?>
                            <?php SecondaryInputField::render('timefield', 'Start Time', '', [], 'start_time_error', null, 'Time', '', '', [], false, 'start_time') ?>
                            <div class="flex flex-col gap-[8px]">
                                <?php Text::render('FinalDurationMessage', '', 'CaptionTwo w-[260px] leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', ''); ?>
                                <?php Text::render('FinalAppointmentMessage', '', 'CaptionTwo w-[260px] leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', ''); ?>
                                <?php Text::render('FinalEndTimeMessage', '', 'CaptionTwo w-[260px] leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', ''); ?>
                            </div>
                        </div>
                        <div class="flex gap-[16px] items-end">
                            <?php Text::render('FinalTotal', '', 'BodyMediumTwo leading-none text-primary dark:text-darkPrimary w-[204px] sm:w-[124px] text-right', $FinalTotalMessage); ?>
                            <?php NewPrimaryButton::render('Book', '', 'BookButton', '257px', null) ?>
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
            <div id="ConfirmAppointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to book this appointment?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/AddAppointment/AddAppointmentFetch.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/AddAppointment/AddAppointmentChecker.js"></script>

        <?php
    }
}