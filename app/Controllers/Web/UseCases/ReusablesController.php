<?php
namespace Project\App\Controllers\Web\UseCases;
use Project\App\Config\Connection;

class ReusablesController
{
    private $pdo;
    public function __construct(){
        $this->pdo = Connection::connection();
    }

    public function addOns($placeHolder)
    {
        $services = [];

        if (isset($placeHolder['swedish'])) {
            $services[] = 'Swedish Massage';
        }
        if (isset($placeHolder['hot_stone'])) {
            $services[] = 'Hot Stone Therapy';
        }
        if (isset($placeHolder['deep_tissue'])) {
            $services[] = 'Deep Tissue Massage';
        }

        return empty($services) ? '' : implode(', ', $services);
    }

    public function suplementTalAddOns($placeHolder)
    {
        $services = [];

        if (isset($placeHolder['swedish'])) {
            $services[] = 'Swedish Massage';
        }
        if (isset($placeHolder['hot_stone'])) {
            $services[] = 'Hot Stone Therapy';
        }
        if (isset($placeHolder['deep_tissue'])) {
            $services[] = 'Deep Tissue Massage';
        }

        return empty($services) ? '' : implode(', ', $services);
    }

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
                return $price;
        }
    }

    public function durationCalculation($startTime, $placeholder)
    {
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
}