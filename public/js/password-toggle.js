function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password_field");
    var iconContainer = document.getElementById("password_icon");

    // TODO: DITO BA TALAGA TO? DITO SA FOLDER NA ITO?
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconContainer.innerHTML = ` 
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                        <path d="M1.66675 10C1.66675 10 4.16675 4.16669 10.0001 4.16669C15.8334 4.16669 18.3334 10 18.3334 10C18.3334 10 15.8334 15.8334 10.0001 15.8334C4.16675 15.8334 1.66675 10 1.66675 10Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                `;
    } else {
        passwordInput.type = "password";
        iconContainer.innerHTML = `
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                                        <path d="M8.23344 8.23334C7.98782 8.46221 7.79081 8.73821 7.65417 9.04488C7.51753 9.35154 7.44406 9.68259 7.43813 10.0183C7.43221 10.3539 7.49396 10.6874 7.6197 10.9987C7.74543 11.31 7.93258 11.5927 8.16998 11.8301C8.40737 12.0675 8.69015 12.2547 9.00145 12.3804C9.31274 12.5061 9.64617 12.5679 9.98185 12.562C10.3175 12.5561 10.6486 12.4826 10.9552 12.3459C11.2619 12.2093 11.5379 12.0123 11.7668 11.7667" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.94165 4.23335C9.29274 4.18961 9.64618 4.16735 9.99998 4.16669C15.8333 4.16669 18.3333 10 18.3333 10C17.9607 10.7976 17.4935 11.5475 16.9417 12.2334" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.50841 5.50836C3.85112 6.63721 2.52497 8.18774 1.66675 10C1.66675 10 4.16675 15.8334 10.0001 15.8334C11.5967 15.8376 13.1591 15.371 14.4917 14.4917" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1.66675 1.66669L18.3334 18.3334" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                `;
    }
}
