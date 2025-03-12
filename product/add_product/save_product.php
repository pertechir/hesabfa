<?php
include('../../config.php');

header('Content-Type: application/json');

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $mainUnit = $_POST['mainUnit'];
    $productName = $_POST['productName']; // دریافت نام محصول از فرم
    $productCode = $_POST['productCode']; // دریافت کد کالا از فرم
    $barcode = $_POST['barcode']; // دریافت بارکد از فرم
    $isActive = isset($_POST['isActive']) ? 1 : 0; // دریافت وضعیت فعال/غیرفعال
    $generalDescription = $_POST['generalDescription'];
    $category = $_POST['category']; // دریافت دسته‌بندی از فرم
    $subUnit = isset($_POST['subUnit']) ? $_POST['subUnit'] : null;
    $conversionFactor = isset($_POST['conversionFactor']) ? $_POST['conversionFactor'] : 1;
    $reorderPoint = isset($_POST['reorderPoint']) ? $_POST['reorderPoint'] : null;
    $minimumOrder = isset($_POST['minimumOrder']) ? $_POST['minimumOrder'] : null;
    $leadTime = isset($_POST['leadTime']) ? $_POST['leadTime'] : null;
    $salePrice = isset($_POST['salePrice']) ? $_POST['salePrice'] : null;
    $purchasePrice = isset($_POST['purchasePrice']) ? $_POST['purchasePrice'] : null;
    $taxRate = isset($_POST['taxRate']) ? $_POST['taxRate'] : null;
    $taxDescription = isset($_POST['taxDescription']) ? $_POST['taxDescription'] : null;

    // سایر پارامترهای فرم
    // ...

    // بررسی تکراری بودن محصول در دسته‌بندی مشخص
    $checkStmt = $db->prepare("SELECT COUNT(*) FROM products WHERE name = :name AND category = :category");
    $checkStmt->bindParam(':name', $productName);
    $checkStmt->bindParam(':category', $category);
    $checkStmt->execute();

    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => "محصول تکراری است."]);
    } else {
        // درج محصول جدید
        $stmt = $db->prepare("INSERT INTO products (name, product_code, barcode, is_active, main_unit, sub_unit, conversion_factor, description, category, reorder_point, minimum_order, lead_time, sale_price, purchase_price, tax_rate, tax_description) VALUES (:name, :product_code, :barcode, :is_active, :main_unit, :sub_unit, :conversion_factor, :description, :category, :reorder_point, :minimum_order, :lead_time, :sale_price, :purchase_price, :tax_rate, :tax_description)");
        $stmt->bindParam(':name', $productName);
        $stmt->bindParam(':product_code', $productCode);
        $stmt->bindParam(':barcode', $barcode);
        $stmt->bindParam(':is_active', $isActive);
        $stmt->bindParam(':main_unit', $mainUnit);
        $stmt->bindParam(':sub_unit', $subUnit);
        $stmt->bindParam(':conversion_factor', $conversionFactor);
        $stmt->bindParam(':description', $generalDescription);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':reorder_point', $reorderPoint);
        $stmt->bindParam(':minimum_order', $minimumOrder);
        $stmt->bindParam(':lead_time', $leadTime);
        $stmt->bindParam(':sale_price', $salePrice);
        $stmt->bindParam(':purchase_price', $purchasePrice);
        $stmt->bindParam(':tax_rate', $taxRate);
        $stmt->bindParam(':tax_description', $taxDescription);

        // سایر پارامترهای فرم
        // ...

        $stmt->execute();
        echo json_encode(['success' => true]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "خطا در ذخیره محصول: " . $e->getMessage()]);
}
?>