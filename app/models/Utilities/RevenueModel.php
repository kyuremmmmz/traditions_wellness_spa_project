<?php
namespace Project\App\Models\Utilities;

use PDO;
use Project\App\Config\Connection;

class RevenueModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT SUM(total_price) AS price FROM appointments");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    public function getAllWeeks()
    {
        $stmt = $this->pdo->query("SELECT 
    DAYNAME(dates.the_date) AS day_name,
    COALESCE(SUM(a.total_price), 0) AS Massages
    FROM 
        (SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE()) DAY) AS the_date UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+1 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+2 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+3 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+4 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+5 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+6 DAY)
        ) AS dates
    LEFT JOIN appointments a 
        ON DATE(a.booking_date) = dates.the_date
        AND a.category = 'Massages'
        AND YEAR(a.booking_date) = YEAR(CURDATE())  
    GROUP BY dates.the_date
    ORDER BY dates.the_date;

    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWeeksByBodyScrub()
    {
        $stmt = $this->pdo->query("SELECT 
    DAYNAME(dates.the_date) AS day_name,
    COALESCE(SUM(a.total_price), 0) AS BodyScrub
    FROM 
        (SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE()) DAY) AS the_date UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+1 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+2 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+3 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+4 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+5 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+6 DAY)
        ) AS dates
    LEFT JOIN appointments a 
        ON DATE(a.booking_date) = dates.the_date
        AND a.category = 'Body Scrubs'
        AND YEAR(a.booking_date) = YEAR(CURDATE())  
    GROUP BY dates.the_date
    ORDER BY dates.the_date;

    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWeeksByPackages()
    {
        $stmt = $this->pdo->query("SELECT 
    DAYNAME(dates.the_date) AS day_name,
    COALESCE(SUM(a.total_price), 0) AS Packages
    FROM 
        (SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE()) DAY) AS the_date UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+1 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+2 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+3 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+4 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+5 DAY) UNION ALL
        SELECT DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE())+6 DAY)
        ) AS dates
    LEFT JOIN appointments a 
        ON DATE(a.booking_date) = dates.the_date
        AND a.category = 'Packages'
        AND YEAR(a.booking_date) = YEAR(CURDATE())  
    GROUP BY dates.the_date
    ORDER BY dates.the_date;

    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMassagesByMonthMassages()
    {
        $stmt = $this->pdo->query("SELECT 
            months.month_name,
            COALESCE(SUM(a.total_price), 0) AS Massages
        FROM 
            (SELECT 'January' AS month_name, 1 AS month_id UNION ALL
            SELECT 'February', 2 UNION ALL
            SELECT 'March', 3 UNION ALL
            SELECT 'April', 4 UNION ALL
            SELECT 'May', 5 UNION ALL
            SELECT 'June', 6 UNION ALL
            SELECT 'July', 7 UNION ALL
            SELECT 'August', 8 UNION ALL
            SELECT 'September', 9 UNION ALL
            SELECT 'October', 10 UNION ALL
            SELECT 'November', 11 UNION ALL
            SELECT 'December', 12) AS months
        LEFT JOIN appointments a 
            ON MONTH(a.booking_date) = months.month_id 
            AND YEAR(a.booking_date) = YEAR(CURDATE()) 
            AND a.category = 'Massages'
        GROUP BY months.month_name
        ORDER BY months.month_id;
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMassagesByMonthBodyScrub()
    {
        $stmt = $this->pdo->query("SELECT 
            months.month_name,
            COALESCE(SUM(a.total_price), 0) AS BodyScrub
        FROM 
            (SELECT 'January' AS month_name, 1 AS month_id UNION ALL
            SELECT 'February', 2 UNION ALL
            SELECT 'March', 3 UNION ALL
            SELECT 'April', 4 UNION ALL
            SELECT 'May', 5 UNION ALL
            SELECT 'June', 6 UNION ALL
            SELECT 'July', 7 UNION ALL
            SELECT 'August', 8 UNION ALL
            SELECT 'September', 9 UNION ALL
            SELECT 'October', 10 UNION ALL
            SELECT 'November', 11 UNION ALL
            SELECT 'December', 12) AS months
        LEFT JOIN appointments a 
            ON MONTH(a.booking_date) = months.month_id 
            AND YEAR(a.booking_date) = YEAR(CURDATE()) 
            AND a.category = 'Body Scrubs'
        GROUP BY months.month_name
        ORDER BY months.month_id;
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMassagesByMonthPackages()
    {
        $stmt = $this->pdo->query("SELECT 
            months.month_name,
            COALESCE(SUM(a.total_price), 0) AS Packages
        FROM 
            (SELECT 'January' AS month_name, 1 AS month_id UNION ALL
            SELECT 'February', 2 UNION ALL
            SELECT 'March', 3 UNION ALL
            SELECT 'April', 4 UNION ALL
            SELECT 'May', 5 UNION ALL
            SELECT 'June', 6 UNION ALL
            SELECT 'July', 7 UNION ALL
            SELECT 'August', 8 UNION ALL
            SELECT 'September', 9 UNION ALL
            SELECT 'October', 10 UNION ALL
            SELECT 'November', 11 UNION ALL
            SELECT 'December', 12) AS months
        LEFT JOIN appointments a 
            ON MONTH(a.booking_date) = months.month_id 
            AND YEAR(a.booking_date) = YEAR(CURDATE()) 
            AND a.category = 'Packages'
        GROUP BY months.month_name
        ORDER BY months.month_id;
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getAllCategories($weekNum)
    {
        $stmt = $this->pdo->prepare("WITH all_days AS (
        SELECT 'Monday' AS day_name UNION ALL
        SELECT 'Tuesday' UNION ALL
        SELECT 'Wednesday' UNION ALL
        SELECT 'Thursday' UNION ALL
        SELECT 'Friday' UNION ALL
        SELECT 'Saturday' UNION ALL
        SELECT 'Sunday'
    )
    SELECT 
        CONCAT('Week ', :weekNum) AS week_number,
        d.day_name,
        COALESCE(SUM(CASE WHEN a.category = 'Massages' THEN a.total_price END), 0) AS Massages,
        COALESCE(SUM(CASE WHEN a.category = 'Body Scrubs' THEN a.total_price END), 0) AS Body_Scrubs,
        COALESCE(SUM(CASE WHEN a.category = 'Packages' THEN a.total_price END), 0) AS Packages,
        COALESCE(SUM(a.total_price), 0) AS total_revenue
    FROM all_days d
    LEFT JOIN appointments a 
        ON DAYNAME(a.booking_date) = d.day_name
        AND MONTH(a.booking_date) = MONTH(CURDATE())  
        AND YEAR(a.booking_date) = YEAR(CURDATE())  
        AND WEEK(a.booking_date, 1) - WEEK(DATE_FORMAT(a.booking_date, '%Y-%m-01'), 1) + 1 = :weekNum
    GROUP BY week_number, d.day_name
    ORDER BY FIELD(d.day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')");

        $stmt->execute(['weekNum' => $weekNum]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}