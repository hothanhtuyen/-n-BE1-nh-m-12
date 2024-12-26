<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home"
                class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage Items</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a
                                href="form_add_item.php"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>Items</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered
                                    table-striped">
                            <thead>
                                <tr>
                                    <th>Ảnh Sản Phẩm</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Xuất Xứ Sản Phẩm</th>
                                    <th>Giá Sản Phẩm</th>
                                    <th>Mô tả Sản Phẩm</th>
                                    <th>Loại Sản Phẩm</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($getAllItems as $value):
                                ?>
                                    <tr class="">
                                        <td width="250">
                                            <img
                                                src="../<?php echo $value['hinh_sanpham'] ?>" />
                                        </td>
                                        <td><?php echo $value['ten_sanpham'] ?></td>
                                        <td><?php echo $value['xuatxu_sanpham'] ?></td>
                                        <td><?php echo $value['gia_sanpham'] ?></td>
                                        <td><?php echo $value['mota_sanpham'] ?></td>
                                        <td><?php echo $value['namedanhmuc'] ?></td>

                                        <td>
                                            <a href="form_update_item.php?id=<?php echo $value['ma_sanpham'] ?>" class="btn
                                                    btn-success btn-mini">Edit</a>
                                            <a href="delete.php?id=<?php echo $value['ma_sanpham'] ?>" class="btn
                                                    btn-danger btn-mini">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                                <li class="active"><a href="">1</a>
                                </li>
                                <li><a href="">2</a></li>
                                <li><a href="">3</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>