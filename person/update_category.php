<?php
include '../database.php';

header('Content-Type: application/json');

try {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $code = isset($_POST['code']) ? mysqli_real_escape_string($connection, $_POST['code']) : '';
    $name = isset($_POST['name']) ? mysqli_real_escape_string($connection, $_POST['name']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($connection, $_POST['description']) : '';

    if ($id === 0 || empty($name)) {
        throw new Exception('شناسه یا نام دسته‌بندی نامعتبر است');
    }

    $sql = "UPDATE categories SET code = '$code', name = '$name', description = '$description' WHERE id = $id";
    executeQuery($sql);

    echo json_encode(['success' => true, 'message' => 'دسته‌بندی با موفقیت به‌روزرسانی شد']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}