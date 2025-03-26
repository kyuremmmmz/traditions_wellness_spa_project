document.addEventListener("DOMContentLoaded", function () {
    if (window.location.pathname !== '/account') {
        return;
    }

    const accountPage = (function() {
        const openPersonalInformationButton = document.getElementById("openPersonalInformationButton");
        const personalInformationModal = document.getElementById("personalInformationModal");
        const closePersonalInformationButton = document.getElementById("closePersonalInformationButton");
        const savePersonalInformationButton = document.getElementById("savePersonalInformationButton");
        const personalInformationConfirmationDialogBox = document.getElementById("personalInformationConfirmationDialogBox");
        const closePersonalInformationConfirmationDialogBox = document.getElementById("closePersonalInformationConfirmationDialogBox");
        const closePersonalInformationWarningDialogBox = document.getElementById("closePersonalInformationWarningDialogBox");
        const personalInformationWarningDialogBox = document.getElementById("personalInformationWarningDialogBox");
        const firstNameInputField = document.getElementById("firstNameInputField");
        const lastNameInputField = document.getElementById("lastNameInputField");
        const genderSelectField = document.getElementById("genderSelectField");

        const openSecurityModalButton = document.getElementById("openSecurityModalButton");
        const securityModal = document.getElementById("securityModal");
        const closeSecurityModalButton = document.getElementById("closeSecurityModalButton");
        const openChangePasswordButton = document.getElementById("openChangePasswordButton");
        const openChangePhoneNumberButton = document.getElementById("openChangePhoneNumberButton");
        const openChangeEmailButton = document.getElementById("openChangeEmailButton");

        const logoutDialogBox = document.getElementById("logoutDialogBox");
        const openLogoutDialogBoxButton = document.getElementById("openLogoutDialogBox");
        const logoutButton = document.getElementById("logoutButton");
        const closeLogoutDialogboxButton = document.getElementById("closeLogoutDialogBox");

        // Links
        

        let isModified = false;

        function init() {
            // Personal Information
            openPersonalInformationButton.addEventListener("click", openPersonalInformationModal);
            closePersonalInformationButton.addEventListener("click", closePersonalInformationModal);
            savePersonalInformationButton.addEventListener("click", showPersonalInformationConfirmationDialogBox);
            closePersonalInformationConfirmationDialogBox.addEventListener("click", hidePersonalInformationConfirmationDialogBox);
            closePersonalInformationWarningDialogBox.addEventListener("click", hidePersonalInformationWarningDialogBox);

            // Security
            openSecurityModalButton.addEventListener("click", openSecurityModal);
            closeSecurityModalButton.addEventListener("click", closeSecurityModal);

            // Logout 
            openLogoutDialogBoxButton.addEventListener("click", openLogoutDialogBox);
            closeLogoutDialogboxButton.addEventListener("click", closeLogoutDialogBox);

            // Validation
            detectChangesToPersonalInformationFields();

            // Links
            openChangeEmailButton.addEventListener("click", () =>       window.location.href = "/changeemail");
            openChangePhoneNumberButton.addEventListener("click", () => window.location.href = "/changephonenumber");
            openChangePasswordButton.addEventListener("click", () =>    window.location.href = "/changepassword");

        }

        // Personal Information Modal
        function openPersonalInformationModal() {
            personalInformationModal.classList.remove("translate-x-full");
            document.body.classList.add("overflow-hidden");
        }

        function closePersonalInformationModal() {
            if (isModified) {
                personalInformationWarningDialogBox.classList.remove("hidden");
            } else {
                personalInformationModal.classList.add("translate-x-full");
                document.body.classList.remove("overflow-hidden");
            }
        }

        // Personal Information Confirmation Dialog Box
        function showPersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.remove("hidden");
        }

        function hidePersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.add("hidden");
        }

        // Personal Information Warning Dialog Box
        function detectChangesToPersonalInformationFields() {
            const fields = [firstNameInputField, lastNameInputField, genderSelectField];

            fields.forEach(field => {
                if (field) {
                    field.addEventListener("change", () => {
                        isModified = true;
                        console.log("Changes detected in:", field.id);
                    });
                }
            });
        }

        function hidePersonalInformationWarningDialogBox() {
            personalInformationWarningDialogBox.classList.add("hidden");
            isModified = false;
        }

        // Security Modal
        function openSecurityModal() {
            securityModal.classList.remove("translate-x-full");
            document.body.classList.add("overflow-hidden");
        }

        function closeSecurityModal() {
            securityModal.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
        }

        // Security Modal
        function openLogoutDialogBox() {
            logoutDialogBox.classList.remove("hidden");
        }

        function closeLogoutDialogBox() {
            logoutDialogBox.classList.add("hidden");
        }

        return {
            init: init
        };
    })();

    accountPage.init();
});