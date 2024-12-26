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

    // Kiểm tra tên đăng nhập và mật khẩu
    if (empty($username) || empty($password)) {
        $message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        // Kiểm tra tên đăng nhập trong cơ sở dữ liệu
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $db_username, $db_password);

        if ($stmt->num_rows > 0) {
            $stmt->fetch(); // Lấy thông tin người dùng

            // Kiểm tra mật khẩu
            if (password_verify($password, $db_password)) {
                $_SESSION['tendangnhap'] = $db_username; // Lưu thông tin người dùng vào session
                $_SESSION['message'] = "Đăng nhập thành công! Xin chào, " . htmlspecialchars($db_username) . ".";
                header("Location: index.php"); // Chuyển hướng đến trang index.php
                exit();
            } else {
                $message = "Mật khẩu không đúng.";
            }
        } else {
            $message = "Tên đăng nhập không tồn tại.";
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
    <title>Đăng Nhập</title>
    <style>
        /* Sử dụng CSS giống như trang đăng ký */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-container h2 {
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
    <div class="login-container">
        <h2>Đăng Nhập</h2>

        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if ($message): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Form đăng nhập -->
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
                <button type="submit">Đăng Nhập</button>
            </div>
        </form>
        <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>
    </div>
</body>

</html>