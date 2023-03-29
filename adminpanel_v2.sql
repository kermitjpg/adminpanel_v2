-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                8.0.17 - MySQL Community Server - GPL
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- midyepanel_v2 için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `midyepanel_v2` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `midyepanel_v2`;

-- tablo yapısı dökülüyor midyepanel_v2.anasayfa
CREATE TABLE IF NOT EXISTS `anasayfa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanimlama` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `anahtar` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tawk` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.bankalar
CREATE TABLE IF NOT EXISTS `bankalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `havale_hesap` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `havale_ad` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `havale_hesap_no` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `havale_sube` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `havale_iban` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.havale
CREATE TABLE IF NOT EXISTS `havale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gonderen_adsoyad` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `islem_saati` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sistem_saati` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `banka_adi` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tutar` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=416 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.hesapayarlari
CREATE TABLE IF NOT EXISTS `hesapayarlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `papara_hesap` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `papara_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payfix_hesap` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payfix_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kripto_no` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.kayitolan
CREATE TABLE IF NOT EXISTS `kayitolan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parola` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ad_soyad` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tc_no` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bakiye` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0₺',
  `ip` char(20) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '1',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.kripto
CREATE TABLE IF NOT EXISTS `kripto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `islem_saati` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sistem_saati` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gonderilen_coin` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tutar` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.mefete
CREATE TABLE IF NOT EXISTS `mefete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `islem_saati` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sistem_saati` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mefete_kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tutar` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.papara
CREATE TABLE IF NOT EXISTS `papara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `islem_saati` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sistem_saati` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `papara_kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tutar` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.payfix
CREATE TABLE IF NOT EXISTS `payfix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tel_no` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `islem_saati` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sistem_saati` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payfix_kullanici` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tutar` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  `okundu` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.sayac_ip
CREATE TABLE IF NOT EXISTS `sayac_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  `tiklama` int(11) NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.sayac_online
CREATE TABLE IF NOT EXISTS `sayac_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tarih` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.sayac_toplam
CREATE TABLE IF NOT EXISTS `sayac_toplam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `toplam_tekil` int(11) NOT NULL,
  `toplam_cogul` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.yatirimlimitleri
CREATE TABLE IF NOT EXISTS `yatirimlimitleri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `havale_minimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `havale_maksimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `papara_minimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `papara_maksimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payfix_minimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payfix_maksimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kripto_minimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kripto_maksimum` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

-- tablo yapısı dökülüyor midyepanel_v2.yoneticiler
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parola` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `yetki` tinyint(4) NOT NULL,
  `aktif` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `kadi` (`kadi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Veri çıktısı seçilmemişti

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
