<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/ApiService.php';

class ServiceService extends ApiService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function syncServices($url, $apikey)
    {
        $data = $this->fetchData($url, $apikey);

        foreach ($data['data'] as $service) {
            $stmt = $this->pdo->prepare("INSERT INTO services (name, duration, cost, service_id) VALUES (:name, :duration, :cost, :service_id)");
            $stmt->execute([
                ':name' => $service['name'],
                ':duration' => $service['duration'],
                ':cost' => $service['cost'],
                ':service_id' => $service['id'],
            ]);
        }
    }
}
