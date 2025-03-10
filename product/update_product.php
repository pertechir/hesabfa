<?php
// اتصال به پایگاه داده
$db = new PDO('mysql:host=localhost;dbname=hesabfa', 'root', '');

// دریافت اطلاعات از فرم
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

// بروزرسانی اطلاعات در جدول products
$query = "UPDATE products SET name = :name, price = :price, description = :description WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':description', $description);

if ($stmt->execute()) {
    header("Location: product_list.php");
    exit();
} else {
    echo "متاسفانه مشکلی در بروزرسانی محصول به وجود آمد.";
}
?>