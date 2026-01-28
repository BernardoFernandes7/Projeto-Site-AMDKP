-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- A despejar estrutura para tabela amdkp.admin_users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela amdkp.admin_users: ~0 rows (aproximadamente)
REPLACE INTO `admin_users` (`id`, `username`, `password`) VALUES
	(1, 'admin', '$2y$10$Xu3xiCTcp1rLQdQ/NcyF7eBA68y4bciINT2gKTtv1IWnOhl4f.yp6');

-- A despejar estrutura para tabela amdkp.dojos
CREATE TABLE IF NOT EXISTS `dojos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `localidade` varchar(100) DEFAULT NULL,
  `morada` text,
  `sensei` varchar(255) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `maps` text,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `respnome` varchar(150) DEFAULT NULL,
  `secretariaemail` varchar(100) DEFAULT NULL,
  `logourl` varchar(255) DEFAULT NULL,
  `fotosurl` varchar(255) DEFAULT NULL,
  `galeriaurl` varchar(255) DEFAULT NULL,
  `galeriainstrutoresurl` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `horario` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela amdkp.dojos: ~16 rows (aproximadamente)
REPLACE INTO `dojos` (`id`, `nome`, `localidade`, `morada`, `sensei`, `telefone`, `whatsapp`, `email`, `site`, `maps`, `facebook`, `instagram`, `respnome`, `secretariaemail`, `logourl`, `fotosurl`, `galeriaurl`, `galeriainstrutoresurl`, `ativo`, `horario`) VALUES
	(1, 'CLUBE ACADEMY KARATE COIMBRA', 'Adémia', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Ema Lopes | Filipe Fernandes', '965668579', '965668579', 'secretaria.karatecoimbra@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(2, 'Clube Millenniumbcp', 'Porto', 'Rua de Sá da Bandeira, n.º 135 - Porto, 4000-433', 'Carlos Rodrigues', '933735828', '933735828', 'clubemillenniumbcp.karate@amdkp.pt', 'www.clubemillenniumbcp.pt', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2753.5675651824877!2d-8.168168424522904!3d40.3025946625789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22e0f76e205a5d%3A0x8aa31a7e3ea51f06!2sLargo%20Eng.%20Maur%C3%ADcio%20Vieira%20de%20Brito%2C%203360-250%20S%C3%A3o%20Pedro%20de%20Alva!5e1!3m2!1spt-PT!2spt!4v1769360183244!5m2!1spt-PT!2spt', NULL, NULL, 'contacto', 'mail secretaria', 'img/dojos/millenium.jpg', 'img/dojos/millenium.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(3, 'Karate Lousã', 'Lousã', 'Rua de Coimbra, 3200-114', 'Rui Rodrigues', '918762500', '918762500', 'karatelousa@gmail.com', 'https:\\www.adam-lousa.pt', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2761.0364896114957!2d-8.251597324532423!3d40.119008673706745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ef535f3809fb%3A0x438d352222503494!2sEscola%20de%20Karat%C3%A9%20da%20Lous%C3%A3!5e1!3m2!1spt-PT!2spt!4v1769360291056!5m2!1spt-PT!2spt', 'https://www.facebook.com/escola.karate.lousa', 'https://www.instagram.com/lousakarate', 'contacto', 'mail secretaria', 'img/dojos/lousa.jpg', 'img/dojos/lousa.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(4, 'Karate Miranda', 'Miranda do Corvo', 'Rua de Coimbra, 3200-114', 'Rui Rodrigues | Sensei Mariana Pereira', '918762500', '918762500', 'karatelousa@gmail.com', 'https:\\www.adam-lousa.pt', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2761.0364896114957!2d-8.251597324532423!3d40.119008673706745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ef535f3809fb%3A0x438d352222503494!2sEscola%20de%20Karat%C3%A9%20da%20Lous%C3%A3!5e1!3m2!1spt-PT!2spt!4v1769360291056!5m2!1spt-PT!2spt', NULL, NULL, 'contacto', 'mail secretaria', 'img/dojos/lousa.jpg', 'img/dojos/lousa.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(5, 'Centro Escolas Bruna Lopes', 'Coimbra', 'Pavilhão de Lordemão: R. Fernando dos Reis Marques 1, 3020-250 Coimbra', 'Bruna Lopes', '918430018', '918430018', 'escolaskaratebrunalopes@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2756.4411605467794!2d-8.417253024526566!3d40.23204406686008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22f94135e6edc5%3A0x6a98462df139b4b!2sPavilh%C3%A3o%20de%20Lordem%C3%A3o!5e1!3m2!1spt-PT!2spt!4v1769361539956!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/escolaskaratebrunalopes?igsh=MTBqOHFvYzcydmJqaw==', 'contacto', 'mail secretaria', 'img/dojos/bruna.jpg', 'img/dojos/bruna.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(6, 'MKFIT', 'Faro', 'R. Júdice Fialho n.37 8005-253', 'Marco Mealha', '918483916', '918483916', 'clubemkfit@gmail.com', 'https://mealhakaratefit.wixsite.com/mkfit', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2882.330572100145!2d-7.967459524685972!3d37.03176355461304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1ab2aa40448f3d%3A0xac29cd6b9bd44201!2sMKFit%20Karate%20Montenegro!5e1!3m2!1spt-PT!2spt!4v1769360378771!5m2!1spt-PT!2spt', 'https://www.facebook.com/MKfitMontenegro', 'https://www.instagram.com/explore/locations/1661460497439666/mkfit-montenegro/', 'contacto', 'mail secretaria', 'img/dojos/Mkfit.jpg', 'img/dojos/Mkfit.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(7, 'Karate São Pedro Alva', 'São Pedro Alva', 'Largo Eng. Mauricio Vieira de Brito, São Pedro de Alva, 3360-258', 'Hélio Jorge', '969372967', '969372967', 'karatespalva@gmail.com', NULL, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2753.5637703685975!2d-8.168384124522909!3d40.3026877625733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22e0f7702d582d%3A0xbbb99d0160d948cf!2sKarate%20Shukokai%20S%C3%A3o%20Pedro%20Alva!5e1!3m2!1spt-PT!2spt!4v1769361608050!5m2!1spt-PT!2spt', 'https://www.facebook.com/karateSPA', 'https://www.instagram.com/karate.spa/', 'contacto', 'mail secretaria', 'img/dojos/spedro.jpg', 'img/dojos/spedro.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(8, 'Clube Karate Tânia Correia', 'Coimbra', 'Rua do campo de futebol Nº1 3025-548 São Silvestre', 'Tânia Correia', '916206929', '916206930', 'c.karatetaniacorreia@gmail.com', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2756.53876275713!2d-8.5252021!3d40.229645999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2256633025b3cd%3A0x57f3727a0980cb54!2sRua%20Campo%20de%20Futebol%2C%20S%C3%A3o%20Silvestre!5e1!3m2!1spt-PT!2spt!4v1769360237383!5m2!1spt-PT!2spt', NULL, NULL, 'contacto', 'mail secretaria', 'img/dojos/tania.jpg', 'img/dojos/tania.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(9, 'IKIGAI CLUBE KARATEPOIARES', 'Vila Nova de Poiares', 'CCP (Centro cultural de Poiares), Avenida dos bombeiros | 3350-160 Poiares Santo André', 'Marco Simões', '919832889', '919832889', 'geral@karatepoiares.pt', 'https://www.karatepoiares.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2757.3115179658407!2d-8.260836824527676!3d40.21065536815695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22e5aee4bc3fb3%3A0x4e8060c1f8170109!2sCIKP%20-%20IKIGAI%20CLUBE%20KARATE%20POIARES!5e1!3m2!1spt-PT!2spt!4v1769360418029!5m2!1spt-PT!2spt', 'https://www.facebook.com/KarateShukokaiPoiares', 'https://www.instagram.com/karatepoiares/', 'contacto', 'mail secretaria', 'img/dojos/poiares.jpg', 'img/dojos/poiares.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(10, 'Karaté de Trouxemil', 'Trouxemil', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Guilherme Graça', '961371264', '961371264', 'guilherme.varges.graca@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(11, 'Karate Adémia', 'Coimbra', 'Adémia, 3020', 'Constança Matos', '911 562 951', '911 562 951', 'karateconstancamatos@amdkp.pt', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(12, 'Eiras', 'Coimbra', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Bruna Lopes', '918430018', '918430018', 'escolaskaratebrunalopes@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(13, 'Brasfemes', 'Coimbra', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Bruna Lopes', '918430018', '918430018', 'escolaskaratebrunalopes@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(14, 'Sta. Apolónia', 'Coimbra', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Bruna Lopes', '918430018', '918430018', 'escolaskaratebrunalopes@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h'),
	(15, 'Loreto', 'Coimbra', 'Rua Vale do Paraíso, Lote 6 3020-501 Ponte de Eiras - Coimbra', 'Bruna Lopes', '918430018', '918430018', 'escolaskaratebrunalopes@gmail.com', 'https://www.karatecoimbra.pt/', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2755.7946272757367!2d-8.440921924525709!3d40.24792626589682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22ffaa9bd662c3%3A0x4e235ec05f8ece4e!2sClube%20Academia%20Karate%20Coimbra%20-%20CAKC!5e1!3m2!1spt-PT!2spt!4v1769360328780!5m2!1spt-PT!2spt', 'https://www.facebook.com/karatecoimbra', 'https://www.instagram.com/karatecoimbra/', 'contacto', 'mail secretaria', 'img/dojos/Cack.jpg', 'img/dojos/Cack.jpg', NULL, NULL, 1, 'segunda a sexta das 19-20 h');

-- A despejar estrutura para tabela amdkp.galeria_albuns
CREATE TABLE IF NOT EXISTS `galeria_albuns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `data_evento` date DEFAULT NULL,
  `imagem_capa` varchar(255) DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela amdkp.galeria_albuns: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela amdkp.galeria_fotos
