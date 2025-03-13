document.addEventListener('DOMContentLoaded', function(){
    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/fetchAppointments');
        const json = await response.json();
        if (response.ok) {
            console.log(json);
            renderData(json);
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
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            <td>${data.nameOfTheUser}</td>
            </tr>`;
            appointmentsTable.innerHTML += html;
            
        });
    }
    fetchData();
});