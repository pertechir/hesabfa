<?php
include '../database.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        throw new Exception('شناسه دسته‌بندی نامعتبر است');
    }

    $id = intval($_GET['id']);
    $result = executeQuery("SELECT id, code, name, description FROM categories WHERE id = $id");

    if ($result->num_rows === 0) {
        throw new Exception('دسته‌بندی مورد نظر یافت نشد');
    }

    echo json_encode($result->fetch_assoc());
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}