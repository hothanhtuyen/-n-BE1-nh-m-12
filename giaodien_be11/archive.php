<?php
    include "header.php";
    if (isset($_GET['maDM'])):
        $maDM = $_GET['maDM'];
        // hiển thị 2 sản phẩm trên 1 trang
        $perPage = 2;
        // Lấy số trang trên thanh địa chỉ
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // Tính tổng số dòng, ví dụ kết quả là 18
        $total = count($sanPhamDB->LaySanPhamTheoDanhMuc($maDM));
        // lấy đường dẫn đến file hiện hành
        $url = $_SERVER['PHP_SELF'] . "?maDM=" . $maDM;
        
?>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $getItemByCate = $sanPhamDB->getItemsByCate($maDM,$page,$perPage);
            foreach($getItemByCate as $value):
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
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>

                            </div>
                            <!-- Product price-->
                            <?php echo $value->giaSanPham?> VNĐ
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                href="cart.php?ma=<?php echo $value->maSanPham?>">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            ?>
          
        </div>
        <div class="pagination justify-content-center" style="display: flex; justify-content: center; margin-top: 20px; list-style: none; padding: 0;">
    <?php
    $totalPages = ceil($total / $perPage);

    // Nút "Trang trước"
    if ($page > 1):
        $prevPage = $page - 1;
        echo "<a href='{$url}&page={$prevPage}' style='text-decoration: none; color: #007bff; padding: 8px 12px; margin: 0 5px; border: 1px solid #ddd; border-radius: 4px;'>« Trang trước</a>";
    else:
        echo "<span style='color: #ccc; padding: 8px 12px; margin: 0 5px; border: 1px solid #ddd; border-radius: 4px;'>« Trang trước</span>";
    endif;

    // Hiển thị các trang
    for ($i = 1; $i <= $totalPages; $i++):
        if ($i == $page):
            echo "<span style='background-color: #007bff; color: #fff; padding: 8px 12px; margin: 0 5px; border: 1px solid #007bff; border-radius: 4px;'>{$i}</span>";
        else:
            echo "<a href='{$url}&page={$i}' style='text-decoration: none; color: #007bff; padding: 8px 12px; margin: 0 5px; border: 1px solid #ddd; border-radius: 4px;'>{$i}</a>";
        endif;
    endfor;

    // Nút "Trang kế"
    if ($page < $totalPages):
        $nextPage = $page + 1;
        echo "<a href='{$url}&page={$nextPage}' style='text-decoration: none; color: #007bff; padding: 8px 12px; margin: 0 5px; border: 1px solid #ddd; border-radius: 4px;'>Trang kế »</a>";
    else:
        echo "<span style='color: #ccc; padding: 8px 12px; margin: 0 5px; border: 1px solid #ddd; border-radius: 4px;'>Trang kế »</span>";
    endif;
    ?>
</div>
    </div>
</section>
<?php endif ?>
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