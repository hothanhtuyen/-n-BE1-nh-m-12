<?php
class Category extends Db
{
    function getAllCates()
    {
        $sql = self::$connection->prepare("SELECT * FROM `tbl_danhmuc`");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function addCate($title){
        $sql = self::$connection->prepare("INSERT 
        INTO `tbl_danhmuc`(`ten_danhmuc`)
        VALUES (?)");
        $sql->bind_param("i",$title);
        return $sql->execute();
    }
    function delete($cate_id){
        $sql = self::$connection->prepare("DELETE FROM `tbl_danhmuc` WHERE `ma_danhmuc`=?");
        $sql->bind_param("i",$cate_id);
        return $sql->execute();
    }
}
