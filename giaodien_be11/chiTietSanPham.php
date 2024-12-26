<?php
require_once './model/sanPham_DB.php';
require_once './model/db.php';

$sanPhamDB = new SanPham_DB();

// Lấy mã sản phẩm từ URL
if (isset($_GET['maSP'])) {
    $maSP = $_GET['maSP'];
    $sanPham = $sanPhamDB->LaySanPhamTheoMaSanPham($maSP); // Hàm lấy thông tin sản phẩm theo mã
    if (!$sanPham) {
        die('Không tìm thấy sản phẩm.');
    }
} else {
    die('Mã sản phẩm không hợp lệ.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark py-3">
        <div class="container">
            <h1 class="text-white text-center">Chi tiết sản phẩm</h1>
        </div>
    </header>

    <!-- Chi tiết sản phẩm -->
    <div class="container mt-5">
        <div class="row">
            <!-- Ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="<?php echo $sanPham->hinhSanPham ?>" class="img-fluid" alt="<?php echo $sanPham->tenSanPham ?>">
            </div>
            
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2><?php echo $sanPham->tenSanPham ?></h2>
                <p class="text-muted"><?php echo number_format($sanPham->giaSanPham, 0, ',', '.') ?> VNĐ</p>
                <p><?php echo $sanPham->moTaSanPham ?></p>
                <a href="cart.php?ma=<?php echo $sanPham->maSanPham ?>" class="btn btn-primary">Thêm vào giỏ</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark mt-5">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
