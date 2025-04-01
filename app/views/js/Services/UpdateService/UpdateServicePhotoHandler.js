const PhotoHandler = {
    handleServicePhotos(serviceData, form) {
        this.resetPhotoDisplays(form);
        
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
    },
    
    displayPhotoFilename(fieldName, photoUrl, form) {
        if (!photoUrl) return;
                
        const existingFileItem = form.querySelector(`[name="${fieldName}_current"]`);
        if (existingFileItem) {
            return;
        }
        
        let fileInput = form.querySelector(`[name="${fieldName}"]`);
        
        const fileName = this.getFileNameFromUrl(photoUrl);
        
        let fileListContainer = null;
        let placeholder = null;
        
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
        
        if (!placeholder) {
            placeholder = fileListContainer.querySelector('[id$="_placeholder"]');
        }

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
    
    displaySlideshowFilenames(photosString, form) {
        if (!photosString) return;
        
        
        let fileInput = form.querySelector('[name="update_slideshow_photos[]"]');
        
        let fileListContainer = null;
        let addButton = null;
        
        fileListContainer = document.getElementById('slideshow_update_slideshow_photos_fileList');
        addButton = document.getElementById('slideshow_update_slideshow_photos_addButton');
        
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
        
        if (!addButton) {
            addButton = fileListContainer.querySelector('button');
        }

        let photoUrls = [];
        try {
            photoUrls = JSON.parse(photosString);
        } catch (e) {
            photoUrls = photosString.split(',').map(url => url.trim()).filter(url => url);
        }
        
        if (photoUrls.length === 0) return;
        
        let fileCount = 0;
        photoUrls.forEach(url => {
            if (!url) return;
            
            const fileName = this.getFileNameFromUrl(url);
            fileCount++;
            
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] px-[12px] h-[40px]';
            fileItem.innerHTML = `
                <span class='truncate BodyTwo text-onBackground dark:text-darkOnBackground'>${fileName}</span>
                <button type='button' class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:text-destructive dark:hover:text-destructive ml-[8px]'>×</button>
                <input type="hidden" name="existing_slideshow_photos[]" value="${url}">
            `;
            
            const removeButton = fileItem.querySelector('button');
            removeButton.addEventListener('click', () => {
                fileListContainer.removeChild(fileItem);
                fileCount--;
                updateAddButton();
            });
            
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
            
            const remainingRequired = Math.max(0, minFiles - fileCount);
            
            addButton.style.display = fileCount >= maxFiles ? 'none' : 'flex';
            
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
    
    getFileNameFromUrl(url) {
        if (!url) return 'unknown';
        
        const urlWithoutParams = url.split('?')[0];
        
        const pathParts = urlWithoutParams.split('/');
        let fileName = pathParts[pathParts.length - 1];
        
        if (fileName.length > 25) {
            const extension = fileName.split('.').pop();
            fileName = fileName.substring(0, 20) + '...' + (extension ? '.' + extension : '');
        }
        
        return fileName || 'unknown';
    },
    
    resetPhotoDisplays(form) {
        const fileInputs = form.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(fileInput => {
            let container = fileInput.closest('.relative');
            if (!container) return;
            
            const fileList = container.querySelector('[id$="_fileList"]');
            if (!fileList) return;
            
            const placeholder = fileList.querySelector('[id$="_placeholder"]');
            
            Array.from(fileList.children).forEach(child => {
                if (placeholder && child !== placeholder) {
                    child.remove();
                } else if (!placeholder && child.classList.contains('flex') && 
                           !child.id?.includes('addButton')) {
                    child.remove();
                }
            });
            
            if (placeholder) {
                placeholder.classList.remove('hidden');
            }
        });
        
        const currentInputs = form.querySelectorAll('[name$="_current"]');
        currentInputs.forEach(input => input.remove());
        
        const existingSlideShowInputs = form.querySelectorAll('[name="existing_slideshow_photos[]"]');
        existingSlideShowInputs.forEach(input => input.remove());
    }
};

// Export the handler for external use
window.PhotoHandler = PhotoHandler;