<?php
class Item extends Db
{
    //Hien thi danh sach cac item theo thu tu moi nhat
    function getAllItems()
    {
        $sql = self::$connection->prepare("SELECT  `tbl_sanpham`.`ma_sanpham`,`ten_sanpham`,`hinh_sanpham`,`xuatxu_sanpham`,`gia_sanpham`,`mota_sanpham`,`tbl_danhmuc`.`ten_danhmuc` as namedanhmuc 
FROM `tbl_sanpham`,`tbl_danhmuc`
WHERE `tbl_sanpham`.`ma_sanpham` = `tbl_danhmuc`.`ma_danhmuc`
ORDER BY `xuatxu_sanpham` DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function search($keyword, $page, $count)
    {
        // Tính số thứ tự trang bắt đầu
        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare("SELECT * FROM `items` 
        WHERE `content` LIKE ?
        LIMIT ?,?");
        $keyword = "%$keyword%";
        $sql->bind_param("sii", $keyword, $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function searchCount($keyword)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` 
        WHERE `content` LIKE ?");
        $keyword = "%$keyword%";
        $sql->bind_param("s", $keyword);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function paginate($url, $total, $count, $page)
    {
        $totalLinks = ceil($total / $count);
        $link = "";
        for ($j = 1; $j <= $totalLinks; $j++) {
            if ($page == $j) {
                $link = $link . "<li class='active'><a href='$url&page=$j'> $j </a></li>";
            } else {
                $link = $link . "<li><a href='$url&page=$j'> $j </a></li>";
            }
        }
        return $link;
    }
    function delete($id)
    {
        $sql = self::$connection->prepare("DELETE FROM `tbl_sanpham` WHERE `ma_sanpham`=?");
        $sql->bind_param("i", $id);
        return $sql->execute();
    }
    function addItem($ten_sanpham, $hinh_sanpham, $xuatxu_sanpham, $gia_sanpham, $mota_sanpham) {
        $sql = self::$connection->prepare(" INSERT INTO tbl_sanpham (ten_sanpham, hinh_sanpham, xuatxu_sanpham, gia_sanpham, mota_sanpham) 
            VALUES (?, ?, ?, ?, ?)");      
        return $sql->execute();
    }
    
}
