document.addEventListener("DOMContentLoaded", () => {
    const selectionBox = document.querySelector('select[name="service_booked"]');
    if (!selectionBox) {
        console.error('Service selection box not found');
        return;
    }

    async function fetchData() {
        try {
            // Keep the original select element's properties
            const originalClass = selectionBox.getAttribute('class');
            const originalStyle = selectionBox.getAttribute('style');

            // Fetch services from the server
            const response = await fetch('http://localhost:8000/store', { method: 'GET' });
            const result = await response.json();
            const services = result.data; // Access the data array from the response

            // Create options while maintaining the select element
            const optionsHtml = services.map(service => 
                `<option value="${service.id}">${service.serviceName}</option>`
            ).join('');

            // Update the select element while preserving its properties
            selectionBox.innerHTML = `${optionsHtml}`;
            selectionBox.setAttribute('class', originalClass);
            selectionBox.setAttribute('style', originalStyle);
            
        } catch (error) {
            console.error('Error fetching services:', error);
            selectionBox.innerHTML = '<option value="">Error loading services</option>';
        }
    }

    fetchData();
});