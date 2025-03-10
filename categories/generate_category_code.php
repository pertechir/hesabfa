<?php
include '../database.php';

// دریافت آخرین کد دسته‌بندی
$result = executeQuery("SELECT MAX(CAST(SUBSTRING(code, 2) AS UNSIGNED)) as max_code FROM categories WHERE code REGEXP '^C[0-9]+$'");
$row = $result->fetch_assoc();

$nextCode = 1;
if ($row['max_code']) {
    $nextCode = $row['max_code'] + 1;
}

$categoryCode = 'C' . str_pad($nextCode, 4, '0', STR_PAD_LEFT);

echo json_encode(['code' => $categoryCode]);
?>