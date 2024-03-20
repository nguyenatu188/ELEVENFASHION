-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2024 lúc 10:31 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `elevenfs`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `checks` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cid`, `uid`, `pid`, `quantity`, `checks`) VALUES
(2, 7, 2, 4, 0),
(11, 1, 3, 1, 1),
(16, 7, 1, 9, 0),
(18, 7, 5, 4, 1),
(19, 7, 8, 1, 1),
(20, 7, 7, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `designer`
--

CREATE TABLE `designer` (
  `did` int(11) NOT NULL,
  `dName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `designer`
--

INSERT INTO `designer` (`did`, `dName`) VALUES
(1, 'Gucci'),
(2, 'christian dior');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `oDate` date DEFAULT NULL,
  `payMethod` char(40) DEFAULT NULL,
  `total` decimal(19,4) DEFAULT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`oid`, `oDate`, `payMethod`, `total`, `uid`) VALUES
(40, '2024-03-07', 'Thanh toán khi nhận hàng', 40.0000, 7),
(41, '2024-03-07', 'Thanh toán khi nhận hàng', 75.0000, 7),
(42, '2024-03-07', 'Thanh toán khi nhận hàng', 190.0000, 7),
(43, '2024-03-07', 'Thanh toán khi nhận hàng', 215.0000, 7),
(44, '2024-03-07', 'Thanh toán khi nhận hàng', 150.0000, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`oid`, `pid`, `soLuong`, `sub_total`) VALUES
(40, 1, 7, 70),
(40, 2, 4, 40),
(40, 3, 1, 10),
(40, 4, 3, 30),
(41, 1, 7, 70),
(41, 2, 4, 40),
(41, 3, 1, 10),
(41, 4, 3, 30),
(41, 5, 3, 75),
(42, 1, 9, 90),
(42, 5, 4, 100),
(43, 1, 9, 90),
(43, 5, 4, 100),
(43, 8, 1, 25),
(44, 5, 4, 100),
(44, 7, 1, 25),
(44, 8, 1, 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `pName` varchar(50) DEFAULT NULL,
  `pImage` varchar(30) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `size` char(10) DEFAULT NULL,
  `fabric` varchar(50) DEFAULT NULL,
  `importDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pid`, `did`, `pName`, `pImage`, `price`, `size`, `fabric`, `importDate`) VALUES
(1, 1, 'black washed jersey shirt with gucci logo', 'a.jpeg', 10.0000, 'S', 'cotton', '2024-01-01'),
(2, 1, 'black washed jersey shirt with gucci logo', 'a.jpeg', 10.0000, 'M', 'cotton', '2024-01-01'),
(3, 1, 'black washed jersey shirt with gucci logo', 'a.jpeg', 10.0000, 'L', 'cotton', '2024-01-01'),
(4, 1, 'black washed jersey shirt with gucci logo', 'a.jpeg', 10.0000, 'XL', 'cotton', '2024-01-01'),
(5, 2, 'Cannage Overshirt', 'Cannage Overshirt.jpg', 25.0000, 'S', 'black technical fabric', '2024-03-03'),
(6, 2, 'Cannage Overshirt', 'Cannage Overshirt.jpg', 25.0000, 'M', 'black technical fabric', '2024-03-03'),
(7, 2, 'Cannage Overshirt', 'Cannage Overshirt.jpg', 25.0000, 'L', 'black technical fabric', '2024-03-03'),
(8, 2, 'Cannage Overshirt', 'Cannage Overshirt.jpg', 25.0000, 'XL', 'black technical fabric', '2024-03-03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping`
--

CREATE TABLE `shipping` (
  `shipid` int(11) NOT NULL,
  `receiverFirstName` char(20) DEFAULT NULL,
  `receiverLastName` char(20) DEFAULT NULL,
  `receiverPhone` char(10) DEFAULT NULL,
  `shippingTo` varchar(30) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shipping`
--

INSERT INTO `shipping` (`shipid`, `receiverFirstName`, `receiverLastName`, `receiverPhone`, `shippingTo`, `oid`) VALUES
(40, 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc', 40),
(41, 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc', 41),
(42, 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc', 42),
(43, 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc', 43),
(44, 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc', 44);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `phoneNo` char(10) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`uid`, `email`, `password`, `firstName`, `lastName`, `phoneNo`, `address`) VALUES
(1, 'nnguyentu13@gmail.com', '1', 'Nguyễn', 'Anh Tú', '0982017836', 'số 10 ngõ 101 Vĩnh Phúc'),
(7, 'vinh@gmail.com', '123', 'Nguyễn', 'VINH', '0999017888', 'số 12 ngõ 101 Vĩnh Phúc');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Chỉ mục cho bảng `designer`
--
ALTER TABLE `designer`
  ADD PRIMARY KEY (`did`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `fk_uid_orders` (`uid`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`oid`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `did` (`did`);

--
-- Chỉ mục cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipid`),
  ADD KEY `oid` (`oid`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `designer`
--
ALTER TABLE `designer`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_uid_orders` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`did`) REFERENCES `designer` (`did`);

--
-- Các ràng buộc cho bảng `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
