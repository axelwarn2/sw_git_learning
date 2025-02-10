<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ApiService.php';

class SpecializationServiceService extends ApiService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function syncSpecializationService($url, $apikey)
    {
        $data = $this->fetchData($url, $apikey);

        foreach ($data['data'] as $service) {
            foreach ($service["specialties"] as $specialty) {
                $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM specializations WHERE specialization_id = :specialization_id");
                $stmt->execute([':specialization_id' => $specialty['id']]);
                $exists = $stmt->fetchColumn();

                if (!$exists) {
                    $stmt = $this->pdo->prepare("INSERT INTO specializations (name, specialization_id) VALUES (:name, :specialization_id)");
                    $stmt->execute([
                        ':name' => $specialty['name'],
                        ':specialization_id' => $specialty['id'],
                    ]);
                }

                $stmt = $this->pdo->prepare("INSERT INTO services_specializations (service_id, specialization_id) VALUES (:service_id, :specialization_id)");
                $stmt->execute([
                    ':service_id' => $service['id'],
                    ':specialization_id' => $specialty['id'],
                ]);
            }
        }
    }

}