<?php
session_start();

// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "db_kiemtra"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Biến để lưu thông báo
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    // Kiểm tra tên đăng nhập và mật khẩu
    if (empty($username) || empty($password) || empty($password_confirm)) {
        $message = "Vui lòng điền đầy đủ thông tin!";
    } elseif ($password !== $password_confirm) {
        $message = "Mật khẩu và xác nhận mật khẩu không trùng khớp.";
    } else {
        // Kiểm tra tên đăng nhập đã tồn tại
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
        } else {
            // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashed_password = password_hash($password, $PASSWORD_DEFAULT);

            // Lưu tài khoản vào cơ sở dữ liệu
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
                header("Location: dangnhap.php"); // Chuyển hướng đến trang đăng nhập
                exit();
            } else {
                $message = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký</title>
    <style>
        /* Sử dụng CSS giống như trang đăng nhập */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .message {
            margin: 15px 0;
            color: green;
        }

        .error {
            margin: 15px 0;
            color: red;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Đăng Ký Tài Khoản</h2>

        <!-- Hiển thị thông báo nếu có -->
        <?php if ($message): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Form đăng ký -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Xác nhận mật khẩu:</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>
            <div class="form-group">
                <button type="submit">Đăng Ký</button>
            </div>
        </form>
        <p>Đã có tài khoản? <a href="dangnhap.php">Đăng nhập ngay</a></p>
    </div>
</body>

</html>