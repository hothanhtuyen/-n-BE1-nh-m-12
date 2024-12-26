<?php
class SanPham
{
    public $maSanPham;
    public $tenSanPham;
    public $hinhSanPham;
    public $xuatXuSanPham;
    public $giaSanPham;
    public $moTaSanPham; // Thêm thuộc tính này
    public $maDanhMuc;

    // Phương thức khởi tạo
    public function __construct($maSanPham, $tenSanPham, $hinhSanPham, $xuatXuSanPham, $giaSanPham, $moTaSanPham, $maDanhMuc)
    {
        $this->maSanPham = $maSanPham;
        $this->tenSanPham = $tenSanPham;
        $this->hinhSanPham = $hinhSanPham;
        $this->xuatXuSanPham = $xuatXuSanPham;
        $this->giaSanPham = $giaSanPham;
        $this->moTaSanPham = $moTaSanPham; // Gán giá trị cho thuộc tính
        $this->maDanhMuc = $maDanhMuc;
    }
}
