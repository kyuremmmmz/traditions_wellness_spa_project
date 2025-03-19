<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Buttons\GlobalButton;


class Page
{
    public static function page()
    {
        ?>
        <main class="w-full flex justify-center items-center min-h-screen bg-gray-100">
            <div class="max-w-5xl w-full bg-white p-6 rounded-lg shadow-md">
                <!-- Header -->
                <div class="flex flex-col items-center justify-center min-h-screen px-4">
    <div class="max-w-md w-full mb-[31px]">
        <!-- Back Button -->
        <svg width="6" height="12" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7 1L1 7L7 13" stroke="#3F3F46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>


        <!-- Form Title -->
        <h2 class="text-xl font-HeaderTwo mt-[31px]">Add a new therapist</h2>
        <p class="text-gray-500 mb-6 font-BodyTwo">Please enter the following.</p>

        <!-- Form -->
        <form class="space-y-4 ">
            <!-- Form Group -->
            <div class="grid grid-cols-3 gap-4 items-center">
                <!-- First Name -->
                <label class="text-gray-500 text-sm text-right font-BodyMediumTwo mt-[16px]">First Name</label>
                <input type="text" value="Frankie" class="col-span-2 border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-400 font-BodyMediumTwo mt-[16px]">
            </div>

            <div class="grid grid-cols-3 gap-4 items-center">
                <!-- Last Name -->
                <label class="text-gray-500 text-sm text-right font-BodyMediumTwo mt-[16px]">Last Name</label>
                <input type="text" value="Ferrer" class="col-span-2 border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-400 font-BodyMediumTwo mt-[16px]">
            </div>

            <div class="grid grid-cols-3 gap-4 items-center">
                <!-- Gender -->
                <label class="text-gray-500 text-sm text-right font-BodyMediumTwo mt-[16px]">Gender</label>
                <select class="col-span-2 border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-400 font-BodyMediumTwo mt-[16px]">
                    <option selected>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="grid grid-cols-3 gap-4 items-center">
                <!-- Status -->
                <label class="text-gray-500 text-sm text-right font-BodyMediumTwo mt-[16px]">Status</label>
                <select class="col-span-2 border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-400 font-BodyMediumTwo mt-[16px]">
                    <option selected>Active</option>
                    <option>Inactive</option>
                </select>
            </div>

            <div class="grid grid-cols-3 gap-4 items-center">
                <!-- Email -->
                <label class="text-gray-500 text-sm text-right font-BodyMediumTwo mt-[16px]">Email</label>
                <input type="text" value="someone@gmail.com" class="col-span-2 border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-gray-400 font-BodyMediumTwo mt-[16px]">
            </div>
        </form>
    </div>
</div>

            <!-- Submit Button -->
            <div class="text-[14px] flex justify-center  pt-[16px] flex gap-4 font-medium">
                    <?php
                    GlobalButton::render(
                        'primary',
                        'Add therapist',
                        '',
                        '',
                        '',
                        'add',
                        'Therapist tButton',
                    );
                    ?>
        </form>
    </div>
</div>
        </main>


            <?php Sidebar::render(); ?>
            <div class="ml-[48px]">
            </div>
        </main>
        <?php
    }
}

Page::page();
