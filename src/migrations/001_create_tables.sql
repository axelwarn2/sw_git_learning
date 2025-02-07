-- Adminer 4.8.1 MySQL 9.1.0 dump

SET NAMES utf8;
SET
time_zone = '+00:00';
SET
foreign_key_checks = 0;
SET
sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `doctor_services`;
CREATE TABLE `doctor_services`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `doctor_id`  int NOT NULL,
    `service_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY          `doctor_id` (`doctor_id`),
    KEY          `service_id` (`service_id`),
    CONSTRAINT `doctor_services_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE,
    CONSTRAINT `doctor_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors`
(
    `id`        bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`      varchar(255) NOT NULL,
    `doctor_id` int          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `doctor_id_unique` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `doctors_specializations`;
CREATE TABLE `doctors_specializations`
(
    `id`                bigint unsigned NOT NULL AUTO_INCREMENT,
    `doctor_id`         int NOT NULL,
    `specialization_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY                 `doctor_id` (`doctor_id`),
    KEY                 `specialization_id` (`specialization_id`),
    CONSTRAINT `doctors_specializations_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE,
    CONSTRAINT `doctors_specializations_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`specialization_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `services`;
CREATE TABLE `services`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)   NOT NULL,
    `duration`   int            NOT NULL,
    `cost`       decimal(10, 2) NOT NULL,
    `service_id` int            NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `service_id_unique` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `services_specializations`;
CREATE TABLE `services_specializations`
(
    `id`                bigint unsigned NOT NULL AUTO_INCREMENT,
    `service_id`        int NOT NULL,
    `specialization_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY                 `specialization_id` (`specialization_id`),
    KEY                 `service_id` (`service_id`),
    CONSTRAINT `services_specializations_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`specialization_id`) ON DELETE CASCADE,
    CONSTRAINT `services_specializations_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `specializations`;
CREATE TABLE `specializations`
(
    `id`                bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(255) NOT NULL,
    `specialization_id` int          NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `specialization_id_unique` (`specialization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2025-02-07 11:28:33