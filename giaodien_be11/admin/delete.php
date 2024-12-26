<?php
//xu ly xoa 3 bang
//neu  get id -> xoa items
//neu get cate_id -> xoa categories
//neu author_id -> xoa authors
include "config.php";
include "models/db.php";
include "models/item.php";
include "models/category.php";
$item = new Item;
$cate = new Category;
if(isset($_GET['id'])){
    //xu ly xoa id trong bang items
    $id = $_GET['id'];
    $item->delete($id);
    header('location:items.php');
}
elseif(isset($_GET['cate_id'])){
    //xu ly xoa id trong bang catagories
    $cate_id = $_GET['cate_id'];
    $cate->delete($cate_id);
    header('location:categories.php');
}
elseif(isset($_GET['author_id'])){
    //xu ly xoa id trong bang author
}