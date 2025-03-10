<?php
include '../database.php';

try {
    $response = ['success' => false, 'message' => ''];
    
    // بررسی فیلدهای اجباری
    if (empty($_POST['name'])) {
        throw new Exception('نام دسته‌بندی اجباری است');
    }

    // آپلود تصویر
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = '../uploads/categories/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileInfo = pathinfo($_FILES['image']['name']);
        $extension = strtolower($fileInfo['extension']);
        
        // بررسی پسوند فایل
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($extension, $allowedExtensions)) {
            throw new Exception('فرمت فایل مجاز نیست. فقط jpg, jpeg, png و gif مجاز هستند');
        }

        // ایجاد نام یکتا برای فایل
        $imageName = uniqid() . '.' . $extension;
        $imagePath = 'uploads/categories/' . $imageName;
        
        if (!move_uploaded_file($_FILES['image']['tmp_name'], '../' . $imagePath)) {
            throw new Exception('خطا در آپلود تصویر');
        }
    }

    // آماده‌سازی داده‌ها
    $code = mysqli_real_escape_string($connection, $_POST['code']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : null;
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $status = isset($_POST['status']) ? intval($_POST['status']) : 1;

    // بررسی تکراری نبودن کد
    if (!empty($code)) {
        $checkCode = executeQuery("SELECT id FROM categories WHERE code = '$code'");
        if ($checkCode->num_rows > 0) {
            throw new Exception('این کد قبلاً استفاده شده است');
        }
    }

    // درج در دیتابیس
    $sql = "INSERT INTO categories (code, name, parent_id, description, image, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssissi", $code, $name, $parent_id, $description, $imagePath, $status);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'دسته‌بندی با موفقیت ذخیره شد';
    } else {
        throw new Exception('خطا در ذخیره‌سازی دسته‌بندی');
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>