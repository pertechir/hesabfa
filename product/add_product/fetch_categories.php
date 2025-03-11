<?php
include '../../config.php';

header('Content-Type: application/json');

$term = isset($_GET['term']) ? $_GET['term'] : '';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("SELECT id, name FROM categories WHERE name LIKE :term");
    $stmt->execute(['term' => '%' . $term . '%']);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $results = [];
    foreach ($categories as $category) {
        $results[] = ['id' => $category['id'], 'text' => $category['name']];
    }

    echo json_encode(['items' => $results]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>