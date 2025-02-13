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
            eightChar.classList.remove('text-darkOnBackgroundTwo');
        } else {
            eightChar.classList.add("text-darkOnBackgroundTwo");
            eightChar.classList.remove("text-white");
            isValid = false;
        }

        if (/[A-Z]/.test(password)) {
            upperCaseCharacters.classList.add('text-white');
            upperCaseCharacters.classList.remove('text-darkOnBackgroundTwo');
        } else {
            upperCaseCharacters.classList.add("text-darkOnBackgroundTwo");
            upperCaseCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[a-z]/.test(password)) {
            lowerCaseCharacters.classList.add('text-white');
            lowerCaseCharacters.classList.remove('text-darkOnBackgroundTwo');
        } else {
            lowerCaseCharacters.classList.add("text-darkOnBackgroundTwo");
            lowerCaseCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[0-9]/.test(password)) {
            numberCharacters.classList.add('text-white');
            numberCharacters.classList.remove('text-darkOnBackgroundTwo');
        } else {
            numberCharacters.classList.add("text-darkOnBackgroundTwo");
            numberCharacters.classList.remove("text-white");
            isValid = false;
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialCharacter.classList.add('text-white');
            specialCharacter.classList.remove('text-darkOnBackgroundTwo');
        } else {
            specialCharacter.classList.add("text-darkOnBackgroundTwo");
            specialCharacter.classList.remove("text-white");
            isValid = false;
        }

        button.disabled = !isValid;
    });
});
