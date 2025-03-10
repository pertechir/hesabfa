<?php
include('../config.php');

$search = $_GET['q'];

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = $db->prepare("SELECT id, name FROM categories WHERE name LIKE :search LIMIT 10");
    $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $query->execute();
    
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $results = [];
    foreach ($categories as $category) {
        $results[] = ['id' => $category['id'], 'text' => $category['name']];
    }
    
    echo json_encode(['items' => $results]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>