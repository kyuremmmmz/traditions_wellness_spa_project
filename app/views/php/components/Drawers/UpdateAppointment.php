<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;

class UpdateAppointment
{
    public static function render(): void
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
        <form action="/updateAppointment" method="post">
            <div id="updateModal" class="sm:pt-[80px] pt-[48px] fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full transition-all duration-300 opacity-0 z-[200]">
                <div class="mx-auto p-[48px] border border-border dark:border-darkBorder w-4/5 rounded-[6px] bg-background dark:bg-darkBackground transform transition-all duration-300 opacity-100 scale-95">
                    <div class="flex flex-col gap-[48px]">
                        <section class="flex flex-col gap-[8px]">
                            <div class="flex w-full justify-end pb-[24px]">
                                <button type="button" id="closeModal" class="relative right-2 transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                    <div class="w-[24px] h-[24px] flex justify-center items-center">
                                        <?php IconChoice::render('exitSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                                    </div>
                                </button>
                            </div>
                            <p class="leading-none HeaderTwo text-onBackground dark:text-darkOnBackground">Update Appointment</p>
                            <p class="leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo">You can modify the details from the selections.</p>
                        </section>
                        <div>
                            <section>
                                <div class="border-b border-border flex dark:border-darkBorder h-[30px] overflow-x-auto">
                                    <div class="mx-[24px] h-[30px]">
                                        <button type="button" id="showSummary" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Summary</button>
                                        <button type="button" id="showServiceBooked" class="px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none">Service Booked</button>
                                    </div>
                                </div>
                            </section>
                            <div class="sm:h-[351px] min-h-[351px] w-full max-w-full flex relative overflow-x-auto pt-[48px]">
                                <section id="summarySection" class="flex w-full max-w-full flex-col sm:flex-row items-top xl:justify-center gap-[48px] absolute w-full transition-all duration-300 transform">
                                    <div class="flex flex-col items-start ">
                                        <div class="flex flex-col w-full gap-[16px] items-start pt-[13px] mb-[40px]">
                                            <?php
                                            TextRowContainer::render('Customer Name', '', 'onBackground', 'darkOnBackground', 'fetchedCustomerName', 'fetched_customer_name');
                                            TextRowContainer::render('Customer Email', '', 'onBackground', 'darkOnBackground', 'fetchedCustomerEmail', 'fetched_customer_email');
                                            TextRowContainer::render('Status', '', 'onBackground', 'darkOnBackground', 'fetchedStatus', 'fetched_status');
                                            TextRowContainer::render('Payment Status', '', 'onBackground', 'darkOnBackground', 'fetchedPaymentStatus', 'fetched_payment_status');
                                            TextRowContainer::render('Assignment Status', '', 'onBackground', 'darkOnBackground', 'fetchedAssignmentStatus', 'fetched_assignment_status');
                                            TextRowContainer::render('Source of Booking', '', 'onBackground', 'darkOnBackground', 'fetchedSourceOfBooking', 'fetched_source_of_booking');
                                            ?>
                                        </div>
                                        <div class="flex flex-col w-full max-w-full gap-[16px] items-start">
                                            <?php
                                            TextRowContainer::render('Appointment ID', '', 'onBackground', 'darkOnBackground', 'modalAppointmentId', 'fetched_appointment_id');
                                            TextRowContainer::render('Client ID', '', 'onBackground', 'darkOnBackground', 'fetchedClientId', 'fetched_client_id');
                                            TextRowContainer::render('Creation Date', '', 'onBackground', 'darkOnBackground', 'fetchedCreationDate', 'fetched_creation_date');
                                            TextRowContainer::render('Approval Date', '', 'onBackground', 'darkOnBackground', 'fetchedApprovalDate', 'fetched_approval_date');
                                            TextRowContainer::render('Last Modified On', '', 'onBackground', 'darkOnBackground', 'fetchedLastModifiedOn', 'fetched_last_modified_on');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-[16px] items-end">
                                        <div class="flex gap-[16px]" id="data">

                                        </div>
                                        <?php SecondaryInputField::render('timefield', 'Start Time', '', [], $TimeError, null, 'timedata', '', '', [], false, 'start_time'); ?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Payment Choice', '', ['Online Payment', 'On-site'], '', null, '', '', '', [], false, '') ?>
                                        <?php SecondaryInputField::render('textfield', 'Receipt Number', 'Enter Receipt Number', [], '', null, '', '', '', [], false, '') ?>
                                        <div class="pl-[65px] sm:pl-[65px] flex flex-col gap-[8px]">
                                            <?php Text::render('FinalDurationMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo w-[260px] dark:text-darkOnBackgroundTwo', $FinalDurationMessage); ?>
                                            <?php Text::render('FinalEndTimeMessage', '', 'CaptionTwo leading-none text-onBackgroundTwo  w-[260px] dark:text-darkOnBackgroundTwo', $FinalEndTimeMessage); ?>
                                        </div>
                                        <div id="hiddenVal"></div>
                                    </div>
                                </section>
                                <section id="serviceBookedSection" class="flex hidden flex-col sm:flex-row items-top justify-start md:justify-center gap-[48px] absolute w-full h-full transition-all duration-300 transform">
                                    <div class="flex flex-col gap-[16px] h-full">
                                        <?php SecondaryInputField::render('dropdownfield', 'Service Booked', 'Select Service Booked', $ServiceBookedOptions, $ServiceBookedOptionsError, null, 'select2', '', '', [], false, 'service_booked') ?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Duration', 'Select Duration', $DurationOptions, $DurationOptionsError, null, 'durationhaha', '', 'duration', [], false, 'duration') ?>
                                        <?php SecondaryInputField::render('dropdownwithpricefield', 'Party Size', 'Select Party Size', [], $PartySizeOptionsError, null, 'party_size', '', '', $PartySizeOptions, false, 'party_size') ?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Massage Selection', 'Select Massage', $MassageOptions, $MassageOptionsError, null, 'MassageOptions', '', '', [], true, 'massage_selection') ?>
                                        <?php SecondaryInputField::render('dropdownfield', 'Body Scrub Selection', 'Select Body Scrub', $BodyScrubOptions, $BodyScrubOptionsError, null, 'BodyScrubOptions', '', '', [], true, 'body_scrub_selection') ?>
                                    </div>
                                    <div class="flex flex-col gap-[16px]">
                                        <!-- pag wala to, hindi magbubukas ung update modal. pachange na lang ung code sa appointments table realtime. nagbabase siya dito oh. 
                                        document.getElementById('modalAppointmentId').value = id;
                                        document.getElementById('modalContactNumber').value = contact;
                                        document.getElementById('modalAddress').value = address;
                                        document.getElementById('modalName').value = name;
                                        document.getElementById('modalBookingDate').value = this.getAttribute('data-date');
                                        document.getElementById('modalTotalPrice').value = price;
                                        document.getElementById('modalAddOns').value = addons;
                                        document.getElementById('modalStatus').value = status;
                                        -->
                                        <p class="text-transparent" id="modalContactNumber"></p>
                                        <p class="text-transparent" id="modalAddress"></p>
                                        <p class="text-transparent" id="modalName"></p>
                                        <p class="text-transparent" id="modalBookingDate"></p>
                                        <p class="text-transparent" id="modalTotalPrice"></p>
                                        <p class="text-transparent" id="modalAddOns"></p>
                                        <p class="text-transparent" id="modalStatus"></p>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="flex flex-col w-full items-center gap-[16px]">
                            <div class="flex gap-[16px] w-full justify-center">
                                <button type="button" id="openCancelAppointmentModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-destructive dark:text-destructive hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Cancel Appointment</button>
                                <button type="button" id="saveModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[240px] w-full border-border dark:border-darkBorder border">Save Changes</button>
                            </div>
                            <button type="button" id="openFinishAppointmentModal" class="px-4 py-2 bg-background dark:bg-darkBackground text-primary dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] max-w-[496px] w-full border-border dark:border-darkBorder border">
                                Finish Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finish Appointment Modal -->
            <div id="FinishAppointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to finish this appointment?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelFinishButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmFinishButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

            <!-- Update Appointment Confirmation Modal -->
            <div id="UpdateConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[228px] flex flex-col">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to save these changes?</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="cancelUpdateButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button type="submit" id="confirmUpdateButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary">Confirm</button>
                    </div>
                </div>
            </div>

            <!-- Cancel Appointment Modal -->
            <div id="CancelAppointmentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[301]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to cancel this appointment? This cannot be undone.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="closeCancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedCancelAppointmentButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>

            <!-- Update Unsaved Progress Modal -->
            <div id="UpdateUnsavedProgressModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[300]">
                <div class="bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-[477px] h-[284px] flex flex-col gap-[24px]">
                    <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]">Are you sure you want to exit? All unsaved changes will be lost.</p>
                    <div class="flex gap-[16px] justify-end mt-[48px]">
                        <button type="button" id="closeUpdateUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                        <button id="proceedUpdateUnsavedProgressButton" class="BodyTwo h-[40px] w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive">Proceed</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}