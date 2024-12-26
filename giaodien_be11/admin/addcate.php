<?php
var_dump($_FILES);
include "config.php";
include "models/db.php";
include "models/item.php";
include "models/category.php";
$cate = new Category;
//xu ly them
$title = $_POST['name'];
var_dump($_POST['name']);
$cate->addCate($title);
//xu ly upload file
// $target_dir = "../img/";
// $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
// move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
//chuyen huong trang sau khi them thanh cong
header('location:categories.php');