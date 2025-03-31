/**
 * PhotoHandler.js - Handles photo-related operations for service forms
 * Works with your existing Tailwind-styled file inputs
 */

const PhotoHandler = {
    /**
     * Initialize the photo handler
     */
    init() {
        console.log('Photo handler initialized');
    },

    /**
     * Handle all photos for a service when populating form
     * @param {Object} serviceData - The service data containing photo URLs
     * @param {HTMLFormElement} form - The form element
     */
    handleServicePhotos(serviceData, form) {
        // Reset all photo displays before handling new service photos
        this.resetPhotoDisplays(form);
        
        console.log('PhotoHandler: Handling photos with data:', serviceData);
        
        // Log all the file inputs we can find to help debugging
        const fileInputs = form.querySelectorAll('input[type="file"]');
        console.log('PhotoHandler: Found file inputs:', Array.from(fileInputs).map(input => input.name || input.id));
        
        // Handle main photo (try different property names)
        const mainPhoto = serviceData.mainPhoto || serviceData.main_photo;
        if (mainPhoto) {
            this.displayPhotoFilename('update_main_photo', mainPhoto, form);
        }
        
        // Handle showcase photos (try different property names)
        const showcasePhoto1 = serviceData.showcasePhoto1 || serviceData.showcase_photo1;
        const showcasePhoto2 = serviceData.showcasePhoto2 || serviceData.showcase_photo2;
        const showcasePhoto3 = serviceData.showcasePhoto3 || serviceData.showcase_photo3;
        
        if (showcasePhoto1) this.displayPhotoFilename('update_showcase_photo1', showcasePhoto1, form);
        if (showcasePhoto2) this.displayPhotoFilename('update_showcase_photo2', showcasePhoto2, form);
        if (showcasePhoto3) this.displayPhotoFilename('update_showcase_photo3', showcasePhoto3, form);
        
        const slideshowPhotos = serviceData.slideShowPhotos || serviceData.slide_show_photos;
        if (slideshowPhotos && slideshowPhotos !== 'No files uploaded') {
            this.displaySlideshowFilenames(slideshowPhotos, form);
        }

        // Add this in the handleServicePhotos method, right before handling slideshow photos
        console.log('SLIDESHOW DATA CHECK:', {
            slideShowPhotos: serviceData.slideShowPhotos,
            slide_show_photos: serviceData.slide_show_photos,
            originalString: typeof serviceData.slideShowPhotos === 'string' ? serviceData.slideShowPhotos : 'not a string',
            dataType: typeof serviceData.slideShowPhotos
        });
    },
    
    /**
     * Display a filename for a photo input field, matching your existing UI
     * @param {string} fieldName - The name of the file input field
     * @param {string} photoUrl - The URL of the photo
     * @param {HTMLFormElement} form - The form element
     */
    displayPhotoFilename(fieldName, photoUrl, form) {
        if (!photoUrl) return;
        
        console.log(`PhotoHandler: Setting filename display for ${fieldName} with ${photoUrl}`);
        
        // First check if a filename is already displayed for this field
        // This prevents duplicates
        const existingFileItem = form.querySelector(`[name="${fieldName}_current"]`);
        if (existingFileItem) {
            console.log(`PhotoHandler: File already displayed for ${fieldName}, skipping`);
            return;
        }
        
        // Find the file input element - try both by name and ID
        let fileInput = form.querySelector(`[name="${fieldName}"]`);
        if (!fileInput) {
            fileInput = document.getElementById(`${fieldName}_input`);
        }
        
        if (!fileInput) {
            console.warn(`PhotoHandler: File input ${fieldName} not found by name or ID`);
            
            // Try to find any file input that might match our field
            const possibleInputs = form.querySelectorAll('input[type="file"]');
            console.log(`PhotoHandler: Available file inputs:`, 
                Array.from(possibleInputs).map(input => ({name: input.name, id: input.id})));
            return;
        }
        
        // Extract filename from URL
        const fileName = this.getFileNameFromUrl(photoUrl);
        
        // Find the file list container near this input
        let fileListContainer = null;
        let placeholder = null;
        
        // First check if the input has an ID we can use to find the container
        if (fileInput.id) {
            const idBase = fileInput.id.replace('_input', '');
            fileListContainer = document.getElementById(`${idBase}_fileList`);
            placeholder = document.getElementById(`${idBase}_placeholder`);
        }
        
        // If we couldn't find it that way, try looking up the DOM tree
        if (!fileListContainer) {
            // Look for fileList div by traversing up the DOM
            let parent = fileInput.parentElement;
            while (parent && !fileListContainer) {
                fileListContainer = parent.querySelector('[id$="_fileList"]');
                if (!fileListContainer) {
                    parent = parent.parentElement;
                }
            }
        }
        
        // If we still don't have it, try looking for any nearby containers
        if (!fileListContainer) {
            // Find the outer container that might have the fileList
            const container = fileInput.closest('.relative') || fileInput.parentElement;
            if (container) {
                fileListContainer = container.querySelector('[id$="_fileList"]');
                placeholder = container.querySelector('[id$="_placeholder"]');
            }
        }
        
        if (!fileListContainer) {
            console.warn(`PhotoHandler: Could not find file list container for ${fieldName}`);
            return;
        }
        
        if (!placeholder) {
            // Try to find the placeholder in the fileListContainer
            placeholder = fileListContainer.querySelector('[id$="_placeholder"]');
        }
        
        console.log(`PhotoHandler: Found container:`, fileListContainer);
        console.log(`PhotoHandler: Found placeholder:`, placeholder);
        
        // Hide the placeholder if found
        if (placeholder) {
            placeholder.classList.add('hidden');
        }
        
        // Create file item element using your existing UI pattern
        const fileItem = document.createElement('div');
        fileItem.className = 'flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] px-[12px] h-[40px]';
        fileItem.innerHTML = `
            <span class='BodyTwo text-onBackground dark:text-darkOnBackground truncate'>${fileName}</span>
            <button type='button' class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:text-destructive dark:hover:text-destructive ml-[8px]'>×</button>
            <input type="hidden" name="${fieldName}_current" value="${photoUrl}">
        `;
        
        // Add remove functionality
        const removeButton = fileItem.querySelector('button');
        removeButton.addEventListener('click', () => {
            fileListContainer.removeChild(fileItem);
            if (placeholder) {
                placeholder.classList.remove('hidden');
            }
            // Remove current value
            const currentInput = form.querySelector(`[name="${fieldName}_current"]`);
            if (currentInput && currentInput !== fileItem.querySelector('input[type="hidden"]')) {
                currentInput.remove();
            }
        });
        
        // Add to the DOM
        fileListContainer.appendChild(fileItem);
    },
    
    /**
     * Display filenames for slideshow photos, matching your existing UI
     * @param {string} photosString - Comma-separated list or JSON string of photo URLs
     * @param {HTMLFormElement} form - The form element
     */
    displaySlideshowFilenames(photosString, form) {
        if (!photosString) return;
        
        console.log(`PhotoHandler: Setting up slideshow filename displays with ${photosString}`);
        
        // Find the file input for slideshow photos
        let fileInput = form.querySelector('[name="update_slideshow_photos[]"]');
        if (!fileInput) {
            // Try to find by ID pattern
            fileInput = document.getElementById('slideshow_update_slideshow_photos_input');
        }
        
        if (!fileInput) {
            console.warn('PhotoHandler: Slideshow photos input not found');
            
            // Log all file inputs for debugging
            const allFileInputs = form.querySelectorAll('input[type="file"]');
            console.log('PhotoHandler: All file inputs:', 
                Array.from(allFileInputs).map(input => ({name: input.name, id: input.id})));
            return;
        }
        
        // Find the file list container - try different approaches
        let fileListContainer = null;
        let addButton = null;
        
        // First try by ID
        fileListContainer = document.getElementById('slideshow_update_slideshow_photos_fileList');
        addButton = document.getElementById('slideshow_update_slideshow_photos_addButton');
        
        // If that fails, try traversing up the DOM
        if (!fileListContainer) {
            let parent = fileInput.parentElement;
            while (parent && !fileListContainer) {
                fileListContainer = parent.querySelector('[id$="_fileList"]');
                addButton = parent.querySelector('[id$="_addButton"]');
                if (!fileListContainer) {
                    parent = parent.parentElement;
                }
            }
        }
        
        if (!fileListContainer) {
            console.warn('PhotoHandler: Slideshow file list container not found');
            return;
        }
        
        if (!addButton) {
            // Try to find the add button in the fileListContainer
            addButton = fileListContainer.querySelector('button');
        }
        
        console.log('PhotoHandler: Found slideshow container:', fileListContainer);
        console.log('PhotoHandler: Found add button:', addButton);
        
        // Parse the photos - might be comma-separated or JSON
        let photoUrls = [];
        try {
            // Try parsing as JSON first
            photoUrls = JSON.parse(photosString);
        } catch (e) {
            // If not JSON, try comma-separated
            photoUrls = photosString.split(',').map(url => url.trim()).filter(url => url);
        }
        
        if (photoUrls.length === 0) return;
        
        // Add each photo filename
        let fileCount = 0;
        photoUrls.forEach(url => {
            if (!url) return;
            
            const fileName = this.getFileNameFromUrl(url);
            fileCount++;
            
            // Create file item element using your existing UI pattern
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] px-[12px] h-[40px]';
            fileItem.innerHTML = `
                <span class='truncate BodyTwo text-onBackground dark:text-darkOnBackground'>${fileName}</span>
                <button type='button' class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:text-destructive dark:hover:text-destructive ml-[8px]'>×</button>
                <input type="hidden" name="existing_slideshow_photos[]" value="${url}">
            `;
            
            // Add remove functionality
            const removeButton = fileItem.querySelector('button');
            removeButton.addEventListener('click', () => {
                fileListContainer.removeChild(fileItem);
                fileCount--;
                updateAddButton();
            });
            
            // Add to the DOM before the add button
            if (addButton && addButton.parentNode === fileListContainer) {
                fileListContainer.insertBefore(fileItem, addButton);
            } else {
                fileListContainer.appendChild(fileItem);
            }
        });
        
        // Update add button visibility based on file count
        function updateAddButton() {
            if (!addButton) return;
            
            const maxFiles = 5;
            const minFiles = 2;
            
            // Calculate remaining required files - THIS LINE WAS MISSING THE VARIABLE DECLARATION
            const remainingRequired = Math.max(0, minFiles - fileCount);
            
            addButton.style.display = fileCount >= maxFiles ? 'none' : 'flex';
            
            // Update remaining required text if needed
            const span = addButton.querySelector('span');
            
            if (span) {
                const originalText = span.getAttribute('data-original-text') || span.textContent;
                span.setAttribute('data-original-text', originalText);
                
                const buttonText = remainingRequired > 0 
                    ? `${originalText} (${remainingRequired} more required)`
                    : fileCount >= maxFiles 
                        ? ''
                        : originalText;
                
                span.textContent = buttonText;
            }
        }
        
        updateAddButton();
    },
    
    /**
     * Extract a filename from a URL
     * @param {string} url - The URL to extract filename from
     * @returns {string} The extracted filename
     */
    getFileNameFromUrl(url) {
        if (!url) return 'unknown';
        
        // Remove query parameters
        const urlWithoutParams = url.split('?')[0];
        
        // Extract filename from path
        const pathParts = urlWithoutParams.split('/');
        let fileName = pathParts[pathParts.length - 1];
        
        // If filename is too long, truncate it
        if (fileName.length > 25) {
            const extension = fileName.split('.').pop();
            fileName = fileName.substring(0, 20) + '...' + (extension ? '.' + extension : '');
        }
        
        return fileName || 'unknown';
    },
    
    /**
     * Reset all photo displays
     * @param {HTMLFormElement} form - The form element
     */
    resetPhotoDisplays(form) {
        // Get all file inputs
        const fileInputs = form.querySelectorAll('input[type="file"]');
        
        // Reset each file input area
        fileInputs.forEach(fileInput => {
            // Find the file list container
            let container = fileInput.closest('.relative');
            if (!container) return;
            
            // Find the file list and placeholder
            const fileList = container.querySelector('[id$="_fileList"]');
            if (!fileList) return;
            
            const placeholder = fileList.querySelector('[id$="_placeholder"]');
            
            // Remove all file items (non-placeholder elements)
            Array.from(fileList.children).forEach(child => {
                if (placeholder && child !== placeholder) {
                    child.remove();
                } else if (!placeholder && child.classList.contains('flex') && 
                           !child.id?.includes('addButton')) {
                    child.remove();
                }
            });
            
            // Show placeholder
            if (placeholder) {
                placeholder.classList.remove('hidden');
            }
        });
        
        // Remove any hidden current photo inputs
        const currentInputs = form.querySelectorAll('[name$="_current"]');
        currentInputs.forEach(input => input.remove());
        
        const existingSlideShowInputs = form.querySelectorAll('[name="existing_slideshow_photos[]"]');
        existingSlideShowInputs.forEach(input => input.remove());
    }
};

// Initialize the photo handler when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    PhotoHandler.init();
});

// Export the handler for external use
window.PhotoHandler = PhotoHandler;