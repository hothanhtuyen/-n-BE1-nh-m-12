<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Debug dữ liệu POST
echo '<pre>';

echo '</pre>';

// Đảm bảo giỏ hàng được khởi tạo
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý các thao tác trên giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Chỉ khởi tạo session nếu nó chưa được bắt đầu
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $action = $_POST['action'];
    $maSanPham = $_POST['maSanPham'] ?? null;

    switch ($action) {
        case 'add': // Thêm sản phẩm vào giỏ hàng
            $quantity = $_POST['quantity'] ?? 1;
            if (isset($_SESSION['cart'][$maSanPham])) {
                $_SESSION['cart'][$maSanPham]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$maSanPham] = [
                    'tenSanPham' => $_POST['tenSanPham'],
                    'giaSanPham' => $_POST['giaSanPham'],
                    'hinhSanPham' => $_POST['hinhSanPham'],
                    'quantity' => $quantity,
                ];
            }
            break;

        case 'update': // Sửa số lượng sản phẩm trong giỏ hàng
            $quantity = $_POST['quantity'];
            if (isset($_SESSION['cart'][$maSanPham])) {
                $_SESSION['cart'][$maSanPham]['quantity'] = $quantity;
            }
            break;

        case 'delete': // Xóa sản phẩm khỏi giỏ hàng
            unset($_SESSION['cart'][$maSanPham]);
            break;

        case 'checkout': // Thanh toán
            // Xử lý thanh toán
            break;
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
<a class="nav-link active" aria-current="page" href="index.php">Trang Chủ</a>

    <div class="container mt-5">
        <h1>Giỏ Hàng</h1>
        <table class="table">
    <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $maSanPham => $item): ?>
                <tr>
                    <td><img src="<?= $item['hinhSanPham'] ?>" alt="<?= $item['tenSanPham'] ?>" width="50"></td>
                    <td><?= $item['tenSanPham'] ?></td>
                    <td><?= number_format($item['giaSanPham'], 0, ',', '.') ?> VNĐ</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['giaSanPham'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <!-- Form để xóa sản phẩm -->
                        <form method="post" action="cart.php" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="maSanPham" value="<?= $maSanPham ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Giỏ hàng trống</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


        
        <?php
// Giả sử dữ liệu giỏ hàng có trong $_SESSION['cart']
if (!empty($_SESSION['cart'])) {
    $tongTien = 0;

    // Tính tổng tiền
    foreach ($_SESSION['cart'] as $item) {
        $tongTien += $item['giaSanPham'] * $item['quantity'];
    }
    ?>

    <!-- Hiển thị tổng tiền và nút thanh toán -->
    <div>
        <h3>Tổng tiền: <?php echo number_format($tongTien, 0, ',', '.'); ?> VNĐ</h3>
        <form method="POST" action="cart.php">
            <input type="hidden" name="action" value="checkout">
            <button type="submit">Thanh toán</button>
            <a href="index.php" class="btn btn">Tiếp Tục Mua Sắm</a>
        </form>
    </div>

    <?php
} else {
    echo "<p>Giỏ hàng trống.</p>";
}

?>

    </div>
</body>

</html>
