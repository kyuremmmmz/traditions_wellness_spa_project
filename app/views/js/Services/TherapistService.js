document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('therapistTable'); // Keep as DOM element
    const fetchData = async () => {
        try {
            const response = await fetch('http://localhost:8000/getAllTherapist');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            console.log('Raw data:', data);
            renderTable(data);
        } catch (error) {
            console.error('Error fetching data:', error);
            table.innerHTML = '<tr><td colspan="5">Failed to load data</td></tr>';
        }
    };

    const renderTable = (items) => {
        table.innerHTML = '';
        if (!Array.isArray(items) || items.length === 0) {
            table.innerHTML = '<tr><td colspan="5">No therapists found</td></tr>';
            return;
        }

        const html = items.map((data, index) => `
            <tr class="transition-colors duration-200 hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface cursor-pointer h-[40px] border-b border-border dark:border-darkBorder"
                data-id="${data.id || ''}"
                data-creation="${formatDate(data.created_at) || ''}"
                data-update="${formatDate(data.updated_at) || ''}"
                data-appointment="${data.booking_date || ''}"
                data-service="${data.service_booked || ''}">
                <td class="pl-[48px] leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo truncate pr-[6px] text-center border-b border-border dark:border-darkBorder">${index + 1}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.first_name + ' ' + data.last_name || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.status || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.gender || 'Solo'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.email || 'No email'}</td>
            </tr>
        `).join('');
        table.innerHTML = html;
    };

    const formatDate = (date) => {
        return date ? new Date(date).toLocaleDateString() : 'N/A';
    };

    fetchData();
});