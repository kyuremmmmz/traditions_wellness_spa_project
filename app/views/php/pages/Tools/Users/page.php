<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Inputs\SelectField;


class Page
{
    public static function page()
    {
        ?>
        <main class="w-full min-h-screen flex">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="0.5" y="0.5" width="49" height="49" rx="5.5" fill="white" stroke="#E4E4E7"/>
        <path d="M29 34V32C29 30.9391 28.5786 29.9217 27.8284 29.1716C27.0783 28.4214 26.0609 28 25 28H19C17.9391 28 16.9217 28.4214 16.1716 29.1716C15.4214 29.9217 15 30.9391 15 32V34" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M22 24C24.2091 24 26 22.2091 26 20C26 17.7909 24.2091 16 22 16C19.7909 16 18 17.7909 18 20C18 22.2091 19.7909 24 22 24Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M35 33.9999V31.9999C34.9993 31.1136 34.7044 30.2527 34.1614 29.5522C33.6184 28.8517 32.8581 28.3515 32 28.1299" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M29 16.1299C29.8604 16.3502 30.623 16.8506 31.1676 17.5522C31.7122 18.2538 32.0078 19.1167 32.0078 20.0049C32.0078 20.8931 31.7122 21.756 31.1676 22.4576C30.623 23.1592 29.8604 23.6596 29 23.8799" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

            <div>
                <h2 class="text-xl text-09090B font-SubHeaderTwo">Users</h2>
                <p class="text-gray-500 text-sm font-CaptionOne mb-[16px]">Last updated on February 16 at 3:07 PM</p>
            </div>
        </div>

        <!-- Search -->
        <div class="relative mb-[16px]">
            <input type="text font-BodyMedium2" class="w-[219px] h-[42px] border rounded-lg pl-10 pr-4 py-2 focus:ring focus:ring-green-300" placeholder="Search User">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </div>

        <!-- Filter -->
        <div class="flex items-center gap-3 mb-4 bg-gray-100 ">
        <label class="text-gray-600 text-sm block mb-1 font-CaptionMediumOne">Filter user type by</label>
                        <?php
                        Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[16px]', ' ');
                        $options = array(
                            'Therapist',
                            'Online Customer',
                            'Guest Customer'
                        );
                        ?>
                        <div class="flex flex-col gap-[16px] pb-[16px]">
                            <?php
                            SelectField::render($options, '', '', 'ewan');
                            ?>
                            <table class="min-w-[791px] h-[px] rounded-lg">
                <thead class="text-gray-600 uppercase text-sm ">
                    <tr>
                        <th class="py-3 px-4 text-left">NO.</th>
                        <th class="py-3 px-4 text-left">NAME</th>
                        <th class="py-3 px-4 text-left">USER TYPE</th>
                        <th class="py-3 px-4 text-left">GENDER</th>
                        <th class="py-3 px-4 text-left">EMAIL</th>
                    </tr>
                    </table>
                </thead>
                        </div>
                            </div>


        <!-- User Table -->
            <table class="min-w-full rounded-lg">
                <tbody class="text-09090B text-sm font-BodyTwo">
                    <?php
                        $users = [
                            ["id" => 1, "name" => "Anna Delvey", "type" => "Therapist", "gender" => "Female", "email" => "someone@gmail.com"],
                            ["id" => 2, "name" => "Denise Capua", "type" => "Online Customer", "gender" => "Male", "email" => "someone@gmail.com"],
                            ["id" => 3, "name" => "Denise Capua", "type" => "Guest Customer", "gender" => "Male", "email" => "someone@gmail.com"],
                        ];
                        foreach ($users as $user) {
                            echo "<tr class='border-t border-gray-200'>";
                            echo "<td class='py-3 px-4'>{$user['id']}</td>";
                            echo "<td class='py-3 px-4'>{$user['name']}</td>";
                            echo "<td class='py-3 px-4'>{$user['type']}</td>";
                            echo "<td class='py-3 px-4'>{$user['gender']}</td>";
                            echo "<td class='py-3 px-4'>{$user['email']}</td>";
                            echo "</tr>";
                        }
                    ?>
                                    </thead>
                </tbody>
            </table>
        </div>
    </div>


            <?php Sidebar::render(); ?>
            <div class="ml-[48px]">
            </div>
        </main>
        <?php
    }
}

Page::page();
