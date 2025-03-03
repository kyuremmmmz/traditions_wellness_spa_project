document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#search');
    const searchSuggestions = document.querySelector('#suggestions');
    const wrapper = document.querySelector('#wrapper');
    const listTemplate = document.querySelector('#li');

    const showRecommendedList = (listOfRecommendations) => {
        searchSuggestions.innerHTML = '';
        searchSuggestions.classList.add('bg-primary');
        wrapper.classList.add('dark:text-white');
        listTemplate.classList.add('hover:bg-slate-200')
        listOfRecommendations.map(item => {
            const listItem = listTemplate.cloneNode(true);
            listItem.removeAttribute('id');
            listItem.textContent = `${item.first_name} ${item.last_name}`;
            listItem.addEventListener('click', () => {
                searchInput.value = `${item.first_name} ${item.last_name}`;
                searchSuggestions.innerHTML = '';
            });
            searchSuggestions.appendChild(listItem);
        });
    };

    const fetchData = async () => {
        const response = await fetch(`http://localhost:8000/searchCustomer`);
        const jsonData = await response.json();
        let value = searchInput.value;
        let recommendedList = [];
        if (value.length > 0) {
            recommendedList = jsonData.filter(item =>
                item.first_name.toLowerCase().includes(value.toLowerCase())
            );
        }
        showRecommendedList(recommendedList);
    };

    searchInput.addEventListener('keyup', fetchData);
});