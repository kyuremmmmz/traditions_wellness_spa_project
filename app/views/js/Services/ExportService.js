export const handleInputBlur = function () {
    const cell = this.parentElement;
    const field = cell.getAttribute('data-field');
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
    saveUpdatedData(cell);
};

export const formatDate = (dateStr) => {
    if (!dateStr) return '';
    const date = new Date(dateStr.split(' ')[0]);
    const options = { month: 'long', day: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
};

export const formatTime = (timeStr) => {
    if (!timeStr) return '';
    const timePart = timeStr.split(' ')[1] || timeStr;
    const [hours, minutes] = timePart.split(':');
    const hourNum = parseInt(hours);
    const modifier = hourNum >= 12 ? 'PM' : 'AM';
    const adjustedHour = hourNum % 12 || 12;
    return `${adjustedHour}:${minutes} ${modifier}`;
};

export const convertTo24Hour = (time12h) => {
    const [time, modifier] = time12h.split(' ');
    let [hours, minutes] = time.split(':');
    if (modifier === 'PM' && hours !== '12') hours = parseInt(hours) + 12;
    if (modifier === 'AM' && hours === '12') hours = '00';
    return `${hours.padStart(2, '0')}:${minutes}`;
};

export const convertTo12Hour = (time24h) => {
    const [hours, minutes] = time24h.split(':');
    const hourNum = parseInt(hours);
    const modifier = hourNum >= 12 ? 'PM' : 'AM';
    const adjustedHour = hourNum % 12 || 12;
    return `${adjustedHour}:${minutes} ${modifier}`;
};

