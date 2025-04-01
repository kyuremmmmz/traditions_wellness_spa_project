document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname !== '/employees') {
        return;
    }

    const table = document.getElementById('therapistTable'); // Keep as DOM element
    let filterBy = document.getElementById('filter_by');
    const fetchData = async () => {
        try {
            const response = await fetch('http://localhost:8000/getAllTherapist');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            const data = await response.json();
            console.log('Raw data:', data);
            renderTable(data);
        } catch (error) {
            console.error('Error fetching data:', error);
            table.innerHTML = '<tr><td colspan="5">Failed to load data</td></tr>';
        }
    };

    const fetchTherapistByStatus = async (status) => {
        const response = await fetch(`http://localhost:8000/getTherapistByStatus/${status}`);
        const data = await response.json();
        if (response.ok) {
            renderTable(data);
        }
    }

    document.addEventListener('change', function () {
        let filtered = filterBy.value.toString().toLowerCase();
        switch (filtered) {
            case 'all':
                fetchData();
                break;
            case 'active':
                fetchTherapistByStatus('active')
                break;
            case 'inactive':
                fetchTherapistByStatus('inactive');
                break;
            default:
                return
        }
    });

    // Javascript here
    const renderTable = (items) => {
        table.innerHTML = '';
        if (!Array.isArray(items) || items.length === 0) {
            table.innerHTML = '<tr><td colspan="5">No therapists found</td></tr>';
            return;
        }

        const html = items.map((data, index) => `
            <tr class="transition-colors duration-200 hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface cursor-pointer h-[40px] border-b border-border dark:border-darkBorder"
                data-id="${data.id || ''}"
                data-firstname="${data.first_name || ''}"
                data-lastname="${data.last_name || ''}"
                data-email="${data.email || ''}"
                data-gender="${data.gender || ''}"
                data-status="${data.status || ''}">
                <td class="pl-[48px] leading-none BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo truncate pr-[6px] text-center border-b border-border dark:border-darkBorder">${index + 1}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.first_name + ' ' + data.last_name || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.status || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.gender || 'N/A'}</td>
                <td class="px-[6px] leading-none BodyTwo text-onBackground dark:text-darkOnBackground truncate text-center border-b border-border dark:border-darkBorder">${data.email || 'No email'}</td>
            </tr>
        `).join('');
        table.innerHTML = html;

        // Add click event listeners to rows
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            row.addEventListener('click', () => openUpdateModal(row));
        });
        document.querySelectorAll('#therapistTable tr').forEach(row => {
            row.addEventListener('click', async () => {
                const data = row.dataset;
                document.getElementById('therapistFirstName').value = data.firstname;
                document.getElementById('therapistLastName').value = data.lastname;
                document.getElementById('therapistEmail').value = data.email;
                document.getElementById('therapistGender').innerHTML = `
                    <option value="${data.gender}" selected>${data.gender}</option>
                    <option value="${data.gender === 'male' ? 'female' : 'male'}">${data.gender === 'male' ? 'female' : 'male'}</option>
                `;
                document.getElementById('therapistStatus').innerHTML = `
                    <option value="${data.status}" selected>${data.status}</option>
                    <option value="${data.status === 'active' ? 'inactive' : 'active'}">${data.status === 'active' ? 'inactive' : 'active'}</option>
                `;
            });
        });

    };

    // Add modal functionality
    let hasUnsavedChanges = false;

    // Track changes in update form
    function trackUpdateFormChanges() {
        const updateForm = document.querySelector('form[action="/updateTherapist"]');
        const inputs = updateForm.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('change', () => {
                hasUnsavedChanges = true;
            });
            input.addEventListener('input', () => {
                hasUnsavedChanges = true;
            });
        });
    }

    // Modal elements
    const updateModal = document.getElementById('updateTherapistModal');
    const unsavedEditModal = document.getElementById('UnsavedEditTherapistModal');
    const deleteModal = document.getElementById('DeleteTherapistModal');
    const saveChangesModal = document.getElementById('SaveChangesTherapistModal');

    // Button elements
    const closeUpdateBtn = document.getElementById('closeUpdateModal');
    const openDeleteBtn = document.getElementById('openDeleteTherapistModal');
    const openSaveChangesBtn = document.getElementById('openSaveChangesTherapistModal');
    
    // Unsaved changes modal buttons
    const closeUnsavedEditBtn = document.getElementById('closeUnsavedEditTherapistButton');
    const proceedUnsavedEditBtn = document.getElementById('proceedUnsavedEditTherapistButton');
    
    // Delete modal buttons
    const closeDeleteBtn = document.getElementById('closeDeleteTherapistButton');
    const proceedDeleteBtn = document.getElementById('proceedDeleteTherapistButton');
    
    // Save changes modal buttons
    const cancelSaveChangesBtn = document.getElementById('cancelSaveChangesTherapistButton');
    const confirmSaveChangesBtn = document.getElementById('confirmSaveChangesTherapistButton');

    // Close update modal handler
    closeUpdateBtn.addEventListener('click', () => {
        if (hasUnsavedChanges) {
            unsavedEditModal.classList.remove('hidden');
        } else {
            closeUpdateModalWithAnimation();
        }
    });

    // Unsaved changes modal handlers
    closeUnsavedEditBtn.addEventListener('click', () => {
        unsavedEditModal.classList.add('hidden');
    });

    proceedUnsavedEditBtn.addEventListener('click', () => {
        unsavedEditModal.classList.add('hidden');
        resetUpdateForm();
        closeUpdateModalWithAnimation();
        hasUnsavedChanges = false;
    });

    // Delete modal handlers
    openDeleteBtn.addEventListener('click', () => {
        deleteModal.classList.remove('hidden');
    });

    closeDeleteBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });

    proceedDeleteBtn.addEventListener('click', async () => {
        try {
            const therapistId = document.getElementById('therapistId').value;
            const response = await fetch('/deleteTherapist', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: therapistId })
            });

            if (response.ok) {
                window.location.reload();
            } else {
                console.error('Failed to delete therapist');
            }
        } catch (error) {
            console.error('Error:', error);
        }
        deleteModal.classList.add('hidden');
    });

    // Save changes modal handlers
    openSaveChangesBtn.addEventListener('click', () => {
        saveChangesModal.classList.remove('hidden');
    });

    cancelSaveChangesBtn.addEventListener('click', () => {
        saveChangesModal.classList.add('hidden');
    });

    function closeUpdateModalWithAnimation() {
        const modalContent = updateModal.querySelector('div:first-child');
        updateModal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            updateModal.classList.add('hidden');
        }, 300);
    }

    function resetUpdateForm() {
        const form = document.querySelector('form[action="/updateTherapist"]');
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            if (input.type === 'select-one') {
                input.selectedIndex = 0;
            } else {
                input.value = input.defaultValue;
            }
        });
    }

    // Initialize change tracking when opening update modal
    function openUpdateModal(row) {
        const modal = document.getElementById('updateTherapistModal');
        const modalContent = modal.querySelector('div:first-child');

        // Reset unsaved changes flag
        hasUnsavedChanges = false;

        // Set form values
        document.getElementById('therapistId').value = row.getAttribute('data-id');
        document.getElementById('therapistFirstName').value = row.getAttribute('data-firstname');
        document.getElementById('therapistLastName').value = row.getAttribute('data-lastname');
        document.getElementById('therapistEmail').value = row.getAttribute('data-email');
        document.getElementById('therapistGender').value = row.getAttribute('data-gender');
        document.getElementById('therapistStatus').value = row.getAttribute('data-status');

        // Show modal with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);

        // Initialize change tracking
        trackUpdateFormChanges();
    }

    // Add event listeners for modal buttons
    document.getElementById('closeTherapistModal')?.addEventListener('click', closeModal);
    document.getElementById('cancelUpdateTherapist')?.addEventListener('click', closeModal);

    function closeModal() {
        const modal = document.getElementById('updateTherapistModal');
        const modalContent = modal.querySelector('div:first-child');
        
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    const formatDate = (date) => {
        return date ? new Date(date).toLocaleDateString() : 'N/A';
    };

    fetchData();

    // Javascript here
});