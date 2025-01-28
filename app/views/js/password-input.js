function togglePassword(inputId) {
    let passwordInput = document.querySelector(`#${inputId}`);
    let eyeIcon = document.querySelector(`#${inputId}-icon`);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
    }
}
