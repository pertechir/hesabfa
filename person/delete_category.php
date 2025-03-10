<?php
include '../database.php';

header('Content-Type: application/json');

try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        throw new Exception('شناسه دسته‌بندی نامعتبر است');
    }

    // بررسی وجود زیرمجموعه
    $checkSql = "SELECT COUNT(*) as count FROM categories WHERE parent_id = " . mysqli_real_escape_string($connection, $id);
    $result = executeQuery($checkSql);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        throw new Exception('این دسته‌بندی دارای زیرمجموعه است و نمی‌تواند حذف شود');
    }

    // بررسی استفاده در جدول persons
    $checkPersonsSql = "SELECT COUNT(*) as count FROM persons WHERE category = (SELECT name FROM categories WHERE id = " . mysqli_real_escape_string($connection, $id) . ")";
    $result = executeQuery($checkPersonsSql);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        throw new Exception('این دسته‌بندی در حال استفاده است و نمی‌تواند حذف شود');
    }

    // حذف دسته‌بندی
    $sql = "DELETE FROM categories WHERE id = " . mysqli_real_escape_string($connection, $id);
    
    if (executeQuery($sql)) {
        echo json_encode(['success' => true, 'message' => 'دسته‌بندی با موفقیت حذف شد']);
    } else {
        throw new Exception('خطا در حذف دسته‌بندی');
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}