<?php
include '../database.php';

header('Content-Type: application/json');

try {
    // دریافت آخرین کد از دیتابیس
    $result = executeQuery("SELECT code FROM categories WHERE code REGEXP '^[0-9]+$' ORDER BY CAST(code AS UNSIGNED) DESC LIMIT 1");
    
    if ($result->num_rows > 0) {
        $lastCode = intval($result->fetch_assoc()['code']);
        $newCode = $lastCode + 1;
    } else {
        $newCode = 1001; // شروع از 1001
    }

    echo json_encode(['code' => (string)$newCode]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'خطا در تولید کد']);
}