<?php
include('../../config.php');

header('Content-Type: application/json');

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $mainUnit = $_POST['mainUnit'];
    $generalDescription = $_POST['generalDescription'];
    $subUnit = isset($_POST['subUnit']) ? $_POST['subUnit'] : null;
    $conversionFactor = isset($_POST['conversionFactor']) ? $_POST['conversionFactor'] : 1;

    // سایر پارامترهای فرم
    // ...

    // بررسی تکراری بودن محصول
    $checkStmt = $db->prepare("SELECT COUNT(*) FROM products WHERE main_unit = :main_unit AND description = :description");
    $checkStmt->bindParam(':main_unit', $mainUnit);
    $checkStmt->bindParam(':description', $generalDescription);
    $checkStmt->execute();

    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => "محصول تکراری است."]);
    } else {
        // درج محصول جدید
        $stmt = $db->prepare("INSERT INTO products (main_unit, sub_unit, conversion_factor, description) VALUES (:main_unit, :sub_unit, :conversion_factor, :description)");
        $stmt->bindParam(':main_unit', $mainUnit);
        $stmt->bindParam(':sub_unit', $subUnit);
        $stmt->bindParam(':conversion_factor', $conversionFactor);
        $stmt->bindParam(':description', $generalDescription);

        // سایر پارامترهای فرم
        // ...

        $stmt->execute();
        echo json_encode(['success' => true]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "خطا در ذخیره محصول: " . $e->getMessage()]);
}
?>