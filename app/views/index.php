<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traditions Wellness Spa</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        // Light theme colors
                        primary:            '#0F172A',
                        primaryHover:       '#1E2D53',
                        onPrimary:          '#FFFFFF',
                        secondary:          '#F1F5F9',
                        secondaryVariant:   '#94A3AB',
                        onSecondary:        '#081021',
                        surface:            '#FAFAFA',
                        highlightSurface:   '#F4F4F5',
                        onSurface:          '#3F3F46',
                        background:         '#FFFFFF',
                        onBackground:       '#09090B',
                        onBackgroundTwo:    '#71717A',
                        onBackgroundLink:   '#5490F2',
                        border:             '#E4E4E7',
                        borderTwo:          '#CBD5E1',
                        borderHighlight:    '#669FFC',
                        success:            '#15803D',
                        destructive:        '#D92626',
                        
                        // Dark theme colors
                        darkPrimary:            '#3B4A6E',
                        darkPrimaryHover:       '#4E6292',
                        darkOnPrimary:          '#FFFFFF',
                        darkSecondary:          '#18181B',
                        darkSecondaryVariant:   '#204586',
                        darkOnSecondary:        '#F4F4F4',
                        darkSurface:            '#01050E',
                        darkHighlightSurface:   '#E0E0E0',
                        darkOnSurface:          '#F4F4F5',
                        darkBackground:         '#050505',
                        darkOnBackground:       '#FAFAFA',
                        darkOnBackgroundTwo:    '#B2B2B2',
                        darkOnBackgroundLink:   '#5490F2',
                        darkBorder:             '#262629',
                        darkBorderTwo:          '#1E293B',
                        darkBorderHighlight:    '#D4D4D8',
                        darkSuccess:            '#15803D',
                        darkDestructive:        '#D92626',
                        },
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                    letterSpacing: {
                        'custom': '-0.3px',
                    }
                }
            },
            plugins: [
                function ({ addComponents }) {
                    addComponents({
                        '.HeaderOne': {
                            fontSize: '28px', fontWeight: '600', lineHeight: '150%'
                        },
                        '.HeaderTwo': {
                            fontSize: '22px', fontWeight: '600', lineHeight: '150%'
                        },
                        '.SubHeaderOne': {
                            fontSize: '22px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.SubHeaderTwo': {
                            fontSize: '17px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.BodyMediumOne': {
                            fontSize: '16px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.BodyMediumTwo': {
                            fontSize: '14px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.BodyOne': {
                            fontSize: '16px', fontWeight: '400', lineHeight: '150%'
                        },
                        '.BodyTwo': {
                            fontSize: '14px', fontWeight: '400', lineHeight: '150%'
                        },
                        '.CaptionMediumOne': {
                            fontSize: '12px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.CaptionMediumTwo': {
                            fontSize: '10px', fontWeight: '500', lineHeight: '150%'
                        },
                        '.CaptionOne': {
                            fontSize: '12px', fontWeight: '400', lineHeight: '150%'
                        },
                        '.MiniOne': {
                            fontSize: '10px', fontWeight: '400', lineHeight: '150%'
                        },
                        '.MiniTwo': {
                            fontSize: '8px', fontWeight: '400', lineHeight: '150%'
                        },
                        'OneColumnContainer': {
                            width: '316px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center'
                        },
                        'FormContainer': {
                            width: '316px', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center'
                        },
                        'FieldContainer': {
                            width: '316px', display: 'flex', flexDirection: 'column', height: '66px'
                        }
                    })
                }
            ]
        };
    </script>
</head>

<!-- Content -->
<body class="bg-background font-inter flex flex-col items-center justify-between w-full h-screen m-0 p-0 tracking-custom leading-custom">
    <button onclick="toggleTheme()" class="bg-primary text-onPrimary dark:bg-darkPrimary dark:text-darkOnPrimary">
        Toggle Theme
    </button><!-- TESTING PURPOSES -->
    <?= $content; ?>
</body>

<!-- Dark Mode and Light Mode Function -->
<script>
    // Toggle between dark and light mode
    function toggleTheme() {
        document.body.classList.toggle('dark');
        document.body.classList.toggle('bg-darkBackground');
    }

    // Detect if the user prefers dark mode based on system preference
    function detectDarkMode() {
        const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        if (darkModeMediaQuery.matches) {
            // Apply dark theme
            document.body.classList.add('dark');
            document.body.classList.add('bg-darkBackground');
        } else {
            // Apply light theme (if necessary)
            document.body.classList.remove('dark');
            document.body.classList.remove('bg-darkBackground');
        }

        // Listen for changes in the system theme preference
        darkModeMediaQuery.addEventListener('change', (e) => {
            if (e.matches) {
                // Apply dark theme when the user switches to dark mode
                document.body.classList.add('dark');
                document.body.classList.add('bg-darkBackground');
            } else {
                // Apply light theme when the user switches to light mode
                document.body.classList.remove('dark');
                document.body.classList.remove('bg-darkBackground');
            }
        });
    }

    // Call the function on page load
    detectDarkMode();
</script>


</html>