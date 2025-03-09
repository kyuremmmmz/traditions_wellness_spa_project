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
    const noOtherSpecialCharacters = document.getElementById('noOtherSpecialCharacters');

    function validateUsername() {
        if (!userInput) return true; // If username input doesn't exist, assume it's valid
        const username = userInput.value;
        let isValid = true;

        // Check length
        if (username.length >= 8) {
            usernameEightCharacter.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            usernameEightCharacter.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            usernameEightCharacter.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            usernameEightCharacter.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        // Check valid characters
        if (/^[A-Za-z0-9_]+$/.test(username)) {
            userOnlyLettersAndNumbers.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            userOnlyLettersAndNumbers.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            userOnlyLettersAndNumbers.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            userOnlyLettersAndNumbers.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        // Check if not empty
        if (username !== "" && /^[A-Za-z0-9_]+$/.test(username)) {
            noOtherSpecialCharacters.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            noOtherSpecialCharacters.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            noOtherSpecialCharacters.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            noOtherSpecialCharacters.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        return isValid;
    }

    function validatePassword() {
        const password = passwordInput.value;
        let isValid = true;

        if (password.length >= 8) {
            eightChar.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            eightChar.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            eightChar.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            eightChar.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        if (/[A-Z]/.test(password)) {
            upperCaseCharacters.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            upperCaseCharacters.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            upperCaseCharacters.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            upperCaseCharacters.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        if (/[a-z]/.test(password)) {
            lowerCaseCharacters.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            lowerCaseCharacters.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            lowerCaseCharacters.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            lowerCaseCharacters.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        if (/[0-9]/.test(password)) {
            numberCharacters.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            numberCharacters.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            numberCharacters.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            numberCharacters.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialCharacter.classList.add('text-onBackground', 'dark:text-darkOnBackground');
            specialCharacter.classList.remove('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
        } else {
            specialCharacter.classList.add('text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo');
            specialCharacter.classList.remove('text-onBackground', 'dark:text-darkOnBackground');
            isValid = false;
        }

        return isValid;
    }

    if (passwordInput) {
        passwordInput.addEventListener('input', updateButtonState);
    }
    
    if (userInput) {
        userInput.addEventListener('input', updateButtonState);
    }

    function updateButtonState() {
        const usernameValid = validateUsername();
        const passwordValid = validatePassword();
        button.disabled = !(usernameValid && passwordValid);
    }
});