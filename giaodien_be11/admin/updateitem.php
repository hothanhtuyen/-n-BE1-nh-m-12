<?php
var_dump($_FILES);
include "config.php";
include "models/db.php";
include "models/item.php";
$item = new Item;
//xu ly them
$id = $_POST['id'];
$title = $_POST['title'];
$madein = $_POST['madein'];
$price = $_POST['price'];
$excerpt = $_POST['excerpt'];
$image = isset($_FILES["fileUpload"]["name"])?$_FILES["fileUpload"]["name"]:"";
$category = $_POST['cate'];

$item->updateItem($id,$title,$madein,$price,$excerpt,$image,$category);
//xu ly upload file
if(isset($_FILES["fileUpload"])){
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
}

//chuyen huong trang sau khi them thanh cong
header('location:items.php');