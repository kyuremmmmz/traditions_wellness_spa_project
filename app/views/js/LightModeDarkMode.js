document.addEventListener("DOMContentLoaded", function () {
    const html = document.querySelector("html");
    const body = document.body;

    function toggleTheme() {
        // Toggle dark mode for both html and body
        html.classList.toggle("dark");
        body.classList.toggle("dark");
        body.classList.toggle("bg-darkBackground");
        body.classList.toggle("bg-background");
    }

    function detectDarkMode() {
        const darkModeMediaQuery = window.matchMedia("(prefers-color-scheme: dark)");

        if (darkModeMediaQuery.matches) {
            html.classList.add("dark");
            body.classList.add("dark");
            body.classList.add("bg-darkBackground");
            body.classList.remove("bg-background");
        } else {
            html.classList.remove("dark");
            body.classList.remove("dark");
            body.classList.remove("bg-darkBackground");
            body.classList.add("bg-background");
        }

        // Listen for changes in system theme preference
        darkModeMediaQuery.addEventListener("change", (e) => {
            if (e.matches) {
                html.classList.add("dark");
                body.classList.add("dark");
                body.classList.add("bg-darkBackground");
                body.classList.remove("bg-background");
            } else {
                html.classList.remove("dark");
                body.classList.remove("dark");
                body.classList.remove("bg-darkBackground");
                body.classList.add("bg-background");
            }
        });
    }

    // Call the function on page load
    detectDarkMode();
});