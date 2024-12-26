<?php
include "header.php";
include "sidebar.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getItemByID = $item->getItemByID($id);
    var_dump($id);
}
//var_dump($getItemByID);
    
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                Home</a></div>
        <h1>Update Items</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Item info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="updateitem.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="control-group">
                                <label class="control-label">ID Sản Phẩm </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="id" value="<?php echo $getItemByID[0]['ma_sanpham']; ?>"/> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tên Sản Phẩm </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="title" value="<?php echo $getItemByID[0]['ten_sanpham'] ?>"/> *
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Xuất xứ sản phẩm</label>
                                <div class="controls">
                                    <textarea class="span11" name="madein">
                                        <?php echo $getItemByID[0]['xuatxu_sanpham'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Giá sản phẩm</label>
                                <div class="controls">
                                    <textarea class="span11" name="price">
                                    <?php echo $getItemByID[0]['gia_sanpham'] ?>
                                    </textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Mo ta</label>
                                <div class="controls">
                                    <textarea class="span11" name="excerpt">
                                        <?php echo $getItemByID[0]['xuatxu_sanpham'] ?>
                                    </textarea>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Choose
                                    an image</label>
                                <div class="controls">
                                    <input type="file" name="fileUpload" id="fileUpload">
                                    <img src="../img/<?php echo $getItemByID[0]['hinh_sanpham'] ?>" alt="">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Choose a
                                    category</label>
                                <div class="controls">
                                    <select name="cate" id="cate">
                                        <?php foreach($getAllCates as $value): 
                                            //if($value['ma_danhmuc'] == $getItemByID['ma_danhmuc'])
                                            ?>
                                            
                                        <option value="<?php echo $value['ma_danhmuc'] ?>"><?php echo $value['ten_danhmuc'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>