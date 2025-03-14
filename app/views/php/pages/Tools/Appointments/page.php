<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\CountDisplayer;
use Project\App\Views\Php\Components\GridViewDefault\GridViewDefaultComponent;
use Project\App\Views\Php\Components\GridViewDefault\GridViewLocation;
use Project\App\Views\Php\Components\Inputs\DefaultInputField;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\StaticRadioButton;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SearchField;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Charts\AppointmentsChart;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Table\AppointmentsTable;
use Project\App\Views\Php\Components\Texts\TextRowContainer;

class Page
{
    public static function page()
    {
        $completedCount = '5';
        $awaitingReviewCount = '3';
        $ongoingCount = '9';
        $upcomingCount = '5';
        $pendingCount = '2';
        $cancelledCount = '2';
        $total = $completedCount + $awaitingReviewCount + $ongoingCount + $upcomingCount + $pendingCount + $cancelledCount;

        // id = SourceOfBooking
        $sourceOfBookingOptions = ['Call', 'Messenger', 'Walk-in']; // name = source_of_booking
        $sourceOfBookingOptionsError = '';
        // id = CustomerType
        $customerTypeOptions = ['New Guest Customer', 'Existing Customer']; // name = customer_type
        $customerTypeOptionsError = '';
        // id = SearchCustomerName
        $SearchedCustomerName = 'John Doe'; // name = search_customer_name
        $SearchedGender = 'Male'; // name = searched_gender
        $SearchedEmail = 'none'; // name = searched_email
        // id = FirstName
        $FirstNameError = ''; // name = first_name
        // id = LastName
        $LastNameError = ''; // name = last_name
        // id = GenderOptions
        $GenderOption = ['Male', 'Female', 'Other']; // name = gender
        // id = CustomerEmail
        $customerEmailError = ''; // name = customer_email
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
        // id = Addons
        $addonsOptions = [
            ['label' => 'Hot Stone Therapy', 'duration' => '30 mins', 'price' => '150'],
            ['label' => 'Swedish Massage', 'duration' => '60 mins', 'price' => '200'],
            ['label' => 'Deep Tissue Massage', 'duration' => '45 mins', 'price' => '180']
        ]; // name = addons
        $addonsOptionsError = '';
        // id = Date
        $DateError = ''; // name = date
        // id = Time
        $TimeError = ''; // name = start_time
        // id = BedSlots
        $BedSlots = ['1', '2', '3', '4', '5']; // name = bed_slots
        $BedSlotsError = '';
        // id = FinalValidationMessage
        $FinalValidationMessage = 'Please fill in all the fields.'; // name = final_validation_message
        $FinalDuration = '1 hour and 30 minutes';
        $FinalEndTIme = '2:30 PM';
        $FinalDurationMessage = "The appointment will last for " . $FinalDuration . "."; // name = final_duration_message
        $FinalEndTimeMessage = "It will end at " . $FinalEndTIme . "."; // name = final_end_time_message
        // id = FinalTotal
        $FinalTotal = '2000';
        $FinalTotalMessage = '₱' . $FinalTotal; // name = final_total_message
        
        
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
                            <?php IconChoice::render('clockMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Appointments');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <section class="flex gap-[16px] py-[16px]">
                        <?php 
                        ActionButton::render('calendarPlus', 'Book an appointment', 'openBookAnAppointmentButton'); 
                        SearchField::render('Search Customer', '')
                        ?>
                    </section>
                    <div class="border border-border border-[1px] dark:border-darkBorder rounded-[6px] w-[1365px]">
                    <table class="border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                        <tr class="p-0 m-0" style="margin: 0; padding: 0;">
                            <td class="p-0 m-0 border border-border dark:border-darkBorder border-[1px]">
                                <section class="p-[48px] w-[240px] flex flex-col gap-[16px]">
                                    <?php AppointmentsChart::render($completedCount, $awaitingReviewCount, $ongoingCount, $upcomingCount, $pendingCount, $cancelledCount, $total);  ?>
                                    <div class="flex flex-col gap-[8px] pl-[24px]">
                                        <?php 
                                            CountDisplayer::render('success', 0, 'Completed', 'completed', '');
                                            CountDisplayer::render('blue', 0, 'Awaiting Review', 'review', '');
                                            CountDisplayer::render('orange', 0, 'Ongoing', 'ongoing', ''); 
                                            CountDisplayer::render('yellow', 0, 'Upcoming', 'upcoming', ''); 
                                            CountDisplayer::render('onBackgroundTwo', 0, 'Pending', 'pending', ''); 
                                            CountDisplayer::render('destructive', 0, 'Canceled', 'cancelled', ''); 
                                        ?>
                                    </div>
                                </section>
                            </td>
                            <td class="p-0 m-0 border border-border dark:border-darkBorder border-[1px]">
                                <section class="p-[48px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5">
                                    <?php 
                                    SecondaryInputField::render('dropdownfield', 'Filter status by', '', ['Option 1', 'Option 2', 'Option 3']);
                                    SecondaryInputField::render('datefield', 'Show appointments from', '');
                                    ?>
                                </section>
                                <section class="max-w-[1120px]">
                                    <?php AppointmentsTable::render('appointmentsTable', '');?>
                                </section>
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Book an appointment -->
            <div id="bookAnAppointmentSection" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5">
                <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full ml-[-8px]">
                    <button id="closeBookAnAppointmentButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        <div class="w-[24px] h-[24px] flex justify-center items-center">
                            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                        </div>
                    </button>
                </div>
                <div class="w-full flex flex-col 2xl:flex-row gap-[48px] 2xl:pb-0 pb-[150px]">
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Book an appointment'); ?>
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                        <div class="flex flex-col mt-[48px] gap-[16px]">
                            <?php SecondaryInputField::render('dropdownfield', 'Source of Booking', 'Select Source of Booking', $sourceOfBookingOptions, $sourceOfBookingOptionsError, null, 'SourceOfBooking', '', '', [], false, 'source_of_booking')?>
                            <div class="flex items-center gap-[16px] justify-end">
                                <p class="BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none">Customer Type</p>
                                <div class="flex gap-[16px]">
                                    <button id="newGuestCustomerButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-primary dark:border-darkPrimary rounded-[6px] cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">New Guest</button>
                                    <button id="existingCustomerButton" class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[122px] h-[40px] border border-border dark:border-darkBorder rounded-[6px] cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Existing</button>
                                </div>
                            </div>
                        </div>
                        <div id="existingCustomerSection" class="flex flex-col my-[48px] gap-[16px] items-end transition-opacity duration-300 ease-in-out" style="display: none;">
                            <div class="mb-[24px]">
                                <?php SecondaryInputField::render('searchfield', 'Search Customer Name', 'Enter Customer Name', [], '', null, 'SearchCustomerName', '', '', [], false, 'search_customer_name')?>
                            </div>
                            <?php TextRowContainer::render('Customer Name', $SearchedCustomerName, 'onBackground', 'darkOnBackground')?>
                            <?php TextRowContainer::render('Gender', $SearchedGender, 'onBackground', 'darkOnBackground')?>
                            <?php TextRowContainer::render('Email', $SearchedEmail, 'onBackground', 'darkOnBackground')?>
                        </div>
                        <div id="newGuestCustomerSection" class="flex flex-col my-[48px] gap-[16px] transition-opacity duration-300 ease-in-out" style="display: none;">
                            <?php SecondaryInputField::render('textfield', 'First Name', 'Enter First Name', [], $FirstNameError, null, 'FirstName', '', '', [], false, 'first_name')?>
                            <?php SecondaryInputField::render('textfield', 'Last Name', 'Enter Last Name', [], $LastNameError, null, 'LastName', '', '', [], false, 'last_name')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Gender', 'Select Gender', $GenderOption, '', null, 'GenderOptions', '', '', [], false, 'gender')?>
                            <?php SecondaryInputField::render('emailfield', 'Email (Optional)', 'Enter Email', [], $customerEmailError, null, 'CustomerEmail', '', '', [], false, 'customer_email')?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col gap-[16px]">
                            <?php SecondaryInputField::render('dropdownfield', 'Service Booked', 'Select Service Booked', $ServiceBookedOptions, $ServiceBookedOptionsError, null, 'ServiceBookedOptions', '', '', [], false, 'service_booked')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Duration', 'Select Duration', $DurationOptions, $DurationOptionsError, null, 'DurationOptions', '', '', [], false, 'duration')?>
                            <?php SecondaryInputField::render('dropdownwithpricefield', 'Party Size', 'Select Party Size', [], $PartySizeOptionsError, null, 'PartySizeOptions', '', '', $PartySizeOptions, false, 'party_size')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Massage Selection', 'Select Massage', $MassageOptions, $MassageOptionsError, null, 'MassageOptions', '', '', [], true, 'massage_selection')?>
                            <?php SecondaryInputField::render('dropdownfield', 'Body Scrub Selection', 'Select Body Scrub', $BodyScrubOptions, $BodyScrubOptionsError, null, 'BodyScrubOptions', '', '', [], true, 'body_scrub_selection')?>
                            <?php SecondaryInputField::render('checkboxwithpricefield', 'Add-ons', '', $addonsOptions, $addonsOptionsError, null, 'AddonsOptions', '', '', [], false, 'addons')?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[16px] w-[480px] sm:w-[400px]">
                        <div class="flex flex-col mb-[48px] gap-[16px]">
                            <?php SecondaryInputField::render('datefield', 'Date', '', [], $DateError, null, 'Date', '', '', [], false, 'date')?>
                            <?php SecondaryInputField::render('timefield', 'Start Time', '', [], $TimeError, null, 'Time', '', '', [], false, 'start_time')?>
                            <?php SecondaryInputField::render('slotpickerfield','Bed Slot/s', '', $BedSlots, $BedSlotsError, null, 'BedSlots', '', '', [], false, 'bed_slots'); ?>
                            <div class="pl-[220px] sm:pl-[140px] flex flex-col gap-[8px]">
                                <?php Text::render('FinalDurationMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', $FinalValidationMessage); ?>
                                <?php Text::render('FinalDurationMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', $FinalDurationMessage); ?>
                                <?php Text::render('FinalEndTimeMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', $FinalEndTimeMessage); ?>
                            </div>
                        </div>
                        <div class="flex gap-[16px] items-center">
                            <?php Text::render('FinalTotal', '', 'BodyMediumTwo leading-none text-primary dark:text-darkPrimary w-[204px] sm:w-[124px] text-right', $FinalTotalMessage); ?>
                            <?php NewPrimaryButton::render('Book', '', 'BookButton', '257px', null)?>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Unsaved Progress Modal -->
            <div id="UnsavedProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="closeUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Confirm Appointment Modal -->
            <div id="ConfirmAppointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to book this appointment?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="cancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="confirmAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

            <!-- Update Appointment Unsaved Progress Modal -->
            <div id="UpdateUnsavedProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit this page? All unsaved changes will be lost.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="closeUpdateUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedUpdateUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Update Appointment Confirmation Modal -->
            <div id="UpdateConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to save these changes?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="cancelUpdateButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="confirmUpdateButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

            <!-- Finish Appointment Modal -->
            <div id="FinishAppointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to finish this appointment?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button id="cancelFinishButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="confirmFinishButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>


            <!-- 
            // id                       : name
            // fetchedCustomerName      : fetched_customer_name
            // fetchedStatus            : fetched_status
            // fetchedPaymentStatus     : fetched_payment_status
            // fetchedAssignmentStatus  : fetched_assignment_status
            // fetchedSourceOfBooking   : fetched_source_of_booking
            // fetchedAppointmentId      : fetched_appointment_id
            // fetchedClientId          : fetched_client_id
            // fetchedApprovalDate      : fetched_approval_date
            // fetchedLastModifiedOn    : fetched_last_modified_on
            // fetchedCreationDate      : fetched_creation_date 
            -->
            <form action="/updateAppointment" method="post">
                <div id="updateModal" class="sm:pt-[80px] pt-[48px] fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full transition-all duration-300 opacity-0 z-[200]">
                    <div class="mx-auto p-[48px] border border-border dark:border-darkBorder w-4/5 rounded-[6px] bg-background dark:bg-darkBackground transform transition-all duration-300 opacity-100 scale-95">
                        <div class="flex flex-col gap-[48px]">
                            <section class="flex flex-col gap-[8px]">
                                <div class="flex w-full justify-start pb-[24px]">
                                    <button type="button" id="closeModal" class="relative right-2 transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                        <div class="w-[24px] h-[24px] flex justify-center items-center">
                                            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                                        </div>
                                    </button>
                                </div>
                                <p class="HeaderTwo leading-none text-onBackground dark:text-darkOnBackground">Update Appointment</p>
                                <p class="BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo">You can modify the details from the selections.</p>
                            </section>
                            <section>
                                <div class="border-b border-border flex dark:border-darkBorder h-[30px] overflow-x-auto">
                                    <div class="mx-[24px] h-[30px]">
                                        <button type="button" id="showSummary" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Summary</button>
                                        <button type="button" id="showServiceBooked" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Service Booked</button>
                                        <button type="button" id="showAssignment" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Assignment</button>
                                        <button type="button" id="showPayment" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Payment</button>
                                    </div>
                                </div>
                            </section>
                            <div class="sm:h-[351px] relative overflow-hidden">
                                <section id="summarySection" class="flex flex-col sm:flex-row items-top justify-center gap-[48px] absolute w-full transition-all duration-300 transform">
                                    <div>
                                        <div class="flex flex-col gap-[16px] items-end mt-[13px] mb-[40px]">
                                            <?php 
                                            TextRowContainer::render('Customer Name', '', 'onBackground', 'darkOnBackground', 'fetchedCustomerName', 'fetched_customer_name');
                                            TextRowContainer::render('Customer Email', '', 'onBackground', 'darkOnBackground', 'fetchedCustomerEmail', 'fetched_customer_email');
                                            TextRowContainer::render('Status', '', 'onBackground', 'darkOnBackground', 'fetchedStatus', 'fetched_status');
                                            TextRowContainer::render('Payment Status', '', 'onBackground', 'darkOnBackground', 'fetchedPaymentStatus', 'fetched_payment_status');
                                            TextRowContainer::render('Assignment Status', '', 'onBackground', 'darkOnBackground', 'fetchedAssignmentStatus', 'fetched_assignment_status');
                                            TextRowContainer::render('Source of Booking', '', 'onBackground', 'darkOnBackground', 'fetchedSourceOfBooking', 'fetched_source_of_booking');
                                            ?>
                                        </div>
                                        <div class="flex flex-col gap-[16px] items-end">
                                            <?php
                                            TextRowContainer::render('Appointment ID', '', 'onBackground', 'darkOnBackground', 'fetchedAppointmentId', 'fetched_appointment_id');
                                            TextRowContainer::render('Client ID', '', 'onBackground', 'darkOnBackground', 'fetchedClientId', 'fetched_client_id');
                                            TextRowContainer::render('Creation Date', '', 'onBackground', 'darkOnBackground', 'fetchedCreationDate', 'fetched_creation_date');
                                            TextRowContainer::render('Approval Date', '', 'onBackground', 'darkOnBackground', 'fetchedApprovalDate', 'fetched_approval_date');
                                            TextRowContainer::render('Last Modified On', '', 'onBackground', 'darkOnBackground', 'fetchedLastModifiedOn', 'fetched_last_modified_on');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-[16px] items-end">
                                        <?php 
                                        SecondaryInputField::render('datefield', 'Date', '', [], $DateError, null, 'Date', '', '', [], false, 'date');
                                        SecondaryInputField::render('timefield', 'Start Time', '', [], $TimeError, null, 'Time', '', '', [], false, 'start_time');
                                        SecondaryInputField::render('slotpickerfield','Bed Slot/s', '', $BedSlots, $BedSlotsError, null, 'BedSlots', '', '', [], false, 'bed_slots');
                                        ?>
                                        <div class="pl-[65px] sm:pl-[65px] flex flex-col gap-[8px]">
                                            <?php Text::render('FinalDurationMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo w-[260px] dark:text-darkOnBackgroundTwo', $FinalValidationMessage); ?>
                                            <?php Text::render('FinalDurationMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo w-[260px] dark:text-darkOnBackgroundTwo', $FinalDurationMessage); ?>
                                            <?php Text::render('FinalEndTimeMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo  w-[260px] dark:text-darkOnBackgroundTwo', $FinalEndTimeMessage); ?>
                                        </div>
                                    </div>
                                </section>
                                <section id="serviceBookedSection" class="flex hidden flex-col sm:flex-row items-top justify-center gap-[48px] absolute w-full transition-all duration-300 transform">
                                    <div class="flex flex-col gap-[16px]">
                                        <?php SecondaryInputField::render('dropdownfield', 'Service Booked', 'Select Service Booked', $ServiceBookedOptions, $ServiceBookedOptionsError, null, 'ServiceBookedOptions', '', '', [], false, 'service_booked')?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Duration', 'Select Duration', $DurationOptions, $DurationOptionsError, null, 'DurationOptions', '', '', [], false, 'duration')?>
                                        <?php SecondaryInputField::render('dropdownwithpricefield', 'Party Size', 'Select Party Size', [], $PartySizeOptionsError, null, 'PartySizeOptions', '', '', $PartySizeOptions, false, 'party_size')?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Massage Selection', 'Select Massage', $MassageOptions, $MassageOptionsError, null, 'MassageOptions', '', '', [], true, 'massage_selection')?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Body Scrub Selection', 'Select Body Scrub', $BodyScrubOptions, $BodyScrubOptionsError, null, 'BodyScrubOptions', '', '', [], true, 'body_scrub_selection')?>
                                    </div>
                                    <div class="flex flex-col gap-[16px]">
                                        <?php SecondaryInputField::render('checkboxwithpricefield', 'Add-ons', '', $addonsOptions, $addonsOptionsError, null, 'AddonsOptions', '', '', [], false, 'addons')?>
                                    </div>
                                </section> 
                                <section id="assignmentSection" class="flex hidden flex-col sm:flex-row items-top justify-center gap-[48px] absolute w-full transition-all duration-300 transform">
                                    <div class="flex flex-col gap-[16px]">
                                        <?php SecondaryInputField::render('searchselectfield', 'Assigned Therapists', 'Search Therapist', [], '', null, '', '', '', [], false, '', 3)?>
                                    </div>
                                </section> 
                                <section id="paymentSection" class="flex hidden flex-col sm:flex-row items-top justify-center gap-[48px] absolute w-full transition-all duration-300 transform">
                                    <div class="flex flex-col gap-[16px]">
                                    <?php SecondaryInputField::render('dropdownfield', 'Payment Choice', '', [], '', null, '', '', '', [], false, '')?>
                                    <?php SecondaryInputField::render('textfield', 'Receipt Number', 'Enter Receipt Number', [], '', null, '', '', '', [], false, '')?>
                                    </div>
                                </section>      
                            </div>  
                            <div class="flex flex-col w-full items-center gap-[16px]">
                                <div class="flex gap-[16px] w-full justify-center">
                                    <button type="button" id="cancelAppointment" class="px-4 py-2 bg-background dark:bg-darkBackground text-destructive dark:text-destructive hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Cancel Appointment</button>
                                    <button type="button" id="saveModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Save Changes</button>
                                </div>
                                <button type="button" id="finishappointment" class="px-4 py-2 bg-background dark:bg-darkBackground text-primary dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[496px] w-full border-border dark:border-darkBorder border">
                                    Finish Appointment
                                </button>
                            </div>                     

                            
    <!-- ITO UNG DATI-->
                        <div class="hidden">
                            <input type="hidden" name="id" id="modalAppointmentId">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="text" name="contactNumber" id="modalContactNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" name="address" id="modalAddress" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Patient</label>
                                    <input type="text" name="nameOfTheUser" id="modalName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Booking Date</label>
                                    <input type="date" name="booking_date" id="modalBookingDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Total Price</label>
                                    <input type="text" name="price" id="modalTotalPrice" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Add-ons</label>
                                    <input type="text" name="addOns" id="modalAddOns" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="modalStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="pending" disabled selected>Pending</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="confirmed">Confirmed</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancel</button>                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <!-- CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN ITO UNG DATING BOOKING AN APPOINTMENT
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
     CHRISTIAN
      -->
     
