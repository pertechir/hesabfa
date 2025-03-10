<?php
include '../database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('خطا در آپلود فایل');
    }

    $uploadDir = '../uploads/categories/';
    
    // ایجاد دایرکتوری اگر وجود نداشته باشد
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            throw new Exception('خطا در ایجاد پوشه آپلود');
        }
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
        throw new Exception('خطا در ذخیره فایل');
    }

    echo json_encode([
        'success' => true,
        'message' => 'فایل با موفقیت آپلود شد',
        'path' => $imagePath
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}