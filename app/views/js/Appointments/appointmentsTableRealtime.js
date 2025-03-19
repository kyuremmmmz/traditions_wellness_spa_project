document.addEventListener('DOMContentLoaded', () => {
    const fetchAppointments = async () => {
        try {
            const response = await fetch('http://localhost:8000/fetchAppointments');
            if (!response.ok) throw new Error('Fetch failed');
            renderData((await response.json())[0]);
        } catch (error) {
            console.error('Error fetching appointments:', error);
        }
    };

    const fetchServices = async () => {
        try {
            const response = await fetch('http://localhost:8000/store', { method: 'GET' });
            if (!response.ok) throw new Error('Fetch failed');
            const json = await response.json();
            if (json.data && Array.isArray(json.data)) {
                return json.data;
            }
            return [];
        } catch (error) {
            console.error('Error fetching services:', error);
            return [];
        }
    };

    const renderDropdown = (items, selectedServiceName) => {
        const selectionBox2 = document.getElementById('select2');
        selectionBox2.innerHTML = items.map(item =>
            `<option value="${item.id}" ${item.serviceName === selectedServiceName ? 'selected' : ''}>${item.serviceName}</option>`
        ).join('') || '<option value="">No services available</option>';
    };

    const renderDurationDropdown = (selectedDuration) => {
        const durationBox = document.getElementById('durationhaha');
        const durationOptions = [
            "1 Hour",
            "1 Hour and 30 minutes",
            "2 Hours"
        ];
        durationBox.innerHTML = durationOptions.map(option =>
            `<option value="${option}" ${option === selectedDuration ? 'selected' : ''}>${option}</option>`
        ).join('') || '<option value="">No duration available</option>';

        if (selectedDuration && !durationOptions.includes(selectedDuration)) {
            durationBox.innerHTML = `<option value="${selectedDuration}" selected>${selectedDuration}</option>` + durationBox.innerHTML;
        }
    };

    const renderData = (items) => {
        document.querySelector('#appointmentsTable').innerHTML = items.map((data, index) => `
            <tr class="transition-colors duration-200 hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface cursor-pointer h-[40px] border-b border-border dark:border-darkBorder"
                data-id="${data.id || ''}"
                data-creation="${formatDate(data.created_at) || ''}"
                data-update="${formatDate(data.updated_at) || ''}"
                data-appointment="${data.booking_date || ''}"
                data-service="${data.service_booked || ''}"
                data-userid="${data.user_id || ''}"
                data-contact="${data.contactNumber || ''}"
                data-time="${data.start_time || ''}"
                data-address="${data.address || ''}" 
                data-name="${data.nameOfTheUser || ''}" 
                data-price="${data.total_price || ''}" 
                data-hours="${data.duration || ''}" 
                data-addons="${data.addOns || ''}"
                data-email="${data.email || ''}"
                data-paymentstatus="${data.payment_status || 'pending'}"
                data-source="${data.source_of_booking || 'pending'}"
                data-status="${data.status || 'pending'}">
                <td class="pl-[48px] leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo truncate pr-[6px] text-center border-b border-border dark:border-darkBorder">${index + 1}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.nameOfTheUser || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.service_booked || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.party_size || 'Solo'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.email || 'No email'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.gender || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${formatDate(data.booking_date) || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${formatTime(data.start_time) || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.duration || 'N/A'}</td>
                <td class="pr-[48px] pl-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">
                    ${data.status ?
                `<span class="inline-flex items-center px-1.5 rounded-full text-xs font-medium ${getStatusColor(data.status)}">${data.status}</span>` :
                `<span class="inline-flex items-center px-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800">STATUS MISSING</span>`}
                </td>
            </tr>
        `).join('');

        document.querySelectorAll('#appointmentsTable tr').forEach(row => {
            row.addEventListener('click', async () => {
                const data = row.dataset;
                const modal = document.getElementById('updateModal');
                const modalContent = modal.querySelector('.transform');

                document.getElementById('modalAppointmentId').textContent = data.id;
                document.getElementById('modalContactNumber').textContent = data.contact;
                document.getElementById('modalAddress').textContent = data.address;
                document.getElementById('fetchedCustomerName').textContent = data.name;
                document.getElementById('modalTotalPrice').textContent = data.price;
                document.getElementById('modalAddOns').textContent = data.addons;
                document.getElementById('fetchedStatus').textContent = data.status;
                document.getElementById('fetchedSourceOfBooking').textContent = data.source;
                document.getElementById('fetchedPaymentStatus').textContent = data.paymentstatus;
                document.getElementById('fetchedAssignmentStatus').textContent = data.status;
                document.getElementById('fetchedCustomerEmail').textContent = data.email;
                document.getElementById('fetchedClientId').textContent = data.userid;
                document.getElementById('fetchedCreationDate').textContent = data.creation;
                document.getElementById('fetchedLastModifiedOn').textContent = data.update;

                document.getElementById('data').innerHTML = `
                    <div class="flex flex-col gap-[4px] w-full justify-center">
                        <p class="BodyTwo text-onBackground dark:text-darkOnBackground text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none max-w-[260px] text-right">Date</p>
                    </div>
                    <input type="date" id="dateInput" value="${data.appointment}" min="2025-03-18" name="date" 
                        class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground 
                        border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] 
                        w-full min-w-[260px] max-w-[260px]" placeholder="Select a date">
                `;
                document.getElementById('timedata').value = data.time;
                const services = await fetchServices();
                renderDropdown(services, data.service);
                renderDurationDropdown(data.hours);

                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.toggle('opacity-0', false).toggle('opacity-100', true);
                    modalContent.classList.toggle('scale-95', false).toggle('scale-100', true);
                }, 10);
            });
        });
    };

    fetchAppointments();
});

const formatDate = dateStr => !dateStr ? 'N/A' : (d => isNaN(d) ? 'N/A' : d.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }))(new Date(dateStr.split(' ')[0]));
const formatTime = timeStr => !timeStr ? 'N/A' : (([h, m]) => !h || !m ? 'N/A' : `${parseInt(h) % 12 || 12}:${m} ${parseInt(h) >= 12 ? 'PM' : 'AM'}`)((timeStr.split(' ')[1] || timeStr).split(':'));
const getStatusColor = status => ({
    completed: 'bg-success bg-opacity-10 text-success',
    'awaiting review': 'bg-blue bg-opacity-10 text-blue',
    ongoing: 'bg-orange bg-opacity-10 text-orange',
    upcoming: 'bg-yellow bg-opacity-10 text-yellow',
    pending: 'bg-onBackgroundTwo bg-opacity-10 text-onBackground dark:text-darkOnBackgroundTwo',
    cancelled: 'bg-destructive bg-opacity-10 text-destructive'
}[status?.toLowerCase()] || 'bg-onBackgroundTwo dark:bg-darkOnBackgroundTwo bg-opacity-10 text-onBackgroundTwo dark:text-');