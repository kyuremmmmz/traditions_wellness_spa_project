document.addEventListener("DOMContentLoaded", function () {
    const openBookAnAppointmentButton = document.getElementById("openBookAnAppointmentButton");
    const bookAnAppointmentSection = document.getElementById("bookAnAppointmentSection");
    const closeBookAnAppointmentButton = document.getElementById("closeBookAnAppointmentButton")

    openBookAnAppointmentButton.addEventListener("click", function () {
        bookAnAppointmentSection.classList.remove("translate-x-full");
        document.body.classList.add("overflow-hidden");  // Disable body scrolling
    });

    closeBookAnAppointmentButton.addEventListener("click", function () {
        bookAnAppointmentSection.classList.add("translate-x-full");
        document.body.classList.remove("overflow-hidden");  // Disable body scrolling

    });

});