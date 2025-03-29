const NewAddOnValidation = {
    validateForm() {
    const form = document.getElementById('newAddOnForm');
    const name = form.querySelector('[name="name"]');
    const price = form.querySelector('[name="price"]');
    
    const isNameValid = this.validateName(name);
    const isPriceValid = this.validatePrice(price);

    console.log("Name Valid:", isNameValid);
    console.log("Price Valid:", isPriceValid);
    
    return isNameValid && isPriceValid;
    },

    validateName(nameInput) {
        const errorElement = document.getElementById('name_error');
        errorElement.textContent = '';

        if (!nameInput.value.trim()) {
            errorElement.textContent = 'Name is required';
            return false;
        }
        if (nameInput.value.length < 3) {
            errorElement.textContent = 'Name must be at least 3 characters';
            return false;
        }
        if (nameInput.value.length > 20) {
            errorElement.textContent = 'Name must not exceed 20 characters';
            return false;
        }
        return true;
    },

    validatePrice(priceInput) {
        const errorElement = document.getElementById('price_error');
        errorElement.textContent = '';

        const priceValue = priceInput.value.trim();

        if (!priceValue) {
            errorElement.textContent = 'Price is required';
            return false;
        }

        if (/^0\d+/.test(priceValue)) {
            errorElement.textContent = 'Price must not have leading zeros';
            return false;
        }

        const parsedPrice = parseFloat(priceValue);

        if (isNaN(parsedPrice) || parsedPrice < 0) {
            errorElement.textContent = 'Price must be a positive number';
            return false;
        }

        if (parsedPrice > 1000) {
            errorElement.textContent = 'Price must not exceed 1000';
            return false;
        }

        return true;
    }
};

window.NewAddOnValidation = NewAddOnValidation;