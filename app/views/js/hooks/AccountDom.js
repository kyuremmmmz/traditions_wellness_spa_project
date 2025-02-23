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

        let isModified = false;

        function init() {
            openPersonalInformationButton.addEventListener("click", openPersonalInformationModal);
            closePersonalInformationButton.addEventListener("click", closePersonalInformationModal);
            savePersonalInformationButton.addEventListener("click", showPersonalInformationConfirmationDialogBox);
            closePersonalInformationConfirmationDialogBox.addEventListener("click", hidePersonalInformationConfirmationDialogBox);
            closePersonalInformationWarningDialogBox.addEventListener("click", hidePersonalInformationWarningDialogBox);
            detectChangesToPersonalInformationFields();
        }

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

        // Warning dialog box

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

        function showPersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.remove("hidden");
        }

        function hidePersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.add("hidden");
        }

        function hidePersonalInformationWarningDialogBox() {
            personalInformationWarningDialogBox.classList.add("hidden");

            isModified = false;
        }

        return {
            init: init
        };
    })();

    accountPage.init();
});