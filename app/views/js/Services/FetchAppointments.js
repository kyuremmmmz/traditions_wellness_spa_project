document.addEventListener('DOMContentLoaded', function () {
    let table = document.getElementById('tableWrapper');

    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/fetchAppointments');
        const json = await response.json();
        if (response.ok) {
            renderData(json);
        }
    };

    const renderData = (data) => {
        table.innerHTML = '';
        let html = '';

        data.forEach((item, index) => {
            const formattedDate = formatDate(item.booking_date);
            const formattedTime = formatTime(item.start_time);

            html += `<tr class="transition-colors duration-200 hover:bg-indigo-50">
                        <td class="px-6 py-4 font-medium text-center">${index + 1}</td>
                        <td class="px-6 py-4 font-medium text-center text-indigo-600 editable" data-field="id">AP00${item.id}</td>
                        <td class="px-6 py-4 text-center editable" data-field="contactNumber">${item.contactNumber}</td>
                        <td class="px-6 py-4 text-center editable" data-field="address">${item.address}</td>
                        <td class="px-6 py-4 text-center editable" data-field="nameOfTheUser">${item.nameOfTheUser}</td>
                        <td class="px-6 py-4 text-center editable" data-field="date" data-raw="${item.booking_date}">${formattedDate}</td>
                        <td class="px-6 py-4 text-center editable" data-field="time" data-raw="${item.start_time}">${formattedTime}</td>
                        <td class="px-6 py-4 text-center editable" data-field="time" data-raw="${item.end_time}">${formattedTime}</td>
                        <td class="px-6 py-4 text-center editable" data-field="number" data-raw="${item.total_price}">${item.total_price}</td>
                        <td class="px-6 py-4 text-center">
                            ${item.status == 'pending' ?
                    `<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Pending</span>` :
                    `<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Confirmed</span>`}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button type="submit" class="px-3 py-1 mr-2 text-xs font-medium text-white bg-primary rounded hover:bg-blue-600">Update</button>
                            <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>`;
        });
        table.innerHTML = html;

        addEditableListeners();
    };

    const addEditableListeners = () => {
        const editableCells = document.querySelectorAll('.editable');
        editableCells.forEach(cell => {
            cell.addEventListener('dblclick', function () {
                const field = this.getAttribute('data-field');
                const rawValue = this.getAttribute('data-raw') || this.textContent.trim();
                console.log('Editing field:', field, 'Raw value:', rawValue);

                if (field === 'date') {
                    const dateValue = rawValue.includes(' ') ? rawValue.split(' ')[0] : rawValue;
                    this.innerHTML = `<input name="date" type="date" value="${dateValue || ''}" class="w-full text-center outline-none">`;
                } else if (field === 'time') {
                    const timeValue = rawValue.includes(':') ? rawValue.split(' ')[1] || rawValue : convertTo24Hour(rawValue);
                    this.innerHTML = `<input name="time" type="time" value="${timeValue || ''}" class="w-full text-center outline-none">`;
                } else {
                    this.innerHTML = `<input name="${field}" type="text" value="${rawValue}" class="max-w-300 min-w-300 text-center border-none ring-0 outline-none">`;
                }

                const input = this.querySelector('input');
                if (input) {
                    input.focus();
                    input.addEventListener('blur', handleInputBlur);
                    input.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.blur();
                        }
                    });
                }
            });
        });
    };

    const handleInputBlur = function () {
        const cell = this.parentElement;
        const field = cell.getAttribute('data-field');
        const name = this.getAttribute('name');
        let newValue = this.value;

        if (field === 'date') {
            newValue = formatDate(newValue);
            cell.setAttribute('data-raw', `${this.value} 00:00:00`);
        } else if (field === 'time') {
            newValue = convertTo12Hour(newValue);
            cell.setAttribute('data-raw', `${this.value}:00`);
        }

        cell.textContent = newValue;
        cell.classList.remove('bg-yellow-100');
        saveUpdatedData(cell, name);
    };

    const formatDate = (dateStr) => {
        if (!dateStr) return '';
        const date = new Date(dateStr.split(' ')[0]);
        const options = { month: 'long', day: 'numeric', year: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    };

    const formatTime = (timeStr) => {
        if (!timeStr) return '';
        const timePart = timeStr.split(' ')[1] || timeStr;
        const [hours, minutes] = timePart.split(':');
        const hourNum = parseInt(hours);
        const modifier = hourNum >= 12 ? 'PM' : 'AM';
        const adjustedHour = hourNum % 12 || 12;
        return `${adjustedHour}:${minutes} ${modifier}`;
    };

    const convertTo24Hour = (time12h) => {
        const [time, modifier] = time12h.split(' ');
        let [hours, minutes] = time.split(':');
        if (modifier === 'PM' && hours !== '12') hours = parseInt(hours) + 12;
        if (modifier === 'AM' && hours === '12') hours = '00';
        return `${hours.padStart(2, '0')}:${minutes}`;
    };

    const convertTo12Hour = (time24h) => {
        const [hours, minutes] = time24h.split(':');
        const hourNum = parseInt(hours);
        const modifier = hourNum >= 12 ? 'PM' : 'AM';
        const adjustedHour = hourNum % 12 || 12;
        return `${adjustedHour}:${minutes} ${modifier}`;
    };

    const saveUpdatedData = (cell, name) => {
        const row = cell.parentElement;
        const field = cell.getAttribute('data-field');
        const newValue = field === 'date' || field === 'time' ? cell.getAttribute('data-raw') : cell.textContent.trim();
        const idCell = row.querySelector('td[data-field="id"]').textContent;
        const appointmentId = idCell.replace('AP00', '');
        console.log(`Saving updated data: ID=${appointmentId}, Name=${name}, Field=${field}, New Value=${newValue}`);

        fetch('http://localhost:8000/updateAppointment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: appointmentId,
                name: name,
                field: field,
                value: newValue
            })
        });
    };

    fetchData();
});