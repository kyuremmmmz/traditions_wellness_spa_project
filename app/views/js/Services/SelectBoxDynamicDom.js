document.addEventListener("DOMContentLoaded", () => {
    const selectionBox = document.getElementById('select');

    async function fetchData() {
        try {
            const response = await fetch('http://localhost:8000/store', { method: 'GET' });
            const json = await response.json();
            if (json.data && Array.isArray(json.data)) {
                console.log(json.data);
                renderDropdowns(json.data);
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function renderDropdowns(items) {
        selectionBox.innerHTML = '';

        items.forEach(item => {
            const html = `
                <option value="${item.id} ${item.price}" selected>${item.serviceName} - ${item.price}</option>
            `;
            selectionBox.innerHTML += html;
        });
    }

    fetchData();
});