<?php
require_once 'SanPham_DB.php';
$db = new SanPham_DB();

// Lấy mã sản phẩm từ query string
$maSP = isset($_GET['maSP']) ? intval($_GET['maSP']) : 0;
$product = $db->LaySanPhamTheoMaSanPham($maSP);

// Kiểm tra nếu sản phẩm không tồn tại
if (!$product) {
    echo "<h3>Sản phẩm không tồn tại.</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Quay lại trang chủ -->
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Quay lại</a>

        <div class="row">
            <!-- Ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($product->getHinhAnh()); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product->getTenSP()); ?>">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($product->getTenSP()); ?></h1>
                <p class="text-muted">Danh mục: <?php echo htmlspecialchars($product->getDanhMuc()); ?></p>
                <p class="fs-4 text-danger">
                    <?php echo number_format($product->getDonGia(), 0, ',', '.'); ?> VND
                </p>
                <p><?php echo nl2br(htmlspecialchars($product->getMoTa())); ?></p>

                <!-- Thêm vào giỏ hàng -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="maSP" value="<?php echo $product->getMaSP(); ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control w-25" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>

        <!-- Đánh giá và bình luận -->
        <div class="mt-5">
            <h3>Đánh giá và bình luận</h3>
            <form action="add_review.php" method="POST" class="mb-4">
                <input type="hidden" name="maSP" value="<?php echo $product->getMaSP(); ?>">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Viết đánh giá của bạn..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Chấm điểm:</label>
                    <select id="rating" name="rating" class="form-select w-25">
                        <option value="5">5 - Tuyệt vời</option>
                        <option value="4">4 - Tốt</option>
                        <option value="3">3 - Bình thường</option>
                        <option value="2">2 - Kém</option>
                        <option value="1">1 - Rất tệ</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Gửi đánh giá</button>
            </form>

            <div class="reviews">
                <!-- Lặp qua danh sách đánh giá -->
                <?php
                $reviews = $db->LayDanhGiaSanPham($maSP); // Hàm này cần được định nghĩa trong `SanPham_DB`
                if (empty($reviews)) {
                    echo "<p>Chưa có đánh giá nào.</p>";
                } else {
                    foreach ($reviews as $review) {
                        echo "<div class='border rounded p-3 mb-3'>";
                        echo "<p><strong>" . htmlspecialchars($review['user_name']) . "</strong> - " . str_repeat('★', $review['rating']) . "</p>";
                        echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
                        echo "<p class='text-muted'>Ngày: " . htmlspecialchars($review['date']) . "</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
