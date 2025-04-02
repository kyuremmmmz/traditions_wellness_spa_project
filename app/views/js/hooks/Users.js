document.addEventListener('DOMContentLoaded', function () {
    let baseUrl = 'http://localhost:8000';
    const fetchData = async () => {
        const response = await fetch(`${baseUrl}/getAllUsers`);
        const data = await response.json();
        if (response.ok) {
            renderData(data);
            console.log(data);
            
        }
    }

    const renderData = (items) => {
        document.querySelector('#appointmentsTable').innerHTML = items.map((data, index) => `
            <tr class="transition-colors duration-200 hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface cursor-pointer h-[40px] border-b border-border dark:border-darkBorder"
            <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${index + 1 || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${ index + 1 || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.first_name + ' ' + data.last_name  || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.role || 'No email'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.gender || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.email || 'N/A'}</td>
            </tr>
        `).join('');
    }
    fetchData();
 });