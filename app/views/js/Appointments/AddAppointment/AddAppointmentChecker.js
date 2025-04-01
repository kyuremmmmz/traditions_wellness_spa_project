document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const newGuestBtn = document.getElementById('newGuestCustomerButton');
    const existingBtn = document.getElementById('existingCustomerButton');
    const newGuestSection = document.getElementById('newGuestCustomerSection');
    const existingSection = document.getElementById('existingCustomerSection');
    const bookBtn = document.querySelector('.BookButton');
    const dateInput = document.querySelector('input[name="date"]');
    const timeInput = document.querySelector('input[name="start_time"]');
    const serviceSelect = document.querySelector('select[name="service_booked"]');
    const durationSelect = document.querySelector('select[name="duration"]');
    const finalTotalElement = document.getElementById('FinalTotal');
    const finalDurationMessageElement = document.getElementById('FinalDurationMessage');
    const finalEndTimeMessageElement = document.getElementById('FinalEndTimeMessage');
    
    // Initialize elements
    if (newGuestBtn && existingBtn) {
        if (newGuestBtn.checked) {
            newGuestSection.style.display = 'flex';
        } else if (existingBtn.checked) {
            existingSection.style.display = 'flex';
        }
        
        // Event listeners for customer type selection
        newGuestBtn.addEventListener('change', function() {
            if (this.checked) {
                newGuestSection.style.display = 'flex';
                existingSection.style.display = 'none';
            }
        });
        
        existingBtn.addEventListener('change', function() {
            if (this.checked) {
                existingSection.style.display = 'flex';
                newGuestSection.style.display = 'none';
            }
        });
    }
    
    // Handle appointment submission
    if (bookBtn) {
        bookBtn.addEventListener('click', function(e) {
            e.preventDefault();
            validateAndSubmit();
        });
    }
    
    // Function to validate form and show confirm modal
    function validateAndSubmit() {
        let isValid = true;
        const requiredFields = document.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        // Specific validation for date and time
        if (dateInput && timeInput && serviceSelect) {
            if (!dateInput.value || !timeInput.value || !serviceSelect.value) {
                isValid = false;
                
                if (!dateInput.value) dateInput.classList.add('border-red-500');
                if (!timeInput.value) timeInput.classList.add('border-red-500');
                if (!serviceSelect.value) {
                    const serviceDiv = document.querySelector('[id^="ServiceBooked"]');
                    if (serviceDiv) serviceDiv.classList.add('border-red-500');
                }
                
                alert('Please fill in all required fields including date, time, and service.');
                return;
            }
            
            // Validate availability
            checkAppointmentAvailability(dateInput.value, timeInput.value, serviceSelect.value);
        } else {
            if (isValid) {
                // Show confirmation modal if all fields are valid
                document.getElementById('ConfirmAppointmentModal').style.display = 'flex';
            } else {
                document.getElementById('FinalValidationMessage').innerHTML = 'Please fill in all required fields.';
            }
        }
    }
    
    // Function to check appointment availability
    function checkAppointmentAvailability(date, time, service) {
        const formData = new FormData();
        formData.append('date', date);
        formData.append('start_time', time);
        formData.append('service_booked', service);
        
        fetch('/checkAppointment', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                // Show confirmation modal if the slot is available
                document.getElementById('ConfirmAppointmentModal').style.display = 'flex';
            } else {
                alert(data.message || 'This time slot is not available. Please select a different time.');
                timeInput.classList.add('border-red-500');
            }
        })
        .catch(error => {
            console.error('Error checking appointment availability:', error);
            alert('An error occurred while checking appointment availability. Please try again.');
        });
    }
    
    // Event listener for cancel button in confirm modal
    const cancelBtn = document.getElementById('cancelAppointmentButton');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            document.getElementById('ConfirmAppointmentModal').style.display = 'none';
        });
    }
    
    // Event listener for confirm button in confirm modal
    const confirmBtn = document.getElementById('confirmAppointmentButton');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            document.getElementById('appointmentForm').submit();
        });
    }
    
    // Calculate duration and total price when relevant fields change
    function updateCalculations() {
        if (durationSelect && timeInput) {
            // Update duration message
            const durationValue = durationSelect.value || '1 Hour';
            if (finalDurationMessageElement) {
                finalDurationMessageElement.textContent = `The appointment will last for ${durationValue}.`;
            }
            
            // Calculate end time
            if (timeInput.value) {
                const startTime = new Date(`2000-01-01 ${timeInput.value}`);
                let durationMinutes = 60; // Default 1 hour
                
                if (durationValue.includes('30')) {
                    durationMinutes = 90; // 1.5 hours
                } else if (durationValue.includes('2')) {
                    durationMinutes = 120; // 2 hours
                }
                
                startTime.setMinutes(startTime.getMinutes() + durationMinutes);
                const endTime = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                if (finalEndTimeMessageElement) {
                    finalEndTimeMessageElement.textContent = `It will end at ${endTime}.`;
                }
            }
        }
        
        // Calculate total price
        let total = 1000; // Base price
        
        // Add service price
        if (serviceSelect && serviceSelect.value) {
            // Fetch service price from the server or from a data attribute if available
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const servicePrice = selectedOption && selectedOption.dataset ? 
                                (selectedOption.dataset.price || 0) : 0;
            total += parseInt(servicePrice, 10);
        }
        
        // Add party size price
        const partySizeSelect = document.querySelector('select[name="party_size"]');
        if (partySizeSelect && partySizeSelect.value) {
            if (partySizeSelect.value === 'Duo') {
                total += 800;
            } else if (partySizeSelect.value === 'Group') {
                total += 1500;
            }
        }
        
        // Add add-ons prices
        const addOnCheckboxes = document.querySelectorAll('input[type="checkbox"]');
        addOnCheckboxes.forEach(checkbox => {
            if (checkbox.checked && checkbox.name) {
                // Handle both old and new addon formats
                if (checkbox.name === 'hot_stone' || 
                    checkbox.name === 'swedish' || 
                    checkbox.name === 'deep_tissue' ||
                    checkbox.name.startsWith('addon_')) {
                    
                    const price = parseInt(checkbox.dataset.price || 0, 10);
                    total += price;
                    
                    // Create hidden input for the price if it doesn't exist
                    const formElement = document.getElementById('appointmentForm');
                    if (formElement) {
                        let hiddenInput = document.querySelector(`input[name="${checkbox.name}_price"]`);
                        if (!hiddenInput) {
                            hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = `${checkbox.name}_price`;
                            hiddenInput.value = price;
                            formElement.appendChild(hiddenInput);
                        }
                    }
                }
            }
        });
        
        // Update total display
        if (finalTotalElement) {
            finalTotalElement.textContent = `Total: ₱${total.toLocaleString()}`;
        }
    }
    
    // Add event listeners for fields that affect calculations
    if (durationSelect) {
        durationSelect.addEventListener('change', updateCalculations);
    }
    
    if (timeInput) {
        timeInput.addEventListener('change', updateCalculations);
    }
    
    if (serviceSelect) {
        serviceSelect.addEventListener('change', updateCalculations);
    }
    
    const partySizeSelect = document.querySelector('select[name="party_size"]');
    if (partySizeSelect) {
        partySizeSelect.addEventListener('change', updateCalculations);
    }
    
    const addOnCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    addOnCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCalculations);
    });
    
    // Initialize calculations on page load
    updateCalculations();
});