document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById('password_field');
    const eightChar = document.getElementById('eightCharacters');
    const specialCharacter = document.getElementById('specialCharacters');
    const upperCaseCharacters = document.getElementById('upperCaseCharacters');
    const lowerCaseCharacters = document.getElementById('lowerCharacters');
    const numberCharacters = document.getElementById('numberCharacters');
    const button = document.getElementById('buttonDisabled');

    passwordInput.addEventListener('input', function () {
        const password = passwordInput.value;

        let isValid = true;

        if (password.length >= 8) {
            eightChar.classList.add('text-white');
            eightChar.classList.remove('onBackgroundTwo');
        } else {
            eightChar.classList.add("onBackgroundTwo");
            eightChar.classList.remove("text-white");
            isValid = false;
        }

        if (/[A-Z]/.test(password)) {
            upperCaseCharacters.classList.add('text-white');
            upperCaseCharacters.classList.remove('onBackgroundTwo');
        } else {
            upperCaseCharacters.classList.add("onBackgroundTwo");
            upperCaseCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[a-z]/.test(password)) {
            lowerCaseCharacters.classList.add('text-white');
            lowerCaseCharacters.classList.remove('onBackgroundTwo');
        } else {
            lowerCaseCharacters.classList.add("onBackgroundTwo");
            lowerCaseCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[0-9]/.test(password)) {
            numberCharacters.classList.add('text-white');
            numberCharacters.classList.remove('onBackgroundTwo');
        } else {
            numberCharacters.classList.add("onBackgroundTwo");
            numberCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialCharacter.classList.add('text-white');
            specialCharacter.classList.remove('onBackgroundTwo');
        } else {
            specialCharacter.classList.add("onBackgroundTwo");
            specialCharacter.classList.remove("text-white");
            isValid = false;
        }

        button.disabled = !isValid;
    });
});
