class AddNewServiceCategoryListener {
    constructor() {
        this.addOnSection = document.getElementById('addon_selection');
        this.massageSectionWrapper = document.getElementById('massage_selection_wrapper');
        this.bodyScrubSectionWrapper = document.getElementById('body_scrub_selection_wrapper');
        this.addOnSectionWrapper = document.getElementById('addon_selection_wrapper');
        this.categoryDropdown = document.getElementById('category');
        this.setupCategoryChangeListener();
    }

    setupCategoryChangeListener() {
        if (this.categoryDropdown && this.addOnSection) {
            this.categoryDropdown.addEventListener('change', () => {
                const selectedCategory = this.categoryDropdown.value;
                if (selectedCategory == 'Packages') {
                    this.addOnSectionWrapper.classList.add('hidden');
                    this.massageSectionWrapper.classList.remove('hidden');
                    this.bodyScrubSectionWrapper.classList.remove('hidden');
                } else if (selectedCategory == 'Body Scrubs') {
                    this.addOnSectionWrapper.classList.remove('hidden');
                    this.massageSectionWrapper.classList.remove('hidden');
                    this.bodyScrubSectionWrapper.classList.add('hidden');
                } else if (selectedCategory == "Massages") {
                    this.addOnSectionWrapper.classList.remove('hidden');
                    this.massageSectionWrapper.classList.add('hidden');
                    this.bodyScrubSectionWrapper.classList.add('hidden');
                }
            });
            const selectedCategory = this.categoryDropdown.value;
            if (selectedCategory == 'Packages') {
                this.addOnSectionWrapper.classList.add('hidden');
                this.massageSectionWrapper.classList.remove('hidden');
                this.bodyScrubSectionWrapper.classList.remove('hidden');
            } else if (selectedCategory == 'Body Scrubs') {
                this.addOnSectionWrapper.classList.remove('hidden');
                this.massageSectionWrapper.classList.remove('hidden');
                this.bodyScrubSectionWrapper.classList.add('hidden');
            } else if (selectedCategory == "Massages") {
                this.addOnSectionWrapper.classList.remove('hidden');
                this.massageSectionWrapper.classList.add('hidden');
                this.bodyScrubSectionWrapper.classList.add('hidden');
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new AddNewServiceCategoryListener();
});