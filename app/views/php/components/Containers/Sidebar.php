<?php

namespace Project\App\Views\Php\Components\Containers;

use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Photo\Photo;
use Project\App\Views\Php\Components\Texts\Text;

class Sidebar
{
    public static function render(?string $className = null): void
    {
        $userFullNameOnSideBar = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        $userRoleOnSideBar = $_SESSION['user']['role'];
        ?>
        <!--<form action="/logout" method="post">
            <button type="submit">Logout puta</button>
        </form>-->
        <aside id="sidebar" class="w-[0px] bg-surface dark:bg-darkSurface p-[0px] sm:h-full sm:flex sm:flex-col sm:justify-between fixed sm:left-0 sm:top-0 sm:w-[48px] sm:hover:w-[258px] sm:p-[8px] sm:bg-surface sm:dark:bg-darkSurface group sm:hover:group duration-200 sm:ease-in-out z-10 sm:z-20 h-full overflow-y-auto">                <section> <!-- wag palitan ang id ng branch button-->
                    <button id="sidebarButton" class="w-[0px] p-[0px] h-[48px] hidden sm:flex bg-background dark:bg-darkBackground border-border dark:border-darkBorder sm:border-none border-[1px] sm:border-[0px] sm:h-[32px] sm:w-[32px] sm:group-hover:w-[241px] sm:group-hover:h-[48px] rounded-[6px] sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface sm:p-[0px] transition-all duration-300 ease-in-out sm:group-hover:opacity-100">
                        <div id="sidebarContainer" class="flex w-[48px] sm:w-[48px] sm:group-hover:w-[225px] sm:h-[32px] sm:group-hover:h-[48px] sm:group-hover:p-[8px] transition-all duration-300 ease-in-out sm:group-hover:opacity-100">
                            <div class="bg-primary dark:bg-darkPrimary w-[32px] h-[32px] rounded-[6px] flex justify-center items-center">
                                <div class="w-[24px] h-[10.45px]">
                                    <svg viewBox="0 0 74 32" fill="white" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M42.5726 3.50951C44.4444 -2.20273 51.9886 0.21221 50.2872 5.05886C49.4886 7.3323 48.7847 11.0203 48.7847 18.0899C48.7847 26.9277 45.4703 31.6161 38.8447 31.6161C36.2847 31.6161 34.214 30.9559 32.6357 29.6289C31.0575 30.9559 28.9868 31.6161 26.4237 31.6161C19.798 31.6161 16.4868 26.9277 16.4868 18.0899V11.6703C16.5121 9.94588 17.7525 9.08368 20.2115 9.08368C22.6957 9.08368 23.9394 9.96615 23.9394 11.7344V18.0899C23.9394 21.6264 24.7665 23.3912 26.4237 23.3912C28.0809 23.3912 28.9078 21.6264 28.9078 18.0899V14.3548C28.9078 12.5865 30.1515 11.7007 32.6357 11.7007C35.12 11.7007 36.3605 12.5865 36.3605 14.3548V18.0899C36.3605 21.6264 37.1906 23.3912 38.8447 23.3912C40.5019 23.3912 41.3289 21.6264 41.3289 18.0899C41.3289 11.0203 41.7077 6.15008 42.5726 3.50951Z"/>
                                        <path d="M69.6432 14.3714C70.2146 14.7014 70.6533 14.9911 70.9627 15.2403C71.2752 15.4896 71.5846 15.7927 71.8971 16.1497C73.2544 18.1032 73.2543 20.1813 73.2543 21.99C73.2543 24.836 72.2726 27.1161 70.325 28.8473C68.2417 30.6964 65.3156 31.6226 61.5499 31.6226C58.3933 31.6226 55.7575 30.7941 53.63 29.1572C51.7677 27.7224 50.8364 26.1731 50.8364 24.5194C50.8364 22.0034 52.2664 20.7472 55.1262 20.7472C56.1742 20.7472 57.2663 21.2389 58.4059 22.219C59.5454 23.1856 61.1616 23.6673 63.2575 23.6673C64.9147 23.6673 65.7418 23.1082 65.7418 21.99C65.7418 21.3972 64.5075 19.7771 62.0359 19.2787C61.6855 19.1675 60.9154 18.9418 59.7254 18.5949C58.6269 18.2918 57.7398 18.019 57.0675 17.7866C54.7884 17.0019 53.1407 15.951 52.118 14.6408C51.2247 13.4249 50.8018 10.8012 50.8018 9.1576C50.8018 6.50693 51.7803 4.37833 53.7342 2.7785C55.8175 1.05068 58.7405 0.188477 62.5063 0.188477C65.6629 0.188477 68.2985 0.959708 70.4261 2.48881C72.2884 3.82593 73.2197 5.26411 73.2197 6.79658C73.2197 9.14412 71.7897 10.3163 68.9299 10.3163C67.8819 10.3163 66.7897 9.86157 65.6502 8.94882C64.5107 8.03944 62.8945 7.58474 60.7986 7.58474C59.1414 7.62515 58.3144 8.17081 58.3144 9.21828C58.3144 9.77064 59.5265 11.4513 61.9981 11.8655C62.3453 11.9733 63.1155 12.1923 64.3055 12.5055C65.4072 12.7952 66.2941 13.0444 66.9665 13.2532C68.1818 13.6507 69.0751 14.0244 69.6432 14.3714Z"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7051 0C27.7051 0 36.3603 -6.42408e-06 36.3603 7.403C36.3603 10.5016 34.1539 10.5016 32.5567 10.5016C30.9595 10.5016 28.9834 10.5016 28.9077 7.41312C28.974 2.19598 27.7051 0 27.7051 0Z"/>
                                        <path d="M14.9084 7.95204V29.1607C14.9084 30.9256 13.6647 31.8114 11.1805 31.8114C8.72155 31.8114 7.48101 30.9492 7.45575 29.2213V7.95204H2.48733C0.830138 7.95204 0 6.625 0 3.97433C0 1.35398 0.811217 0.0269445 2.42738 0H21.5119C23.1312 0.0269445 23.9393 1.35398 23.9393 3.97433C23.9393 6.625 23.1123 7.95204 21.4551 7.95204H14.9084Z"/>
                                    </svg>
                                </div>
                            </div>
                            <div id="sidebarText" class="h-full flex w-[0px] flex-col justify-center sm:w-[0px] sm:overflow-hidden pl-[8px] gap-[4px] sm:opacity-0 transition-all duration-300 ease-in-out sm:group-hover:w-[152px] sm:group-hover:opacity-100">
                                <?php 
                                Text::render('','', 'text-onBackground text-semibold text-left text-[14px] text-onBackground dark:text-darkOnBackground leading-none', 'Ayala');
                                Text::render('','', 'MiniOne text-onBackground text-left dark:text-darkOnBackground leading-none', 'Branch');
                                ?>
                            </div>
                        </div>
                    </button>

                    <div class="mt-[48px] sm:mt-0">
                        <div id="sidebarContainer" class="hidden sm:hidden">
                            <?php echo Text::render('', '', 'text-onBackgroundTwo ml-[8px] dark:text-darkOnBackgroundTwo CaptionMediumOne leading-none  text-left transition-all duration-300 ease-in-out', 'Tools'); ?>
                        </div>
                        <?php echo Text::render('', '', 'text-onBackgroundTwo sm:h-[0px] hidden sm:flex sm:group-hover:h-[12px] dark:text-darkOnBackgroundTwo CaptionMediumOne sm:opacity-0 sm:group-hover:opacity-100 leading-none sm:w-[0px] sm:group-hover:w-[241px] sm:mt-[0px] sm:group-hover:mt-[24px] sm:pl-[8px] text-left transition-all duration-300 ease-in-out', 'Tools'); ?>
                        <div class="flex flex-col mt-[12px] border-border dark:border-darkBorder border-[1px] sm:border-none rounded-[6px] sm:rounded-none bg-surface dark:bg-darkSurface sm:bg-surface sm:bg-darkSurface">
                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/dashboard">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] rounded-tr-[5px] rounded-tl-[5px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('dashboardSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Dashboard')?>
                                    </button>
                                </a>    
                            </div> 


                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/appointments">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('appointmentsSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Appointments')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/employees">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('employeesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Employees')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/finances">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('financesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Finances')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/inventory">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('inventorySmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Inventory')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/branches">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('branchesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Branches')?>
                                    </button>
                                </a>    
                            </div>
                            
                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/services">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('servicesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Services')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/users">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] rounded-br-[5px] rounded-bl-[5px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('usersSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Users')?>
                                    </button>
                                </a>    
                            </div> 
                        </div>
                    </div>
                </section>

                <section>
                    <div>
                        <div id="sidebarContainer" class="hidden sm:hidden">
                            <?php echo Text::render('', '', 'text-onBackgroundTwo ml-[8px] dark:text-darkOnBackgroundTwo CaptionMediumOne leading-none mt-[24px] text-left transition-all duration-300 ease-in-out', 'Utilities'); ?>
                        </div>
                        <?php echo Text::render('', '', 'text-onBackgroundTwo sm:h-[0px] hidden sm:flex sm:group-hover:h-[12px] dark:text-darkOnBackgroundTwo CaptionMediumOne sm:opacity-0 sm:group-hover:opacity-100 leading-none sm:w-[0px] sm:group-hover:w-[241px] sm:mt-[0px] sm:group-hover:mt-[24px] sm:pl-[8px] text-left transition-all duration-300 ease-in-out', 'Utilities'); ?>
                        <div class="flex flex-col mt-[12px] border-border dark:border-darkBorder border-[1px] sm:border-none rounded-[6px] sm:rounded-none bg-background dark:bg-darkBackground sm:bg-surface sm:bg-darkSurface">
                        <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/calendar">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('calendarSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Calendar')?>
                                    </button>
                                </a>    
                            </div>

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/messages">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('messagesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Messages')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/notifications">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('notificationSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Notifications')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/tasks">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('taskSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'whitespace-nowrap text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Tasks & Routines')?>
                                    </button>
                                </a>    
                            </div> 

                            <div id="sidebarButton" class="sm:w-[32px] sm:group-hover:w-[241px] transition-all duration-300 ease-in-out">
                                <a href="/feedbacks">
                                    <button id="sidebarButton" class="w-full p-[8px] pl-[14px] sm:pl-[8px] h-[40px] sm:h-[32px] rounded-br-[5px] rounded-bl-[5px] sm:rounded-[6px] bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface flex items-center">
                                        <?php IconChoice::render('feedbacksSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                        Text::render('sidebarText', '', 'whitespace-nowrap text-onBackground w-[0px] sm:w-[0px] pl-[8px] sm:pl-[0px] sm:group-hover:w-[152px] text-semibold text-left text-[14px] pl-[8px] sm:group-hover:pl-[8px] text-onSurface dark:text-darkOnSurface leading-none sm:opacity-0 transition-all duration-300 ease-in-out opacity-0 sm:group-hover:opacity-100', 'Feedbacks & Reports')?>
                                    </button>
                                </a>    
                            </div> 
                        </div>
                    </div>

                    <button id="sidebarButton" class="w-[0px] p-[0px] h-[48px] mt-[48px] sm:mt-[24px] hidden sm:flex bg-background dark:bg-darkBackground border-border dark:border-darkBorder sm:border-none border-[1px] sm:border-[0px] sm:h-[32px] sm:w-[32px] sm:group-hover:w-[241px] sm:group-hover:h-[48px] rounded-[6px] sm:bg-surface sm:dark:bg-darkSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface sm:p-[0px] transition-all duration-300 ease-in-out sm:group-hover:opacity-100 z-3">
                        <div id="sidebarContainer" class="flex w-[48px] sm:w-[48px] sm:group-hover:w-[225px] sm:h-[32px] sm:group-hover:h-[48px] sm:group-hover:p-[8px] transition-all duration-300 ease-in-out sm:group-hover:opacity-100">
                            <div class="bg-primary dark:bg-darkPrimary w-[32px] h-[32px] rounded-[6px] flex justify-center items-center">
                                <?php  Photo::render() ?>
                            </div>
                            <div id="sidebarText" class="h-full flex w-[0px] flex-col justify-center sm:w-[0px] sm:overflow-hidden pl-[8px] gap-[4px] sm:opacity-0 transition-all duration-300 ease-in-out sm:group-hover:w-[152px] sm:group-hover:opacity-100">
                                <?php 
                                Text::render('','', 'text-onBackground text-semibold text-left text-[14px] truncate text-onBackground dark:text-darkOnBackground leading-none', $userFullNameOnSideBar);
                                Text::render('','', 'MiniOne text-onBackground text-left dark:text-darkOnBackground leading-none', $userRoleOnSideBar);
                                ?>
                            </div>
                        </div>
                    </button>
                </section>
        </aside>
        <button id="sidebarToggle" class="absolute transition-all duration-200 left-[40px] top-[48px] p-[4px] flex rounded-[6px] bg-background sm:hidden dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
            <div class="w-[24px] h-[24px] flex justify-center items-center">
            <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
            </div>
            <?php
            IconChoice::render('sideBarMedium', '24px', '24px', '', 'onSurface', 'darkOnSurface');?>
        </button>
            <script> // THIS IS IMPORTANT! 
                window.addEventListener('load', () => {
                    setTimeout(() => {
                    document.getElementById('sidebarButton').classList.add('transition-all');
                    }, 2000); // 2000ms = 2 seconds
                });
                document.getElementById("sidebarToggle").addEventListener("click", function () {
                    document.querySelectorAll("#sidebar").forEach(sidebar => {
                        if (sidebar.classList.contains("w-[0px]")) {
                            sidebar.classList.remove("w-[0px]", "p-[0px]");
                            sidebar.classList.add("w-full", "p-[48px]");
                        }
                    });

                    document.querySelectorAll("#sidebarButton").forEach(sidebarButton => {
                        if (sidebarButton.classList.contains("w-[0px]", "hidden", "p-[0px]")) {
                            sidebarButton.classList.remove("w-[0px]", "hidden", "p-[0px]");
                            sidebarButton.classList.add("w-full", "flex", "p-[8px]");
                        }
                    });

                    document.querySelectorAll("#sidebarText").forEach(sidebarText => {
                        if (sidebarText.classList.contains("w-[0px]")) {
                            sidebarText.classList.remove("w-[0px]",'opacity-0');
                            sidebarText.classList.add("w-full", 'opacity-100');
                        }
                    });

                    document.querySelectorAll("#sidebarContainer").forEach(sidebarContainer => {
                        if (sidebarContainer.classList.contains("w-[48px]")) {
                            sidebarContainer.classList.remove("w-[48px]");
                            sidebarContainer.classList.add("w-full");
                        }

                        if (sidebarContainer.classList.contains("hidden")) {
                            sidebarContainer.classList.remove("hidden");
                        }
                    });
                });
            </script>
        <?php
    }
}