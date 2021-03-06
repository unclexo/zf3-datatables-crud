CREATE TABLE IF NOT EXISTS `test_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `test_users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$dfKX5G68X87Q8RS54wsXm.MPQB7g9q/D5gafAPsD8ESDag4Cu4bzm'),
(2, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(3, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(4, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(5, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(6, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(7, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$nCXDrL8uyRRzM.KBC6o9bedGcfLIvkCvVhG/EvHfi3mQaNlWcyr9W'),
(8, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(9, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(10, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(11, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$dfKX5G68X87Q8RS54wsXm.MPQB7g9q/D5gafAPsD8ESDag4Cu4bzm'),
(12, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(13, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(14, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(15, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(16, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(17, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$nCXDrL8uyRRzM.KBC6o9bedGcfLIvkCvVhG/EvHfi3mQaNlWcyr9W'),
(18, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(19, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(20, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(21, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$dfKX5G68X87Q8RS54wsXm.MPQB7g9q/D5gafAPsD8ESDag4Cu4bzm'),
(22, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(23, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(24, 'Dolor', 'Sit', 'dolor@sit.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG'),
(25, 'Lorem', 'Ipsum', 'lorem@ipsum.com', '$2y$10$iMDN8kS81DAdHy9/zNd3we2ChPwhy2bTkVIsCyHpNtaNZl9zUuyxG');