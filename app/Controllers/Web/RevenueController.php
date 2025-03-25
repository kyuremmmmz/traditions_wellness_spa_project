<?php
namespace App\Controllers\Web;

use Project\App\Config\Connection;
use PDO;

class RevenueController {
    private $db;

    public function __construct() {
        $this->db = Connection::globalConnection();
        header('Content-Type: application/json');
    }

    public function getWeeklyRevenue($year, $month, $week) {
        try {
            $startDate = date('Y-m-d', strtotime($year . 'W' . str_pad($week, 2, '0', STR_PAD_LEFT)));
            $endDate = date('Y-m-d', strtotime($startDate . ' +6 days'));

            $query = "SELECT 
                        DATE_FORMAT(a.booking_date, '%w') as day_of_week,
                        SUM(CASE WHEN s.category = 'Massage' THEN a.total_price ELSE 0 END) as massages,
                        SUM(CASE WHEN s.category = 'Body Scrub' THEN a.total_price ELSE 0 END) as body_scrubs,
                        SUM(CASE WHEN s.category = 'Package' THEN a.total_price ELSE 0 END) as packages
                    FROM appointments a
                    JOIN services s ON a.services_id = s.id
                    WHERE a.booking_date BETWEEN :start_date AND :end_date
                    AND a.status = 'completed'
                    GROUP BY DATE_FORMAT(a.booking_date, '%w')
                    ORDER BY day_of_week";

            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':start_date' => $startDate,
                ':end_date' => $endDate
            ]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Initialize arrays with zeros
            $data = [
                'massages' => array_fill(0, 7, 0),
                'body_scrubs' => array_fill(0, 7, 0),
                'packages' => array_fill(0, 7, 0)
            ];

            // Fill in actual data
            foreach ($results as $row) {
                $dayIndex = $row['day_of_week'];
                $data['massages'][$dayIndex] = (float)$row['massages'];
                $data['body_scrubs'][$dayIndex] = (float)$row['body_scrubs'];
                $data['packages'][$dayIndex] = (float)$row['packages'];
            }

            return json_encode($data);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Failed to fetch weekly revenue data']);
        }
    }

    public function getMonthlyRevenue($year, $month) {
        try {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            
            $query = "SELECT 
                        DAY(a.booking_date) as day,
                        SUM(CASE WHEN s.category = 'Massage' THEN a.total_price ELSE 0 END) as massages,
                        SUM(CASE WHEN s.category = 'Body Scrub' THEN a.total_price ELSE 0 END) as body_scrubs,
                        SUM(CASE WHEN s.category = 'Package' THEN a.total_price ELSE 0 END) as packages
                    FROM appointments a
                    JOIN services s ON a.services_id = s.id
                    WHERE YEAR(a.booking_date) = :year 
                    AND MONTH(a.booking_date) = :month
                    AND a.status = 'completed'
                    GROUP BY DAY(a.booking_date)
                    ORDER BY day";

            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':year' => $year,
                ':month' => $month
            ]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Initialize arrays with zeros
            $data = [
                'massages' => array_fill(0, $daysInMonth, 0),
                'body_scrubs' => array_fill(0, $daysInMonth, 0),
                'packages' => array_fill(0, $daysInMonth, 0)
            ];

            // Fill in actual data
            foreach ($results as $row) {
                $dayIndex = $row['day'] - 1; // Convert to 0-based index
                $data['massages'][$dayIndex] = (float)$row['massages'];
                $data['body_scrubs'][$dayIndex] = (float)$row['body_scrubs'];
                $data['packages'][$dayIndex] = (float)$row['packages'];
            }

            return json_encode($data);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Failed to fetch monthly revenue data']);
        }
    }

    public function getYearlyRevenue($year) {
        try {
            $query = "SELECT 
                        MONTH(a.booking_date) as month,
                        SUM(CASE WHEN s.category = 'Massage' THEN a.total_price ELSE 0 END) as massages,
                        SUM(CASE WHEN s.category = 'Body Scrub' THEN a.total_price ELSE 0 END) as body_scrubs,
                        SUM(CASE WHEN s.category = 'Package' THEN a.total_price ELSE 0 END) as packages
                    FROM appointments a
                    JOIN services s ON a.services_id = s.id
                    WHERE YEAR(a.booking_date) = :year
                    AND a.status = 'completed'
                    GROUP BY MONTH(a.booking_date)
                    ORDER BY month";

            $stmt = $this->db->prepare($query);
            $stmt->execute([':year' => $year]);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Initialize arrays with zeros
            $data = [
                'massages' => array_fill(0, 12, 0),
                'body_scrubs' => array_fill(0, 12, 0),
                'packages' => array_fill(0, 12, 0)
            ];

            // Fill in actual data
            foreach ($results as $row) {
                $monthIndex = $row['month'] - 1; // Convert to 0-based index
                $data['massages'][$monthIndex] = (float)$row['massages'];
                $data['body_scrubs'][$monthIndex] = (float)$row['body_scrubs'];
                $data['packages'][$monthIndex] = (float)$row['packages'];
            }

            return json_encode($data);
        } catch (\Exception $e) {
            http_response_code(500);
            return json_encode(['error' => 'Failed to fetch yearly revenue data']);
        }
    }
}