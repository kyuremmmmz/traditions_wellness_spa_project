document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById();
    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/fetchAppointments');
        const json = await response.json();
        if (response.ok) {
            renderData();
        }
    }
    fetchData();
})