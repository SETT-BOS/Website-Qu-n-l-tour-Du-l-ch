<?php

class Category
{
    // khai thuốc tính categoriy
    public $id;
    public $name;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    // khai báo hàm khởi tạo
    public function __construct($data = [])
    {
      if (is_array($data)) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
      }
    }

// lấy hàm danh sách tất cả danh mục
public static function all($status = null, $keyword = null)
{
    $db = getDB();
   if (!$db){
        return [];
   }



   try {
    $where = [];
    $params = [];
    // lọc theo trang thái
    if ($status !== null && $status !== '') {
        $where[] = 'status = :status';
        $params[':status'] = $status;
    }

    // loc theo từ khóa
    if (!empty($keyword)) {
        $where[] = "(name LIKE ? OR description LIKE ?)";
        $searchTerm = '%' . trim($keyword) . '%';
        $params[] = $searchTerm;
        $params[] = $searchTerm;
   } 
   
  //  viết câu sql
  $sql = "SELECT * FROM categories";
  if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
  }
  $sql .= " ORDER BY created_at DESC";
   
  $stmt = $db->prepare($sql);
  $stmt->execute($params);

  $result = $stmt->fetchAll();
  $categories = [];

  foreach ($result as $key => $row) {
    $categories[] = new Category($row);
   
   
  } 
  
  return $categories;
  



 







}catch (PDOException $e){
    error_log("lỗi khi lấy dữ liieuej dnah mục tour" . $e->getMessage());
    return [];
  }
}
}

