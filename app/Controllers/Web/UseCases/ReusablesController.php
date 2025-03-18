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

    public function durationCalculation(){}
}