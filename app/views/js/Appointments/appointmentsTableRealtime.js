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
            <tr class="transition-colors duration-200 hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface cursor-pointer h-[40px] border-b border-border dark:border-darkBorder" data-id="${data.contactNumber}" data-contact="${data.contactNumber || ''}" data-address="${data.address || ''}" data-name="${data.nameOfTheUser || ''}" data-price="${data.total_price || ''}" data-hours="${data.hrs || ''}" data-addons="${data.addOns || ''}" data-status="${data.status || 'pending'}">
                <td class="pl-[48px] leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo truncate pr-[6px] text-center border-b border-border dark:border-darkBorder">${index + 1}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.nameOfTheUser || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.service_booked || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.address || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.email || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.gender}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.booking_date}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.start_time || ''}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.duration || ''}</td>
                <td class="pr-[48px] pl-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">
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
                const addons = this.getAttribute('data-addons');
                const status = this.getAttribute('data-status');

                const modal = document.querySelector('#updateModal');
                const modalContent = modal.querySelector('.transform');
                document.getElementById('modalAppointmentId').value = id;
                document.getElementById('modalContactNumber').value = contact;
                document.getElementById('modalAddress').value = address;
                document.getElementById('modalName').value = name;
                document.getElementById('modalBookingDate').value = this.getAttribute('data-date');
                document.getElementById('modalTotalPrice').value = price;
                document.getElementById('modalAddOns').value = addons;
                document.getElementById('modalStatus').value = status;

                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }, 10);
            });
        });
    }
    fetchData();
});

function getStatusColor(status) {
    switch (status.toLowerCase()) {
        case 'completed':
            return 'bg-success bg-opacity-10 text-success';
        case 'awaiting review':
            return 'bg-blue bg-opacity-10 text-blue';
        case 'ongoing':
            return 'bg-orange bg-opacity-10 text-orange';
        case 'upcoming':
            return 'bg-yellow bg-opacity-10 text-yellow';
        case 'pending':
            return 'bg-onBackgroundTwo bg-opacity-10 text-onBackground dark:text-darkOnBackgroundTwo';
        case 'cancelled':
            return 'bg-destructive bg-opacity-10 text-destructive';
        default:
            return 'bg-onBackgroundTwo dark:bg-darkOnBackgroundTwo bg-opacity-10 text-onBackgroundTwo dark:text-';
    }
}