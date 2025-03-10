<?php
include '../database.php';

header('Content-Type: application/json');

try {
    $code = isset($_POST['code']) ? mysqli_real_escape_string($connection, $_POST['code']) : '';
    $name = isset($_POST['name']) ? mysqli_real_escape_string($connection, $_POST['name']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($connection, $_POST['description']) : '';

    if (empty($name)) {
        throw new Exception('نام دسته‌بندی الزامی است');
    }

    $sql = "INSERT INTO categories (code, name, description) VALUES ('$code', '$name', '$description')";
    executeQuery($sql);

    echo json_encode(['success' => true, 'message' => 'دسته‌بندی با موفقیت ذخیره شد']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}