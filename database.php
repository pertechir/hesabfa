<?php
$connection = new mysqli("localhost", "root", "", "hesabfa");

if ($connection->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $connection->connect_error);
}

$connection->set_charset("utf8mb4");

function executeQuery($sql) {
    global $connection;
    $result = $connection->query($sql);
    
    if ($result === false) {
        error_log("خطای SQL: " . $connection->error . "\nQuery: " . $sql);
        throw new Exception("خطا در اجرای درخواست");
    }
    
    return $result;
}

// تابع برای اجرای Prepared Statements
function executePreparedStatement($sql, $types, $params) {
    global $connection;
    
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        error_log("خطا در آماده‌سازی دستور: " . $connection->error);
        throw new Exception("خطا در اجرای درخواست");
    }
    
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    if (!$stmt->execute()) {
        error_log("خطا در اجرای دستور: " . $stmt->error);
        throw new Exception("خطا در اجرای درخواست");
    }
    
    return $stmt;
}