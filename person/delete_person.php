<?php
include '../database.php';

// دریافت شناسه شخص از پارامتر URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// بررسی وجود شناسه
if ($id <= 0) {
    header("Location: person.php?message=" . urlencode("شناسه شخص نامعتبر است."));
    exit;
}

// Query برای حذف شخص
$sql = "DELETE FROM persons WHERE id = $id";

// اجرای Query
if (executeQuery($sql)) {
    $message = "شخص مورد نظر با موفقیت حذف شد.";
} else {
    $message = "خطا در حذف شخص: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه اصلی با پیام
header("Location: person.php?message=" . urlencode($message));
exit;
?>