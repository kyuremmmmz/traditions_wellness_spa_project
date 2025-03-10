<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;

class Page
{
    public static function page()
    {
                ?>
                <main class="flex w-full gap-4">
                    <?php Sidebar::render(); ?>
                    <div class="ml-[48px] w-full p-6 min-h-screen ">
                        <!-- Header -->
                        <div class="flex justify-between items-center ">
                            <div class="flex items-center gap-2">
                            <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_1651_4755)">
                        <rect x="4.49988" y="9" width="50" height="50" rx="6" fill="white"/>
                        <rect x="4.99988" y="9.5" width="49" height="49" rx="5.5" stroke="#E4E4E7"/>
                        </g>
                        <path d="M36.4999 30C36.4999 28.4087 35.8677 26.8826 34.7425 25.7574C33.6173 24.6321 32.0912 24 30.4999 24C28.9086 24 27.3825 24.6321 26.2572 25.7574C25.132 26.8826 24.4999 28.4087 24.4999 30C24.4999 37 21.4999 39 21.4999 39H39.4999C39.4999 39 36.4999 37 36.4999 30Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M32.2299 43C32.0541 43.3031 31.8017 43.5547 31.4981 43.7295C31.1945 43.9044 30.8503 43.9965 30.4999 43.9965C30.1495 43.9965 29.8053 43.9044 29.5017 43.7295C29.1981 43.5547 28.9457 43.3031 28.7699 43" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="27.4999" width="37" height="18" rx="9" fill="#F2F9F1"/>
                        <path d="M39.3877 11.2955V10.2301L43.159 4.27273H43.9985V5.84091H43.4659L40.7684 10.1108V10.179H45.9375V11.2955H39.3877ZM43.5255 13V10.9716L43.534 10.4858V4.27273H44.7826V13H43.5255ZM47.4526 13L51.2622 5.46591V5.40199H46.856V4.27273H52.6259V5.44034L48.829 13H47.4526Z" fill="#0C2108"/>
                        <defs>
                        <filter id="filter0_d_1651_4755" x="0.499878" y="7" width="58" height="58" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="2"/>
                        <feGaussianBlur stdDeviation="2"/>
                        <feComposite in2="hardAlpha" operator="out"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1651_4755"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1651_4755" result="shape"/>
                        </filter>
                        </defs>
                        </svg>
                                <Bell class="w-6 h-6" />
                                <h1 class="text-xl font-SubHeaderTwo">Dashboard</h1>
                                <span class="text-gray-500 text-sm font-CaptionOne">Last updated at 3:07 PM</span>
                            </div>
                            <RefreshCcw class="cursor-pointer w-5 h-5" />
                        </div>



