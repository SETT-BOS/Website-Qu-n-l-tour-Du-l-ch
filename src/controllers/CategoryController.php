<?php
class CategoryController
{
    public function index(){
        // requireLogin();

        // lấy dữ liệu từ form 
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $status = isset($_GET['status']) ? $_GET['status'] !== '' ? $_GET['status'] : null : null; 

        // lấy danh mục với bộ lọc
        $categories = Category::all($status, $keyword);

        // truyền dữ liệu sang view
        view('admin.categories.index' , [
            'title' => 'Quản lý danh mục',
            'categories' => $categories,
            'keyword' => $keyword,
            'currentKeyword' => $keyword,
            'currentStatus' => $status
        ]);


    }    
}
?>