<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ApiService.php';

class SpecializationService extends ApiService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function syncSpecialization($url, $apikey)
    {
        $data = $this->fetchData($url, $apikey);

        foreach ($data["data"] as $doctor) {
            foreach ($doctor["specialties"] as $speciality) {
                $stmt = $this->pdo->prepare("INSERT INTO specializations (name, specialization_id) VALUES (:name, :specialization_id)");
                $stmt->execute([
                    ":name" => $speciality["name"],
                    ":specialization_id" => $speciality["id"],
                ]);
            }
        }
    }
}