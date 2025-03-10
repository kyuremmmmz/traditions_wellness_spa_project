document.addEventListener('DOMContentLoaded', function () {
    let table = document.getElementById('tableWrapper');
    if (!table) {
        console.error('Table wrapper element not found!');
        return;
    }

    let modalWrapper = document.getElementById('modalWrapper');
    if (!modalWrapper) {
        console.error('Modal wrapper element not found!');
        return;
    }

    const modalHTML = `
        <div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full transition-opacity duration-300 opacity-0">
            <div class="relative top-20 mx-auto p-5 border w-2/3 shadow-lg rounded-md bg-white transform transition-transform duration-300 scale-95">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Update Appointment</h3>
                    <input type="hidden" name="id" id="modalAppointmentId">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="contactNumber" id="modalContactNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="modalAddress" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Patient</label>
                            <input type="text" name="nameOfTheUser" id="modalName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Booking Date</label>
                            <input type="date" name="booking_date" id="modalBookingDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                       
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Total Price</label>
                            <input type="text" name="price" id="modalTotalPrice" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Add-ons</label>
                            <input type="text" name="addOns" id="modalAddOns" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="modalStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="pending" disabled selected>Pending</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="confirmed">Confirmed</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" id="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Cancel</button>
                        <button type="submit" id="saveModal" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    modalWrapper.innerHTML = modalHTML;

    const fetchData = async () => {
        try {
            console.log('Fetching from: http://localhost:8000/fetchAppointments');
            const response = await fetch('http://localhost:8000/fetchAppointments');
            if (!response.ok) {
                throw new Error(`Fetch failed with status: ${response.status}`);
            }
            const json = await response.json();
            console.log('Fetched Data:', json);
            renderData(json);
        } catch (error) {
            console.error('Fetch error:', error);
            table.innerHTML = `<tr><td colspan="16" class="text-center py-4 text-red-600">Error loading data: ${error.message}</td></tr>`;
        }
    };

    const renderData = (data) => {
        if (!data || !Array.isArray(data)) {
            console.error('Invalid data format:', data);
            table.innerHTML = '<tr><td colspan="16" class="text-center py-4 text-red-600">No valid data to display</td></tr>';
            return;
        }
        let html = '';
        data.forEach((item, index) => {
            const formattedDate = formatDate(item.booking_date);
            const formattedStartTime = formatTime(item.start_time);
            

            html += `
            <tr class="transition-colors duration-200 hover:bg-indigo-50">
                <td class="px-6 py-4 font-medium text-center">${index + 1}</td>
                <td class="px-6 py-4 font-medium text-center text-indigo-600">${item.id || ''}</td>
                <td class="px-6 py-4 text-center">${item.contactNumber || ''}</td>
                <td class="px-6 py-4 text-center">${item.address || ''}</td>
                <td class="px-6 py-4 text-center">${item.nameOfTheUser || ''}</td>
                <td class="px-6 py-4 text-center">${formattedDate}</td>
                <td class="px-6 py-4 text-center">${formattedStartTime}</td>
                <td class="px-6 py-4 text-center">${item.total_price || ''}</td>
                <td class="px-6 py-4 text-center">${item.addOns || ''}</td>
                <td class="px-6 py-4 text-center">
                    ${item.status === 'pending' ?
                    `<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">${item.status.toUpperCase()}</span>` :
                    `<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">${item.status.toUpperCase()}</span>`}
                </td>
                <td class="px-6 py-4 text-center">
                    <button type="button" class="update-btn px-3 py-1 mr-2 text-xs font-medium text-white bg-primary rounded hover:bg-primary" 
                        data-id="${item.id || ''}"
                        data-contact="${item.contactNumber || ''}"
                        data-address="${item.address || ''}"
                        data-name="${item.nameOfTheUser || ''}"
                        data-price="${item.total_price || ''}"
                        data-hours="${item.hrs || ''}"
                        data-addons="${item.addOns || ''}"
                        data-status="${item.status || 'pending'}"
                        }">Update</button>
                    <form action="/deleteAppointment" method="post" class="inline">
                        <input type="hidden" name="id" value="${item.id || ''}">
                        <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>`;
        });
        table.innerHTML += html + '</tbody>';
        document.querySelectorAll('.update-btn').forEach(button => {
            button.addEventListener('click', function () {
                const modal = document.getElementById('updateModal');
                const modalContent = modal.querySelector('.transform');
                document.getElementById('modalAppointmentId').value = this.getAttribute('data-id');
                document.getElementById('modalContactNumber').value = this.getAttribute('data-contact');
                document.getElementById('modalAddress').value = this.getAttribute('data-address');
                document.getElementById('modalName').value = this.getAttribute('data-name');
                document.getElementById('modalBookingDate').value = this.getAttribute('data-date');
                document.getElementById('modalTotalPrice').value = this.getAttribute('data-price');
                document.getElementById('modalAddOns').value = this.getAttribute('data-addons');
                document.getElementById('modalStatus').value = this.getAttribute('data-status');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }, 10);
            });
        });
    };

    const modal = document.getElementById('updateModal');
    const closeModalBtn = document.getElementById('closeModal');

    closeModalBtn.addEventListener('click', () => {
        const modalContent = modal.querySelector('.transform');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            const modalContent = modal.querySelector('.transform');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    });

    const formatDate = (dateStr) => {
        if (!dateStr || typeof dateStr !== 'string') return '';
        const date = new Date(dateStr.split(' ')[0]);
        if (isNaN(date.getTime())) return '';
        const options = { month: 'long', day: 'numeric', year: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    };

    const formatTime = (timeStr) => {
        if (!timeStr || typeof timeStr !== 'string') return '';
        const timePart = timeStr.split(' ')[1] || timeStr;
        const [hours, minutes] = timePart.split(':');
        if (!hours || !minutes) return '';
        const hourNum = parseInt(hours);
        if (isNaN(hourNum)) return '';
        const modifier = hourNum >= 12 ? 'PM' : 'AM';
        const adjustedHour = hourNum % 12 || 12;
        return `${adjustedHour}:${minutes} ${modifier}`;
    };

    fetchData();
});