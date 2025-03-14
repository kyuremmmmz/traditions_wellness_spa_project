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
        <main class="w-full min-h-screen flex">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
                <!-- Header -->
                <div class="flex items-center gap-3 mb-6">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.5" y="0.5" width="49" height="49" rx="5.5" fill="white" stroke="#E4E4E7"/>
            <path d="M32 24V19C32 18.4696 31.7893 17.9609 31.4142 17.5858C31.0391 17.2107 30.5304 17 30 17C29.4696 17 28.9609 17.2107 28.5858 17.5858C28.2107 17.9609 28 18.4696 28 19" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M28 23V17C28 16.4696 27.7893 15.9609 27.4142 15.5858C27.0391 15.2107 26.5304 15 26 15C25.4696 15 24.9609 15.2107 24.5858 15.5858C24.2107 15.9609 24 16.4696 24 17V19" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M24 23.5V19C24 18.4696 23.7893 17.9609 23.4142 17.5858C23.0391 17.2107 22.5304 17 22 17C21.4696 17 20.9609 17.2107 20.5858 17.5858C20.2107 17.9609 20 18.4696 20 19V27" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M32 21C32 20.4696 32.2107 19.9609 32.5858 19.5858C32.9609 19.2107 33.4696 19 34 19C34.5304 19 35.0392 19.2107 35.4142 19.5858C35.7893 19.9609 36 20.4696 36 21V27C36 29.1217 35.1572 31.1566 33.6569 32.6569C32.1566 34.1571 30.1217 35 28 35H26C23.2 35 21.5 34.14 20.01 32.66L16.41 29.06C16.0659 28.6789 15.8816 28.1802 15.8951 27.6669C15.9087 27.1537 16.1191 26.6653 16.4827 26.303C16.8464 25.9406 17.3355 25.7319 17.8488 25.7202C18.3621 25.7085 18.8602 25.8946 19.24 26.24L21 28" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

                    <div>
                        <h2 class="text-xl font-SubHeaderTwo">Therapists</h2>
                        <p class="text-gray-500 text-sm font-CaptionOne">Last updated on February 16 at 3:07 PM</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="text-[16px] pt-[16px] flex gap-4">
                    <?php
                    GlobalButton::render(
                        'primary',
                        '+ Add a therapist',
                        '',
                        '',
                        '',
                        'add',
                        'Therapist tButton',
                    );
                    ?>
                    
                    <div class="relative">
                        <input type="text" class="w-[250px] h-[40px] border rounded-lg pl-10 pr-4 py-2 focus:ring focus:ring-gray-300" placeholder="Search Therapist">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </div>
                </div>
                        
                
                <!-- Filter -->
                <div class="mb-4">
                    <label class="text-gray-600 text-sm font-CaptionMediumOne">Filter status by</label>
                    <select class="border rounded-md px-4 py-2 w-[200px] text-gray-700 font-CaptionMediumOne">
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                
                <!-- User Table -->
                <div class="overflow-x-auto">
                    <table class="w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                            <tr>
                                <th class="py-3 px-6 text-left">NO.</th>
                                <th class="py-3 px-6 text-left">THERAPIST NAME</th>
                                <th class="py-3 px-6 text-left">STATUS</th>
                                <th class="py-3 px-6 text-left">GENDER</th>
                                <th class="py-3 px-6 text-left">EMAIL</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 text-sm font-BodyTwo">
                            <?php
                                $users = [
                                    ["id" => 1, "name" => "Anna Delvey", "status" => "Active", "gender" => "Male", "email" => "someone@gmail.com"],
                                    ["id" => 2, "name" => "Denise Capua", "status" => "Active", "gender" => "Male", "email" => "someone@gmail.com"],
                                ];
                                foreach ($users as $user) {
                                    echo "<tr class='border-t border-gray-200'>";
                                    echo "<td class='py-3 px-6'>{$user['id']}</td>";
                                    echo "<td class='py-3 px-6'>{$user['name']}</td>";
                                    echo "<td class='py-3 px-6'>{$user['status']}</td>";
                                    echo "<td class='py-3 px-6'>{$user['gender']}</td>";
                                    echo "<td class='py-3 px-6'>{$user['email']}</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
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
