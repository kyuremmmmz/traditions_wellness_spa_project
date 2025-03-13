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
            html += `
            <tr class="transition-colors duration-200 hover:bg-highlightSurface cursor-pointer h-[40px]" data-id="${data.id || ''}" data-contact="${data.contactNumber || ''}" data-address="${data.address || ''}" data-name="${data.nameOfTheUser || ''}" data-price="${data.total_price || ''}" data-hours="${data.hrs || ''}" data-addons="${data.addOns || ''}" data-status="${data.status || 'pending'}">
                <td class="pl-[48px] leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo truncate pr-[6px] text-center">${index + 1}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.clientName || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.contactNumber || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.address || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.nameOfTheUser || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.booking_date}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.start_time}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.total_price || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">${data.addOns || ''}</td>
                <td class="pr-[48px] pl-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center">
                    ${data.status ? 
                    `<span class="inline-flex items-center px-1.5 rounded-full text-xs font-medium ${getStatusColor(data.status)}">${data.status}</span>` :
                    `<span class="inline-flex items-center px-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800">STATUS MISSING</span>`}
                </td>
            </tr>`;
        });
        appointmentsTable.innerHTML += html;

        // Add event listener to each row
        document.querySelectorAll('#appointmentsTable tr').forEach(row => {
            row.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const contact = this.getAttribute('data-contact');
                const address = this.getAttribute('data-address');
                const name = this.getAttribute('data-name');
                const price = this.getAttribute('data-price');
                const hours = this.getAttribute('data-hours');
                const addons = this.getAttribute('data-addons');
                const status = this.getAttribute('data-status');
                // Perform the desired action with the data
                console.log(`Row clicked: ID=${id}, Contact=${contact}, Address=${address}, Name=${name}, Price=${price}, Hours=${hours}, Add-ons=${addons}, Status=${status}`);
            });
        });
    }
    fetchData();
});

function getStatusColor(status) {
    switch (status.toLowerCase()) {
        case 'completed':
            return 'bg-green-100 text-green-800';
        case 'awaiting review':
            return 'bg-blue-100 text-blue-800';
        case 'ongoing':
            return 'bg-orange-100 text-orange-800';
        case 'upcoming':
            return 'bg-yellow-100 text-yellow-800';
        case 'pending':
            return 'bg-gray-100 text-gray-800';
        case 'cancelled':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}