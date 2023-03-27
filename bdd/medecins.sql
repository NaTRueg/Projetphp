-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2023 at 10:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medecins`
--

-- --------------------------------------------------------

--
-- Table structure for table `medecins`
--

CREATE TABLE `medecins` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialite_id` int NOT NULL,
  `ville_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medecins`
--

INSERT INTO `medecins` (`id`, `nom`, `email`, `specialite_id`, `ville_id`) VALUES
(1, 'Docteur Cardiologie Paris', 'cardiologie.paris@exemple.com', 1, 1),
(2, 'Docteur Cardiologie Marseille', 'cardiologie.marseille@exemple.com', 1, 2),
(3, 'Docteur Cardiologie Lyon', 'cardiologie.lyon@exemple.com', 1, 3),
(4, 'Docteur Cardiologie Toulouse', 'cardiologie.toulouse@exemple.com', 1, 4),
(5, 'Docteur Cardiologie Nice', 'cardiologie.nice@exemple.com', 1, 5),
(6, 'Docteur Cardiologie Nantes', 'cardiologie.nantes@exemple.com', 1, 6),
(7, 'Docteur Cardiologie Strasbourg', 'cardiologie.strasbourg@exemple.com', 1, 7),
(8, 'Docteur Cardiologie Montpellier', 'cardiologie.montpellier@exemple.com', 1, 8),
(9, 'Docteur Cardiologie Bordeaux', 'cardiologie.bordeaux@exemple.com', 1, 9),
(10, 'Docteur Cardiologie Lille', 'cardiologie.lille@exemple.com', 1, 10),
(11, 'Docteur Dermatologie Paris', 'dermatologie.paris@exemple.com', 2, 1),
(12, 'Docteur Dermatologie Marseille', 'dermatologie.marseille@exemple.com', 2, 2),
(13, 'Docteur Dermatologie Lyon', 'dermatologie.lyon@exemple.com', 2, 3),
(14, 'Docteur Dermatologie Toulouse', 'dermatologie.toulouse@exemple.com', 2, 4),
(15, 'Docteur Dermatologie Nice', 'dermatologie.nice@exemple.com', 2, 5),
(16, 'Docteur Dermatologie Nantes', 'dermatologie.nantes@exemple.com', 2, 6),
(17, 'Docteur Dermatologie Strasbourg', 'dermatologie.strasbourg@exemple.com', 2, 7),
(18, 'Docteur Dermatologie Montpellier', 'dermatologie.montpellier@exemple.com', 2, 8),
(19, 'Docteur Dermatologie Bordeaux', 'dermatologie.bordeaux@exemple.com', 2, 9),
(20, 'Docteur Dermatologie Lille', 'dermatologie.lille@exemple.com', 2, 10),
(21, 'Docteur Endocrinologie Paris', 'endocrinologie.paris@exemple.com', 3, 1),
(22, 'Docteur Endocrinologie Marseille', 'endocrinologie.marseille@exemple.com', 3, 2),
(23, 'Docteur Endocrinologie Lyon', 'endocrinologie.lyon@exemple.com', 3, 3),
(24, 'Docteur Endocrinologie Toulouse', 'endocrinologie.toulouse@exemple.com', 3, 4),
(25, 'Docteur Endocrinologie Nice', 'endocrinologie.nice@exemple.com', 3, 5),
(26, 'Docteur Endocrinologie Nantes', 'endocrinologie.nantes@exemple.com', 3, 6),
(27, 'Docteur Endocrinologie Strasbourg', 'endocrinologie.strasbourg@exemple.com', 3, 7),
(28, 'Docteur Endocrinologie Montpellier', 'endocrinologie.montpellier@exemple.com', 3, 8),
(29, 'Docteur Endocrinologie Bordeaux', 'endocrinologie.bordeaux@exemple.com', 3, 9),
(30, 'Docteur Endocrinologie Lille', 'endocrinologie.lille@exemple.com', 3, 10),
(31, 'Docteur Gynécologie Paris', 'gynécologie.paris@exemple.com', 4, 1),
(32, 'Docteur Gynécologie Marseille', 'gynécologie.marseille@exemple.com', 4, 2),
(33, 'Docteur Gynécologie Lyon', 'gynécologie.lyon@exemple.com', 4, 3),
(34, 'Docteur Gynécologie Toulouse', 'gynécologie.toulouse@exemple.com', 4, 4),
(35, 'Docteur Gynécologie Nice', 'gynécologie.nice@exemple.com', 4, 5),
(36, 'Docteur Gynécologie Nantes', 'gynécologie.nantes@exemple.com', 4, 6),
(37, 'Docteur Gynécologie Strasbourg', 'gynécologie.strasbourg@exemple.com', 4, 7),
(38, 'Docteur Gynécologie Montpellier', 'gynécologie.montpellier@exemple.com', 4, 8),
(39, 'Docteur Gynécologie Bordeaux', 'gynécologie.bordeaux@exemple.com', 4, 9),
(40, 'Docteur Gynécologie Lille', 'gynécologie.lille@exemple.com', 4, 10),
(41, 'Docteur Hématologie Paris', 'hématologie.paris@exemple.com', 5, 1),
(42, 'Docteur Hématologie Marseille', 'hématologie.marseille@exemple.com', 5, 2),
(43, 'Docteur Hématologie Lyon', 'hématologie.lyon@exemple.com', 5, 3),
(44, 'Docteur Hématologie Toulouse', 'hématologie.toulouse@exemple.com', 5, 4),
(45, 'Docteur Hématologie Nice', 'hématologie.nice@exemple.com', 5, 5),
(46, 'Docteur Hématologie Nantes', 'hématologie.nantes@exemple.com', 5, 6),
(47, 'Docteur Hématologie Strasbourg', 'hématologie.strasbourg@exemple.com', 5, 7),
(48, 'Docteur Hématologie Montpellier', 'hématologie.montpellier@exemple.com', 5, 8),
(49, 'Docteur Hématologie Bordeaux', 'hématologie.bordeaux@exemple.com', 5, 9),
(50, 'Docteur Hématologie Lille', 'hématologie.lille@exemple.com', 5, 10),
(51, 'Docteur Neurologie Paris', 'neurologie.paris@exemple.com', 6, 1),
(52, 'Docteur Neurologie Marseille', 'neurologie.marseille@exemple.com', 6, 2),
(53, 'Docteur Neurologie Lyon', 'neurologie.lyon@exemple.com', 6, 3),
(54, 'Docteur Neurologie Toulouse', 'neurologie.toulouse@exemple.com', 6, 4),
(55, 'Docteur Neurologie Nice', 'neurologie.nice@exemple.com', 6, 5),
(56, 'Docteur Neurologie Nantes', 'neurologie.nantes@exemple.com', 6, 6),
(57, 'Docteur Neurologie Strasbourg', 'neurologie.strasbourg@exemple.com', 6, 7),
(58, 'Docteur Neurologie Montpellier', 'neurologie.montpellier@exemple.com', 6, 8),
(59, 'Docteur Neurologie Bordeaux', 'neurologie.bordeaux@exemple.com', 6, 9),
(60, 'Docteur Neurologie Lille', 'neurologie.lille@exemple.com', 6, 10),
(61, 'Docteur Ophtalmologie Paris', 'ophtalmologie.paris@exemple.com', 7, 1),
(62, 'Docteur Ophtalmologie Marseille', 'ophtalmologie.marseille@exemple.com', 7, 2),
(63, 'Docteur Ophtalmologie Lyon', 'ophtalmologie.lyon@exemple.com', 7, 3),
(64, 'Docteur Ophtalmologie Toulouse', 'ophtalmologie.toulouse@exemple.com', 7, 4),
(65, 'Docteur Ophtalmologie Nice', 'ophtalmologie.nice@exemple.com', 7, 5),
(66, 'Docteur Ophtalmologie Nantes', 'ophtalmologie.nantes@exemple.com', 7, 6),
(67, 'Docteur Ophtalmologie Strasbourg', 'ophtalmologie.strasbourg@exemple.com', 7, 7),
(68, 'Docteur Ophtalmologie Montpellier', 'ophtalmologie.montpellier@exemple.com', 7, 8),
(69, 'Docteur Ophtalmologie Bordeaux', 'ophtalmologie.bordeaux@exemple.com', 7, 9),
(70, 'Docteur Ophtalmologie Lille', 'ophtalmologie.lille@exemple.com', 7, 10),
(71, 'Docteur Pédiatrie Paris', 'pédiatrie.paris@exemple.com', 8, 1),
(72, 'Docteur Pédiatrie Marseille', 'pédiatrie.marseille@exemple.com', 8, 2),
(73, 'Docteur Pédiatrie Lyon', 'pédiatrie.lyon@exemple.com', 8, 3),
(74, 'Docteur Pédiatrie Toulouse', 'pédiatrie.toulouse@exemple.com', 8, 4),
(75, 'Docteur Pédiatrie Nice', 'pédiatrie.nice@exemple.com', 8, 5),
(76, 'Docteur Pédiatrie Nantes', 'pédiatrie.nantes@exemple.com', 8, 6),
(77, 'Docteur Pédiatrie Strasbourg', 'pédiatrie.strasbourg@exemple.com', 8, 7),
(78, 'Docteur Pédiatrie Montpellier', 'pédiatrie.montpellier@exemple.com', 8, 8),
(79, 'Docteur Pédiatrie Bordeaux', 'pédiatrie.bordeaux@exemple.com', 8, 9),
(80, 'Docteur Pédiatrie Lille', 'pédiatrie.lille@exemple.com', 8, 10),
(81, 'Docteur Psychiatrie Paris', 'psychiatrie.paris@exemple.com', 9, 1),
(82, 'Docteur Psychiatrie Marseille', 'psychiatrie.marseille@exemple.com', 9, 2),
(83, 'Docteur Psychiatrie Lyon', 'psychiatrie.lyon@exemple.com', 9, 3),
(84, 'Docteur Psychiatrie Toulouse', 'psychiatrie.toulouse@exemple.com', 9, 4),
(85, 'Docteur Psychiatrie Nice', 'psychiatrie.nice@exemple.com', 9, 5),
(86, 'Docteur Psychiatrie Nantes', 'psychiatrie.nantes@exemple.com', 9, 6),
(87, 'Docteur Psychiatrie Strasbourg', 'psychiatrie.strasbourg@exemple.com', 9, 7),
(88, 'Docteur Psychiatrie Montpellier', 'psychiatrie.montpellier@exemple.com', 9, 8),
(89, 'Docteur Psychiatrie Bordeaux', 'psychiatrie.bordeaux@exemple.com', 9, 9),
(90, 'Docteur Psychiatrie Lille', 'psychiatrie.lille@exemple.com', 9, 10),
(91, 'Docteur Urologie Paris', 'urologie.paris@exemple.com', 10, 1),
(92, 'Docteur Urologie Marseille', 'urologie.marseille@exemple.com', 10, 2),
(93, 'Docteur Urologie Lyon', 'urologie.lyon@exemple.com', 10, 3),
(94, 'Docteur Urologie Toulouse', 'urologie.toulouse@exemple.com', 10, 4),
(95, 'Docteur Urologie Nice', 'urologie.nice@exemple.com', 10, 5),
(96, 'Docteur Urologie Nantes', 'urologie.nantes@exemple.com', 10, 6),
(97, 'Docteur Urologie Strasbourg', 'urologie.strasbourg@exemple.com', 10, 7),
(98, 'Docteur Urologie Montpellier', 'urologie.montpellier@exemple.com', 10, 8),
(99, 'Docteur Urologie Bordeaux', 'urologie.bordeaux@exemple.com', 10, 9),
(100, 'Docteur Urologie Lille', 'urologie.lille@exemple.com', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` int NOT NULL,
  `heure` time NOT NULL,
  `date` date NOT NULL,
  `utilisateur_id` int NOT NULL,
  `medecin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `heure`, `date`, `utilisateur_id`, `medecin_id`) VALUES
