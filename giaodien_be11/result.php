<?php
include "header.php";


// Thiết lập số lượng sản phẩm hiển thị trên mỗi trang
$limit = 2;

// Xác định trang hiện tại
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Tính chỉ số bắt đầu của sản phẩm trên trang hiện tại
$offset = ($page - 1) * $limit;

// Nếu có từ khóa tìm kiếm
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Lấy tổng số sản phẩm phù hợp với từ khóa
    $totalProducts = $sanPhamDB->countSearchResults($keyword);

    // Lấy danh sách sản phẩm theo từ khóa với phân trang
    $danhSachSanPham = $sanPhamDB->searchWithPagination($keyword, $limit, $offset);
} else {
    // Lấy tổng số sản phẩm
    $totalProducts = $sanPhamDB->countAllProducts();

    // Lấy danh sách tất cả sản phẩm với phân trang
    $danhSachSanPham = $sanPhamDB->LayTatCaSanPhamPhanTrang($limit, $offset);
}

// Tính tổng số trang
$totalPages = ceil($totalProducts / $limit);
?>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            if (isset($danhSachSanPham) && !empty($danhSachSanPham)) {
                foreach ($danhSachSanPham as $value) {
                    ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                            </div>
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $value->hinhSanPham ?>"
                                 alt="<?php echo $value->tenSanPham ?>" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><a href="item.php?maSP=<?php echo $value->maSanPham ?>"
                                                             style="text-decoration: none; color: black"><?php echo $value->tenSanPham?></a>
                                    </h5>
                                    <!-- Product price-->
                                    <?php echo number_format($value->giaSanPham ?? 0, 0, ',', '.') ?> VNĐ
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                            href="cart.php?ma=<?php echo $value->maSanPham ?>">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="text-center">Không có sản phẩm nào được tìm thấy.</p>';
            }
            ?>

        </div>

        <!-- Phân trang -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&keyword=<?php echo $keyword ?? ''; ?>"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link"
                           href="?page=<?php echo $i; ?>&keyword=<?php echo $keyword ?? ''; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&keyword=<?php echo $keyword ?? ''; ?>"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</section>
