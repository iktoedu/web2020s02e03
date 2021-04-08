CREATE TABLE `contact` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name_last` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `name_first` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `name_patronymic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
