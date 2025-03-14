<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function render()
    {
        
?>
<main class="flex w-full bg-gray-100 dark:bg-gray-900 min-h-screen">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                
            <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 mt-[16px]">
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.5" y="0.5" width="49" height="49" rx="5.5" fill="white" stroke="#E4E4E7"/>
            <path d="M24 33C22.2441 33.0053 20.5503 32.3505 19.2545 31.1654C17.9588 29.9803 17.1558 28.3515 17.0047 26.6021C16.8537 24.8527 17.3657 23.1104 18.4391 21.7207C19.5126 20.3311 21.0691 19.3957 22.8 19.1C28.5 18 30 17.48 32 15C33 17 34 19.18 34 23C34 28.5 29.22 33 24 33Z" stroke="#3F3F46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 34C15 31 16.85 28.64 20.08 28C22.5 27.52 25 26 26 25" stroke="#3F3F46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

                <div>
                    <h2 class="text-xl font-semibold">Services</h2>
                    <p class="text-sm text-gray-500 mb-[16px]">Last updated at 3:07 PM</p>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg">+ Add a new service</button>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg">+ Add a new add-on</button>
                </div>
            </div>
        </div>
        
        <div class="border-b mb-4">
            <nav class="flex gap-4 text-gray-700">
                <a href="#" class="font-semibold border-b-2 border-green-600 pb-2">All Services</a>
                <a href="#">Messages</a>
                <a href="#">Body Basics</a>
                <a href="#">Packages</a>
                <a href="#">Add-ons</a>
                <a href="#">Archived Services</a>
                <a href="#">Archived Add-ons</a>
            </nav>
        </div>
        
                <div class="max-w-6xl mx-auto p-4">
                    <div class="grid grid-cols-3 gap-6">
                        <!-- Service Item -->
                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image1.jpg" alt="Bamboo Massage" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Bamboo Massage</h3>
                                <p class="text-sm text-gray-500">Warm bamboo therapy for deep relaxation.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                            3.8 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2722_6622)">
                            <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2722_6622">
                            <rect width="10" height="10" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>
                        <span class="ml-2 text-green-600 font-semibold">Starting from ₱420</span>
                                        </div>
                                    </div>
                                    <span class="text-gray-400">&gt;</span>
                                </div>
                        
                        <!-- Repeat for other services -->
                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image2.jpg" alt="Coffee Scrub" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Coffee Scrub</h3>
                                <p class="text-sm text-gray-500">With 1 hour body massage of your choice.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                                    4.5 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2722_6622)">
                        <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_2722_6622">
                        <rect width="10" height="10" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                        <span class="ml-2 text-green-600 font-semibold">₱350</span>
                                </div>
                            </div>
                            <span class="text-gray-400">&gt;</span>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image3.jpg" alt="Dagdagay" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Dagdagay</h3>
                                <p class="text-sm text-gray-500">Bamboo foot massage for stress relief.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                                    3.8 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2722_6622)">
                        <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_2722_6622">
                        <rect width="10" height="10" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                        <span class="ml-2 text-green-600 font-semibold">Starting from ₱450</span>
                                </div>
                            </div>
                            <span class="text-gray-400">&gt;</span>
                        </div>
                        
                        <!-- More service items -->
                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image1.jpg" alt="Bamboo Massage" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Bamboo Massage</h3>
                                <p class="text-sm text-gray-500">Warm bamboo therapy for deep relaxation.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                            3.8 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2722_6622)">
                            <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_2722_6622">
                            <rect width="10" height="10" fill="white"/>
                            </clipPath>
                            </defs>
                            </svg>
                        <span class="ml-2 text-green-600 font-semibold">Starting from ₱420</span>
                                        </div>
                                    </div>
                                    <span class="text-gray-400">&gt;</span>
                                </div>
                        
                        <!-- Repeat for other services -->
                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image2.jpg" alt="Coffee Scrub" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Coffee Scrub</h3>
                                <p class="text-sm text-gray-500">With 1 hour body massage of your choice.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                                    4.5 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2722_6622)">
                        <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_2722_6622">
                        <rect width="10" height="10" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                        <span class="ml-2 text-green-600 font-semibold">₱350</span>
                                </div>
                            </div>
                            <span class="text-gray-400">&gt;</span>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white shadow-md rounded-lg">
                            <img src="image3.jpg" alt="Dagdagay" class="w-16 h-16 rounded-lg object-cover">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold">Dagdagay</h3>
                                <p class="text-sm text-gray-500">Bamboo foot massage for stress relief.</p>
                                <div class="flex items-center mt-1 text-yellow-500">
                                    3.8 <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2722_6622)">
                        <path d="M5 0.833374L6.2875 3.44171L9.16667 3.86254L7.08334 5.89171L7.575 8.75837L5 7.40421L2.425 8.75837L2.91667 5.89171L0.833336 3.86254L3.7125 3.44171L5 0.833374Z" fill="#D08011" stroke="#D08011" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_2722_6622">
                        <rect width="10" height="10" fill="white"/>
                        </clipPath>
                        </defs>
                        </svg>
                        <span class="ml-2 text-green-600 font-semibold">Starting from ₱450</span>
                                </div>
                            </div>
                            <span class="text-gray-400">&gt;</span>
                        </div>
                    </div>
                </div>

                


                <!-- More service items -->
                </div>
                </div>



                
                <!-- Sidebar -->
                <?php Sidebar::render(); ?>
            </div>
        </main>
<?php
    }
}

Page::render();
