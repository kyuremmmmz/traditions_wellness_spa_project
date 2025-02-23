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

        function init() {
            openPersonalInformationButton.addEventListener("click", openModal);
            closePersonalInformationButton.addEventListener("click", closeModal);
            savePersonalInformationButton.addEventListener("click", showPersonalInformationConfirmationDialogBox);
            closePersonalInformationConfirmationDialogBox.addEventListener("click", hidePersonalInformationConfirmationDialogBox);
        }

        function openModal() {
            personalInformationModal.classList.remove("translate-x-full");
            document.body.classList.add("overflow-hidden");
        }

        function closeModal() {
            personalInformationModal.classList.add("translate-x-full");
            document.body.classList.remove("overflow-hidden");
        }

        function showPersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.remove("hidden");
        }

        function hidePersonalInformationConfirmationDialogBox() {
            personalInformationConfirmationDialogBox.classList.add("hidden");
        }

        return {
            init: init
        };
    })();

    accountPage.init();
});