-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 26, 2024 lúc 03:06 PM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_kiemtra`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

DROP TABLE IF EXISTS `tbl_danhmuc`;
CREATE TABLE IF NOT EXISTS `tbl_danhmuc` (
  `ma_danhmuc` int NOT NULL AUTO_INCREMENT,
  `ten_danhmuc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_danhmuc`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`ma_danhmuc`, `ten_danhmuc`) VALUES
(1, 'Dien thoai'),
(2, 'Laptop'),
(3, 'Thiet bi khac');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nguoidung`
--

DROP TABLE IF EXISTS `tbl_nguoidung`;
CREATE TABLE IF NOT EXISTS `tbl_nguoidung` (
  `tendangnhap` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `matkhau` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quyen` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

DROP TABLE IF EXISTS `tbl_sanpham`;
CREATE TABLE IF NOT EXISTS `tbl_sanpham` (
  `ma_sanpham` int NOT NULL AUTO_INCREMENT,
  `ten_sanpham` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_sanpham` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `xuatxu_sanpham` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_sanpham` int NOT NULL,
  `mota_sanpham` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_danhmuc` int NOT NULL,
  PRIMARY KEY (`ma_sanpham`),
  KEY `FK_SanPham_DanhMuc` (`ma_danhmuc`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`ma_sanpham`, `ten_sanpham`, `hinh_sanpham`, `xuatxu_sanpham`, `gia_sanpham`, `mota_sanpham`, `ma_danhmuc`) VALUES
(1, 'Điện Thoại IPhone 16 Ultra Promax', 'img/IPhone16.png', 'VietNam', 20000000, 'Máy mới 100% , chính hãng Apple Việt Nam.\nCellphoneS hiện là đại lý bán lẻ uỷ quyền iPhone chính hãng VN/A của Apple Việt Nam\niPhone sử dụng iOS 18, Cáp Sạc USB‑C (1m), Tài liệu\n1 ĐỔI 1 trong 30 ngày nếu có lỗi phần cứng nhà sản xuất. Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple: CareS.vn(xem chi tiết)\nGiá sản phẩm đã bao gồm VAT', 1),
(2, 'Điện thoại realme C67 8GB/128GB', 'img/realme.png', 'VietNam', 3790000, 'Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Cây lấy sim, Ốp lưng, Cáp Type C, Củ sạc nhanh rời đầu Type A\n\nchính sách bảo hành\nHư gì đổi nấy 12 tháng tại 2965 siêu thị toàn quốc (miễn phí tháng đầu) Xem chi tiết\n\nchính sách bảo hành\nBảo hành chính hãng điện thoại 1 năm tại các trung tâm bảo hành hãng', 1),
(3, 'Điện Thoại Samsung Galaxy 20 Ultra Promax', 'img/Samsung.png', 'VietNam', 20000000, 'Màn hình Dynamic AMOLED 2X, 6.9\", Quad HD+ (2K+)\n\nChip Exynos 990\n\nRAM: 12 GB\n\nDung lượng: 256 GB\n\nCamera sau: Chính 108 MP & Phụ 12 MP, 12 MP, cảm biến Laser AF', 1),
(4, 'MacBook Pro M2 2022 8GB/512GB', 'img/Macbook.png', 'VietNam', 15000000, 'Loại card đồ họa. 10 nhân GPU · Dung lượng RAM. 8GB · Loại RAM. 8GB · Ổ cứng. 512GB SSD · Cổng giao tiếp. Cổng sạc. Cổng màn hình. Thunderbolt 3 (lên đến 40Gb/s)', 1),
(5, 'Điện Thoại WinPhone', 'img/Win.png', 'VietNam', 15000000, 'Windows Phone 7 có thể coi là một cái nhìn hoàn toàn mới về hệ điều hành dành cho điện thoại. ', 1),
(6, 'Laptop gaming Msi', 'img/Msi.png', 'VietNam', 20000000, 'RAM 256GB, ROM 1028GB, SSD 512GB', 2),
(7, 'Laptop gaming Asus', 'img/Asus.png', 'VietNam', 20000000, 'ROM 1024GB, RAM 1024GB, SSD 1024GB', 2),
(8, 'Laptop Dell', 'img/Dell.png', 'VietNam', 19000000, 'ROM 512GB, RAM 256GB, HDD 128GB', 2),
(9, 'Laptop HP', 'img/HP.png', 'VietNam', 20000000, 'ROM 512GB, RAM 512GB, HDD 512GB', 2),
(10, 'Laptop Macbook', 'img/Mac.png', 'VietNam', 20000000, 'ROM 512GB, RAM 512GB, SSD 512GB', 2),
(11, 'Tai nghe Bluetooth co day', 'img/blue.png', 'VietNam', 150000, 'Mới, đầy đủ phụ kiện từ nhà sản xuất\nTai nghe và Hộp sạc, Sách hướng dẫn\nBảo hành 18 tháng chính hãng 1 đổi 1 trong 15 ngày nếu có lỗi phần cứng từ NSX.(xem chi tiết)\nGiá sản phẩm đã bao gồm VAT', 3),
(12, 'Cục Sạc Bluetooth', 'img/sac.png', 'VietNam', 200000, 'Pin sạc dự phòng không dây chính hãng, giá rẻ, sạc nhanh.', 3),
(13, 'Chuột không dây Logitech MX Master 2S', 'img/chuot.png', 'VietNam', 1390000, 'Mới, đầy đủ phụ kiện từ nhà sản xuất\r\n1 x Chuột không dây Logitech, 1 x Dây cáp đi kèm, 1 x Sách hướng dẫn sử dụng\r\nBảo hành 12 tháng chính hãng. (xem chi tiết)\r\nGiá sản phẩm đã bao gồm VAT', 3),
(14, 'Sạc laptop', 'img/lap.png', 'VietNam', 300000, 'Mới, đầy đủ phụ kiện từ nhà sản xuất\nCủ sạc, Sách hướng dẫn\nBảo hành 18 tháng chính hãng, 1 đổi 1(xem chi tiết)\nGiá sản phẩm đã bao gồm VAT', 3),
(15, 'Ốp Lưng Điện Thoại ', 'img/op.png', 'VietNam', 120000, 'Ốp lung điện thoại in theo yêu cầu\r\nTình trạng: Còn hàng', 3),
(16, 'Túi Đụng LapTop', 'img/tui.png', 'VietNam', 150000, 'Sản phẩm mới, chính hãng (Không bảo hành, đổi trả).', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
