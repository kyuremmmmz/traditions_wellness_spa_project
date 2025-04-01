<?php
namespace Project\App\Controllers\Web\UseCases;
use Project\App\Config\Connection;

class ReusablesController
{
    private $pdo;
    
    public function __construct(){
        $this->pdo = Connection::connection();
    }

    /**
     * Process add-ons from form data
     * 
     * @param array $placeHolder POST data containing add-on information
     * @return string Comma-separated list of selected add-ons
     */
    public function addOns($placeHolder)
    {
        $services = [];

        // Check for standard add-ons
        if (isset($placeHolder['hot_stone']) && (!empty($placeHolder['hot_stone']) || $placeHolder['hot_stone'] > 0)) {
            $services[] = 'Hot Stone';
        }
        
        if (isset($placeHolder['swedish']) && (!empty($placeHolder['swedish']) || $placeHolder['swedish'] > 0)) {
            $services[] = 'Swedish';
        }
        
        if (isset($placeHolder['deep_tissue']) && (!empty($placeHolder['deep_tissue']) || $placeHolder['deep_tissue'] > 0)) {
            $services[] = 'Deep Tissue';
        }
        
        // Check for massage selection label
        if (isset($placeHolder['massage_selection']['label'])) {
            $services[] = 'Swedish Massage';
        }
        
        // Check for new add-on fields that start with 'addon_'
        foreach ($placeHolder as $key => $value) {
            if (strpos($key, 'addon_') === 0 && !empty($value)) {
                // Extract the add-on name from the key (e.g., addon_ventosa => Ventosa)
                $addonName = ucfirst(str_replace('addon_', '', $key));
                $services[] = $addonName;
            }
        }

        return empty($services) ? '' : implode(', ', $services);
    }

    /**
     * Process supplemental add-ons from form data
     * 
     * @param array $placeHolder POST data containing supplemental add-on information
     * @return string Comma-separated list of supplemental add-ons
     */
    public function suplementTalAddOns($placeHolder)
    {
        $services = [];

        if (isset($placeHolder['hot_stone'])) {
            $services[] = 'Hot Stone';
        }
        if (isset($placeHolder['ear_candling'])) {
            $services[] = 'Ear Candling';
        }
        if (isset($placeHolder['ventosa'])) {
            $services[] = 'Ventosa';
        }

        return empty($services) ? '' : implode(', ', $services);
    }

    /**
     * Process body scrub selections from form data
     * 
     * @param array $placeHolder POST data containing body scrub selection information
     * @return string Comma-separated list of body scrub selections
     */
    public function bodyScrubSelection($placeHolder)
    {
        $services = [];

        // Handle checkbox-style inputs
        if (isset($placeHolder['coffee_scrub'])) {
            $services[] = 'Coffee Scrub';
        }
        if (isset($placeHolder['milk_whitening_scrub'])) {
            $services[] = 'Milk Whitening Scrub';
        }
        if (isset($placeHolder['shea_and_butter_scrub'])) {
            $services[] = 'Shea and Butter Scrub';
        }
        
        // Handle array inputs
        if (isset($placeHolder['body_scrub_selection']) && is_array($placeHolder['body_scrub_selection'])) {
            foreach ($placeHolder['body_scrub_selection'] as $selection) {
                if (!empty($selection)) {
                    $services[] = trim($selection);
                }
            }
        } 
        // Handle string input
        elseif (isset($placeHolder['body_scrub_selection']) && is_string($placeHolder['body_scrub_selection']) && !empty($placeHolder['body_scrub_selection'])) {
            // Split by comma if it's a comma-separated string
            if (strpos($placeHolder['body_scrub_selection'], ',') !== false) {
                $items = explode(',', $placeHolder['body_scrub_selection']);
                foreach ($items as $item) {
                    if (!empty(trim($item))) {
                        $services[] = trim($item);
                    }
                }
            } else {
                $services[] = trim($placeHolder['body_scrub_selection']);
            }
        }

        return empty($services) ? '' : implode(', ', array_unique($services));
    }

