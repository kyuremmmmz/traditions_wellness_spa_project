<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ImgUploadButton
{
    public static function render(?string $className = null): void
    {
        echo '<div class="relative group">';
        echo '  <label for="imgUpload" id="imgUploadLabel" class="w-[128px] h-[128px] mt-[90px] bg-background dark:bg-darkBackground rounded-full hover:bg-secondary dark:hover:bg-darkSecondary border-[2px] border-border dark:border-darkBorder flex justify-center items-center cursor-pointer overflow-hidden relative">';
        echo '      <img id="profilePreview" src="" alt="Profile Picture" class="absolute top-0 left-0 hidden object-cover w-full h-full rounded-full"/>';
        
        // Upload icon container (visible by default, hidden after image upload, reappears on hover)
        echo '      <div id="uploadIconContainer" class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 rounded-full opacity-100 group-hover:opacity-100">';
        IconChoice::render('uploadBig', '[24px]', '[24px]', '', '[primary]', '[darkPrimary]');
        echo '      </div>';

        echo '  </label>';
        echo '  <input type="file" id="imgUpload" name="imgUpload" class="hidden" accept="image/*" />';
        echo '</div>';

        // JavaScript to handle image preview and icon behavior
        // JavaScript to handle image preview and icon behavior
        echo '<script>
        document.getElementById("imgUpload").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById("profilePreview");
                    const iconContainer = document.getElementById("uploadIconContainer");
                    const uploadLabel = document.getElementById("imgUploadLabel");

                    preview.src = e.target.result;
                    preview.classList.remove("hidden");

                    // Hide the upload icon initially
                    iconContainer.style.opacity = "0";

                    // Activate hover effect only after an image is uploaded
                    uploadLabel.addEventListener("mouseenter", function() {
                        iconContainer.style.opacity = "1";
                    });

                    uploadLabel.addEventListener("mouseleave", function() {
                        iconContainer.style.opacity = "0";
                    });
                };
                reader.readAsDataURL(file);
            }
        });
        </script>';
        echo '<script>
            document.getElementById("imgUpload").addEventListener("change", function(event) {
                const file = event.target.files[0];

                if (file) {
                    const maxSize = 500 * 1024; // 500KB limit
                    const allowedTypes = ["image/jpeg", "image/jpg"];

                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        alert("Only JPG files are allowed.");
                        event.target.value = ""; // Reset input
                        return;
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        alert("File is too large! Please upload an image smaller than 500KB.");
                        event.target.value = ""; // Reset input
                        return;
                    }

                    // Convert to Base64 if valid
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("profilePreview").src = e.target.result;
                        document.getElementById("profilePreview").classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>';
    }
}