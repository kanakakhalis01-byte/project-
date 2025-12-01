-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2025 pada 10.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$hZfkhskiYNkjvdwDqe.Ybe7jjgnf.2ySCzMd1nYCzUvmZW8n8keCi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `img`, `desc`) VALUES
(1, 'Margarita', 17.00, 'public/img/m1.jpg', 'A classic pizza with fresh tomatoes, mozzarella, and basil.'),
(2, 'Montanara', 17.00, 'public/img/m2.jpg', 'A savory pizza with sausage, mushrooms, and red chili.'),
(3, 'Con Carne', 17.00, 'public/img/m3.jpg', 'A meat lover\'s dream with a rich tomato sauce and fresh basil.'),
(4, 'Pepperoni', 17.00, 'public/img/m4.jpg', 'A classic pepperoni pizza with arugula and black olives.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_time` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `transaction_time`, `total`, `status`) VALUES
(1, NULL, '2025-10-14 14:37:01', 17.00, 'Pending'),
(2, NULL, '2025-10-14 14:37:40', 17.00, 'Pending'),
(3, NULL, '2025-10-14 14:38:22', 170.00, 'Pending'),
(4, NULL, '2025-10-14 17:14:49', 17.00, 'Pending'),
(5, NULL, '2025-10-16 11:31:09', 85.00, 'Processing'),
(6, 2, '2025-10-16 21:45:11', 17.00, 'Completed'),
(7, 2, '2025-10-19 22:45:23', 34.00, 'Pending'),
(8, 2, '2025-10-19 22:46:49', 17.00, 'Pending'),
(9, 2, '2025-10-20 10:02:08', 17.00, 'Pending'),
(10, 2, '2025-10-20 10:04:08', 17.00, 'Pending'),
(11, 4, '2025-10-20 14:41:04', 17.00, 'Pending'),
(12, 4, '2025-10-20 14:42:41', 51.00, 'Completed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 17.00),
(2, 2, 2, 1, 17.00),
(3, 3, 1, 10, 17.00),
(4, 4, 2, 1, 17.00),
(5, 5, 3, 5, 17.00),
(6, 6, 1, 1, 17.00),
(7, 7, 2, 2, 17.00),
(8, 8, 2, 1, 17.00),
(9, 9, 2, 1, 17.00),
(10, 10, 2, 1, 17.00),
(11, 11, 1, 1, 17.00),
(12, 12, 2, 3, 17.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'rezki', '$2y$10$hrZQ2aaqNNytzLkzZWc33.aEAr5vok0EBxAnct0iSQCybi8QfUyp6'),
(2, 'langit', '$2y$10$NbPNX9SPn4PJJeDRdD0LZOge6cBI/7NgeT9wEVusN6r.LQqVpI0A.'),
(3, 'kanaka', '$2y$10$RJ8jVNWmf/OPDIashcyItuFK62wYDSqdc5K5o4iTCJlza83Ger1pW'),
(4, 'nakita', '$2y$10$AKdepnueZODgzv5r9mdgGeFHTdBYOJjZddTq.6PfL.p0o2gmZ2bs2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
