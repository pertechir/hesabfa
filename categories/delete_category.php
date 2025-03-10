<?php
include '../database.php';

header('Content-Type: application/json; charset=utf-8');

try {
    if (!isset($_GET['id'])) {
        throw new Exception('شناسه دسته‌بندی نامعتبر است');
    }

    $id = intval($_GET['id']);

    // بررسی استفاده از این دسته‌بندی در جدول person_categories
    $usageCheck = executeQuery("SELECT COUNT(*) as count FROM person_categories WHERE category_id = $id");
    $usage = $usageCheck->fetch_assoc();
    
    if ($usage['count'] > 0) {
        throw new Exception('این دسته‌بندی به یک یا چند شخص متصل است و قابل حذف نیست');
    }

    // بررسی وجود زیر دسته‌بندی
    $subcategoryCheck = executeQuery("SELECT COUNT(*) as count FROM categories WHERE parent_id = $id");
    $subcategories = $subcategoryCheck->fetch_assoc();
    
    if ($subcategories['count'] > 0) {
        throw new Exception('این دسته‌بندی دارای زیر دسته‌بندی است و قابل حذف نیست');
    }

    // دریافت اطلاعات دسته‌بندی برای حذف تصویر
    $category = executeQuery("SELECT image FROM categories WHERE id = $id")->fetch_assoc();
    if (!$category) {
        throw new Exception('دسته‌بندی مورد نظر یافت نشد');
    }

    // حذف تصویر اگر وجود داشته باشد
    if (!empty($category['image'])) {
        $imagePath = '../' . $category['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // حذف دسته‌بندی از دیتابیس
    $result = executeQuery("DELETE FROM categories WHERE id = $id");

    if ($result) {
        echo json_encode([
            'success' => true, 
            'message' => 'دسته‌بندی با موفقیت حذف شد'
        ], JSON_UNESCAPED_UNICODE);
    } else {
        throw new Exception('خطا در حذف دسته‌بندی');
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}