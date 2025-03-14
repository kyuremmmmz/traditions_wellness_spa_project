document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname !== '/appointments') {
        return;
    }

    let table = document.getElementById('appointmentsTable');
    if (!table) {
        console.error('Table wrapper element not found!');
        return;
    }

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
            console.log('Processing item:', item); // Debugging line
            const formattedDate = formatDate(item.booking_date);
            const formattedStartTime = formatTime(item.start_time);
    
            
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