<?php

namespace Project\App\Controllers\Web\UseCases;

class ReusablesController
{
    /**
     * Calculate the end time based on start time and duration
     * 
     * @param string $startTime Start time in H:i:s format
     * @param array $file POST data containing duration information
     * @return string End time in H:i:s format
     */
    public function durationCalculation($startTime, $file)
    {
        // Default to 1 hour if duration not set
        $durationMinutes = 60;
        
        if (isset($file['duration'])) {
            if ($file['duration'] == '1 Hour') {
                $durationMinutes = 60;
            } elseif ($file['duration'] == '1 Hour and 30 minutes') {
                $durationMinutes = 90;
            } elseif ($file['duration'] == '2 Hours') {
                $durationMinutes = 120;
            } else {
                // Try to parse numeric value if it's just minutes
                $numericDuration = (int) preg_replace('/[^0-9]/', '', $file['duration']);
                if ($numericDuration > 0) {
                    $durationMinutes = $numericDuration;
                }
            }
        }
        
        // Parse the start time
        $startDateTime = \DateTime::createFromFormat('H:i:s', $startTime);
        if (!$startDateTime) {
            // Try alternate format if the standard format fails
            $startDateTime = \DateTime::createFromFormat('h:i A', $startTime);
            if (!$startDateTime) {
                // If all parsing fails, default to current time
                $startDateTime = new \DateTime();
            }
        }
        
        // Add the duration
        $startDateTime->modify("+{$durationMinutes} minutes");
        
        // Return in the correct format for MySQL TIME field
        return $startDateTime->format('H:i:s');
    }

    /**
     * Calculate the total price based on party size
     * 
     * @param int $basePrice Base price of the service
     * @param string $partySize Party size (Solo, Duo, Group)
     * @return int Calculated price
     */
    public function priceCalculation($basePrice, $partySize)
    {
        if ($partySize == 'Solo') {
            return $basePrice;
        } elseif ($partySize == 'Duo') {
            return $basePrice + 800; // Solo + 800
        } elseif ($partySize == 'Group') {
            return $basePrice + 1500; // Solo + 1500
        } else {
            // Try to parse numeric value if it's not a standard size
            $numericSize = (int) $partySize;
            if ($numericSize > 1) {
                return $basePrice * $numericSize; // Base price * number of people
            }
            return $basePrice; // Default to base price
        }
    }

    /**
     * Process add-ons from form data
     * 
     * @param array $file POST data containing add-on information
     * @return string Comma-separated list of selected add-ons
     */
    public function addOns($file)
    {
        $addOns = [];
        
        // Check for standard add-ons
        if (isset($file['hot_stone']) && $file['hot_stone'] > 0) {
            $addOns[] = 'Hot Stone';
        }
        
        if (isset($file['swedish']) && $file['swedish'] > 0) {
            $addOns[] = 'Swedish';
        }
        
        if (isset($file['deep_tissue']) && $file['deep_tissue'] > 0) {
            $addOns[] = 'Deep Tissue';
        }
        
        // Check for new add-on fields that start with 'addon_'
        foreach ($file as $key => $value) {
            if (strpos($key, 'addon_') === 0 && !empty($value)) {
                // Extract the add-on name from the key (e.g., addon_ventosa => Ventosa)
                $addonName = ucfirst(str_replace('addon_', '', $key));
                $addOns[] = $addonName;
            }
        }
        
        // Format the add-ons as a comma-separated string
        return implode(', ', $addOns);
    }
}