<?php
var_dump($_FILES);

include 'model/config.php';
include 'model/db.php';
include 'model/item.php';

// Khởi tạo biến
$ten_sanpham = $_POST['ten_sanpham'] ?? '';
$hinhsanpham = $_FILES['fileupload']['name'] ?? '';
$xuatxu_sanpham = $_POST['xuatxu_sanpham'] ?? '';
$gia_sanpham = $_POST['gia_sanpham'] ?? '';
$mota_sanpham = $_POST['mota_sanpham'] ?? '';

// Kiểm tra dữ liệu bắt buộc
if (empty($ten_sanpham) || empty($hinhsanpham) || empty($xuatxu_sanpham) || empty($gia_sanpham)) {
    die("Vui lòng nhập đầy đủ thông tin!");
}

// Thư mục lưu trữ tệp
$target_dir = './img/';
$target_file = $target_dir . basename($hinhsanpham);
$upload_ok = true;

// Kiểm tra lỗi tải tệp
if ($_FILES['fileupload']['error'] !== UPLOAD_ERR_OK) {
    echo "Lỗi tải tệp!";
    $upload_ok = false;
}

// Xác thực loại tệp
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (!in_array($file_type, ['jpg', 'jpeg', 'png'])) {
    echo "Chỉ cho phép các tệp JPG, JPEG, PNG.";
    $upload_ok = false;
}

// Di chuyển tệp nếu không có lỗi
if ($upload_ok) {
    if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_file)) {
        echo "Tệp đã được tải lên thành công.";
    } else {
        echo "Không thể di chuyển tệp.";
        $upload_ok = false;
    }
}

// Thêm dữ liệu vào cơ sở dữ liệu
if ($upload_ok) {
    $item = new Item();
    $item->addItem($ten_sanpham, $hinhsanpham, $xuatxu_sanpham, $gia_sanpham, $mota_sanpham);
    header('Location: items.php');
    exit;
} else {
    echo "Lỗi khi xử lý tải tệp.";
}
?>