-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 27. 21:28
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `instrument_rental`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_type` enum('számlázási','szállítási','mindkettő') NOT NULL,
  `zip` int(11) NOT NULL,
  `settlement` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `street_type` varchar(30) NOT NULL,
  `house_number` varchar(100) NOT NULL,
  `floor_number` smallint(6) DEFAULT NULL,
  `door_number` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `instruments`
--

CREATE TABLE `instruments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `condition` enum('Új','Újszerű','Használt') NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `monthly_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `deposit` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `instruments`
--

INSERT INTO `instruments` (`id`, `category_id`, `brand_id`, `condition`, `title`, `description`, `monthly_price`, `deposit`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Használt', 'Yamaha F310', 'Kiváló belépő szintű dreadnought gitár, tömör lucfenyő tetőlappal.', 6000, 15000, 'https://ts4.mm.bing.net/th?id=OIP.KV_9oRgN5yEIOaLeFq9h8wHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(2, 1, 2, 'Használt', 'Fender CD-60', 'Gazdag, meleg hangzású dreadnought gitár, kezdőknek és haladóknak egyaránt.', 7000, 18000, 'https://ts3.mm.bing.net/th?id=OIP.FDncGMlUnYI_lM1xwuosoAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(3, 1, 3, 'Használt', 'Ibanez V50', 'Klasszikus dreadnought forma, könnyű játszhatóság, kezdők számára ideális.', 6500, 16000, 'https://ts3.mm.bing.net/th?id=OIP.Y1n-NPP4Uk91vI6AqYi86gHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(4, 1, 5, 'Újszerű', 'Cort Earth70', 'Solid spruce tetőlapú dreadnought, kiváló ár-érték arány.', 8000, 20000, 'https://ts3.mm.bing.net/th?id=OIP.mkA6JorOeqGx1yIVjwNKzwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(5, 1, 6, 'Újszerű', 'Takamine GD11M', 'Mahagóni tetőlapú dreadnought gitár, kiváló rezonancia és tónusmélység.', 8000, 20000, 'https://ts3.explicit.bing.net/th?id=OIP.Gu0VD3IAjst54p4crKng_wHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(6, 1, 7, 'Használt', 'Epiphone DR-100', 'Könnyű, barátságos akusztikus gitár, természetes és sunburst kivitelben.', 6500, 17000, 'https://ts2.mm.bing.net/th?id=OIP.yTodjplIDs6AfVRnULqEsgHaKT&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(7, 1, 8, 'Használt', 'Harley Benton D-120CE', 'Elektroakusztikus dreadnought cutaway gitár, beépített hangszedővel.', 5500, 14000, 'https://ts3.mm.bing.net/th?id=OIP.9OuDj1I1K2jMcCSW6pIg4gHaJ4&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(8, 1, 9, 'Újszerű', 'Sigma DM-ST', 'Természetes felületkezelésű solid top dreadnought, kiemelkedő hangminőség.', 9000, 22000, 'https://ts2.mm.bing.net/th?id=OIP.Sujyr509WVgTk-ZLqFZdEwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(9, 2, 4, 'Újszerű', 'Casio CDP-S110', 'Kompakt 88 billentyűs digitális zongora, kezdőknek ideális.', 12000, 30000, 'https://ts2.mm.bing.net/th?id=OIP.jk4Tb8KeeL6mJPyKLJcy9wHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(10, 2, 10, 'Újszerű', 'Roland FP-10', 'Hordozható 88 billentyűs Roland, PHA-4 Standard mechanika.', 13000, 35000, 'https://ts3.mm.bing.net/th?id=OIP.pnsVAMzEQ8kEpns5REIVMwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(11, 2, 1, 'Újszerű', 'Yamaha P-45', '88 kalapácsos billentyűzet, tiszta Yamaha hangminőség.', 12500, 28000, 'https://ts4.mm.bing.net/th?id=OIP.IcCQnebXxeXGxxH4Gr-wxgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(12, 2, 11, 'Újszerű', 'Korg B2', '88 billentyűs Korg digitális zongora.', 11000, 28000, 'https://ts2.mm.bing.net/th?id=OIP.04Xo95ECGL5oRQDVFOcDHwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(13, 2, 12, 'Új', 'Kawai ES110', 'Responsive Hammer Compact mechanika.', 15500, 41000, 'https://ts4.mm.bing.net/th?id=OIP.rq2m1CR1Oc69GCa4FongUwHaG2&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(14, 2, 4, 'Újszerű', 'Casio PX-S1100', 'Slim line Privia sorozat.', 14000, 38000, 'https://ts3.mm.bing.net/th?id=OIP.y0Ho_Nvy2hEBIFBNcceJiAHaF2&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(15, 3, 13, 'Újszerű', 'Alesis Turbo Mesh Kit', 'Elektromos dobszett mesh dobfejekkel, csendes játék, kezdőknek ideális.', 10000, 25000, 'https://ts1.mm.bing.net/th?id=OIP.8oVZ09yiExnae9X0rMBuEAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(16, 3, 13, 'Újszerű', 'Alesis Nitro Mesh Kit', 'Elektromos dob mesh fejjel.', 11000, 28000, 'https://ts3.mm.bing.net/th?id=OIP.OCK5Jibq8WjKWPj29-JYJAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(17, 3, 10, 'Újszerű', 'Roland TD-1DMK', 'Roland belépő szintű elektromos dob, mesh dobfejek.', 14000, 38000, 'https://ts2.mm.bing.net/th?id=OIP.yt85stDE0cTs-tzXEjXsywHaH7&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(18, 3, 1, 'Újszerű', 'Yamaha DTX402K', 'Yamaha DTX sorozat, 10 készlet, 287 hangszín.', 12000, 30000, 'https://ts2.mm.bing.net/th?id=OIP.a-DhvFjFZMA1oV7yCKLXrwHaGW&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(19, 3, 14, 'Újszerű', 'Millenium MPS-850', 'Mesh pad elektromos dobszett.', 10500, 27000, 'https://ts4.mm.bing.net/th?id=OIP.QvadRfJL239sdCrptkJ-QwHaHT&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(20, 3, 13, 'Újszerű', 'Alesis Command Mesh', 'Command Mesh Kit.', 13000, 34000, 'https://ts4.mm.bing.net/th?id=OIP.P_q9ENPhyZB_ni0BcI25VwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(21, 3, 10, 'Újszerű', 'Roland TD-50KV2', 'Csúcsmodell.', 30000, 85000, 'https://ts4.mm.bing.net/th?id=OIP._JvyDGgI_n2rPhxuPKpYqAHaFE&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(22, 3, 1, 'Újszerű', 'Yamaha DTX10K', 'DTX10 sorozat.', 28000, 80000, 'https://ts2.mm.bing.net/th?id=OIP.kBuJIS0i3DirnR5BgzhCUQHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(23, 3, 13, 'Újszerű', 'Alesis Strike Pro', 'Strike Pro Kit.', 24000, 68000, 'https://ts1.mm.bing.net/th?id=OIP.M76jcX0vDCK91uisU-84mAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(24, 3, 14, 'Újszerű', 'Millenium MPS-1000', 'MPS-1000 elektromos dob.', 20000, 55000, 'https://ts1.mm.bing.net/th?id=OIP.W8NzLf6fQeDE02Bgbr_n8QHaEK&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(25, 4, 33, 'Használt', '4/4-es hegedű kezdőszett', 'Teljes méretű hegedű kezdőszett vonóval és kofferrel, kezdőknek.', 5000, 12000, 'https://ts2.mm.bing.net/th?id=OIP.fk3M6_xCOAM3uPIuWFWu8AHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(26, 4, 15, 'Használt', 'Stentor Student 1', 'Belépő szintű Stentor hegedű, tömör tető és szett kiegészítők.', 5500, 13000, 'https://ts3.mm.bing.net/th?id=OIP.aqtSNgAAC9bk4_8NfcaMOQHaFj&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(27, 4, 16, 'Használt', 'Gewa Allegro', 'Német minőségű Gewa hegedű.', 7000, 18000, 'https://ts1.mm.bing.net/th?id=OIP.LyHRobyrrzAoO2T4rIJJLQHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(28, 4, 1, 'Újszerű', 'Yamaha V3SKA', 'Yamaha kezdő hegedűszett.', 8000, 20000, 'https://ts3.mm.bing.net/th?id=OIP.OV7nu1V17K05d1qVhNmveAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(29, 4, 17, 'Használt', 'Primavera 200', 'Belépő szintű hegedű.', 6000, 15000, 'https://ts2.mm.bing.net/th?id=OIP.PkqDU3t9opIxxf3t71dgvAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(30, 4, 18, 'Használt', 'Stagg VN-4/4', 'Teljes méretű Stagg hegedű.', 5000, 12000, 'https://ts2.mm.bing.net/th?id=OIP.Wxvdi067snPh5hFnyvEzhgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(31, 4, 19, 'Újszerű', 'Hidersine Vivente', 'Minőségi Hidersine hegedű.', 8500, 21000, 'https://ts3.mm.bing.net/th?id=OIP.v7vRwSyHZGaOsQ27eImzGwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(32, 4, 17, 'Használt', 'Primavera 100', 'Belépő szintű hegedű.', 5500, 13500, 'https://ts2.mm.bing.net/th?id=OIP.BmiDah8RcaB9fBqm5cBZ4QHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(33, 4, 15, 'Újszerű', 'Stentor Conservatoire', 'Felső kategóriás Stentor modell.', 8500, 21000, 'https://ts2.mm.bing.net/th?id=OIP.2by8HCYH1Q2qQ_lq-bsMEgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(34, 4, 15, 'Újszerű', 'Stentor Elysia', 'Felső kategóriás Stentor modell.', 11500, 30000, 'https://ts1.mm.bing.net/th?id=OIP.tKnLR969q0Xe8MM2AIVhSwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(35, 5, 1, 'Használt', 'Yamaha YAS-280', 'Megbízható belépő szintű alt szaxofon.', 14000, 40000, 'https://ts1.mm.bing.net/th?id=OIP.T93kIxeDVRR8RtGo7KDglwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(36, 5, 22, 'Használt', 'Trevor James The Horn', 'Kedvelt diák hangszer.', 16000, 48000, 'https://ts2.mm.bing.net/th?id=OIP.OKvCxdiTWUSbuDU9BgdvpAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(37, 5, 23, 'Használt', 'Conn-Selmer AS650', 'Diák alt szaxofon.', 13500, 36000, 'https://ts3.mm.bing.net/th?id=OIP.dBTnEKWq_5KXwqg-ohPoKgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(38, 5, 24, 'Használt', 'Gear4music Alto Sax', 'Belépő szintű alt szaxofon.', 10000, 25000, 'https://ts4.mm.bing.net/th?id=OIP.s9GsVKOotA7zG-Tv4lyCbgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(39, 5, 20, 'Használt', 'Jupiter JAS700', 'Haladó diák hangszer.', 17000, 50000, 'https://ts3.mm.bing.net/th?id=OIP.R4pZDftqAdPt4ofFcBmwbQHaHu&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(40, 5, 25, 'Használt', 'Buffet Crampon 100 Series', 'Minőségi alt szaxofon.', 18000, 55000, 'https://ts3.mm.bing.net/th?id=OIP.G1EVlGoYeCEplm3O4QieSAAAAA&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(41, 5, 22, 'Használt', 'Trevor James Alpha', 'Könnyű fújhatóság.', 12500, 33000, 'https://ts4.mm.bing.net/th?id=OIP.mPFfLMXuCH3MqRapautybgHaLH&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(42, 5, 1, 'Újszerű', 'Yamaha YAS-62', 'Professzionális Yamaha alt szaxofon.', 25000, 75000, 'https://ts1.mm.bing.net/th?id=OIP.IUIPNzcZryapXC4u3xkR4QHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(43, 5, 20, 'Újszerű', 'Jupiter JAS1100', 'Haladó Jupiter modell.', 21000, 60000, 'https://ts2.mm.bing.net/th?id=OIP.BHntntgBk_qG6dYyhZKEKgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(44, 5, 26, 'Újszerű', 'Yanagisawa AWO1', 'Prémium japán alt szaxofon.', 28000, 85000, 'https://ts2.mm.bing.net/th?id=OIP.oDRQUtRcQajexygUWa-lBgHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(45, 5, 21, 'Újszerű', 'Selmer Series 2', 'Professzionális Selmer hangszer.', 30000, 90000, 'https://ts2.mm.bing.net/th?id=OIP.a2nb6DMb3FX2C1f7WQU1pQHaJe&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(46, 5, 25, 'Újszerű', 'Buffet Senzo', 'Prémium francia alt szaxofon.', 27000, 80000, 'https://ts2.mm.bing.net/th?id=OIP.AEXoraSyXQlfYxy-rEm1hwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(47, 6, 27, 'Használt', 'Squier Stratocaster + erősítő', 'Kezdőknek ideális elektromos gitár szett.', 9000, 20000, 'https://ts3.mm.bing.net/th?id=OIP.zFuSmRWFTmPca01eO3xD2AHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(48, 6, 7, 'Használt', 'Epiphone Les Paul Special 2', 'Belépő szintű Les Paul modell.', 8500, 20000, 'https://ts1.mm.bing.net/th?id=OIP.Z4BFf-0vM04O87Z2YQ_NfAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(49, 6, 1, 'Használt', 'Yamaha Pacifica 112V', 'Kiváló ár-érték arányú Pacifica modell.', 9500, 22000, 'https://ts1.mm.bing.net/th?id=OIP.G6u_sZVEAa0_7oSFqwTuSAHaI2&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(50, 6, 2, 'Használt', 'Fender Squier Telecaster', 'Klasszikus Telecaster forma.', 10000, 25000, 'https://ts1.mm.bing.net/th?id=OIP.Ewi35LGrhF61mc66FhShagHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(51, 6, 8, 'Használt', 'Harley Benton ST-20', 'Belépő szintű ST modell.', 6500, 15000, 'https://ts1.mm.bing.net/th?id=OIP.AdW4izEqU4daB8TsEprsvAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(52, 6, 5, 'Használt', 'Cort X100', 'Modern formájú elektromos gitár.', 8000, 19000, 'https://ts1.mm.bing.net/th?id=OIP.k7EwvVIEhE-rdcftzagX3QHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(53, 6, 28, 'Használt', 'Jackson JS11 Dinky', 'Metal orientált hangszer.', 9500, 23000, 'https://ts2.mm.bing.net/th?id=OIP.QelzF30QUqh5r5SO4aGLvQHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(54, 6, 29, 'Használt', 'Gibson Les Paul Studio', 'Prémium Les Paul modell.', 22000, 70000, 'https://ts2.mm.bing.net/th?id=OIP.VwQEb2cbfwhrc2ZeSxJA1wHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(55, 6, 3, 'Használt', 'Ibanez AZES40', 'Modern Ibanez modell.', 12000, 32000, 'https://ts4.mm.bing.net/th?id=OIP.pBJH1tii9Fd_LjyY8ORykwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(56, 6, 30, 'Használt', 'PRS SE Custom 24', 'Kedvelt PRS modell.', 15000, 45000, 'https://ts4.mm.bing.net/th?id=OIP.I0SRLFQccyUD-laDCZpzMAHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(57, 6, 31, 'Használt', 'ESP LTD EC-256', 'Rock/metal orientált hangszer.', 12500, 35000, 'https://ts1.mm.bing.net/th?id=OIP.kL0igh5MNGMitCTpmPqrMwHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(58, 6, 32, 'Használt', 'Schecter C-6 Deluxe', 'Belépő szintű metal gitár.', 11500, 33000, 'https://ts2.mm.bing.net/th?id=OIP.eTA4lVZbr-Kg3S4egl428wHaHa&pid=15.1&o=7&rm=3', '2026-04-27 15:55:10', '2026-04-27 15:55:10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `instrument_brands`
--

CREATE TABLE `instrument_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(191) NOT NULL,
  `brand_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `instrument_brands`
--

INSERT INTO `instrument_brands` (`id`, `brand_name`, `brand_description`, `created_at`, `updated_at`) VALUES
(1, 'Yamaha', 'Japán hangszer- és elektronikai gyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(2, 'Fender', 'Világhírű gitár- és basszusgyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(3, 'Ibanez', 'Japán gitármárka, rock és metal játékosok kedvence.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(4, 'Casio', 'Digitális zongorák és szintetizátorok gyártója.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(5, 'Cort', 'Koreai gitárgyártó, kiváló ár-érték aránnyal.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(6, 'Takamine', 'Japán prémium akusztikus gitármárka.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(7, 'Epiphone', 'Gibson leányvállalata, megfizethető Les Paul és SG modellek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(8, 'Harley Benton', 'Thomann saját márkája, kiváló ár-érték arány.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(9, 'Sigma', 'Martin által alapított, prémium akusztikusgitár-márka.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(10, 'Roland', 'Professzionális zenei eszközök gyártója.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(11, 'Korg', 'Szintetizátorok és digitális zongorák japán gyártója.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(12, 'Kawai', 'Japán zongoragyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(13, 'Alesis', 'Elektromos dobok és stúdióeszközök gyártója.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(14, 'Millenium', 'Megfizethető dob- és ütőhangszerek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(15, 'Stentor', 'Brit hegedűgyártó, zeneiskolai hangszerek specialistája.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(16, 'Gewa', 'Német vonós hangszergyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(17, 'Primavera', 'Belépő szintű vonós hangszerek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(18, 'Stagg', 'Belga hangszermárka.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(19, 'Hidersine', 'Brit vonós hangszermárka.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(20, 'Jupiter', 'Tajvani fúvóshangszer-gyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(21, 'Selmer', 'Francia prémium szaxofongyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(22, 'Trevor James', 'Brit fúvóshangszer-gyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(23, 'Conn-Selmer', 'Amerikai fúvóshangszer-gyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(24, 'Gear4music', 'Brit online hangszerkereskedő saját márkája.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(25, 'Buffet Crampon', 'Francia prémium fúvóshangszer-gyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(26, 'Yanagisawa', 'Japán prémium szaxofongyártó.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(27, 'Squier', 'Fender leányvállalata, megfizethető modellek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(28, 'Jackson', 'Amerikai gitármárka, rock és metal kedvence.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(29, 'Gibson', 'Legendás amerikai gitármárka, Les Paul és SG alkotója.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(30, 'PRS', 'Paul Reed Smith gitárok, kézzel készített prémium hangszerek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(31, 'ESP', 'Japán gitármárka, rock és metal hangszerek specialistája.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(32, 'Schecter', 'Amerikai gitármárka, modern rock és metal modellekkel.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(33, 'Ismeretlen', 'Ismeretlen vagy vegyes gyártójú hangszerek.', '2026-04-27 15:55:10', '2026-04-27 15:55:10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `instrument_categories`
--

CREATE TABLE `instrument_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `instrument_categories`
--

