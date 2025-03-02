document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#search');
    const searchSuggestions = document.querySelector('#suggestions');
    const wrapper = document.querySelector('#wrapper');
    const list = document.querySelector('#li');
    const showRecommendedList = (ListOfRecommendations) => {
        searchSuggestions.innerHTML = '';
        
        searchSuggestions.classList.add('bg-primary')
        wrapper.classList.add('dark:text-white')
        ListOfRecommendations.map(item => {
            list.innerHTML = '';
            list.textContent = `${item.first_name} ${item.last_name}`
            list.addEventListener('click', () => {
                searchInput.value = `${item.first_name} ${item.last_name}`;
                searchSuggestions.innerHTML = '';
            });
            searchSuggestions.appendChild(list);
        })
    }

    const fetchData = async () => {
        const response = await fetch(`http://localhost:8000/searchCustomer`);
        const jsonData = await response.json();
        let value = searchInput.value;
        let recommendedList = []
        if (value.length>0) {
            recommendedList = jsonData.filter(item => item.first_name.toLowerCase().includes(value.toLowerCase()))
        }
        showRecommendedList(recommendedList);
    }
    searchInput.addEventListener('keyup', fetchData);
});