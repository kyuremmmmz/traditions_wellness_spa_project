<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Buttons\BackButton;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Headers\DrawerTitle;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Modals\ConfirmationDialog;

class NewAddOn
{
    public static function render(): void
    {
        ?>
        <form action="/createAddOns" method="post" id="newAddOnForm" onsubmit="return NewAddOnValidation.validateForm()">
            <div id="AddANewAddOnSection" class="hidden ml-[0px] w-full overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-0 max-w-[480px]">
                <?php BackButton::render('exitNewAddOn'); ?>
                <div class="w-full flex flex-col gap-[48px] items-center sm:mt-[64px] mt-[0px]">
                    <?php DrawerTitle::render('Add a new add-on', 'Please enter the following'); ?>
                    <section class="flex flex-col gap-[16px] min-w-[412px] max-w-[412px] items-end justify-end">
                        <?php SecondaryInputField::render('textfield', 'Name', 'Enter Name', [], 'name_error', null, 'name', '', 'required minlength="3" maxlength="50"', [], false, 'name', 0, '') ?>
                        <?php SecondaryInputField::render('numberfield', 'Price', 'Enter Price', [], 'price_error', null, 'price', '', 'required min="0" step="0.01"', [], false, 'price') ?>
                        <?php SecondaryInputField::render('dropdownfield', 'Status', '', ['Archived', 'Active'], '', null, 'status', '', 'required', [], false, 'status', 0) ?>
                        <div class="mt-[32px]"> <?php NewPrimaryButton::render('Create add-on', 'submit', 'openConfirmAddANewAddOnModal', '260px', null) ?> </div>
                    </section>
                </div>
            </div>
            <?php ConfirmationDialog::render('ConfirmNewAddOnModal', 'Are you sure you want to add this add-on?', 'proceedConfirmNewAddOn', 'cancelConfirmNewAddOn', 'submit', 'primary') ?>
            <?php ConfirmationDialog::render('UnsavedNewAddOnModal', 'Are you sure you want exit? All unsaved changes will be lost.', 'proceedUnsavedNewAddOn', 'cancelUnsavedNewAddOn', 'button', 'destructive') ?>
        </form>

        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/Addons/NewAddOnDOM.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/Addons/NewAddOnValidation.js"></script>
        <?php 
    }
}