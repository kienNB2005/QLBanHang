<?php
if(!function_exists('view')){
    function view ($view = 'admin/dashboard.php', $data = [],$layout = 'admin/layout.php'){
        $pathView = './views/';
        if (!empty($data)) {
        extract($data); // biến mảng thành biến riêng
        }
        ob_start();
        require $pathView. $view;
        $content = ob_get_clean();
        require $pathView. $layout;
    }
}