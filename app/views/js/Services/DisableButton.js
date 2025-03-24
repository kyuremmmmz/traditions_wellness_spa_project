document.addEventListener('DOMContentLoaded', function () { 
    let massageSelection = document.getElementById('massage_selection');
    let category = document.getElementById('category');

    const disableAll = () => {
        if (category.value === 'Body Scrubs') {
            massageSelection.classList.add('opacity-30 cursor-not-allowed');
        }
    }

    disableAll();
 });