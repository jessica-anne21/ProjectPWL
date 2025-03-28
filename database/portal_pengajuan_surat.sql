-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 09:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_pengajuan_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_studi_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `user_id`, `program_studi_id`, `created_at`, `updated_at`) VALUES
('2', 5, 2, '2025-03-22 07:18:42', '2025-03-22 07:18:42'),
('8', 4, 1, '2025-03-22 07:13:52', '2025-03-22 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kaprodi`
--

CREATE TABLE `kaprodi` (
  `id_kaprodi` varchar(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kaprodi`
--

INSERT INTO `kaprodi` (`id_kaprodi`, `user_id`, `program_studi_id`, `created_at`, `updated_at`) VALUES
('720001', 9, 1, '2025-03-24 07:09:10', '2025-03-24 07:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nrp` varchar(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `user_id`, `program_studi_id`, `created_at`, `updated_at`) VALUES
('1972035', 8, 1, '2025-03-24 07:03:06', '2025-03-24 07:03:06'),
('2272031', 7, 1, '2025-03-22 07:26:41', '2025-03-22 07:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `nrp` varchar(7) NOT NULL,
  `jenis_surat` enum('Surat Keterangan Aktif','Surat Cuti','Surat Mata Kuliah') NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('Diajukan','Disetujui','Ditolak') NOT NULL DEFAULT 'Diajukan',
  `file_surat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `nama_prodi`) VALUES
(1, 'Teknik Informatika'),
(2, 'Sistem Informasi'),
(3, 'Magister Ilmu Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` enum('Admin','Mahasiswa','Kaprodi','Tata Usaha') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Mahasiswa'),
(3, 'Kaprodi'),
(4, 'Tata Usaha');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7gXx7TgCGtkFMW5HW9WpluKH6ILUnN3mVJxvehbP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjJDQzF5amp2dXBvc2FrbmRlNXZvNHJRUmY1c1g1WWtuOEx2NGlvbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1743085216),
('Ic9pximNEPltfieuBUzAcyXDR5MoqUaTxfOYVFMn', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1R2RG5lYTVHQnhJRHk0dkZXbUZYRTBzRFZITWxya3dTV1VPWEJkWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1743092721),
('KzA02DJafvNQinzXrDsCV2JgO1YiL5MIvz5O2Cqh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTdsUDdtYlNpMkdUUjg0eVBJM2s5SGdhQ09HOXRJZFF3aG55eE4wdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1743149186);

-- --------------------------------------------------------

--
-- Table structure for table `tata_usaha`
--

CREATE TABLE `tata_usaha` (
  `id_tata_usaha` varchar(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_studi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tata_usaha`
--

INSERT INTO `tata_usaha` (`id_tata_usaha`, `user_id`, `program_studi_id`, `created_at`, `updated_at`) VALUES
('720002', 11, 1, '2025-03-24 07:13:28', '2025-03-24 07:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(4, 'Admin', 'admin2@example.com', '$2y$12$4Kf8ZbSPdkIAk2qxw0zt3.r2IOkdqDzuY/qOzKpkvPAKaqgxtoyiu', 1, '2025-03-22 07:13:52', '2025-03-22 07:13:52'),
(5, 'Admin SI', 'admin.si@gmail.com', '$2y$12$RAcNcQjCnvjwnue3e7EThuYod5HMcuVUfMyrFaJCpiofYIDWTBLTG', 1, '2025-03-22 07:18:42', '2025-03-22 07:18:42'),
(7, 'Jessica Anne', 'jessica@gmail.com', '$2y$12$8Myws9jLNLClx/zfU1XjdOsJT5HCpzc6ZDlPW.BiHJHSAjpq9dEH.', 2, '2025-03-22 07:26:41', '2025-03-22 07:26:41'),
(8, 'Jonathan Christandy', 'jonathan@gmail.com', '$2y$12$b29W0ncxl33j4GXgCmU9uOn9l09OOqXit.2EHbF1CGRvONxe3fRv2', 2, '2025-03-24 07:03:06', '2025-03-24 07:03:06'),
(9, 'Robby', 'robby@gmail.com', '$2y$12$/ZvWzI5.g7HD4.oogtvx3ucmcUmopDQ7g4bX5tncDJZ1agJwU.Y3m', 3, '2025-03-24 07:09:10', '2025-03-24 07:09:10'),
(11, 'Anita', 'anita@gmail.com', '$2y$12$F8cFDv0WiHoxjWWRwaPI7OOSuB.io615HKlVQ1Hbhq8PETW1VO/kG', 4, '2025-03-24 07:13:28', '2025-03-24 07:13:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD PRIMARY KEY (`id_kaprodi`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nrp` (`nrp`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tata_usaha`
--
ALTER TABLE `tata_usaha`
  ADD PRIMARY KEY (`id_tata_usaha`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `program_studi_id` (`program_studi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`program_studi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kaprodi`
--
ALTER TABLE `kaprodi`
  ADD CONSTRAINT `kaprodi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kaprodi_ibfk_2` FOREIGN KEY (`program_studi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`program_studi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_ibfk_1` FOREIGN KEY (`nrp`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE;

--
-- Constraints for table `tata_usaha`
--
ALTER TABLE `tata_usaha`
  ADD CONSTRAINT `tata_usaha_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tata_usaha_ibfk_2` FOREIGN KEY (`program_studi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
