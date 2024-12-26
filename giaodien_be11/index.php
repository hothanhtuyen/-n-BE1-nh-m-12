<?php

require_once './model/sanPham_DB.php';
require_once './model/db.php';
$sanPhamDB = new SanPham_DB();
session_start();

//Featured News
$featuredProducts = $sanPhamDB->LaySanPhamNoiBat(4);
$searchResults = [];
// Hiển thị thông báo đăng nhập thành công nếu có
////if (isset($_SESSION['message'])) {
//echo '<p class="message">' . $_SESSION['message'] . '</p>';
//unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
//}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TDC SHOP</title>
    <div id="#!">

    </div>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>


    <!-- Hiển thị thông tin người dùng nếu đã đăng nhập -->
    <?php if (isset($_SESSION['tendangnhap'])): ?>

        <a href="logout.php"></a>
    <?php else: ?>
        <p><a href="dangnhap.php"></a> </p>
    <?php endif; ?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">TDC SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <?php
                            $danhMuc = $sanPhamDB->LayTatCaDanhMuc();
                            foreach ($danhMuc as $key => $value) {
                            ?>
                                <li><a class="dropdown-item" href="archive.php?maDM=<?php echo $value['ma_danhmuc'] ?>"><?php echo $value['ten_danhmuc'] ?></a></li>
                            <?php
                            }
                            ?>

                        </ul>
                    </li>
                </ul>
                <form action="result.php" method="get">
                    <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                        <input name="keyword" type="text" class="form-control border-0" placeholder="Keyword">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-primary text-dark border-0 px-3">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="cart.php" class="cart-btn">

                    <button type="button">🛒 cart </button>
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                    <?php endif; ?>
                </a>
                <form class="d-flex">
                    <a class="btn btn-outline-dark" href="dangnhap.php">
                        <i class="bi bi-person-fill"></i>
                        <?php if (isset($_SESSION['tendangnhap'])): ?>
                            <p>Xin chào, <?php echo htmlspecialchars($_SESSION['tendangnhap'], ENT_QUOTES, 'UTF-8'); ?>!</p>
                        <?php endif; ?>

                    </a>
                </form>
                <!-- Form đăng xuất -->
                <form action="logout.php" method="POST">
                    <button type="submit" name="logout">Đăng Xuất</button>
                </form>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">SHOP TDC</h1>
                <p class="lead fw-normal text-white-50 mb-0">Thiết Bị Điện Tử</p>
            </div>
        </div>
    </header>
    <!-- Featured News -->
    <div class="featured-news">
        <h2>Featured News</h2>
        <div class="news-container">
            <?php foreach ($featuredProducts as $value): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?php echo $value->hinhSanPham ?>" alt="<?php echo $value->tenSanPham ?>" />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <a href="chiTietSanPham.php?maSP=<?php echo $value->maSanPham ?>" style="text-decoration: none; color: black">
                                    <?php echo $value->tenSanPham ?>
                                </a>
                                <?php echo number_format($value->giaSanPham, 0, ',', '.') ?> VNĐ
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form method="post" action="cart.php">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="maSanPham" value="<?= $value->maSanPham ?>">
                                    <input type="hidden" name="tenSanPham" value="<?= $value->tenSanPham ?>">
                                    <input type="hidden" name="giaSanPham" value="<?= $value->giaSanPham ?>">
                                    <input type="hidden" name="hinhSanPham" value="<?= $value->hinhSanPham ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Thêm vào giỏ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <style>
        /* Style cho phần Featured News */
        .featured-news {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .featured-news h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 30px;
            text-align: center;
        }

        .news-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-body .text-center {
            margin-bottom: 20px;
        }

        .card-body a {
            display: block;
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .card-body a:hover {
            color: #0056b3;
        }

        .card-body .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #28a745;
        }

        .card-footer {
            background-color: transparent;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .card-footer .btn {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .card-footer .btn:hover {
            background-color: #0056b3;
        }

        .card-footer .btn:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php

                $danhSachSanPham = $sanPhamDB->LayTatCaSanPham();
                if (isset($_GET['maDM'])) {
                    $danhSachSanPham = $sanPhamDB->LaySanPhamTheoDanhMuc($_GET['maDM']);
                }

                foreach ($danhSachSanPham as  $value) {
                ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $value->hinhSanPham ?>" alt="<?php echo $value->tenSanPham ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><a href="chiTietSanPham.php?maSP=<?php echo $value->maSanPham ?>" style="text-decoration: none; color: black"><?php echo $value->tenSanPham ?></a></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>

                                    </div>
                                    <?php echo number_format($value->giaSanPham, 0, ',', '.') ?> VNĐ
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="maSanPham" value="<?= $value->maSanPham ?>">
                                        <input type="hidden" name="tenSanPham" value="<?= $value->tenSanPham ?>">
                                        <input type="hidden" name="giaSanPham" value="<?= $value->giaSanPham ?>">
                                        <input type="hidden" name="hinhSanPham" value="<?= $value->hinhSanPham ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-outline-dark mt-auto">Thêm vào giỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Footer--
    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>