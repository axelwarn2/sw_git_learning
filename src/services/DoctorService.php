<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ApiService.php';

class DoctorService extends ApiService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function syncDoctors($url, $apikey)
    {
        $data = $this->fetchData($url, $apikey);

        foreach ($data['data'] as $doctor) {
            $stmt = $this->pdo->prepare("INSERT INTO doctors (name, doctor_id) VALUES (:name, :doctor_id)");
            $stmt->execute([
                ':name' => $doctor['full_name'],
                ':doctor_id' => $doctor['id'],
            ]);

            foreach ($doctor['procedures'] as $procedure) {
                $stmt = $this->pdo->prepare("INSERT INTO doctor_services (doctor_id, service_id) VALUES (:doctor_id, :service_id)");
                $stmt->execute([
                    ':doctor_id' => $doctor['id'],
                    ':service_id' => $procedure['id'],
                ]);
            }
        }
    }
}
