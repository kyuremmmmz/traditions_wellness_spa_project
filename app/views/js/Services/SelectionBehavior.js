class SelectionBehavior {
    constructor() {
        this.categoryDropdown = document.querySelector('select[name="category"]');
        this.massageSelection = document.getElementById('massage_selection');
        this.bodyScrubSelection = document.getElementById('body_scrub_selection');
        
        this.init();
    }

    init() {
        if (this.categoryDropdown) {
            this.updateSelections(this.categoryDropdown.value);
            this.categoryDropdown.addEventListener('change', (e) => {
                this.updateSelections(e.target.value);
            });
        }
    }

    updateSelections(category) {
        switch(category) {
            case 'Massages':
                this.massageSelection.style.display = 'none';
                this.bodyScrubSelection.style.display = 'none';
                break;
            case 'Body Scrubs':
                this.massageSelection.style.display = 'none';
                this.bodyScrubSelection.style.display = 'flex';
                break;
            case 'Packages':
                this.massageSelection.style.display = 'flex';
                this.bodyScrubSelection.style.display = 'flex';
                break;
            default:
                this.massageSelection.style.display = 'flex';
                this.bodyScrubSelection.style.display = 'flex';
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new SelectionBehavior();
});