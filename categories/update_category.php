<?php
include '../database.php';

try {
    $response = ['success' => false, 'message' => ''];
    
    // بررسی وجود شناسه دسته‌بندی
    if (!isset($_POST['id'])) {
        throw new Exception('شناسه دسته‌بندی نامعتبر است');
    }

    $id = intval($_POST['id']);
    
    // بررسی فیلدهای اجباری
    if (empty($_POST['name'])) {
        throw new Exception('نام دسته‌بندی اجباری است');
    }

    // دریافت اطلاعات فعلی دسته‌بندی
    $currentCategory = executeQuery("SELECT image FROM categories WHERE id = $id")->fetch_assoc();
    if (!$currentCategory) {
        throw new Exception('دسته‌بندی مورد نظر یافت نشد');
    }

    // آپلود تصویر جدید
    $imagePath = $currentCategory['image']; // حفظ تصویر فعلی به صورت پیش‌فرض
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

        // حذف تصویر قبلی
        if ($currentCategory['image'] && file_exists('../' . $currentCategory['image'])) {
            unlink('../' . $currentCategory['image']);
        }

        // ایجاد نام یکتا برای فایل جدید
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

    // بررسی تکراری نبودن کد (به جز برای خود این دسته‌بندی)
    if (!empty($code)) {
        $checkCode = executeQuery("SELECT id FROM categories WHERE code = '$code' AND id != $id");
        if ($checkCode->num_rows > 0) {
            throw new Exception('این کد قبلاً استفاده شده است');
        }
    }

    // بروزرسانی در دیتابیس
    $sql = "UPDATE categories SET 
            code = ?, 
            name = ?, 
            parent_id = ?, 
            description = ?, 
            image = ?,
            status = ?
            WHERE id = ?";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssissii", $code, $name, $parent_id, $description, $imagePath, $status, $id);
    
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'دسته‌بندی با موفقیت بروزرسانی شد';
    } else {
        throw new Exception('خطا در بروزرسانی دسته‌بندی');
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>