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
                <div class="relative">
                <input
                    type="radio"
                    id="${item.id}" 
                    name="service_id" 
                    value="${item.id}"
                    class="peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo checked:border-borderHighlight dark:checked:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] appearance-none cursor-pointer focus:ring-0"
                />
                <label 
                    for="${item.id}" 
                    id="${item.id}-label"
                    class="transition-all ease-in-out absolute BodyOne left-[7px] mt-[10px]   text-onBackgroundTwo dark:text-darkOnBackgroundTwo peer-checked:text-onBackground dark:peer-checked:text-darkOnBackground  dark:bg-darkBackground bg-background px-[7px] pointer-events-none "
                >
                    ${item.category}
                </label>
            </div>
            `;
            selectionBox.innerHTML += html;
        });
    }

    fetchData();
});