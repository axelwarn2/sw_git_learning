<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/DoctorService.php';
require_once __DIR__ . '/ServiceService.php';
require_once __DIR__ . '/SpecializationService.php';
require_once __DIR__ . '/SpecializationServiceService.php';
require_once __DIR__ . '/SpecializationDoctorService.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = new PDO("mysql:host=sw-mysql;dbname=default", "default", "123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $crmUrl = $_POST["crmurl"];
    $apiKey = $_POST["apikey"];

    $doctorService = new DoctorService($pdo);
    $serviceService = new ServiceService($pdo);
    $specializationService = new SpecializationService($pdo);
    $specializationServiceService = new SpecializationServiceService($pdo);
    $specializationDoctorService = new SpecializationDoctorService($pdo);

    try {
        $specializationService->syncSpecialization("$crmUrl/api/v1/doctors", $apiKey);
        $serviceService->syncServices("$crmUrl/api/v1/procedures", $apiKey);
        $doctorService->syncDoctors("$crmUrl/api/v1/doctors", $apiKey);
        $specializationDoctorService->syncSpecializationDoctor("$crmUrl/api/v1/doctors", $apiKey);
        $specializationServiceService->syncSpecializationService("$crmUrl/api/v1/procedures", $apiKey);

//    header("Location: /");
    } catch (Exception $exception) {
        die("Ошибка: {$exception}");
    }
}