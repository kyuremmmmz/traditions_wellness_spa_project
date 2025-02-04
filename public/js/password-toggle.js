function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password_field");
    var iconContainer = document.getElementById("password_icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconContainer.innerHTML = ` 
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                        <path d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                `;
    } else {
        passwordInput.type = "password";
        iconContainer.innerHTML = `
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                        <path d="M9.87988 9.88C9.58514 10.1547 9.34873 10.4859 9.18476 10.8539C9.02079 11.2218 8.93262 11.6191 8.92552 12.0219C8.91841 12.4247 8.99251 12.8248 9.14339 13.1984C9.29428 13.5719 9.51885 13.9113 9.80373 14.1962C10.0886 14.481 10.4279 14.7056 10.8015 14.8565C11.175 15.0074 11.5752 15.0815 11.978 15.0744C12.3808 15.0673 12.778 14.9791 13.146 14.8151C13.514 14.6512 13.8452 14.4148 14.1199 14.12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.73 5.08C11.1513 5.02751 11.5754 5.00079 12 5C19 5 22 12 22 12C21.5529 12.9571 20.9922 13.8569 20.33 14.68" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.61 6.60999C4.62125 7.96461 3.02987 9.82524 2 12C2 12 5 19 12 19C13.9159 19.0051 15.7908 18.4451 17.39 17.39" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M2 2L22 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                `;
    }
}
