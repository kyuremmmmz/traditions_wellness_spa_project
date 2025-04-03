<?php
namespace Project\App\Controllers\Mobile;

use Project\App\Models\Services\ServicesModel;
use Exception;
use Project\App\Models\Utilities\AppointmentsModel;
use PDO;

class AppointmentController
{
    private $appointmentModel;
    private $serviceModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentsModel();
        $this->serviceModel = new ServicesModel();
    }

    public function bookAppointment()
    {
        try {
            // Get JSON input
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            // Log received data for debugging
            error_log('Received data: ' . json_encode($data));
            
            if (!$data) {
                throw new Exception("Invalid request data");
            }
            
            // Validate required fields
            $requiredFields = ['userId', 'serviceId', 'appointmentDate', 'appointmentTime', 'numberOfPeople', 'totalPrice'];
            foreach ($requiredFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    throw new Exception("Missing required field: $field");
                }
            }

            // Get user information - attempt to fetch user details from database
            $userInfo = $this->getUserInfo($data['userId']);
            error_log('User info retrieved: ' . json_encode($userInfo));
            
            // Determine userName - try multiple field possibilities in the users table
            $userName = '';
            // Check possible name fields in users table
            $possibleNameFields = ['name', 'first_name', 'firstName', 'username', 'full_name', 'fullName'];
            foreach ($possibleNameFields as $field) {
                if (!empty($userInfo[$field])) {
                    $userName = $userInfo[$field];
                    break;
                }
            }
            
            // If no name found, try to combine first and last name
            if (empty($userName) && !empty($userInfo['first_name']) && !empty($userInfo['last_name'])) {
                $userName = $userInfo['first_name'] . ' ' . $userInfo['last_name'];
            }
            
            // Fallback to data directly from request if provided
            if (empty($userName) && !empty($data['userName'])) {
                $userName = $data['userName'];
            }
            
            // Final fallback
            if (empty($userName)) {
                $userName = 'Guest User';
            }
            
            // Log the selected username
            error_log('Selected username: ' . $userName);
            
            // Extract other user details with fallbacks
            $userEmail = $data['email'] ?? $userInfo['email'] ?? 'N/A';
            $userGender = $data['gender'] ?? $userInfo['gender'] ?? 'N/A';
            $userAddress = $data['address'] ?? $userInfo['address'] ?? 'N/A';
            $userContact = $data['contactNumber'] ?? $userInfo['phone'] ?? $userInfo['contact_number'] ?? $userInfo['contactNumber'] ?? 'N/A';
            
            // Check if appointment time is available
            $isAvailable = $this->appointmentModel->checkAvailability(
                $data['appointmentDate'],
                $data['appointmentTime']
            );
            
            if (!$isAvailable) {
                // Return busy status
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'This appointment time is already taken. Please select another time.'
                ]);
                exit;
            }
            
            // Get service details
            $service = $this->serviceModel->getServiceDetails($data['serviceId']);
            if (!$service) {
                throw new Exception("Service not found");
            }

            // Convert duration from minutes to formatted string (e.g., "1 hour", "2 hours")
            $durationInMinutes = $service['duration'] ?? 60;
            $durationFormatted = $this->formatDuration($durationInMinutes);
            
            // Format booking date - Use appointmentDate, not booking_date
            $bookingDate = date('Y-m-d', strtotime($data['appointmentDate']));
            if ($bookingDate === '1970-01-01' || $bookingDate === false) {
                // Fallback to current date if parsing fails
                $bookingDate = date('Y-m-d');
            }
            
            // Calculate end time based on start time and duration
            $startTime = $data['appointmentTime'];
            $endTime = date('H:i:s', strtotime($startTime) + $durationInMinutes * 60);
            
            // Determine party size format (Single, Duo, Group)
            $partySizeFormatted = $this->formatPartySize($data['numberOfPeople']);
            
            // Get category from service or default
            $category = $service['category'] ?? 'Massages';
            
            // Format addons as JSON if provided
            $addOns = isset($data['addons']) ? json_encode($data['addons']) : '';
            
            // Prepare appointment data
            $appointmentData = [
                'nameOfTheUser' => $userName,
                'user_id' => $data['userId'], // Correct casing from the JSON input
                'address' => $userAddress,
                'contactNumber' => $userContact,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_price' => $data['totalPrice'],
                'addOns' => $addOns,
                'services_id' => $data['serviceId'],
                'booking_date' => $bookingDate,
                'status' => 'pending',
                'duration' => $durationFormatted,
                'service_booked' => $service['serviceName'] ?? 'Service',
                'party_size' => $partySizeFormatted,
                'gender' => $userGender,
                'email' => $userEmail,
                'massage_selection' => $data['massageType'] ?? '',
                'body_scrub_selection' => $data['bodyScrubType'] ?? '',
                'source_of_booking' => 'mobile',
                'payment_status' => $data['paymentStatus'] ?? 'not paid',
                'category' => $category
            ];
            
            // Log the appointment data being sent to the database
            error_log('Appointment data: ' . json_encode($appointmentData));
            
            $appointmentId = $this->appointmentModel->create($appointmentData);
            
            // Return success response
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'message' => 'Appointment booked successfully',
                'data' => [
                    'id' => $appointmentId,
                    'userId' => $data['userId'],
                    'userName' => $userName,
                    'serviceId' => $data['serviceId'],
                    'serviceName' => $service['serviceName'] ?? 'Service',
                    'appointmentDate' => $bookingDate,
                    'appointmentTime' => $startTime,
                    'endTime' => $endTime,
                    'numberOfPeople' => $data['numberOfPeople'],
                    'totalPrice' => $data['totalPrice'],
                    'status' => 'pending',
                    'duration' => $durationFormatted,
                    'paymentStatus' => $data['paymentStatus'] ?? 'not paid',
                    'massageSelection' => $data['massageType'] ?? '',
                    'bodyScrubSelection' => $data['bodyScrubType'] ?? '',
                    'createdAt' => date('Y-m-d H:i:s')
                ]
            ]);
            
        } catch (Exception $e) {
            // Log the error
            error_log('Mobile appointment error: ' . $e->getMessage());
            
            // Return error response
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Format duration from minutes to a readable string
     */
    private function formatDuration($minutes)
    {
        if ($minutes >= 60) {
            $hours = floor($minutes / 60);
            return $hours . ($hours > 1 ? ' hours' : ' hour');
        } else {
            return $minutes . ' minutes';
        }
    }

    /**
     * Format party size to match web booking format
     */
    private function formatPartySize($numberOfPeople)
    {
        $number = intval($numberOfPeople);
        if ($number === 1) {
            return 'Single';
        } elseif ($number === 2) {
            return 'Duo';
        } else {
            return 'Group';
        }
    }

    public function getUserAppointments($userID)
    {
        try {
            // Validate user ID
            if (!$userID || !is_numeric($userID)) {
                throw new Exception("Invalid user ID: $userID");
            }

            // Log what we're doing
            error_log("Fetching appointments for user ID: $userID");

            // Query for active bookings
            $activeQuery = "SELECT 
                a.id, 
                a.services_id,
                s.serviceName AS headline, 
                CONCAT('₱', a.total_price) AS price, 
                IFNULL(DATE_FORMAT(a.booking_date, '%M %d, %Y'), 'No date specified') AS date,
                IFNULL(DATE_FORMAT(a.start_time, '%h:%i %p'), 'No time specified') AS time,
                s.description,
                a.status,
                a.booking_date AS raw_date,
                a.start_time AS raw_time
            FROM appointments a
            LEFT JOIN services s ON a.services_id = s.id
            WHERE a.user_id = :userID 
            AND (a.status = 'pending' OR a.status = 'confirmed')
            ORDER BY a.booking_date ASC";

            // Prepare and execute with better error handling
            $stmt = $this->appointmentModel->getPdo()->prepare($activeQuery);
            if (!$stmt) {
                $error = $this->appointmentModel->getPdo()->errorInfo();
                throw new Exception("Query preparation error: " . json_encode($error));
            }

            $success = $stmt->execute(['userID' => $userID]);
            if (!$success) {
                $error = $stmt->errorInfo();
                throw new Exception("Query execution error: " . json_encode($error));
            }

            $activeBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Found " . count($activeBookings) . " active bookings for user $userID");

            // Fetch past bookings
            $pastQuery = "SELECT 
                a.id, 
                a.services_id,
                s.serviceName AS headline, 
                CONCAT('₱', a.total_price) AS price, 
                IFNULL(DATE_FORMAT(a.booking_date, '%M %d, %Y'), 'No date specified') AS date,
                IFNULL(DATE_FORMAT(a.start_time, '%h:%i %p'), 'No time specified') AS time,
                s.description,
                a.status,
                a.booking_date AS raw_date,
                a.start_time AS raw_time
            FROM appointments a
            LEFT JOIN services s ON a.services_id = s.id
            WHERE a.user_id = :userID 
            AND (a.status = 'completed' OR a.status = 'cancelled')
            ORDER BY a.booking_date DESC";

            $stmt = $this->appointmentModel->getPdo()->prepare($pastQuery);
            if (!$stmt) {
                $error = $this->appointmentModel->getPdo()->errorInfo();
                throw new Exception("Query preparation error: " . json_encode($error));
            }

            $success = $stmt->execute(['userID' => $userID]);
            if (!$success) {
                $error = $stmt->errorInfo();
                throw new Exception("Query execution error: " . json_encode($error));
            }

            $pastBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Found " . count($pastBookings) . " past bookings for user $userID");

            // Ensure arrays are not null even if empty
            $activeBookings = $activeBookings ?: [];
            $pastBookings = $pastBookings ?: [];

            // Prepare response
            $response = [
                'status' => 'success',
                'message' => 'Bookings retrieved successfully',
                'activeBookings' => $activeBookings,
                'pastBookings' => $pastBookings
            ];

            // Log the response (but truncate it if large)
            $responseJson = json_encode($response);
            error_log("Response for user $userID: " . (strlen($responseJson) > 500 ? 
                substr($responseJson, 0, 500) . "... (truncated)" : 
                $responseJson));

            // Send JSON response with proper headers
            header('Content-Type: application/json');
            ob_clean();
            echo $responseJson;
            exit;

        } catch (Exception $e) {
            // Detailed error logging
            error_log("ERROR fetching appointments for user $userID: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            // Send error response
            header('Content-Type: application/json');
            http_response_code(500);
            ob_clean();
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    private function getUserInfo($userId)
    {
        try {
            // Log the userId being looked up
            error_log('Looking up user with ID: ' . $userId);
            
            // Make sure userId is an integer
            $userId = intval($userId);
            
            $sql = "SELECT * FROM users WHERE id = :userId";
            $stmt = $this->appointmentModel->getPdo()->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                // User found
                error_log('User found: ' . json_encode($result));
                return $result;
            } else {
                // Log that no user was found
                error_log('No user found with ID: ' . $userId);
                
                // Try alternative query methods as fallback
                $altSql = "SELECT * FROM users WHERE id = $userId";
                $altStmt = $this->appointmentModel->getPdo()->query($altSql);
                $altResult = $altStmt ? $altStmt->fetch(PDO::FETCH_ASSOC) : null;
                
                if ($altResult) {
                    error_log('User found with alternative query: ' . json_encode($altResult));
                    return $altResult;
                }
                
                return [];
            }
        } catch (Exception $e) {
            error_log('Error fetching user info: ' . $e->getMessage());
            error_log('Error trace: ' . $e->getTraceAsString());
            return [];
        }
    }
}