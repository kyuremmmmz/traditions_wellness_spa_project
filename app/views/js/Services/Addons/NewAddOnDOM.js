const NewAddOnDOM = {
    elements: {
        form: () => document.getElementById('newAddOnForm'),
        confirmModal: () => document.getElementById('ConfirmNewAddOnModal'),
        unsavedModal: () => document.getElementById('UnsavedNewAddOnModal'),
        cancelConfirmModal: () => document.getElementById('cancelConfirmNewAddOn'),
        proceedConfirmModal: () => document.getElementById('proceedConfirmNewAddOn'),
        cancelUpdateModal: () => document.getElementById('cancelUnsavedNewAddOn'),
        proceedUpdateModal: () => document.getElementById('proceedUnsavedNewAddOn'),
        closeButton: () => document.getElementById('exitNewAddOn'),
        drawer: () => document.getElementById('AddANewAddOnSection')
    },

        isDirty: false,

    handlers: {
        submit(e) {
            e.preventDefault();
            if (window.NewAddOnValidation.validateForm()) {
                NewAddOnDOM.openConfirmationDialog();
            }
        },

        cancel() {
            NewAddOnDOM.closeConfirmationDialog();
        },

        proceed() {
            NewAddOnDOM.elements.form().submit();
        },

        close() {
            if (NewAddOnDOM.hasUnsavedChanges()) {
                NewAddOnDOM.openUnsavedChangesModal();
            } else {
                NewAddOnDOM.closeDrawer();
            }
        },

        cancelUnsavedChanges() {
            NewAddOnDOM.closeUnsavedChangesModal();
        },

        proceedUnsavedChanges() {
            NewAddOnDOM.resetFieldsToEmpty();
            NewAddOnDOM.closeDrawer();
            NewAddOnDOM.closeUnsavedChangesModal();
        }
    },

    init() {
        const { form, cancelConfirmModal, proceedConfirmModal, closeButton, cancelUpdateModal, proceedUpdateModal } = this.elements;

        form().addEventListener('submit', this.handlers.submit);
        cancelConfirmModal().addEventListener('click', this.handlers.cancel);
        proceedConfirmModal().addEventListener('click', this.handlers.proceed);
        closeButton().addEventListener('click', this.handlers.close);

        cancelUpdateModal().addEventListener('click', this.handlers.cancelUnsavedChanges);
        proceedUpdateModal().addEventListener('click', this.handlers.proceedUnsavedChanges);

        this.attachInputChangeListeners();
    },

    openConfirmationDialog() {
        this.elements.confirmModal().classList.remove('hidden');
    },

    closeConfirmationDialog() {
        this.elements.confirmModal().classList.add('hidden');
    },

    closeDrawer() {
        this.elements.drawer().classList.add("translate-x-full");
    },

    openUnsavedChangesModal() {
        this.elements.unsavedModal().classList.remove('hidden');
    },

    closeUnsavedChangesModal() {
        this.elements.unsavedModal().classList.add('hidden');
    },

    hasUnsavedChanges() {
        return this.isDirty;
    },

    attachInputChangeListeners() {
        const inputs = this.elements.form()?.querySelectorAll('input, textarea, select') || [];
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                this.isDirty = true;
            });
        });
    },

    resetFieldsToEmpty() {
        const inputs = this.elements.form()?.querySelectorAll('input, textarea') || [];
        inputs.forEach(input => input.value = '');
        this.isDirty = false;
    }
};

document.addEventListener('DOMContentLoaded', () => {
    NewAddOnDOM.init();
});

window.NewAddOnDOM = NewAddOnDOM;