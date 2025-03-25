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



    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM your_table_name WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createCategory($category)
    {
        $stmt = $this->pdo->prepare("INSERT INTO services (category, updated_at, created_at) VALUES (:categoryNameField, NOW(), NOW())");
        return $stmt->execute([
            'categoryNameField' => $category
        ]);
    }

    public function createServices(
        $serviceName,
        $price,
        $caption,
        $description,
        $status,
        $duration_details,
        $party_size_details,
        $massage_details,
        $body_scrub_details,
        $add_on_details,
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
        $supplemental_add_ons
    ) {
        $stmt = $this->pdo->prepare("INSERT INTO 
            services (
            serviceName, price, caption, description,status, duration_details, party_size_details,
            massage_details, body_scrub_details, add_ons_details, main_photo, slide_show_photos,
            showcase_photo1, headline1, caption1, showcase_photo2, headline2, caption2, 
            showcase_photo3, headline3, caption3, massage_selection, body_scrub_selection, 
            supplementtal_add_ons, updated_at, created_at
        ) VALUES (
            :serviceName, :price, :caption, :description,:status, :duration_details, :party_size_details,
            :massage_details, :body_scrub_details, :add_on_details, :main_photo, :slide_show_photos,
            :show_case_photo1, :headline1, :caption1, :show_case_photo2, :headline2, :caption2, 
            :show_case_photo3, :headline3, :caption3, :massage_selection, :body_scrub_selection, 
            :supplemental_add_ons, NOW(), NOW()
        )");

        return $stmt->execute([
            'serviceName' => $serviceName,
            'price' => $price,
            'caption' => $caption,
            'description' => $description,
            'status' => $status,
            'duration_details' => $duration_details,
            'party_size_details' => $party_size_details,
            'massage_details' => $massage_details,
            'body_scrub_details' => $body_scrub_details,
            'add_on_details' => $add_on_details,
            'main_photo' => $main_photo,
            'slide_show_photos' => $slide_show_photos,
            'show_case_photo1' => $show_case_photo1,
            'headline1' => $headline1,
            'caption1' => $caption1,
            'show_case_photo2' => $show_case_photo2,
            'headline2' => $headline2,
            'caption2' => $caption2,
            'show_case_photo3' => $show_case_photo3,
            'headline3' => $headline3,
            'caption3' => $caption3,
            'massage_selection' => $massage_selection,
            'body_scrub_selection' => $body_scrub_selection,
            'supplemental_add_ons' => $supplemental_add_ons
        ]);
    }


    public function update($id, $description, $price, $serviceName)
    {
        $stmt = $this->pdo->prepare("UPDATE services SET description = :description, price = :price, serviceName = :serviceName WHERE category = :radio");
        return $stmt->execute([
            'radio' => $id,
            'description' => $description,
            'price' => $price,
            'serviceName' => $serviceName
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM your_table_name WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}