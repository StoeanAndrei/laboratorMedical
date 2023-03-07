-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 19, 2023 la 04:34 PM
-- Versiune server: 10.4.21-MariaDB
-- Versiune PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `laboratormedical`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `adrese_pacienti`
--

CREATE TABLE `adrese_pacienti` (
  `ID_Adresa` int(11) NOT NULL,
  `Judet` varchar(50) NOT NULL,
  `Localitate` varchar(50) NOT NULL,
  `Strada` varchar(50) NOT NULL,
  `Numar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `adrese_pacienti`
--

INSERT INTO `adrese_pacienti` (`ID_Adresa`, `Judet`, `Localitate`, `Strada`, `Numar`) VALUES
(1, 'Ialomita', 'Urziceni', 'Stadionului', 47),
(2, 'Buzau', 'Buzau', 'Mare', 4),
(4, 'Prahova', 'Valenii de Munte', 'Mihai Viteazu', 6),
(5, 'Ialomita', 'Urziceni', 'Liceului', 12),
(6, 'Prahova', 'Maneciu', 'Lunga', 5),
(10, 'Bucuresti', 'Sector 4', 'Tei', 67),
(11, 'Prahova', 'Ploiesti', '45', 67),
(13, 'Constanta', 'Costinesti', 'Laleaua', 23),
(14, 'Ialomita', 'Movilita', '23', 56),
(15, 'Arges', 'Campulung', 'Mioritei', 7),
(16, 'Ialomita', 'Urziceni', 'Preciziei', 34);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `analize`
--

CREATE TABLE `analize` (
  `ID_Analiza` int(11) NOT NULL,
  `Denumire` varchar(50) NOT NULL,
  `Detaliu` varchar(150) NOT NULL,
  `Pret` int(11) NOT NULL DEFAULT 0,
  `ID_Categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `analize`
--

INSERT INTO `analize` (`ID_Analiza`, `Denumire`, `Detaliu`, `Pret`, `ID_Categorie`) VALUES
(1, 'Analiza pulmonara', 'Masurarea gradului de toxicitate', 250, 1),
(2, 'Analiza cardiaca', 'Monitorizarea batailor inimii', 100, 3),
(3, 'Analiza sangelui', 'Observarea densitatii sangelui', 70, 4),
(4, 'Camerele inimii', 'Controlul functionarii corespunzatoare a camerelor', 160, 3),
(5, 'Anti-HCV', 'ARN-VHC confirma diagnosticul si cuantifica numarul de copii virale in sange', 80, 2),
(6, 'Activitatea plasminogenului', 'Plasminogenul este sintetizat in ficat, prezent in diferite tesuturi si fluide', 100, 5),
(7, 'Acid vanilmandelic', 'Acidul 3-metoxi-4-hidroximandelic constituie principalul metabolit al al epinefrinei si norepinefrinei', 60, 6),
(8, 'Osteocalcin', 'Osteocalcinul (denumit si proteina G1a a osului) ', 100, 7);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `buletine`
--

CREATE TABLE `buletine` (
  `ID_Buletin` int(11) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `ID_Medic` int(11) NOT NULL,
  `ID_Pacient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `buletine`
--

INSERT INTO `buletine` (`ID_Buletin`, `Date`, `ID_Medic`, `ID_Pacient`) VALUES
(2, 'Analize generale', 1, 1),
(4, 'Analize generale', 2, 4),
(5, 'Analize generale', 3, 8),
(6, 'Analize generale', 3, 5),
(7, 'Analize generale', 2, 9),
(8, 'Analize generale', 4, 10),
(9, 'Analize generale', 4, 11);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categorii`
--

CREATE TABLE `categorii` (
  `ID_Categorie` int(11) NOT NULL,
  `Denumire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `categorii`
--

INSERT INTO `categorii` (`ID_Categorie`, `Denumire`) VALUES
(1, 'Test Toxicologic'),
(2, 'Markeri Virali'),
(3, 'Puls cardiac'),
(4, 'Detalii sanguine'),
(5, 'Teste de hematologie'),
(6, 'Markeri tumorali'),
(7, 'Markeri Ososi');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `detalii_buletin`
--

CREATE TABLE `detalii_buletin` (
  `ID_Detaliu` int(11) NOT NULL,
  `Valoare` varchar(50) NOT NULL,
  `ID_Analiza` int(11) NOT NULL,
  `ID_Buletin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `detalii_buletin`
--

INSERT INTO `detalii_buletin` (`ID_Detaliu`, `Valoare`, `ID_Analiza`, `ID_Buletin`) VALUES
(1, 'Plamani sanatosi', 1, 2),
(2, 'Inima sanatoasa, intr-un corp sanatos', 2, 4),
(3, 'Plamani buni', 1, 4),
(4, 'Sanatos tun', 5, 5),
(5, 'Excelente analize!', 3, 6),
(6, 'Inima sanatoasa iubeste mai mult', 2, 6),
(7, 'Bun rau nepotu, fumeaza de rupe', 1, 7),
(8, 'Sange sanatos, mai are putin si moare baba', 3, 8),
(9, 'Mai are putin si moare', 5, 8),
(10, 'Ce sa mai vorbim domnule doctor, e lesinata', 4, 8),
(11, 'Bun1', 2, 9),
(12, 'Bun2', 6, 9),
(13, 'Bun3', 8, 9);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `grade_medici`
--

CREATE TABLE `grade_medici` (
  `ID_Grad` int(11) NOT NULL,
  `Grad` int(11) NOT NULL,
  `OreConsult` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `grade_medici`
--

INSERT INTO `grade_medici` (`ID_Grad`, `Grad`, `OreConsult`) VALUES
(1, 3, 1280),
(2, 2, 165),
(3, 5, 240),
(4, 1, 40);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `medici`
--

CREATE TABLE `medici` (
  `ID_Medic` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Parola` varchar(50) NOT NULL,
  `Specializare` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  `ID_Grad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `medici`
--

INSERT INTO `medici` (`ID_Medic`, `Nume`, `Prenume`, `Parola`, `Specializare`, `Email`, `Telefon`, `ID_Grad`) VALUES
(1, 'Boraciu', 'Sanda', 'boraClau2000', 'Medic generalist', 'sanda20@yahoo.com', '0767892352', 1),
(2, 'Stoean', 'Georgeta', 'gina2023', 'Medic generalist', 'georgeta@yahoo.com', '0774888888', 2),
(3, 'Andrei', 'Florin', 'ambulantierul2022', 'Medic ambulantier', 'flo@yahoo.com', '0787654300', 3),
(4, 'Stoica', 'Alexandra', 'alexa2002', 'Medic de familie', 'alex@yahoo.ro', '0782783542', 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `pacienti`
--

CREATE TABLE `pacienti` (
  `ID_Pacient` int(11) NOT NULL,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `CNP` varchar(13) NOT NULL,
  `Sex` char(1) NOT NULL DEFAULT 'F',
  `Varsta` int(11) NOT NULL,
  `Inaltime` float NOT NULL,
  `Greutate` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  `ID_Adresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Eliminarea datelor din tabel `pacienti`
--

INSERT INTO `pacienti` (`ID_Pacient`, `Nume`, `Prenume`, `CNP`, `Sex`, `Varsta`, `Inaltime`, `Greutate`, `Email`, `Telefon`, `ID_Adresa`) VALUES
(1, 'Stoean', 'Andrei', '1234567890123', 'M', 22, 1.85, 78, 'andreistoean@yahoo.com', '0767111222', 1),
(2, 'Gavaneanu', 'Cristinica', '1423854730264', 'F', 21, 16.5, 55, 'gava@yahoo.com', '761110000', 2),
(4, 'Jercan', 'Sabin', '1234567899876', 'M', 21, 19.1, 92, 'sabin@yahoo.com', '0777777777', 6),
(5, 'Andrei', 'Alina', '1234567899871', 'F', 20, 16, 52, 'alina@yahoo.com', '0777777774', 10),
(6, 'Nemtia', 'Viorica', '2345678910999', 'F', 19, 16, 45, 'vio20@gmail.com', '0777111122', 11),
(8, 'Popescu', 'Liviu', '6374937263456', 'M', 21, 1.67, 71, 'livache2000@yahoo.com', '0762635473', 13),
(9, 'Cristea', 'Marian', '2647384568345', 'M', 45, 1.7, 89, 'marian@gmail.com', '0762637432', 14),
(10, 'Pipilutescu', 'Andreea', '1745637211324', 'F', 78, 1.56, 64, 'andia@yahoo.com', '0788232323', 15),
(11, 'X', 'Dragos', '1111111111111', 'M', 47, 2.1, 89, 'andragos@yahoo.com', '0767921333', 16);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `adrese_pacienti`
--
ALTER TABLE `adrese_pacienti`
  ADD PRIMARY KEY (`ID_Adresa`);

--
-- Indexuri pentru tabele `analize`
--
ALTER TABLE `analize`
  ADD PRIMARY KEY (`ID_Analiza`);

--
-- Indexuri pentru tabele `buletine`
--
ALTER TABLE `buletine`
  ADD PRIMARY KEY (`ID_Buletin`),
  ADD UNIQUE KEY `ID_Medic` (`ID_Medic`,`ID_Pacient`),
  ADD KEY `ID_Pacient` (`ID_Pacient`);

--
-- Indexuri pentru tabele `categorii`
--
ALTER TABLE `categorii`
  ADD PRIMARY KEY (`ID_Categorie`);

--
-- Indexuri pentru tabele `detalii_buletin`
--
ALTER TABLE `detalii_buletin`
  ADD PRIMARY KEY (`ID_Detaliu`),
  ADD UNIQUE KEY `ID_Analiza` (`ID_Analiza`,`ID_Buletin`),
  ADD KEY `ID_Buletin` (`ID_Buletin`);

--
-- Indexuri pentru tabele `grade_medici`
--
ALTER TABLE `grade_medici`
  ADD PRIMARY KEY (`ID_Grad`);

--
-- Indexuri pentru tabele `medici`
--
ALTER TABLE `medici`
  ADD PRIMARY KEY (`ID_Medic`),
  ADD UNIQUE KEY `ID_Grad` (`ID_Grad`);

--
-- Indexuri pentru tabele `pacienti`
--
ALTER TABLE `pacienti`
  ADD PRIMARY KEY (`ID_Pacient`),
  ADD UNIQUE KEY `CNP` (`CNP`),
  ADD UNIQUE KEY `ID_Adresa` (`ID_Adresa`);

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `analize`
--
ALTER TABLE `analize`
  ADD CONSTRAINT `analize_ibfk_1` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorii` (`ID_Categorie`);

--
-- Constrângeri pentru tabele `buletine`
--
ALTER TABLE `buletine`
  ADD CONSTRAINT `buletine_ibfk_1` FOREIGN KEY (`ID_Pacient`) REFERENCES `pacienti` (`ID_Pacient`),
  ADD CONSTRAINT `buletine_ibfk_2` FOREIGN KEY (`ID_Medic`) REFERENCES `medici` (`ID_Medic`);

--
-- Constrângeri pentru tabele `detalii_buletin`
--
ALTER TABLE `detalii_buletin`
  ADD CONSTRAINT `detalii_buletin_ibfk_1` FOREIGN KEY (`ID_Analiza`) REFERENCES `analize` (`ID_Analiza`),
  ADD CONSTRAINT `detalii_buletin_ibfk_2` FOREIGN KEY (`ID_Buletin`) REFERENCES `buletine` (`ID_Buletin`);

--
-- Constrângeri pentru tabele `medici`
--
ALTER TABLE `medici`
  ADD CONSTRAINT `medici_ibfk_1` FOREIGN KEY (`ID_Grad`) REFERENCES `grade_medici` (`ID_Grad`);

--
-- Constrângeri pentru tabele `pacienti`
--
ALTER TABLE `pacienti`
  ADD CONSTRAINT `pacienti_ibfk_1` FOREIGN KEY (`ID_Adresa`) REFERENCES `adrese_pacienti` (`ID_Adresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
