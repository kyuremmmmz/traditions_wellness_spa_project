<?php
namespace Project\App\Models\Services;

use PDO;
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

    public function findByArchive()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE status = 'Archived'");
        $stmt->execute();
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

    public function createServices(
        $category,
        $serviceName,
        $fixed_price,
        $caption,
        $description,
        $status,
        $duration_details,
        $party_size_details,
        $massage_details,
        $body_scrub_details,
        $add_ons_details,
        $main_photo,
        $slide_show_photos,
        $show_case_photo1,
        $headline1,
        $caption1,
        $show_case_photo2,
        $headline2,
        $caption2,
        $show_case_photo3,
        $headline3,
        $caption3,
        $massage_selection,
        $body_scrub_selection,
        $supplemental_add_ons,
        $party_size,
        $one_hour_price,
        $one_hour_thirty_price,
        $two_hour_price
    ) {
        $stmt = $this->pdo->prepare("INSERT INTO 
            services (
            category, serviceName, fixed_price, caption, description, status, duration_details, 
            party_size_details, massage_details, body_scrub_details, add_ons_details, 
            main_photo, slide_show_photos, showcase_photo1, headline1, caption1, 
            showcase_photo2, headline2, caption2, showcase_photo3, headline3, caption3, 
            massage_selection, body_scrub_selection, supplemental_add_ons, party_size, one_hour_price, one_hour_thirty_price, two_hour_price,
            updated_at, created_at
        ) VALUES (
            :category, :service_name, :fixed_price, :service_caption, :service_description, :status, :duration_details, 
            :party_size_details, :massage_details, :body_scrub_details, :addon_details, 
            :main_photo, :slideshow_photos, :showcase_photo_1, :showcase_headline_1, :showcase_caption_1, 
            :showcase_photo_2, :showcase_headline_2, :showcase_caption_2, :showcase_photo_3, :showcase_headline_3, :showcase_caption_3, 
            :massage_selection, :body_scrub_selection, :supplemental_addons, :party_size, :one_hour_price, :one_hour_thirty_price, :two_hour_price,
            NOW(), NOW()
        )");

        
        return $stmt->execute([
            'category' => $category,
            'service_name' => $serviceName,
            'fixed_price' => $fixed_price,
            'service_caption' => $caption,
            'service_description' => $description,
            'status' => $status,
            'duration_details' => $duration_details,
            'party_size_details' => $party_size_details,
            'massage_details' => $massage_details,
            'body_scrub_details' => $body_scrub_details,
            'addon_details' => $add_ons_details,
            'main_photo' => $main_photo,
            'slideshow_photos' => $slide_show_photos,
            'showcase_photo_1' => $show_case_photo1,
            'showcase_headline_1' => $headline1,
            'showcase_caption_1' => $caption1,
            'showcase_photo_2' => $show_case_photo2,
            'showcase_headline_2' => $headline2,
            'showcase_caption_2' => $caption2,
            'showcase_photo_3' => $show_case_photo3,
            'showcase_headline_3' => $headline3,
            'showcase_caption_3' => $caption3,
            'massage_selection' => $massage_selection,
            'body_scrub_selection' => $body_scrub_selection,
            'supplemental_addons' => $supplemental_add_ons,
            'party_size' => $party_size,
            'one_hour_price' => $one_hour_price,
            'one_hour_thirty_price' => $one_hour_thirty_price,
            'two_hour_price' => $two_hour_price,
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
        $stmt = $this->pdo->prepare("SELECT id, serviceName, description, category, status FROM services WHERE category = :category AND status = 'Active'");
        $stmt->execute(['category' => $category]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}