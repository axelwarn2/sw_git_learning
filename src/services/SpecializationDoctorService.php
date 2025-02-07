<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ApiService.php';

class SpecializationDoctorService extends ApiService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function syncSpecializationDoctor($url, $apikey)
    {
        $data = $this->fetchData($url, $apikey);

        foreach ($data["data"] as $doctor) {
            foreach ($doctor['specialties'] as $speciality) {
                $stmt = $this->pdo->prepare("INSERT INTO doctors_specializations (doctor_id, specialization_id) VALUES (:doctor_id, :specialization_id)");
                $stmt->execute([
                    ':doctor_id' => $doctor['id'],
                    ':specialization_id' => $speciality['id'],
                ]);
            }
        }
    }
}