INSERT INTO `instrument_categories` (`id`, `category_name`, `category_description`, `created_at`, `updated_at`) VALUES
(1, 'Akusztikus gitár', 'Akusztikus gitárok minden szinthez.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(2, 'Digitális zongora', 'Digitális zongorák kezdőknek és profiknak.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(3, 'Dobfelszerelés', 'Akusztikus és elektromos dobok.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(4, 'Hegedű', 'Hegedűk kezdőknek és haladóknak, minden méretben.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(5, 'Alt szaxofon', 'Alt szaxofonok iskolai és professzionális szintre.', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(6, 'Elektromos gitár', 'Elektromos gitárok erősítővel és anélkül.', '2026-04-27 15:55:10', '2026-04-27 15:55:10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_26_141144_create_personal_access_tokens_table', 1),
(5, '2026_03_26_145707_addresses', 1),
(6, '2026_03_26_150825_instrument_categories', 1),
(7, '2026_03_26_151211_instrument_brands', 1),
(8, '2026_03_26_151438_instruments', 1),
(9, '2026_03_26_152042_rents', 1),
(10, '2026_04_23_092421_add_price_and_deposit_to_instruments_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rents`
--

CREATE TABLE `rents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `instrument_id` bigint(20) UNSIGNED NOT NULL,
  `rent_price` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `real_end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('blENnj4BIFKgUQJOEu2KXAN3O9mbNRN62j7y8EZB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJlTGVkV0lyYmxFUFhTSk9xTmVobnJQVVhWNlBIQVd6OUZWOHBLUkFvIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1777312771),
('HFSiwWVU8dAtZKjR16kWptEXaqtwfhrV5sLqLi0z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJxVEx1dEk4cmczUGJOMmJXZndTa0ZINkgzb1dSS2NIOVFvRnY5WlVHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnQtYnJhbmRzIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1777312810),
('oMVAs5P1MAayRpuOs5RlGMcFrHcl5UqmKuYvgsip', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJJRWNSSzZqSmI0UW0xNm9YMWtBT1hNMHRuN3Q1ODd3cVNCcEszVThDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnRzIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1777312769),
('QFTB3u80pLcDtDXgXtaiQCEkBQ3XZTdjBZWMiHlf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJPV3MzMHRlb1VVbmZyNnVKZXFYN1BNOUVDNUVpbzdJcFE1aDR0SVNyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnQtY2F0ZWdvcmllcyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1777312769),
('u3Az57j6iPJTJ7v7KRhKMjrFPqjixi0GeDj2Bpan', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJ0Sm16aTdERmFyNDBmd2RvNzBrbHl6OUl3VVhKaXV2VVR0enY5OW5OIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnQtYnJhbmRzIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1777312769),
('YJrDGyFeGYXvTo8Ng7JKbNqZuYIMT9DSagz5iwhe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJ1VkRzUWZWRU5vc3VZeGRqQ2FWbEYwWGJqNVF4VEFYRmVDT1lCV1JGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnQtY2F0ZWdvcmllcyIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1777312810),
('YxWNQhi3KoavtyTJlnf8AzFDb3byYWwTNY3VSk5l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJ6eHFWRUR2TDRhR0tGYll0amh3RmFHb0JzRTZzb09sWDJaV1p1SkY3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2luc3RydW1lbnRzIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1777312809);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title` enum('Úr','Hölgy','Dr.','Professzor') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `is_admin`, `email`, `password`, `title`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@hangszer.hu', '$2y$12$QneKBYENZhDtLyQaOo6XN.8dqWuBdjRxsUYG2TIu3NEYSdOcaNVES', 'Úr', 'Admin', 'Admin', '2026-04-27 15:55:10', '2026-04-27 15:55:10'),
(2, 0, 'user@hangszer.hu', '$2y$12$UrMUZ0VIxZWNBdGX1xJUJuN2rIbjcRYzgM8B/2kUklCdTqsEufmB6', 'Úr', 'User', 'User', '2026-04-27 15:55:10', '2026-04-27 15:55:10');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instruments_category_id_foreign` (`category_id`),
  ADD KEY `instruments_brand_id_foreign` (`brand_id`);

--
-- A tábla indexei `instrument_brands`
--
ALTER TABLE `instrument_brands`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `instrument_categories`
--
ALTER TABLE `instrument_categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- A tábla indexei `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rents_user_id_foreign` (`user_id`),
  ADD KEY `rents_instrument_id_foreign` (`instrument_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `instruments`
--
ALTER TABLE `instruments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT a táblához `instrument_brands`
--
ALTER TABLE `instrument_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `instrument_categories`
--
ALTER TABLE `instrument_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rents`
--
ALTER TABLE `rents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `instruments`
--
ALTER TABLE `instruments`
  ADD CONSTRAINT `instruments_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `instrument_brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `instruments_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `instrument_categories` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_instrument_id_foreign` FOREIGN KEY (`instrument_id`) REFERENCES `instruments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
