document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname !== '/services') {
        return;
    }
    const listData = document.getElementById('test');
    const radioButtonContainer = document.getElementById('radioContainer');
    const list = document.getElementById('paragraphData');
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
                    <div class="flex gap-2">
                        <input type="radio" id="${radioId}" name="radioGroup" class="hidden peer/${radioId}" value="${item.category}">
                        <label for="${radioId}" class="cursor-pointer border-border dark:border-darkBorder rounded-[6px] w-full h-[40px] peer-checked/${radioId}:border-borderHighlight dark:peer-checked/option1:border-darkBorderHighlight border-[2px] transition-all flex items-center pl-[12px]">
                            <p class="BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface pl-[12px]">
                                ${item.category}
                                <input type="hidden" value="${item.id}" id="hidden-${radioId}" name="radioId">
                            </p>
                        </label>
                    </div>
                </div>
        `;
        });

        document.querySelectorAll('input[name="radioGroup"]').forEach((radio) => {
            radio.addEventListener("change", (event) => {
                console.log("Selected Value:", event.target.value);
                document.getElementById("hiddenContainer2").innerHTML = `<input type="hidden" value="${event.target.value}" name="radio">`;
            });
        });


    };


    fetchData();
});