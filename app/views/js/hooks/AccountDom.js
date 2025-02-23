document.addEventListener("DOMContentLoaded", function () {
    if (window.location.pathname !== '/account') {
        return;
    }

    const openPersonalInfoModalButton = document.getElementById("openPersonalInfoModalButton");
    const personalInfoModal = document.getElementById("personalInfoModal");
    const closePersonalInfoModalButton = document.getElementById("closePersonalInfoModalButton");

    openPersonalInfoModalButton.addEventListener("click", function () {
        personalInfoModal.classList.remove("translate-x-full");
        document.body.classList.add("overflow-hidden"); 
    });

    // Close modal
    closePersonalInfoModalButton.addEventListener("click", function () {
        personalInfoModal.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");
    });
});