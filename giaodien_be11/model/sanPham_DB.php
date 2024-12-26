    <?php
    require_once 'db.php';
    require_once 'sanPham.php';

    class SanPham_DB extends Database
    {
        public function LayTatCaDanhMuc()
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_danhmuc");
            $sql->execute();

            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

            return $items;
        }

        public function LayTatCaSanPham()
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham");
            $sql->execute();

            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

            $products = array();
            foreach ($items as $key => $value) {
                $products[] = new SanPham($value['ma_sanpham'], $value['ten_sanpham'], $value['hinh_sanpham'], $value['xuatxu_sanpham'], $value['gia_sanpham'], $value['mota_sanpham'], $value['ma_danhmuc']);
            }

            return $products;
        }
        public function getItemsByCate($maDM, $page, $count)
        {
            $start = ($page - 1) * $count;
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham WHERE ma_danhmuc = ?
        LIMIT ?,?");
            $sql->bind_param("iii", $maDM, $start, $count);
            $sql->execute();
            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            $products = array();
            $products = array();
            foreach ($items as $key => $value) {
                $products[] = new SanPham($value['ma_sanpham'], $value['ten_sanpham'], $value['hinh_sanpham'], $value['xuatxu_sanpham'], $value['gia_sanpham'], $value['mota_sanpham'], $value['ma_danhmuc']);
            }
            return $products;
        }
        public function LaySanPhamTheoDanhMuc($maDM)
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham WHERE ma_danhmuc = ?");
            $sql->bind_param("s", $maDM);
            $sql->execute();

            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

            $products = array();
            foreach ($items as $key => $value) {
                $products[] = new SanPham($value['ma_sanpham'], $value['ten_sanpham'], $value['hinh_sanpham'], $value['xuatxu_sanpham'], $value['gia_sanpham'], $value['mota_sanpham'], $value['ma_danhmuc']);
            }

            return $products;
        }

        public function LaySanPhamTheoMaSanPham($maSP)
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham WHERE ma_sanpham = ?");
            $sql->bind_param("s", $maSP);
            $sql->execute();

            // Lấy kết quả từ truy vấn
            $result = $sql->get_result();
            $item = $result->fetch_assoc(); // Lấy dòng đầu tiên

            // Nếu không có sản phẩm, trả về null
            if (!$item) {
                return null;
            }

            // Tạo đối tượng SanPham từ dòng đầu tiên
            return new SanPham(
                $item['ma_sanpham'],
                $item['ten_sanpham'],
                $item['hinh_sanpham'],
                $item['xuatxu_sanpham'],
                $item['gia_sanpham'],
                $item['mota_sanpham'],
                $item['ma_danhmuc']
            );
        }

        public function LaySoLuongSanPham()
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham WHERE ma_sanpham = ?");
            $sql->bind_param("s", $maSP);
            $sql->execute();

            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_NUM);

            $soLuong = 0;
            foreach ($items as $key => $value) {
                $soLuong = $value[0];
            }

            return $soLuong;
        }
        public function search($keyword)
        {
            $sql = self::$conn->prepare("SELECT * FROM `tbl_sanpham` 
            WHERE `ten_sanpham` LIKE ?");
            $keyword = "%$keyword%";
            $sql->bind_param("s", $keyword);
            $sql->execute();
            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return $items;
        }
        public function searchCount($keyword)
        {
            $sql = self::$conn->prepare("SELECT * FROM `items` 
            WHERE `content` LIKE ?");
            $keyword = "%$keyword%";
            $sql->bind_param("s", $keyword);
            $sql->execute();
            $items = array();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            return $items;
        }
        public function countSearchResults($keyword)
        {
            $sql = self::$conn->prepare("SELECT COUNT(*) as total FROM tbl_sanpham WHERE ten_sanpham LIKE ?");
            $keyword = "%$keyword%";
            $sql->bind_param("s", $keyword);
            $sql->execute();
            $result = $sql->get_result()->fetch_assoc();
            return $result['total'];
        }
        public function searchWithPagination($keyword, $limit, $offset)
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham WHERE ten_sanpham LIKE ? LIMIT ? OFFSET ?");
            $keyword = "%$keyword%";
            $sql->bind_param("sii", $keyword, $limit, $offset);
            $sql->execute();
            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
            $products = [];
            foreach ($items as $value) {
                $products[] = new SanPham(
                    $value['ma_sanpham'],
                    $value['ten_sanpham'],
                    $value['hinh_sanpham'],
                    $value['xuatxu_sanpham'],
                    $value['gia_sanpham'],
                    $value['mota_sanpham'],
                    $value['ma_danhmuc']
                );
            }
            return $products;
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
        //Featured News
        public function LaySanPhamNoiBat($limit = 4)
        {
            $sql = self::$conn->prepare("SELECT * FROM tbl_sanpham LIMIT ?");
            $sql->bind_param("i", $limit);
            $sql->execute();

            $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

            $products = array();
            foreach ($items as $value) {
                $products[] = new SanPham(
                    $value['ma_sanpham'],
                    $value['ten_sanpham'],
                    $value['hinh_sanpham'],
                    $value['xuatxu_sanpham'],
                    $value['gia_sanpham'],
                    $value['mota_sanpham'],
                    $value['ma_danhmuc']
                );
            }

            return $products;
        }
    }
    ?>