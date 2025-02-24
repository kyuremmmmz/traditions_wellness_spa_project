<?php

namespace Project\App\Views\Php\Components\Icons;

class IconChoice
{
    public static function render(
        string $choice, 
        string $width = "", 
        string $height = "", 
        string $fill = "", 
        string $lightstroke = " asda", 
        string $darkstroke = "", 
        string $bgcolor = "", 
        string $darkbgcolor = "", 
        string $bgcolorhighlight = "", 
        string $darkbgcolorhighlight = "", 
        string $px = "[0px]", 
        string $py = "[0px]"
    ): void {
        switch ($choice) {
            case "logoutBig":
                // You can define an icon here if needed
                $icon = "logoutBig";
                break;
            case "exitSmall":
                $icon = '
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M13 1L1 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 1L13 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "alertBig":
                $icon = '
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M18 34C26.8366 34 34 26.8366 34 18C34 9.16344 26.8366 2 18 2C9.16344 2 2 9.16344 2 18C2 26.8366 9.16344 34 18 34Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 11.6001V18.0001" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 24.3999H18.016" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "leftArrow":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M15 8H1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 15L1 8L8 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case 'miniCircle':
                $icon =
                    '<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-">
                        <circle cx="4" cy="4" r="4" fill=""/>
                    </svg>
                ';  
                break;
            case 'eyeClose';
                $icon = '
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M8.23344 8.23334C7.98782 8.46221 7.79081 8.73821 7.65417 9.04488C7.51753 9.35154 7.44406 9.68259 7.43813 10.0183C7.43221 10.3539 7.49396 10.6874 7.6197 10.9987C7.74543 11.31 7.93258 11.5927 8.16998 11.8301C8.40737 12.0675 8.69015 12.2547 9.00145 12.3804C9.31274 12.5061 9.64617 12.5679 9.98185 12.562C10.3175 12.5561 10.6486 12.4826 10.9552 12.3459C11.2619 12.2093 11.5379 12.0123 11.7668 11.7667" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.94165 4.23335C9.29274 4.18961 9.64618 4.16735 9.99998 4.16669C15.8333 4.16669 18.3333 10 18.3333 10C17.9607 10.7976 17.4935 11.5475 16.9417 12.2334" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.50841 5.50836C3.85112 6.63721 2.52497 8.18774 1.66675 10C1.66675 10 4.16675 15.8334 10.0001 15.8334C11.5967 15.8376 13.1591 15.371 14.4917 14.4917" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.66675 1.66669L18.3334 18.3334" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case 'eyeOpen';
                $icon = '
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M1.66675 10C1.66675 10 4.16675 4.16669 10.0001 4.16669C15.8334 4.16669 18.3334 10 18.3334 10C18.3334 10 15.8334 15.8334 10.0001 15.8334C4.16675 15.8334 1.66675 10 1.66675 10Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "uploadBig":
                $icon = '
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current text-primary dark:text-darkPrimary">
                        <path d="M26 18V23.3333C26 24.0406 25.719 24.7189 25.219 25.219C24.7189 25.719 24.0406 26 23.3333 26H4.66667C3.95942 26 3.28115 25.719 2.78105 25.219C2.28095 24.7189 2 24.0406 2 23.3333V18" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.6666 8.66667L14 2L7.33331 8.66667" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2V18" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "userSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M12.6667 14V12.6667C12.6667 11.9594 12.3857 11.2811 11.8856 10.781C11.3855 10.281 10.7072 10 10 10H6C5.29276 10 4.61448 10.281 4.11438 10.781C3.61429 11.2811 3.33334 11.9594 3.33334 12.6667V14"  stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 7.33333C9.47276 7.33333 10.6667 6.13943 10.6667 4.66667C10.6667 3.19391 9.47276 2 8 2C6.52724 2 5.33334 3.19391 5.33334 4.66667C5.33334 6.13943 6.52724 7.33333 8 7.33333Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "activitiesSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M13.3333 13V13.3333C13.3333 13.687 13.1929 14.0261 12.9428 14.2762C12.6928 14.5262 12.3536 14.6667 12 14.6667H4C3.64638 14.6667 3.30724 14.5262 3.05719 14.2762C2.80714 14.0261 2.66667 13.687 2.66667 13.3333V2.66668C2.66667 2.31305 2.80714 1.97392 3.05719 1.72387C3.30724 1.47382 3.64638 1.33334 4 1.33334H9.66667L12 3.66668" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.33334 12H6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.28 6.40665C12.41 6.27664 12.5643 6.17352 12.7342 6.10316C12.9041 6.0328 13.0861 5.99658 13.27 5.99658C13.4539 5.99658 13.6359 6.0328 13.8058 6.10316C13.9756 6.17352 14.13 6.27664 14.26 6.40665C14.39 6.53666 14.4931 6.691 14.5635 6.86087C14.6339 7.03073 14.6701 7.21279 14.6701 7.39665C14.6701 7.58051 14.6339 7.76257 14.5635 7.93244C14.4931 8.1023 14.39 8.25664 14.26 8.38665L11.3 11.3333L8.66666 12L9.32666 9.36665L12.28 6.40665Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "securitySmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M12.6667 7.33334H3.33333C2.59695 7.33334 2 7.9303 2 8.66668V13.3333C2 14.0697 2.59695 14.6667 3.33333 14.6667H12.6667C13.403 14.6667 14 14.0697 14 13.3333V8.66668C14 7.9303 13.403 7.33334 12.6667 7.33334Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.66666 7.33334V4.66668C4.66666 3.78262 5.01785 2.93478 5.64297 2.30965C6.2681 1.68453 7.11594 1.33334 8 1.33334C8.88405 1.33334 9.7319 1.68453 10.357 2.30965C10.9821 2.93478 11.3333 3.78262 11.3333 4.66668V7.33334" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "reportTicketSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M2 4.66668V6.00001C2.53043 6.00001 3.03914 6.21072 3.41421 6.5858C3.78929 6.96087 4 7.46958 4 8.00001C4 8.53044 3.78929 9.03915 3.41421 9.41422C3.03914 9.7893 2.53043 10 2 10V11.3333C2 12.0667 2.6 12.6667 3.33333 12.6667H12.6667C13.0203 12.6667 13.3594 12.5262 13.6095 12.2762C13.8595 12.0261 14 11.687 14 11.3333V10C13.4696 10 12.9609 9.7893 12.5858 9.41422C12.2107 9.03915 12 8.53044 12 8.00001C12 7.46958 12.2107 6.96087 12.5858 6.5858C12.9609 6.21072 13.4696 6.00001 14 6.00001V4.66668C14 4.31305 13.8595 3.97392 13.6095 3.72387C13.3594 3.47382 13.0203 3.33334 12.6667 3.33334H3.33333C2.97971 3.33334 2.64057 3.47382 2.39052 3.72387C2.14048 3.97392 2 4.31305 2 4.66668Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.66666 3.33334V4.66668" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.66666 11.3333V12.6667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.66666 7.33334V8.66668" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "chevronRightSmall":
                $icon = '
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M7 1L1 7L7 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "aboutSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M8 14.6667C11.6819 14.6667 14.6667 11.6819 14.6667 8.00001C14.6667 4.31811 11.6819 1.33334 8 1.33334C4.3181 1.33334 1.33333 4.31811 1.33333 8.00001C1.33333 11.6819 4.3181 14.6667 8 14.6667Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 10.6667V8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 5.33334H8.00667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "sideBarMedium":
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 9H21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 21V9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "settingsMedium": 
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M12.22 2H11.78C11.2496 2 10.7409 2.21071 10.3658 2.58579C9.99072 2.96086 9.78 3.46957 9.78 4V4.18C9.77964 4.53073 9.68706 4.87519 9.51154 5.17884C9.33602 5.48248 9.08374 5.73464 8.78 5.91L8.35 6.16C8.04596 6.33554 7.70108 6.42795 7.35 6.42795C6.99893 6.42795 6.65404 6.33554 6.35 6.16L6.2 6.08C5.74107 5.81526 5.19584 5.74344 4.684 5.88031C4.17217 6.01717 3.73555 6.35154 3.47 6.81L3.25 7.19C2.98526 7.64893 2.91345 8.19416 3.05031 8.706C3.18717 9.21783 3.52154 9.65445 3.98 9.92L4.13 10.02C4.43228 10.1945 4.68362 10.4451 4.85905 10.7468C5.03448 11.0486 5.1279 11.391 5.13 11.74V12.25C5.1314 12.6024 5.03965 12.949 4.86405 13.2545C4.68844 13.5601 4.43521 13.8138 4.13 13.99L3.98 14.08C3.52154 14.3456 3.18717 14.7822 3.05031 15.294C2.91345 15.8058 2.98526 16.3511 3.25 16.81L3.47 17.19C3.73555 17.6485 4.17217 17.9828 4.684 18.1197C5.19584 18.2566 5.74107 18.1847 6.2 17.92L6.35 17.84C6.65404 17.6645 6.99893 17.5721 7.35 17.5721C7.70108 17.5721 8.04596 17.6645 8.35 17.84L8.78 18.09C9.08374 18.2654 9.33602 18.5175 9.51154 18.8212C9.68706 19.1248 9.77964 19.4693 9.78 19.82V20C9.78 20.5304 9.99072 21.0391 10.3658 21.4142C10.7409 21.7893 11.2496 22 11.78 22H12.22C12.7504 22 13.2591 21.7893 13.6342 21.4142C14.0093 21.0391 14.22 20.5304 14.22 20V19.82C14.2204 19.4693 14.3129 19.1248 14.4885 18.8212C14.664 18.5175 14.9163 18.2654 15.22 18.09L15.65 17.84C15.954 17.6645 16.2989 17.5721 16.65 17.5721C17.0011 17.5721 17.346 17.6645 17.65 17.84L17.8 17.92C18.2589 18.1847 18.8042 18.2566 19.316 18.1197C19.8278 17.9828 20.2645 17.6485 20.53 17.19L20.75 16.8C21.0147 16.3411 21.0866 15.7958 20.9497 15.284C20.8128 14.7722 20.4785 14.3356 20.02 14.07L19.87 13.99C19.5648 13.8138 19.3116 13.5601 19.136 13.2545C18.9604 12.949 18.8686 12.6024 18.87 12.25V11.75C18.8686 11.3976 18.9604 11.051 19.136 10.7455C19.3116 10.4399 19.5648 10.1862 19.87 10.01L20.02 9.92C20.4785 9.65445 20.8128 9.21783 20.9497 8.706C21.0866 8.19416 21.0147 7.64893 20.75 7.19L20.53 6.81C20.2645 6.35154 19.8278 6.01717 19.316 5.88031C18.8042 5.74344 18.2589 5.81526 17.8 6.08L17.65 6.16C17.346 6.33554 17.0011 6.42795 16.65 6.42795C16.2989 6.42795 15.954 6.33554 15.65 6.16L15.22 5.91C14.9163 5.73464 14.664 5.48248 14.4885 5.17884C14.3129 4.87519 14.2204 4.53073 14.22 4.18V4C14.22 3.46957 14.0093 2.96086 13.6342 2.58579C13.2591 2.21071 12.7504 2 12.22 2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "dashboardSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M6.66667 2H2V8H6.66667V2Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2H9.33331V5.33333H14V2Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 8H9.33331V14H14V8Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66667 10.6667H2V14H6.66667V10.6667Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "appointmentsSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M7.99998 14.6667C11.6819 14.6667 14.6666 11.6819 14.6666 8.00001C14.6666 4.31811 11.6819 1.33334 7.99998 1.33334C4.31808 1.33334 1.33331 4.31811 1.33331 8.00001C1.33331 11.6819 4.31808 14.6667 7.99998 14.6667Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 4V8L10.6667 9.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            
            case "employeesSmall": 
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M10.6666 14V12.6667C10.6666 11.9594 10.3857 11.2811 9.8856 10.781C9.3855 10.281 8.70722 10 7.99998 10H3.99998C3.29274 10 2.61446 10.281 2.11436 10.781C1.61426 11.2811 1.33331 11.9594 1.33331 12.6667V14" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.99998 7.33333C7.47274 7.33333 8.66665 6.13943 8.66665 4.66667C8.66665 3.19391 7.47274 2 5.99998 2C4.52722 2 3.33331 3.19391 3.33331 4.66667C3.33331 6.13943 4.52722 7.33333 5.99998 7.33333Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.6666 8.66667C13.403 8.66667 14 8.06971 14 7.33333C14 6.59695 13.403 6 12.6666 6C11.9303 6 11.3333 6.59695 11.3333 7.33333C11.3333 8.06971 11.9303 8.66667 12.6666 8.66667Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.6667 5.33334V6.00001" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.6667 8.66666V9.33332" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.4 6.33334L13.82 6.66668" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.5133 8L10.9333 8.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.4 8.33333L13.82 8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.5133 6.66668L10.9333 6.33334" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            
            case "financesSmall": 
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M8 1.33334V14.6667" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.3333 3.33334H6.33333C5.71449 3.33334 5.121 3.57918 4.68342 4.01676C4.24583 4.45435 4 5.04784 4 5.66668C4 6.28552 4.24583 6.87901 4.68342 7.31659C5.121 7.75418 5.71449 8.00001 6.33333 8.00001H9.66667C10.2855 8.00001 10.879 8.24584 11.3166 8.68343C11.7542 9.12101 12 9.7145 12 10.3333C12 10.9522 11.7542 11.5457 11.3166 11.9833C10.879 12.4208 10.2855 12.6667 9.66667 12.6667H4" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "inventorySmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M1.97998 8.61333C1.78315 8.73159 1.6202 8.89867 1.5069 9.09839C1.39361 9.29812 1.33382 9.52371 1.33331 9.75333V11.9133C1.33382 12.143 1.39361 12.3685 1.5069 12.5683C1.6202 12.768 1.78315 12.9351 1.97998 13.0533L3.97998 14.2533C4.18735 14.3779 4.42472 14.4437 4.66665 14.4437C4.90857 14.4437 5.14594 14.3779 5.35331 14.2533L7.36841 13.0453C7.76021 12.8104 7.99998 12.3871 7.99998 11.9303V9.73605C7.99998 9.27941 7.76039 8.85625 7.36882 8.62131L5.33577 7.40147C4.92393 7.15437 4.40941 7.15447 3.99767 7.40172L1.97998 8.61333Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.66665 11L1.50665 9.10001" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.66669 11L8.00002 9" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.66669 11V14.4467" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.63116 8.62131C8.23959 8.85625 8 9.27941 8 9.73605V11.9303C8 12.3871 8.23977 12.8104 8.63157 13.0453L10.6467 14.2533C10.854 14.3779 11.0914 14.4437 11.3333 14.4437C11.5753 14.4437 11.8126 14.3779 12.02 14.2533L14.02 13.0533C14.2168 12.9351 14.3798 12.768 14.4931 12.5683C14.6064 12.3685 14.6662 12.143 14.6667 11.9133V9.75333C14.6662 9.52371 14.6064 9.29812 14.4931 9.09839C14.3798 8.89867 14.2168 8.73159 14.02 8.61333L12.0023 7.40172C11.5906 7.15447 11.076 7.15437 10.6642 7.40147L8.63116 8.62131Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.3333 11L8 9" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.3333 11L14.4933 9.10001" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.3333 11V14.4467" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.31335 2.94666C5.11653 3.06491 4.95357 3.23199 4.84028 3.43172C4.72698 3.63144 4.66719 3.85704 4.66669 4.08666V6.26394C4.66669 6.72058 4.90628 7.14374 5.29784 7.37868L7.33118 8.59868C7.74286 8.8457 8.25718 8.8457 8.66886 8.59868L10.7022 7.37868C11.0938 7.14374 11.3334 6.72058 11.3334 6.26394V4.08666C11.3329 3.85704 11.2731 3.63144 11.1598 3.43172C11.0465 3.23199 10.8835 3.06491 10.6867 2.94666L8.68669 1.74666C8.47931 1.62207 8.24194 1.55624 8.00002 1.55624C7.7581 1.55624 7.52073 1.62207 7.31335 1.74666L5.31335 2.94666Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8.00003 5.33332L4.84003 3.43332" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 5.33332L11.16 3.43332" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 9.00001V5.33334" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case  "branchesSmall": 
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M4 14.6667V2.66668C4 2.48668 4 2.30001 4.04667 2.12001C4.08747 1.94043 4.17782 1.77589 4.30745 1.64508C4.43708 1.51427 4.60079 1.42244 4.78 1.38001C4.97333 1.33334 5.82 1.33334 6 1.33334H10.6667C10.8467 1.33334 11.0333 1.33334 11.2133 1.38001C11.3929 1.42082 11.5575 1.51116 11.6883 1.64079C11.8191 1.77042 11.9109 1.93414 11.9533 2.11334C12 2.30001 12 2.48668 12 2.66668V14.6667H4Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.33339 9.33333V13.3333C1.33339 14.0667 1.93339 14.6667 2.66672 14.6667H4.00006V8H2.66672C2.48672 8 2.30006 8 2.12006 8.04667C1.94006 8.09333 1.77339 8.18 1.64006 8.31333C1.51339 8.44 1.42672 8.60667 1.38006 8.78667C1.34242 8.96633 1.32675 9.14989 1.33339 9.33333Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.88 6.04665C13.7003 6.00902 13.5168 5.99335 13.3333 5.99999H12V14.6667H13.3333C13.687 14.6667 14.0261 14.5262 14.2761 14.2761C14.5262 14.0261 14.6667 13.6869 14.6667 13.3333V7.33332C14.6667 7.14665 14.6667 6.96665 14.62 6.78665C14.5733 6.60665 14.4867 6.43999 14.3533 6.30665C14.2267 6.17999 14.06 6.09332 13.88 6.04665Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66663 4H9.33329" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66663 6.66666H9.33329" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66663 9.33334H9.33329" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66663 12H9.33329" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;

            case "servicesSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M7.33334 13.3333C6.16271 13.3369 5.03351 12.9003 4.16968 12.1103C3.30586 11.3202 2.77052 10.2343 2.66983 9.06805C2.56914 7.90176 2.91047 6.74022 3.62611 5.81381C4.34175 4.88739 5.37943 4.26378 6.53334 4.06665C10.3333 3.33331 11.3333 2.98665 12.6667 1.33331C13.3333 2.66665 14 4.11998 14 6.66665C14 10.3333 10.8133 13.3333 7.33334 13.3333Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.33331 14C1.33331 12 2.56665 10.4267 4.71998 10C6.33331 9.68 7.99998 8.66667 8.66665 8" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                ';
                break;
            case "usersSmall": 
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M10.6666 14V12.6667C10.6666 11.9594 10.3857 11.2811 9.8856 10.781C9.3855 10.281 8.70722 10 7.99998 10H3.99998C3.29274 10 2.61446 10.281 2.11436 10.781C1.61426 11.2811 1.33331 11.9594 1.33331 12.6667V14" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.99998 7.33333C7.47274 7.33333 8.66665 6.13943 8.66665 4.66667C8.66665 3.19391 7.47274 2 5.99998 2C4.52722 2 3.33331 3.19391 3.33331 4.66667C3.33331 6.13943 4.52722 7.33333 5.99998 7.33333Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.6667 14V12.6667C14.6662 12.0758 14.4696 11.5019 14.1076 11.0349C13.7456 10.5679 13.2388 10.2344 12.6667 10.0867" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.6667 2.08667C11.2403 2.23354 11.7487 2.56714 12.1118 3.03488C12.4748 3.50262 12.6719 4.07789 12.6719 4.67C12.6719 5.26212 12.4748 5.83739 12.1118 6.30513C11.7487 6.77287 11.2403 7.10647 10.6667 7.25334" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            
            case "calendarSmall": 
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M12.6667 2.66669H3.33333C2.59695 2.66669 2 3.26364 2 4.00002V13.3334C2 14.0697 2.59695 14.6667 3.33333 14.6667H12.6667C13.403 14.6667 14 14.0697 14 13.3334V4.00002C14 3.26364 13.403 2.66669 12.6667 2.66669Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.6667 1.33331V3.99998" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.33331 1.33331V3.99998" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 6.66669H14" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.33331 9.33331H5.33998"  stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 9.33331H8.00667" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.6667 9.33331H10.6734" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.33331 12H5.33998"stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H8.00667"stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.6667 12H10.6734" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            
            case "messagesSmall":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M14 7.66669C14.0023 8.5466 13.7967 9.41461 13.4 10.2C12.9296 11.1412 12.2065 11.9328 11.3116 12.4862C10.4168 13.0396 9.3855 13.3329 8.33333 13.3334C7.45342 13.3356 6.58541 13.1301 5.8 12.7334L2 14L3.26667 10.2C2.86995 9.41461 2.66437 8.5466 2.66667 7.66669C2.66707 6.61452 2.96041 5.58325 3.51381 4.68839C4.06722 3.79352 4.85884 3.0704 5.8 2.60002C6.58541 2.20331 7.45342 1.99772 8.33333 2.00002H8.66667C10.0562 2.07668 11.3687 2.66319 12.3528 3.64726C13.3368 4.63132 13.9233 5.94379 14 7.33335V7.66669Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                ';
                break;
            
            case "notificationSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M12 5.6665C12 4.60564 11.5786 3.58822 10.8284 2.83808C10.0783 2.08793 9.06087 1.6665 8 1.6665C6.93913 1.6665 5.92172 2.08793 5.17157 2.83808C4.42143 3.58822 4 4.60564 4 5.6665C4 10.3332 2 11.6665 2 11.6665H14C14 11.6665 12 10.3332 12 5.6665Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.15335 14.333C9.03614 14.5351 8.86791 14.7028 8.6655 14.8194C8.46309 14.9359 8.2336 14.9973 8.00001 14.9973C7.76643 14.9973 7.53694 14.9359 7.33453 14.8194C7.13212 14.7028 6.96389 14.5351 6.84668 14.333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            
            case "taskSmall": 
                $icon = ' 
                        <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M8.33366 1.6665H4.33366C3.96547 1.6665 3.66699 1.96498 3.66699 2.33317V3.6665C3.66699 4.03469 3.96547 4.33317 4.33366 4.33317H8.33366C8.70185 4.33317 9.00033 4.03469 9.00033 3.6665V2.33317C9.00033 1.96498 8.70185 1.6665 8.33366 1.6665Z" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 2.99982H10.3333C10.687 2.99982 11.0261 3.14029 11.2761 3.39034C11.5262 3.64039 11.6667 3.97953 11.6667 4.33315V13.6665C11.6667 14.0201 11.5262 14.3592 11.2761 14.6093C11.0261 14.8593 10.687 14.9998 10.3333 14.9998H2.33333C1.97971 14.9998 1.64057 14.8593 1.39052 14.6093C1.14048 14.3592 1 14.0201 1 13.6665V4.33315C1 3.97953 1.14048 3.64039 1.39052 3.39034C1.64057 3.14029 1.97971 2.99982 2.33333 2.99982H3.66667" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.33337 7.6665H9.00004" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.33337 10.9998H9.00004" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.66699 7.6665H3.67366" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.66699 11H3.67366" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            
            case "feedbacksSmall": 
                $icon = ' 
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M7.66667 14.6668C11.3486 14.6668 14.3333 11.6821 14.3333 8.00016C14.3333 4.31826 11.3486 1.3335 7.66667 1.3335C3.98477 1.3335 1 4.31826 1 8.00016C1 11.6821 3.98477 14.6668 7.66667 14.6668Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.6665 5.3335V8.00016" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.6665 10.6665H7.67317" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "servicesMedium":
                $icon = '
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M11 20C9.24406 20.0053 7.55025 19.3505 6.25452 18.1654C4.95878 16.9803 4.15577 15.3515 4.00474 13.6021C3.8537 11.8527 4.36569 10.1104 5.43915 8.72074C6.51261 7.33112 8.06913 6.3957 9.8 6.1C15.5 5 17 4.48 19 2C20 4 21 6.18 21 10C21 15.5 16.22 20 11 20Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 21C2 18 3.85 15.64 7.08 15C9.5 14.52 12 13 13 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "plusSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M8 3.33334V12.6667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.33334 8H12.6667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break; 
            case "defaultSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M3.33333 2C2.97971 2 2.64057 2.14048 2.39052 2.39052C2.14048 2.64057 2 2.97971 2 3.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.6667 2C13.0203 2 13.3594 2.14048 13.6095 2.39052C13.8595 2.64057 14 2.97971 14 3.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 12.6666C14 13.0202 13.8595 13.3594 13.6095 13.6094C13.3594 13.8595 13.0203 14 12.6667 14" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.33333 14C2.97971 14 2.64057 13.8595 2.39052 13.6094C2.14048 13.3594 2 13.0202 2 12.6666" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 2H6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 14H6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.33331 2H9.99998" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.33331 14H9.99998" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 6V6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 6V6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M2 9.33337V10" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 9.33337V10" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break; 
            case "plusBoxVerySmall":
                $icon = '
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M9.5 1.5H2.5C1.94772 1.5 1.5 1.94772 1.5 2.5V9.5C1.5 10.0523 1.94772 10.5 2.5 10.5H9.5C10.0523 10.5 10.5 10.0523 10.5 9.5V2.5C10.5 1.94772 10.0523 1.5 9.5 1.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 4V8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 6H8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "addServiceSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M7.3334 13.3333C6.16277 13.3369 5.03357 12.9003 4.16975 12.1103C3.30592 11.3202 2.77058 10.2343 2.66989 9.06805C2.5692 7.90176 2.91053 6.74022 3.62617 5.81381C4.34181 4.88739 5.37949 4.26378 6.5334 4.06665C10.3334 3.33331 11.3334 2.98665 12.6667 1.33331C13.3334 2.66665 14.0001 4.11998 14.0001 6.66665C14.0001 7.91902 13.9616 8.32946 13.3334 9.33331" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1.33325 14C1.33325 12 2.56659 10.4267 4.71992 10C6.33325 9.68 7.99992 8.66667 8.66659 8" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.33325 12H13.3333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.3333 10V14" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "logoutSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M6 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V3.33333C2 2.97971 2.14048 2.64057 2.39052 2.39052C2.64057 2.14048 2.97971 2 3.33333 2H6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.6667 11.3334L14.0001 8.00002L10.6667 4.66669" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 8H6" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "passwordSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M14.0001 1.33334L12.6667 2.66668M12.6667 2.66668L14.6667 4.66668L12.3334 7.00001L10.3334 5.00001M12.6667 2.66668L10.3334 5.00001M7.59339 7.74001C7.93762 8.07965 8.21126 8.48404 8.39856 8.92987C8.58587 9.37571 8.68313 9.85419 8.68475 10.3378C8.68637 10.8213 8.59231 11.3005 8.408 11.7475C8.22369 12.1946 7.95277 12.6008 7.61082 12.9428C7.26888 13.2847 6.86268 13.5556 6.4156 13.74C5.96852 13.9243 5.48939 14.0183 5.00582 14.0167C4.52224 14.0151 4.04376 13.9178 3.59792 13.7305C3.15209 13.5432 2.74771 13.2696 2.40806 12.9253C1.74015 12.2338 1.37057 11.3076 1.37892 10.3462C1.38728 9.38482 1.7729 8.46517 2.45273 7.78534C3.13256 7.10551 4.0522 6.71989 5.01359 6.71154C5.97498 6.70318 6.90119 7.07276 7.59273 7.74068L7.59339 7.74001ZM7.59339 7.74001L10.3334 5.00001" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "emailSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M13.3334 2.66666H2.66671C1.93033 2.66666 1.33337 3.26361 1.33337 3.99999V12C1.33337 12.7364 1.93033 13.3333 2.66671 13.3333H13.3334C14.0698 13.3333 14.6667 12.7364 14.6667 12V3.99999C14.6667 3.26361 14.0698 2.66666 13.3334 2.66666Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.6667 4.66666L8.68671 8.46666C8.48089 8.59561 8.24292 8.664 8.00004 8.664C7.75716 8.664 7.51919 8.59561 7.31337 8.46666L1.33337 4.66666" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
            case "phoneSmall":
                $icon = '
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                            <path d="M14.6667 11.28V13.28C14.6675 13.4657 14.6294 13.6495 14.555 13.8196C14.4807 13.9897 14.3716 14.1424 14.2348 14.2679C14.0979 14.3934 13.9364 14.489 13.7605 14.5485C13.5847 14.608 13.3983 14.6301 13.2134 14.6133C11.1619 14.3904 9.19137 13.6894 7.46004 12.5667C5.84926 11.5431 4.48359 10.1775 3.46004 8.56668C2.33336 6.82748 1.6322 4.84734 1.41337 2.78668C1.39671 2.60233 1.41862 2.41652 1.4777 2.2411C1.53679 2.06567 1.63175 1.90447 1.75655 1.76776C1.88134 1.63105 2.03324 1.52182 2.20256 1.44703C2.37189 1.37224 2.55493 1.33352 2.74004 1.33335H4.74004C5.06357 1.33016 5.37723 1.44473 5.62254 1.6557C5.86786 1.86667 6.02809 2.15964 6.07337 2.48001C6.15779 3.12006 6.31434 3.7485 6.54004 4.35335C6.62973 4.59196 6.64915 4.85129 6.59597 5.1006C6.5428 5.34991 6.41928 5.57875 6.24004 5.76001L5.39337 6.60668C6.34241 8.27571 7.72434 9.65764 9.39337 10.6067L10.24 9.76001C10.4213 9.58077 10.6501 9.45725 10.8994 9.40408C11.1488 9.35091 11.4081 9.37032 11.6467 9.46001C12.2516 9.68571 12.88 9.84227 13.52 9.92668C13.8439 9.97237 14.1396 10.1355 14.3511 10.385C14.5625 10.6345 14.6748 10.9531 14.6667 11.28Z" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                ';
                break;
        };

        // Modify the SVG content with dynamic classes
        echo preg_replace_callback('/class="([^"]+)"/', function($matches) use ($width, $height, $fill, $lightstroke, $darkstroke, $bgcolor, $darkbgcolor, $bgcolorhighlight, $darkbgcolorhighlight, $px, $py) {
            $classes = $matches[1];

            // Add the dynamic classes here
            $classes .= " w-{$width} h-{$height} fill-{$fill} text-{$lightstroke} dark:text-{$darkstroke} bg-{$bgcolor} dark:bg-{$darkbgcolor} hover:bg-{$bgcolorhighlight} dark:hover:bg-{$darkbgcolorhighlight} px-{$px} py-{$py}";
            
            return 'class="' . $classes . '"';
        }, $icon);
    }
}
