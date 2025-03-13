document.addEventListener('DOMContentLoaded', function(){
    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/fetchAppointments');
        const json = await response.json();
        if (response.ok) {
            console.log(json[0]);
            renderData(json[0]);
        }
    }

    const renderData = async (item) => {
        let appointmentsTable = document.querySelector('#appointmentsTable');
        let html = '';
        item.forEach((data, index) => {
            html = `
            <tr>
            <td>${index +1}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.services_id}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.booking_date}</td>
            <td>${data.start_time}</td>
            <td>${data.hrs}</td>
            <td>${data.status}</td>
            </tr>`;
            appointmentsTable.innerHTML += html;
            
        });
    }
    fetchData();
});