                        <!-- Today's Overview -->
                        <div class="max-w-lg mx-auto w-full p-4">
                            <h2 class="text-xl font-BodyOne mb-3">Today's Overview</h2>
                            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                                <div class="p-4 flex items-start gap-3 border-b">
                                    <div>
                                        <p class="text-sm text-gray-600 font-CaptionOne">Store Status</p>
                                        <p class="text-lg font-SubHeaderOne">Open</p>
                                    </div>
                                </div>
                                <div class="p-4 space-y-3">
                                    <div class="flex items-start gap-3">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.4999 11V6C18.4999 5.46957 18.2892 4.96086 17.9141 4.58579C17.539 4.21071 17.0303 4 16.4999 4C15.9694 4 15.4607 4.21071 15.0857 4.58579C14.7106 4.96086 14.4999 5.46957 14.4999 6" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.4999 10V4C14.4999 3.46957 14.2892 2.96086 13.9141 2.58579C13.539 2.21071 13.0303 2 12.4999 2C11.9694 2 11.4607 2.21071 11.0857 2.58579C10.7106 2.96086 10.4999 3.46957 10.4999 4V6" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.4999 10.5V6C10.4999 5.46957 10.2892 4.96086 9.91409 4.58579C9.53902 4.21071 9.03031 4 8.49988 4C7.96944 4 7.46074 4.21071 7.08566 4.58579C6.71059 4.96086 6.49988 5.46957 6.49988 6V14" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.4999 8C18.4999 7.46957 18.7106 6.96086 19.0856 6.58579C19.4607 6.21071 19.9694 6 20.4999 6C21.0303 6 21.539 6.21071 21.9141 6.58579C22.2891 6.96086 22.4999 7.46957 22.4999 8V14C22.4999 16.1217 21.657 18.1566 20.1567 19.6569C18.6564 21.1571 16.6216 22 14.4999 22H12.4999C9.69986 22 7.99986 21.14 6.50986 19.66L2.90986 16.06C2.56579 15.6789 2.38145 15.1802 2.39498 14.6669C2.40852 14.1537 2.61891 13.6653 2.98258 13.303C3.34625 12.9406 3.83536 12.7319 4.34863 12.7202C4.8619 12.7085 5.36002 12.8946 5.73986 13.24L7.49986 15" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">2/10</p>
                                            <p class="text-gray-700 font-CaptionOne">Beds Available</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.4999 6H4.49988C3.39531 6 2.49988 6.89543 2.49988 8V16C2.49988 17.1046 3.39531 18 4.49988 18H20.4999C21.6044 18 22.4999 17.1046 22.4999 16V8C22.4999 6.89543 21.6044 6 20.4999 6Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12.4999 14C13.6044 14 14.4999 13.1046 14.4999 12C14.4999 10.8954 13.6044 10 12.4999 10C11.3953 10 10.4999 10.8954 10.4999 12C10.4999 13.1046 11.3953 14 12.4999 14Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">₱4,090.00</p>
                                            <p class="text-gray-700 font-CaptionOne">Revenue Earned</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Appointments -->
                        <div class="max-w-lg mx-auto w-full p-4">
                            <h2 class="text-xl font-BodyOne mb-3">Appointments</h2>
                            <div class="bg-white">
                            <div class="white shadow-md rounded-xl overflow-hidden">
                                <div class="p-4 flex items-start gap-3 border-b">
                                    <span class="w-3 h-3 bg-green-500 rounded-full mt-1"></span>
                                    <div>
                                        <p class="text-sm text-gray-600 font-BodyMediumOne">18</p>
                                        <p class="text-lg font-CaptionOne">Completed</p>
                                    </div>
                                </div>
                                <div class="p-4 space-y-3">
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">9</p>
                                            <p class="text-gray-700 font-CaptionONe">Ongoing</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">5</p>
                                            <p class="text-gray-700 font-CaptionOne">Missed</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">3</p>
                                            <p class="text-gray-700 font-CaptionOne">Cancelled</p>
                                        </div>
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-BodyMediumOne">20</p>
                                            <p class="text-gray-700 font-CaptionOne">Scheduled</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Staff Attendance -->
                        <div class="max-w-lg mx-auto w-full p-4">
                        <h2 class="text-lg font-BodyOne mb-[16px]">Staff Attendance</h2>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 11L18 13L22 9" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                    <UserCheck class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">9</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne ">Active</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2 mb-[9px]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 8V14" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 11H16" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                    <UserPlus class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">3</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne">Available</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2 mb-[9px]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 8L22 13" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 8L17 13" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                    <UserX class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">0</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne">Absent</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2 mb-[9px]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 11H16" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                    <User class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">1</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne">On-Leave</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Reports -->
                        <div class="max-w-lg mx-auto w-full p-4">
                        <h2 class="text-lg font-BodyOne mb-[16px]">Reports</h2>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                    <UserCheck class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">0</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne ">Feedbacks Collected</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2 mb-[9px]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.7301 18L13.7301 3.99998C13.5556 3.69218 13.3027 3.43617 12.997 3.25805C12.6913 3.07993 12.3438 2.98608 11.9901 2.98608C11.6363 2.98608 11.2888 3.07993 10.9831 3.25805C10.6774 3.43617 10.4245 3.69218 10.2501 3.99998L2.25005 18C2.07373 18.3053 1.98128 18.6519 1.98206 19.0045C1.98284 19.3571 2.07683 19.7032 2.2545 20.0078C2.43217 20.3124 2.6872 20.5646 2.99375 20.7388C3.30029 20.9131 3.64746 21.0032 4.00005 21H20.0001C20.351 20.9996 20.6956 20.9069 20.9993 20.7313C21.3031 20.5556 21.5553 20.3031 21.7306 19.9991C21.9059 19.6951 21.9981 19.3504 21.998 18.9995C21.9979 18.6486 21.9055 18.3039 21.7301 18Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 9V13" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 17H12.01" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                    <UserPlus class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">0</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne">Incidents</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div class="flex items-center gap-2 mb-[9px]">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 21V19C21.9993 18.1137 21.7044 17.2528 21.1614 16.5523C20.6184 15.8519 19.8581 15.3516 19 15.13" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="#09090B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                    <UserX class="w-[316px] h-[56px]" />
                                    <div>
                                        <p class="text-lg font-BodyMediumOne">1</p>
                                        <p class="text-sm text-gray-500 font-CaptionOne">Employee Issues</p>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>



                        <!-- Upcoming Events -->
                        <div class="max-w-lg mx-auto w-full p-4">
                            <h2 class="text-xl font-BodyOne mb-3">Upcoming Events</h2>
                            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                                <div class="p-4 flex items-start gap-3 border-b">
                                    <span class="w-3 h-3 bg-red-500 rounded-full mt-1"></span>
                                    <div>
                                        <p class="text-sm text-gray-600 font-CaptionOne ">February 25</p>
                                        <p class="text-lg font-BodyMediumOne">Monthly Manager Meeting</p>
                                    </div>
                                </div>
                                <div class="p-4 space-y-3">
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-CaptionOne">March 6</p>
                                            <p class="text-gray-700 font-CaptionOne">Franchise Meeting with Julie</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-CaptionOne">March 15</p>
                                            <p class="text-gray-700 font-CaptionOne">Discuss Jason’s Promotion</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="w-2 h-2 bg-gray-500 rounded-full mt-1.5"></span>
                                        <div>
                                            <p class="text-sm font-CaptionOne">March 30</p>
                                            <p class="text-gray-700 font-CaptionOne">Plan for Renovations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
        <?php
    }
}

Page::page();
