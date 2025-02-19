document.addEventListener('DOMContentLoaded', function () {
    const listData = document.getElementById('test');
    
    const fetchData = async () => {
        const response = await fetch('http://localhost:8000/store');
        const jsonData = await response.json();
        if (jsonData.data && Array.isArray(jsonData.data)) {
            console.log(jsonData);
            renderData(jsonData.data);
        }
    };
    const renderData = (data) => {
        listData.innerHTML = "";
        data.map((item) => {
            listData.innerHTML += `<li class="text-white">${item.category}</li>`;
        })
    }
    fetchData();
});