CREATE TABLE IF NOT EXISTS `galeria_fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `url_foto` varchar(255) NOT NULL,
  `data_upload` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela amdkp.galeria_fotos: ~27 rows (aproximadamente)
REPLACE INTO `galeria_fotos` (`id`, `categoria`, `titulo`, `url_foto`, `data_upload`) VALUES
	(1, 'jornadas', 'Jornada', 'img/jornada/jornada1.jpg', '2026-01-26 16:09:28'),
	(2, 'jornadas', 'Jornada', 'img/jornada/jornada2.jpg', '2026-01-26 16:09:28'),
	(3, 'jornadas', 'Jornada', 'img/jornada/jornada3.jpg', '2026-01-26 16:09:28'),
	(4, 'jornadas', 'Jornada', 'img/jornada/jornada4.jpg', '2026-01-26 16:09:28'),
	(5, 'jornadas', 'Jornada', 'img/jornada/jornada5.jpg', '2026-01-26 16:09:28'),
	(6, 'jornadas', 'Jornada', 'img/jornada/jornada6.jpg', '2026-01-26 16:09:28'),
	(7, 'jornadas', 'Jornada', 'img/jornada/jornada7.jpg', '2026-01-26 16:09:28'),
	(8, 'jornadas', 'Jornada', 'img/jornada/jornada8.jpg', '2026-01-26 16:09:28'),
	(9, 'jornadas', 'Jornada', 'img/jornada/jornada9.jpg', '2026-01-26 16:09:28'),
	(10, 'masterclass', 'Masterclass', 'img/masterclass/masterclass1.jpg', '2026-01-26 16:09:28'),
	(11, 'masterclass', 'Masterclass', 'img/masterclass/masterclass2.jpg', '2026-01-26 16:09:28'),
	(12, 'masterclass', 'Masterclass', 'img/masterclass/masterclass3.jpg', '2026-01-26 16:09:28'),
	(13, 'masterclass', 'Masterclass', 'img/masterclass/masterclass4.jpg', '2026-01-26 16:09:28'),
	(14, 'masterclass', 'Masterclass', 'img/masterclass/masterclass5.jpg', '2026-01-26 16:09:28'),
	(15, 'masterclass', 'Masterclass', 'img/masterclass/masterclass6.jpg', '2026-01-26 16:09:28'),
	(16, 'masterclass', 'Masterclass', 'img/masterclass/masterclass7.jpg', '2026-01-26 16:09:28'),
	(17, 'masterclass', 'Masterclass', 'img/masterclass/masterclass8.jpg', '2026-01-26 16:09:28'),
	(18, 'masterclass', 'Masterclass', 'img/masterclass/masterclass9.jpg', '2026-01-26 16:09:28'),
	(19, 'meeting', 'Meeting', 'img/meeting/meeting1.jpg', '2026-01-26 16:09:28'),
	(20, 'meeting', 'Meeting', 'img/meeting/meeting2.jpg', '2026-01-26 16:09:28'),
	(21, 'meeting', 'Meeting', 'img/meeting/meeting3.jpg', '2026-01-26 16:09:28'),
	(22, 'meeting', 'Meeting', 'img/meeting/meeting4.jpg', '2026-01-26 16:09:28'),
	(23, 'meeting', 'Meeting', 'img/meeting/meeting5.jpg', '2026-01-26 16:09:28'),
	(24, 'meeting', 'Meeting', 'img/meeting/meeting6.jpg', '2026-01-26 16:09:28'),
	(25, 'meeting', 'Meeting', 'img/meeting/meeting7.jpg', '2026-01-26 16:09:28'),
	(26, 'meeting', 'Meeting', 'img/meeting/meeting8.jpg', '2026-01-26 16:09:28'),
	(27, 'meeting', 'Meeting', 'img/meeting/meeting9.jpg', '2026-01-26 16:09:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
