document.addEventListener('DOMContentLoaded', function () {
    const listData = document.getElementById('test');
    const radioButtonContainer = document.getElementById('radioContainer'); // Updated ID

    const fetchData = async () => {
        try {
            const response = await fetch('http://localhost:8000/store');
            const jsonData = await response.json();

            if (jsonData.data && Array.isArray(jsonData.data)) {
                console.log(jsonData);
                renderData(jsonData.data);
                renderDataForRadio(jsonData.data);
            }
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    };

    const renderData = (data) => {
        listData.innerHTML = "";
        data.forEach((item) => {
            listData.innerHTML += `<li class="text-white">${item.category}</li>`;
        });
    };

    const renderDataForRadio = (data) => {
        radioButtonContainer.innerHTML = "";

        data.map((item, index) => {
            const radioId = `option${index + 1}`;
            radioButtonContainer.innerHTML += `
                    <div class="mt-[24px] min-w-[316px] max-w-[400px]">
                        <div id="" class="flex gap-2">
                            <input type="radio" id="${radioId}" name="radioGroup" class="hidden peer/${radioId}">
                            <label for="${radioId}" id="radioButton"
                                class="cursor-pointer border-border dark:border-darkBorder rounded-[6px] w-full h-[40px] peer-checked/${radioId}:border-borderHighlight dark:peer-checked/option1:border-darkBorderHighlight border-[2px] transition-all flex items-center pl-[12px]">
                                <?php IconChoice::render('defaultSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface'); ?>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="onSurface color-darkOnSurface">
                                    <path d="M3.33333 2C2.97971 2 2.64057 2.14048 2.39052 2.39052C2.14048 2.64057 2 2.97971 2 3.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6667 2C13.0203 2 13.3594 2.14048 13.6095 2.39052C13.8595 2.64057 14 2.97971 14 3.33333" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 12.6666C14 13.0202 13.8595 13.3594 13.6095 13.6094C13.3594 13.8595 13.0203 14 12.6667 14" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.33333 14C2.97971 14 2.64057 13.8595 2.39052 13.6094C2.14048 13.3594 2 13.0202 2 12.6666" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 2H6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 14H6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.33331 2H9.99998" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.33331 14H9.99998" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 6V6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 6V6.66667" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 9.33337V10" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 9.33337V10" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p class="BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface pl-[12px]">
                                    ${item.category}
                                </p>
                            </label>
                        </div>
                    </div>
            `;
        });
    };

    fetchData();
});
