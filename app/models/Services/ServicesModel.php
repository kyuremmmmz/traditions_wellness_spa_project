<?php
namespace Project\App\Models\Services;

use PDO;
use PDOException;
use Project\App\Config\Connection;

class ServicesModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
        if ($this->pdo === null) {
            throw new \Exception("Failed to establish a database connection.");
        }
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllServiceName()
    {
        $stmt = $this->pdo->query("SELECT id,serviceName, price, description FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCategory($category)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE category = :category");
        $stmt->execute(['category' => $category]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createCategory($category)
    {
        $stmt = $this->pdo->prepare("INSERT INTO services (category, updated_at, created_at) VALUES (:categoryNameField, NOW(), NOW())");
        return $stmt->execute([
            'categoryNameField' => $category
        ]);
    }

    public function createServices($params) {
        $stmt = $this->pdo->prepare("INSERT INTO 
            services (
            category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price, rating, duration,
            updated_at, created_at
        ) VALUES (
            :category, :service_name, :fixed_price, :service_caption, :service_description, :status, :duration_details, 
            :party_size_details, :massage_details, :body_scrub_details, :addon_details, 
            :main_photo, :slideshow_photos, :showcase_photo_1, :showcase_headline_1, :showcase_caption_1, 
            :showcase_photo_2, :showcase_headline_2, :showcase_caption_2, :showcase_photo_3, :showcase_headline_3, :showcase_caption_3, 
            :massage_selection, :body_scrub_selection, :supplemental_addons, :party_size, :one_hour_price, :one_hour_thirty_price, :two_hour_price, :rating, :duration,
            NOW(), NOW()
        )");
        
        return $stmt->execute([
            'category' => $params['category'],
            'service_name' => $params['service_name'],
            'fixed_price' => $params['fixed_price'],
            'service_caption' => $params['service_caption'],
            'service_description' => $params['service_description'],
            'status' => $params['status'],
            'duration_details' => $params['duration_details'],
            'party_size_details' => $params['party_size_details'],
            'massage_details' => $params['massage_details'],
            'body_scrub_details' => $params['body_scrub_details'],
            'addon_details' => $params['addon_details'],
            'main_photo' => $params['main_photo'],
            'slideshow_photos' => $params['slideshow_photos'],
            'showcase_photo_1' => $params['showcase_photo_1'],
            'showcase_headline_1' => $params['showcase_headline_1'],
            'showcase_caption_1' => $params['showcase_caption_1'],
            'showcase_photo_2' => $params['showcase_photo_2'],
            'showcase_headline_2' => $params['showcase_headline_2'],
            'showcase_caption_2' => $params['showcase_caption_2'],
            'showcase_photo_3' => $params['showcase_photo_3'],
            'showcase_headline_3' => $params['showcase_headline_3'],
            'showcase_caption_3' => $params['showcase_caption_3'],
            'massage_selection' => $params['massage_selection'],
            'body_scrub_selection' => $params['body_scrub_selection'],
            'supplemental_addons' => $params['supplemental_addons'],
            'party_size' => $params['party_size'],
            'one_hour_price' => $params['one_hour_price'],
            'one_hour_thirty_price' => $params['one_hour_thirty_price'],
            'two_hour_price' => $params['two_hour_price'],
            'duration' => $params['duration'],
            'rating' => $params['rating']
        ]);
    }


    public function update($id, $description, $price, $serviceName)
    {
        $stmt = $this->pdo->prepare("UPDATE services 
                                    SET description = :description, 
                                        price = :price, 
                                        serviceName = :serviceName 
                                    WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'description' => $description,
            'price' => $price,
            'serviceName' => $serviceName
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM services WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function findByCategoryAndActive($category)
    {
        error_log("findByCategoryAndActive called with category: " . $category);

        $stmt = $this->pdo->prepare("SELECT 
            id, category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price, rating, duration
        FROM services 
        WHERE category = :category 
        AND status = 'Active'");
        $stmt->execute(['category' => $category]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        error_log("Query returned: " . json_encode($result));

        return $result;
    }

    public function findByCategoryAndStatus($category, $status)
    {
        $stmt = $this->pdo->prepare("SELECT 
            id, category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price, rating, duration
        FROM services 
        WHERE category = :category 
        AND status = :status");
        $stmt->execute(['category' => $category, 'status' => $status]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAllActiveServices()
    {
        $stmt = $this->pdo->prepare("SELECT 
            id, category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price, rating, duration
        FROM services 
        WHERE status = 'Active'");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findByArchive()
    {
        $stmt = $this->pdo->prepare("SELECT 
            id, category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price, rating, duration
        FROM services 
        WHERE status = 'Archived'");

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Corresponding method in ServicesModel
    public function getServiceCategoryById($serviceId)
{
    try {
        $stmt = $this->pdo->prepare("SELECT category FROM services WHERE id = :serviceId");
        $stmt->execute(['serviceId' => $serviceId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['category'] : null;
        } catch (PDOException $e) {
            // Log the database error
            error_log('Database Error in getServiceCategoryById: ' . $e->getMessage());
            return null;
        }
    }
}
