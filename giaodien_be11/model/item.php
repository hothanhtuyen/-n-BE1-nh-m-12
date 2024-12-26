<?php
require_once 'db.php';
class Item extends Db
{
    public function getNewItems($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` 
        ORDER BY `created_at` DESC 
        LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function search($keyword, $page, $count)
    {
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
    public function getAllItemsByCate($cate_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM `items` 
        WHERE `category` = ?");
        $sql->bind_param("i", $cate_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getItemsByCate($cate_id, $page, $count)
    {
        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare("SELECT * FROM `items` 
        WHERE `category` = ?
        LIMIT ?,?");
        $sql->bind_param("iii", $cate_id, $start, $count);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function paginate($url, $total, $page, $count, $offset)
    {
        if ($total <= 0) {
            return "";
        }
        $totalLinks = ceil($total / $count);
        if ($totalLinks <= 1) {
            return "";
        }
        $from = $page - $offset;
        $to = $page + $offset;
        //offset quy dinh so luong link hien thi o 2 ben trang hien hanh
        //offset = 2 va page =5 luc nay thanh phan trang se hien thi 34567
        if ($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if ($to > $totalLinks) {
            $to = $totalLinks;
        }
        $link = "";
        $prev = "";
        $next = "";
        for ($j = $from; $j <= $to; $j++) {
            $link = $link . "<a href= '$url&page=$j'>$j </a>";
        }
        if ($page > 1) {
            $prevPage = $page - 1;
            $prev = "<a href='$url&page=$prevPage'> Prev link </a>";
        }
        if ($page < $totalLinks) {
            $nextPage = $page + 1;
            $next = "<a href='$url&page=$nextPage'> Next link </a>";
        }
        return $prev . $link . $next;
    }
}
