
// Toggle between dark and light mode
        const html = document.querySelector('html');
        const body = document.body;

        function toggleTheme() {
            // Toggle dark mode for both html and body
            html.classList.toggle('dark');
        body.classList.toggle('dark');
        body.classList.toggle('bg-darkBackground');
        body.classList.toggle('bg-background');
    }

        // Detect if the user prefers dark mode based on system preference
        function detectDarkMode() {
        const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

        if (darkModeMediaQuery.matches) {
            // Apply dark theme to both html and body
            html.classList.add('dark');
        body.classList.add('dark');
        body.classList.add('bg-darkBackground');
        body.classList.remove('bg-background');
        } else {
            // Apply light theme to both html and body
            html.classList.remove('dark');
        body.classList.remove('dark');
        body.classList.remove('bg-darkBackground');
        body.classList.add('bg-background');
        }

        // Listen for changes in the system theme preference
        darkModeMediaQuery.addEventListener('change', (e) => {
            if (e.matches) {
            // Apply dark theme when the user switches to dark mode
            html.classList.add('dark');
        body.classList.add('dark');
        body.classList.add('bg-darkBackground');
        body.classList.remove('bg-background');
            } else {
            // Apply light theme when the user switches to light mode
            html.classList.remove('dark');
        body.classList.remove('dark');
        body.classList.remove('bg-darkBackground');
        body.classList.add('bg-background');
            }
        });
    }

        // Call the function on page load
        detectDarkMode();