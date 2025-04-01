const UpdateAddOnDOM = {
    elements: {
        form: () => document.getElementById('UpdateAddOnForm'),
        // Openers
        openConfirmUpdate: () => document.getElementById('openConfirmUpdateAddOnModal'),
        openUnsavedChanges: () => document.getElementById('openUnsavedUpdateAddOnModal'),
        openDelete: () => document.getElementById('openDeleteUpdateAddOnModal'),
        // Modals
        confirmModal: () => document.getElementById('ConfirmUpdateAddOnModal'),
        unsavedModal: () => document.getElementById('UnsavedUpdateAddOnModal'),
        deleteModal: () => document.getElementById('DeleteUpdateAddOnModal'),
        // Confirmation buttons
        cancelConfirm: () => document.getElementById('cancelUpdateAddOn'),
        proceedConfirm: () => document.getElementById('proceedUpdateAddOn'),
        // Unsaved changes buttons
        cancelUnsaved: () => document.getElementById('cancelUnsavedUpdateAddOn'),
        proceedUnsaved: () => document.getElementById('proceedUnsavedUpdateAddOn'),
        // Delete buttons
        cancelDelete: () => document.getElementById('cancelDeleteUpdateAddOn'),
        proceedDelete: () => document.getElementById('proceedDeleteUpdateAddOn'),
        // Close button
        closeButton: () => document.getElementById('exitUpdateAddOn'),
        drawer: () => document.getElementById('UpdateAddOnSection')
    },

    isDirty: false,

    handlers: {
        submit(e) {
            e.preventDefault();
            if (window.UpdateAddOnValidation.validateForm()) {
                UpdateAddOnDOM.openConfirmationDialog();
            }
        },

        cancel() {
            UpdateAddOnDOM.closeConfirmationDialog();
        },

        proceed() {
            UpdateAddOnDOM.elements.form().submit();
        },

        close() {
            if (UpdateAddOnDOM.hasUnsavedChanges()) {
                UpdateAddOnDOM.openUnsavedChangesModal();
            } else {
                UpdateAddOnDOM.closeDrawer();
            }
        },

        cancelUnsavedChanges() {
            UpdateAddOnDOM.closeUnsavedChangesModal();
        },

        proceedUnsavedChanges() {
            UpdateAddOnDOM.resetFieldsToEmpty();
            UpdateAddOnDOM.closeDrawer();
            UpdateAddOnDOM.closeUnsavedChangesModal();
        },

        cancelDelete() {
            UpdateAddOnDOM.closeDeleteModal();
        },

        proceedDelete() {
            const form = UpdateAddOnDOM.elements.form();
            const addonId = form?.querySelector('input[name="update_addon_id"]')?.value;
        
            fetch('http://localhost:8000/deleteAddOn', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ addon_id: addonId })
            })
            .then(() => location.reload())
            .catch(error => console.error("Error deleting add-on:", error));
        },
        
        openUnsavedChanges() {
            UpdateAddOnDOM.openUnsavedChangesModal();
        },

        openDelete() {
            UpdateAddOnDOM.openDeleteModal();
        }
    },

    init() {
        const { 
            form, cancelConfirm, proceedConfirm, closeButton, 
            cancelUnsaved, proceedUnsaved, cancelDelete, proceedDelete,
            openConfirmUpdate, openUnsavedChanges, openDelete
        } = this.elements;

        form()?.addEventListener('submit', this.handlers.submit);
        cancelConfirm()?.addEventListener('click', this.handlers.cancel);
        proceedConfirm()?.addEventListener('click', this.handlers.proceed);
        closeButton()?.addEventListener('click', this.handlers.close);
        cancelUnsaved()?.addEventListener('click', this.handlers.cancelUnsavedChanges);
        proceedUnsaved()?.addEventListener('click', this.handlers.proceedUnsavedChanges);
        cancelDelete()?.addEventListener('click', this.handlers.cancelDelete);
        proceedDelete()?.addEventListener('click', this.handlers.proceedDelete);

        // Modal openers
        openConfirmUpdate()?.addEventListener('click', this.handlers.openConfirmUpdate);
        openUnsavedChanges()?.addEventListener('click', this.handlers.openUnsavedChanges);
        openDelete()?.addEventListener('click', this.handlers.openDelete);
        
        this.attachInputChangeListeners();
    },

    openConfirmationDialog() {
        this.elements.confirmModal()?.classList.remove('hidden');
    },

    closeConfirmationDialog() {
        this.elements.confirmModal()?.classList.add('hidden');
    },

    closeDrawer() {
        this.elements.drawer()?.classList.add("translate-x-full");
        this.elements.drawer()?.classList.remove("translate-x-0");
    },

    openUnsavedChangesModal() {
        this.elements.unsavedModal()?.classList.remove('hidden');
    },

    closeUnsavedChangesModal() {
        this.elements.unsavedModal()?.classList.add('hidden');
    },

    openDeleteModal() {
        this.elements.deleteModal()?.classList.remove('hidden');
    },

    closeDeleteModal() {
        this.elements.deleteModal()?.classList.add('hidden');
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
    }
};

document.addEventListener('DOMContentLoaded', () => {
    UpdateAddOnDOM.init();
});

window.UpdateAddOnDOM = UpdateAddOnDOM;
