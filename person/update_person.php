<?php
include '../database.php';

// دریافت اطلاعات از فرم
$id = (int)$_POST['id'];

// بررسی وجود شناسه
if ($id <= 0) {
    header("Location: person.php?message=" . urlencode("شناسه شخص نامعتبر است."));
    exit;
}

// دریافت اطلاعات از فرم
$code_hesabdari = $_POST['code_hesabdari'];
$company = $_POST['company'];
$title = $_POST['title'];
$name = $_POST['name'];
$family = $_POST['family'];
$nickname = $_POST['nickname'];

// دریافت اطلاعات مربوط به نوع شخص
$type_customer = isset($_POST['type_customer']) ? 1 : 0;
$type_supplier = isset($_POST['type_supplier']) ? 1 : 0;
$type_shareholder = isset($_POST['type_shareholder']) ? 1 : 0;
$type_employee = isset($_POST['type_employee']) ? 1 : 0;

// دریافت اطلاعات تماس
$telephone = $_POST['telephone'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

// دریافت اطلاعات آدرس
$address_text = $_POST['address_text'];

// اعتبارسنجی اطلاعات
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: edit_person.php?id=$id&message=" . urlencode($message));
    exit;
}

// جلوگیری از XSS و SQL Injection
$code_hesabdari = htmlspecialchars(escapeString($code_hesabdari));
$company = htmlspecialchars(escapeString($company));
$title = htmlspecialchars(escapeString($title));
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$nickname = htmlspecialchars(escapeString($nickname));
$telephone = htmlspecialchars(escapeString($telephone));
$mobile = htmlspecialchars(escapeString($mobile));
$email = htmlspecialchars(escapeString($email));
$address_text = htmlspecialchars(escapeString($address_text));

// Query برای به‌روزرسانی اطلاعات
$sql = "UPDATE ashkhas SET 
    code_hesabdari = '$code_hesabdari',
    company = '$company',
    title = '$title',
    name = '$name',
    family = '$family',
    nickname = '$nickname',
    type_customer = $type_customer,
    type_supplier = $type_supplier,
    type_shareholder = $type_shareholder,
    type_employee = $type_employee,
    telephone = '$telephone',
    mobile = '$mobile',
    email = '$email',
    address_text = '$address_text'
WHERE id = $id";

// اجرای Query
if (executeQuery($sql)) {
    $message = "اطلاعات شخص با موفقیت به‌روزرسانی شد.";
} else {
    $message = "خطا در به‌روزرسانی اطلاعات: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه اصلی با پیام
header("Location: person.php?message=" . urlencode($message));
exit;
?>