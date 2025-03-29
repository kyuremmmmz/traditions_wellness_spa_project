<?php

namespace Project\App\Views\Php\Components\Drawers;

use Project\App\Views\Php\Components\Buttons\BackButton;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Headers\DrawerTitle;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Modals\ConfirmationDialog;

class UpdateAddOn
{
    public static function render(): void
    {
        ?>
        <form action="/updateAddOn" method="post" id="UpdateAddOnForm" onsubmit="return UpdateAddOnValidation.validateForm()">
            <div id="UpdateAddOnSection" class="hidden ml-[0px] w-full overflow-x-auto max-w-full p-[48px] overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-0 max-w-[480px]">
                <?php BackButton::render('exitUpdateAddOn'); ?>
                <div class="w-full flex flex-col gap-[48px] items-center justify-center sm:mt-[64px] mt-[0px]">
                    <?php DrawerTitle::render('Update add-on', 'You may modify the following details'); ?>
                    <section class="flex flex-col gap-[16px] min-w-[300px] max-w-[300px] items-end justify-end">
                        <?php SecondaryInputField::render('hidden', 'ID', '', [], '', null, 'update_addon_id', '', '', [], false, 'update_addon_id') ?>
                        <?php SecondaryInputField::render('textfield', 'Name', 'Enter Name', [], 'update_name_error', null, 'update_name', '', 'required minlength="3" maxlength="50"', [], false, 'update_name', 0, '') ?>
                        <?php SecondaryInputField::render('numberfield', 'Price', 'Enter Price', [], 'update_price_error', null, 'update_price', '', 'required min="0" step="0.01"', [], false, 'update_price') ?>
                        <?php SecondaryInputField::render('dropdownfield', 'Status', '', ['Archived', 'Active'], '', null, 'update_status', '', 'required', [], false, 'update_status', 0) ?>
                        <div class="mt-[32px] flex flex-col gap-[8px]"> 
                            <?php NewPrimaryButton::render('Save Changes', 'submit', 'openConfirmUpdateAddOnModal', '260px', null, '') ?>
                            <?php NewPrimaryButton::render('Delete', 'button', 'openDeleteUpdateAddOnModal', '260px', null, 'destructive') ?>
                        </div>
                    </section>
                </div>
            </div>
            <?php ConfirmationDialog::render('ConfirmUpdateAddOnModal', 'Are you sure you want to update this add-on?', 'proceedUpdateAddOn', 'cancelUpdateAddOn', 'submit', 'primary') ?>
            <?php ConfirmationDialog::render('UnsavedUpdateAddOnModal', 'Are you sure you want exit? All unsaved changes will be lost.', 'proceedUnsavedUpdateAddOn', 'cancelUnsavedUpdateAddOn', 'button', 'destructive') ?>
            <?php ConfirmationDialog::render('DeleteUpdateAddOnModal', 'Are you sure you want to delete this add-on? It is recommended instead to archive it.', 'proceedDeleteUpdateAddOn', 'cancelDeleteUpdateAddOn', 'button', 'destructive') ?>
        </form>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/Addons/UpdateAddOnDOM.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/Addons/UpdateAddOnValidation.js"></script>

        <?php
    }
}