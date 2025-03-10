<?php
// اتصال به پایگاه داده
$db = new PDO('mysql:host=localhost;dbname=hesabfa', 'root', '');

// دریافت اطلاعات از فرم
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

// درج اطلاعات در جدول products
$query = "INSERT INTO products (name, price, description) VALUES (:name, :price, :description)";
$stmt = $db->prepare($query);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':description', $description);

if ($stmt->execute()) {
    header("Location: product_list.php");
    exit();
} else {
    echo "متاسفانه مشکلی در ثبت محصول جدید به وجود آمد.";
}
?>