(46, '14:30:00', '2023-03-30', 39, 43);

-- --------------------------------------------------------

--
-- Table structure for table `specialites`
--

CREATE TABLE `specialites` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specialites`
--

INSERT INTO `specialites` (`id`, `nom`) VALUES
(1, 'Cardiologie'),
(2, 'Dermatologie'),
(3, 'Endocrinologie'),
(4, 'Gynécologie'),
(5, 'Hématologie'),
(6, 'Neurologie'),
(7, 'Ophtalmologie'),
(8, 'Pédiatrie'),
(9, 'Psychiatrie'),
(10, 'Urologie');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'utilisateur',
  `isAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `date_naissance`, `email`, `mot_de_passe`, `role`, `isAdmin`) VALUES
(39, 'Test', 'Jean', '1995-03-10', 'test@jean.fr', '$2y$10$koqoaiJFArBvIBI986g2suG3XDuaIMUJaCC2NVBxzTPQg/8Yyy2N2', 'admin', 1),
(40, 'Gerard', 'Test', '1995-10-20', 'gerard@test.fr', '$2y$10$Vcki6NkBKLX64AWbNsJBHufdlts..h36rKt0./qnBIi6OrkMI1veW', 'utilisateur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `villes`
--

CREATE TABLE `villes` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `villes`
--

INSERT INTO `villes` (`id`, `nom`) VALUES
(1, 'Paris'),
(2, 'Marseille'),
(3, 'Lyon'),
(4, 'Toulouse'),
(5, 'Nice'),
(6, 'Nantes'),
(7, 'Strasbourg'),
(8, 'Montpellier'),
(9, 'Bordeaux'),
(10, 'Lille');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medecins`
--
ALTER TABLE `medecins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialite_id` (`specialite_id`),
  ADD KEY `ville_id` (`ville_id`);

--
-- Indexes for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `medecin_id` (`medecin_id`);

--
-- Indexes for table `specialites`
--
ALTER TABLE `specialites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medecins`
--
ALTER TABLE `medecins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `specialites`
--
ALTER TABLE `specialites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medecins`
--
ALTER TABLE `medecins`
  ADD CONSTRAINT `medecins_ibfk_1` FOREIGN KEY (`specialite_id`) REFERENCES `specialites` (`id`),
  ADD CONSTRAINT `medecins_ibfk_2` FOREIGN KEY (`ville_id`) REFERENCES `villes` (`id`);

--
-- Constraints for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `rendez_vous_ibfk_2` FOREIGN KEY (`medecin_id`) REFERENCES `medecins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
