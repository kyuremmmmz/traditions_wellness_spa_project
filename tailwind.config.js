/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.php", "./**/*.html"],
    darkMode: ['class', '[data-theme="dark"]'],
    theme: {
        extend: {
            colors: {
                // Light theme colors
                primary: {
                    DEFAULT: '#0F172A',
                    hover: '#1E2D53',
                },
                on: {
                    primary: '#FFFFFF',
                    surface: '#3F3F46',
                    background: '#09090B',
                    'background-2': '#71717A',
                    link: '#5490F2',
                    secondary: '#334155'
                },
                background: '#FFFFFF',
                surface: {
                    DEFAULT: '#FAFAFA',
                    highlight: '#F4F4F5'
                },
                secondary: {
                    DEFAULT: '#F1F5F9',
                    variant: '#94A3AB'
                },
                border: {
                    DEFAULT: '#E4E4E7',
                    2: '#CBD5E1',
                    highlight: '#669FFC'
                },
                success: '#15803D',
                destructive: '#D92626',

                // Dark theme colors
                dark: {
                    primary: {
                        DEFAULT: '#3B4A6E',
                        hover: '#4E6292',
                    },
                    on: {
                        primary: '#FFFFFF',
                        surface: '#E0E0E0',
                        background: '#FAFAFA',
                        'background-2': '#B2B2B2',
                        link: '#5490F2',
                        secondary: '#081021'
                    },
                    background: '#000000',
                    surface: {
                        DEFAULT: '#020817',
                        highlight: '#F4F4F5'
                    },
                    secondary: {
                        DEFAULT: '#18181B',
                        variant: '#204586'
                    },
                    border: {
                        DEFAULT: '#E4E4E7',
                        2: '#1E293B',
                        highlight: '#D4D4D8'
                    },
                    success: '#15803D',
                    destructive: '#D92626'
                }
            }
        },
    },
    plugins: [require('daisyui')],
}