    /**
     * Process massage selections from form data
     * 
     * @param array $placeHolder POST data containing massage selection information
     * @return string Comma-separated list of massage selections
     */
    public function massageSelection($placeHolder)
    {
        $services = [];

        // Handle checkbox-style inputs
        if (isset($placeHolder['bamboossage'])) {
            $services[] = 'Bamboossage';
        }
        if (isset($placeHolder['dagdagay'])) {
            $services[] = 'Dagdagay';
        }
        if (isset($placeHolder['hilot'])) {
            $services[] = 'Hilot';
        }
        if (isset($placeHolder['swedish'])) {
            $services[] = 'Swedish';
        }
        
        // Handle array inputs
        if (isset($placeHolder['massage_selection']) && is_array($placeHolder['massage_selection'])) {
            foreach ($placeHolder['massage_selection'] as $selection) {
                if (!empty($selection)) {
                    $services[] = trim($selection);
                }
            }
        } 
        // Handle string input
        elseif (isset($placeHolder['massage_selection']) && is_string($placeHolder['massage_selection']) && !empty($placeHolder['massage_selection'])) {
            // Split by comma if it's a comma-separated string
            if (strpos($placeHolder['massage_selection'], ',') !== false) {
                $items = explode(',', $placeHolder['massage_selection']);
                foreach ($items as $item) {
                    if (!empty(trim($item))) {
                        $services[] = trim($item);
                    }
                }
            } else {
                $services[] = trim($placeHolder['massage_selection']);
            }
        }

        return empty($services) ? '' : implode(', ', array_unique($services));
    }

    /**
     * Calculate the total price based on party size
     * 
     * @param int $price Base price of the service
     * @param string $params Party size (Solo, Duo, Group)
     * @return int Calculated price
     */
    public function priceCalculation($price, $params)
    {
        switch ($params) {
            case 'Solo':
                return 1000;
            case 'Duo':
                return 1800;
            case 'Group':
                return 2500;
            default:
                // Try to parse numeric value if it's not a standard size
                $numericSize = (int) $params;
                if ($numericSize > 1) {
                    return $price * $numericSize; // Base price * number of people
                }
                return $price; // Default to base price
        }
    }

    /**
     * Calculate the end time based on start time and duration
     * 
     * @param string $startTime Start time (format can vary)
     * @param array $placeholder POST data containing duration information
     * @return string End time in the appropriate format
     */
    public function durationCalculation($startTime, $placeholder)
    {
        // Return formatted end time for display (for older code)
        if (strpos($startTime, ':') !== false && !isset($placeholder['formatted_time'])) {
            $minutes = [
                '1 Hour' => 60,
                '2 Hours' => 120,
                '1 Hour and 30 minutes' => 90,
                'swedish' => 60,
                'hot_stone' => 30,
                'deep_tissue' => 45
            ];

            $totalMinutes = ($minutes[$placeholder['duration']] ?? 0)
                + (isset($placeholder['swedish']) ? 60 : 0)
                + (isset($placeholder['hot_stone']) ? 30 : 0)
                + (isset($placeholder['deep_tissue']) ? 45 : 0);

            list($hr, $min) = explode(":", $startTime);
            $endMinutes = ($hr * 60 + $min) + $totalMinutes;

            $endHr = floor($endMinutes / 60) % 12 ?: 12;
            $endMin = $endMinutes % 60;
            $period = $endMinutes / 60 >= 12 ? "PM" : "AM";

            return sprintf("%02d:%02d %s", $endHr, $endMin, $period);
        }
        
        // For database storage (new code)
        // Default to 1 hour if duration not set
        $durationMinutes = 60;
        
        if (isset($placeholder['duration'])) {
            if ($placeholder['duration'] == '1 Hour' || $placeholder['duration'] == '1 hour') {
                $durationMinutes = 60;
            } elseif ($placeholder['duration'] == '1 Hour and 30 minutes' || $placeholder['duration'] == '1 hour and 30 minutes') {
                $durationMinutes = 90;
            } elseif ($placeholder['duration'] == '2 Hours' || $placeholder['duration'] == '2 hours') {
                $durationMinutes = 120;
            } else {
                // Try to parse numeric value if it's just minutes
                $numericDuration = (int) preg_replace('/[^0-9]/', '', $placeholder['duration']);
                if ($numericDuration > 0) {
                    $durationMinutes = $numericDuration;
                }
            }
        }
        
        // Add addon times
        if (isset($placeholder['swedish']) && !empty($placeholder['swedish'])) {
            $durationMinutes += 60;
        }
        if (isset($placeholder['hot_stone']) && !empty($placeholder['hot_stone'])) {
            $durationMinutes += 30;
        }
        if (isset($placeholder['deep_tissue']) && !empty($placeholder['deep_tissue'])) {
            $durationMinutes += 45;
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
}