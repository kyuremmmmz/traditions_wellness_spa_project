document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById('password_field');
    const userInput = document.getElementById('username_field_login');
    const eightChar = document.getElementById('eightCharacters');
    const specialCharacter = document.getElementById('specialCharacter');
    const upperCaseCharacters = document.getElementById('upperCaseCharacters');
    const lowerCaseCharacters = document.getElementById('lowerCharacters');
    const numberCharacters = document.getElementById('numberCharacters');
    const button = document.getElementById('buttonDisabled');
    const usernameEightCharacter = document.getElementById('usernameEightCharacter');
    const userOnlyLettersAndNumbers = document.getElementById('userOnlyLettersAndNumbers');
    
    userInput.addEventListener('input', function() {
        const username = userInput.value;
        let isValid = true;

        if (username.length >= 8) {
            usernameEightCharacter.classList.add('text-white');
            usernameEightCharacter.classList.remove('text-darkOnBackgroundTwo');
        } else {
            usernameEightCharacter.classList.add('text-darkOnBackgroundTwo');
            usernameEightCharacter.classList.remove('text-white');
            isValid = false;
        }

        if (/^[A-Za-z0-9_]+$/.test(username)) {
            userOnlyLettersAndNumbers.classList.add('text-white');
            userOnlyLettersAndNumbers.classList.remove('text-darkOnBackgroundTwo');
        } else {
            userOnlyLettersAndNumbers.classList.remove('text-white');
            userOnlyLettersAndNumbers.classList.add('text-darkOnBackgroundTwo');
            isValid = false;
        }


        button.disabled = !isValid;
    })
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
