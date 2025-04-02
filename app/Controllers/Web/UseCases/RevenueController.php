<?php
namespace Project\App\Controllers\Web\UseCases;

use Project\App\Config\Connection;
use PDO;
use Project\App\Models\Utilities\RevenueModel;

class RevenueController {
    private $db;

    public function __construct() {
        $this->db = new RevenueModel();
    }
    public function getTotalRevenueAsWeek(){
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAll();
        echo json_encode([$revenue]);
        exit;
    }

    public function getAllCategories($week)
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllCategories($week);
        echo json_encode([$revenue]);
        exit;
    }


    public function getAllBodyScrubs()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllWeeksByBodyScrub();
        echo json_encode([$revenue]);
        exit;
    }
    public function getMassagesByMonthMassages()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getMassagesByMonthMassages();
        echo json_encode([$revenue]);
        exit;
    }

    public function getMassagesByMonthPackages()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getMassagesByMonthPackages();
        echo json_encode([$revenue]);
        exit;
    }


    public function getMassagesByMonthBodyScrub()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getMassagesByMonthBodyScrub();
        echo json_encode([$revenue]);
        exit;
    }
    public function getAllPackages()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllWeeksByPackages();
        echo json_encode([$revenue]);
        exit;
    }

    public function getAllWeeks()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllWeeks();
        echo json_encode([$revenue]);
        exit;
    }

    public function getAllCategoriesByMonth($year)
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllCategoriesByMonth($year);
        echo json_encode([$revenue]);
        exit;
    }

    public function getTotalRevenueAsMonth()
    {
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAll();
        echo json_encode([$revenue]);
        exit;
    }

    public function getTotalRevenuePerCateg(){
        header('Content-Type: application/json');
        ob_clean();
        $revenue = $this->db->getAllWeeks();
        echo json_encode([$revenue]);
        exit;
    }
}