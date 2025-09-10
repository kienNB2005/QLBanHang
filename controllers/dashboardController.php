<?php
// Khởi tạo thống kê
require './models/dashboard.php';
require './helper/common.php';

class DashboardController {
    // Khởi tạo model
    private $dashboardModel;

    function __construct() {
        $this->dashboardModel = new Dashboard();
    }

    // Action index
    public function index() {
        // Lấy dữ liệu thống kê từ model
        $data = $this->dashboardModel->TotalProducts();
        $dataUser = $this->dashboardModel->TotalUser();
        $dataOrder = $this->dashboardModel->TotalOrder();

        // Gọi view chung, truyền data sang
        return view('admin/dashboard.php', [
            'data' => $data,
            'dataUser' => $dataUser,
            'dataOrder' => $dataOrder
        ]);
    }
}
