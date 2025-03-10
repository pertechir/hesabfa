<?php
include '../database.php';

header('Content-Type: application/json');

try {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $excludeId = isset($_GET['exclude']) ? intval($_GET['exclude']) : 0;

    $where = [];
    if ($search) {
        $search = mysqli_real_escape_string($connection, $search);
        $where[] = "(name LIKE '%$search%' OR code LIKE '%$search%')";
    }
    if ($excludeId) {
        $where[] = "id != $excludeId";
    }

    $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
    
    $sql = "SELECT id, code, name, description FROM categories $whereClause ORDER BY name ASC";
    $result = executeQuery($sql);

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            'id' => $row['id'],
            'code' => $row['code'],
            'name' => $row['name'],
            'description' => $row['description']
        ];
    }

    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'خطا در دریافت دسته‌بندی‌ها']);
}