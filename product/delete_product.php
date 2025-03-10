<?php
// اتصال به پایگاه داده
$db = new PDO('mysql:host=localhost;dbname=hesabfa', 'root', '');

// دریافت ID محصول از درخواست
$id = $_GET['id'];

// حذف محصول
$stmt = $db->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

// بازگشت به صفحه فهرست محصولات
header("Location: product_list.php");
exit();
?>