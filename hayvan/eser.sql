-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Şub 2021, 11:02:11
-- Sunucu sürümü: 10.4.17-MariaDB
-- PHP Sürümü: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eser`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(50) NOT NULL,
  `eposta` varchar(50) NOT NULL,
  `telno` varchar(11) NOT NULL,
  `mesaj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `adsoyad`, `eposta`, `telno`, `mesaj`) VALUES
(48, 'aa', 'aa', 'aa', 'aa'),
(49, 'krrr', 'krrr', 'krrr', 'krrr');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resim`
--

CREATE TABLE `resim` (
  `id` int(11) NOT NULL,
  `resimyol` varchar(999) NOT NULL,
  `kupeno` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `resim`
--

INSERT INTO `resim` (`id`, `resimyol`, `kupeno`) VALUES
(22, 'resim/1.jpg', '12227772222322'),
(29, 'resim/2.jpg', '11111111111111'),
(30, 'resim/3.jpg', '12247772222322');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tip`
--

CREATE TABLE `tip` (
  `id` int(11) NOT NULL,
  `kategori` varchar(40) NOT NULL,
  `marka` varchar(40) NOT NULL,
  `model` varchar(40) NOT NULL,
  `plaka` varchar(40) NOT NULL,
  `kurban` varchar(40) NOT NULL,
  `saseno` varchar(40) NOT NULL,
  `muayene` date NOT NULL,
  `resimyolu` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tip`
--

INSERT INTO `tip` (`id`, `kategori`, `marka`, `model`, `plaka`, `kurban`, `saseno`, `muayene`, `resimyolu`) VALUES
(1, 'Simental', '2', 'Yok', 'Yapıldı', 'Uygun', '12227772222322', '2020-12-09', 'resim/1.jpg'),
(2, 'Holstein', '1', 'Yok', 'Yapıldı', 'Uygun', '11111111111111', '2020-12-16', 'resim/2.jpg'),
(3, 'Belçika', '1', 'Var', 'Yapılmadı', 'Uygun Değil', '12247772222322', '2020-12-17', 'resim/3.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

CREATE TABLE `yonetici` (
  `id` int(11) NOT NULL,
  `kulad` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`id`, `kulad`, `sifre`) VALUES
(1, 'eser', '96de4eceb9a0c2b9b52c0b618819821b'),
(6, 'krm', '96de4eceb9a0c2b9b52c0b618819821b');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `resim`
--
ALTER TABLE `resim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Tablo için AUTO_INCREMENT değeri `resim`
--
ALTER TABLE `resim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `tip`
--
ALTER TABLE `tip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
