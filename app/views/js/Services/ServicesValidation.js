document.addEventListener('DOMContentLoaded', function () {
    const submitButton = document.getElementById('openConfirmationModal');
    const inputIds = [
        'status',
        'category',
        'service_name',
        'service_caption',
        'service_description',
        'duration_details',
        'party_size_details',
        'main_photo_input',
        'showcase_photo_input',
        'showcase_headline_1',
        'showcase_caption_1',
        'showcase_photo_2_fileList',
        'showcase_headline_2',
        'showcase_caption_2',
        'showcase_photo_3_fileList',
        'showcase_headline_3',
        'showcase_caption_3',
        'price_type',
    ];

    function validateForm() {
        let isValid = true;
        inputIds.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                if (input.type === 'file') {
                    if (!input.files || input.files.length === 0) {
                        isValid = false;
                    }
                } else if (typeof input.value === 'string' && !input.value.trim()) {
                    isValid = false;
                }
            }
        });
        submitButton.disabled = !isValid;
    }

    inputIds.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', validateForm);
            input.addEventListener('change', validateForm);
        }
    });

    validateForm();
});