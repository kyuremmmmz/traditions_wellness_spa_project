<?php
namespace ProjectAppModelsServices;

use PDO;
use Project\App\Config\Connection;

class ServiceAddOnsModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connection();
    }

    public function attachAddOnToService($serviceId, $addOnId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO service_add_ons (service_id, add_on_id) VALUES (:service_id, :add_on_id)");
        return $stmt->execute([
            'service_id' => $serviceId,
            'add_on_id' => $addOnId
        ]);
    }

    public function detachAddOnFromService($serviceId, $addOnId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM service_add_ons WHERE service_id = :service_id AND add_on_id = :add_on_id");
        return $stmt->execute([
            'service_id' => $serviceId,
            'add_on_id' => $addOnId
        ]);
    }

    public function getAddOnsForService($serviceId)
    {
        $stmt = $this->pdo->prepare("
            SELECT a.* 
            FROM add_ons a
            JOIN service_add_ons sa ON a.id = sa.add_on_id
            WHERE sa.service_id = :service_id AND a.status = 'active'
        ");
        $stmt->execute(['service_id' => $serviceId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicesForAddOn($addOnId)
    {
        $stmt = $this->pdo->prepare("
            SELECT s.* 
            FROM services s
            JOIN service_add_ons sa ON s.id = sa.service_id
            WHERE sa.add_on_id = :add_on_id
        ");
        $stmt->execute(['add_on_id' => $addOnId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}