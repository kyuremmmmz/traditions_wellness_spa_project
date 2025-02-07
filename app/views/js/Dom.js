document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById('password_field');
    const eightChar = document.getElementById('eightCharacters');
    const specialCharacter = document.getElementById('specialCharacters');
    const upperCaseCharacters = document.getElementById('upperCaseCharacters');
    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;
        if (password.length >= 8) {
            eightChar.classList.add('text-green-500');
            eightChar.classList.remove('onBackgroundTwo');
        } else {
            eightChar.classList.add("onBackgroundTwo");
            eightChar.classList.remove("text-green-500");
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialCharacter.classList.add('text-green-500', 'duration-300');
            specialCharacter.classList.remove('onBackgroundTwo');
        } else {
            specialCharacter.classList.add("onBackgroundTwo");
            specialCharacter.classList.remove("text-green-500");
        }

        if (/[A-Z]/.test(password)) {
            upperCaseCharacters.classList.add('text-green-500');
            upperCaseCharacters.classList.remove('onBackgroundTwo');
        } else {
            upperCaseCharacters.classList.add("onBackgroundTwo");
            upperCaseCharacters.classList.remove("text-green-500");
        }
    })
});
