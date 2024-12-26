<?php
require "model/config.php";
require "model/db.php"; 
require "model/sanPham_DB.php";
$sanPhamDB = new SanPham_DB();

//var_dump($getAllCates);
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">TDC SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
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
                        Register / Login
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
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>