            <div class="hidden">
                <form class="flex flex-col gap-12" action="/appointCustomer" method="POST">
                    <div class="flex flex-col gap-2">
                        <?php
                        Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Book an Appointment');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Please enter the following.');
                        ?>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Source. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Where did the booking come from?');
                            ?>
                        </div>
                        <div class="pb-[64px]">
                            <?php GridViewDefaultComponent::render() ?>
                        </div>
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Location. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Where will the service take place?');
                            ?>
                        </div>
                        <div class="">
                            <?php GridViewLocation::render() ?>
                        </div>
                    </div>
                    <div class="flex flex-col pb-[48px]">
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Service. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What will be booked?');
                            ?>
                        </div>
                        <div id="select" class="flex flex-col gap-[16px] FieldContainer min-w-[316px] w-full max-w-[400px] pb-[64px]">

                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Add-ons.  ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Are there special requests?');
                            ?>
                        </div>
                        <div class="pb-[64px]">
                            <?php StaticRadioButton::render() ?>
                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Date.');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What day will it happen?');
                            ?>
                        </div>
                        <div class=" pb-[64px]">
                            <?php GlobalInputField::render('date', 'Select date', 'date', ''); ?>
                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Time.');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What time will it start?');
                            ?>
                        </div>
                        <div class=" pb-[64px]">
                            <?php GlobalInputField::render('time', 'Select time', 'time', ''); ?>
                        </div>

                        <div class="flex flex-col w-full">
                            <div class="flex flex-row gap-2">
                                <?php
                                Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Customer.  ');
                                Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Who is the client?');
                                ?>
                            </div>
                            <?php

                            DefaultInputField::render('SearchCustomer', 'Search for existing customer', 'text', 'search', '', '',);
                            ?>
                            <div id="hiddenValue">
                            </div>
                            <div class=" rounded-xl bg-primary hover:bg-slate-500 cursor-pointer w-[325px]" id="wrapper">
                                <ul class="hover:bg-slate-400" id="suggestions">
                                    <li id="li"></li>
                                </ul>
                            </div>
                            <div class=" py-[10px]">
                                <?php DefaultInputField::render('guestCustomer', 'Add a guest customer', 'text', 'm', '', '',); ?>
                            </div>
                        </div>
                        
                        <div class="text-[16px]  flex justify-center pt-[148px]">
                            <?php
                            GlobalButton::render(
                                'primary',
                                'Book',
                                '',
                                '',
                                '',
                                'submit',
                                'appointmentButton',
                            );
                            ?>
                        </div>
                </form>
            </div>
        </main>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/charts/appointmentsChart.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/AppointmentsDom.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/appointmentsTableRealtime.js"></script>
        
        <?php
        // Output all footer scripts
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
        ?>
        <?php
    }
}

Page::page();
