<?php

// اتصال به پایگاه داده
include '../database.php';

// دریافت اطلاعات از فرم (قسمت بالای صفحه)
$code_hesabdari = $_POST['code_hesabdari'];
$company = $_POST['company'];
$title = $_POST['title'];
$name = $_POST['name'];
$family = $_POST['family'];
$nickname = $_POST['nickname'];
$category = $_POST['category'];

//دریافت اطلاعات مربوط به نوع شخص
$type_customer = isset($_POST['type_customer']) ? 1 : 0;
$type_supplier = isset($_POST['type_supplier']) ? 1 : 0;
$type_shareholder = isset($_POST['type_shareholder']) ? 1 : 0;
$type_employee = isset($_POST['type_employee']) ? 1 : 0;

//دریافت اطلاعات تب عمومی
$credit = $_POST['credit'];
$price_list = $_POST['price_list'];
$tax_type = $_POST['tax_type'];
$tax_registration = $_POST['tax_registration'];
$shenase_meli = $_POST['shenase_meli'];
$code_eghtesadi = $_POST['code_eghtesadi'];
$shomare_sabt = $_POST['shomare_sabt'];
$code_shobe = $_POST['code_shobe'];
$tozihat = $_POST['tozihat'];

//دریافت اطلاعات تب آدرس
$address_text = $_POST['address_text'];
$country = $_POST['country'];
$ostan = $_POST['ostan'];
$shahr = $_POST['shahr'];
$codeposti = $_POST['codeposti'];

//دریافت اطلاعات تب تماس
$telephone = $_POST['telephone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$telephone1 = $_POST['telephone1'];
$telephone2 = $_POST['telephone2'];
$telephone3 = $_POST['telephone3'];
$email = $_POST['email'];
$website = $_POST['website'];

//اعتبارسنجی اطلاعات (حداقل نام و نام خانوادگی)
if (empty($name) || empty($family)) {
    $message = "نام و نام خانوادگی الزامی است.";
    header("Location: add_person.php?message=" . urlencode($message));
    exit;
}

//جلوگیری از XSS و SQL Injection
$code_hesabdari = htmlspecialchars(escapeString($code_hesabdari));
$company = htmlspecialchars(escapeString($company));
$title = htmlspecialchars(escapeString($title));
$name = htmlspecialchars(escapeString($name));
$family = htmlspecialchars(escapeString($family));
$nickname = htmlspecialchars(escapeString($nickname));
$category = htmlspecialchars(escapeString($category));

//جلوگیری از XSS و SQL Injection (تب عمومی)
$credit = htmlspecialchars(escapeString($credit));
$price_list = htmlspecialchars(escapeString($price_list));
$tax_type = htmlspecialchars(escapeString($tax_type));
$tax_registration = htmlspecialchars(escapeString($tax_registration));
$shenase_meli = htmlspecialchars(escapeString($shenase_meli));
$code_eghtesadi = htmlspecialchars(escapeString($code_eghtesadi));
$shomare_sabt = htmlspecialchars(escapeString($shomare_sabt));
$code_shobe = htmlspecialchars(escapeString($code_shobe));
$tozihat = htmlspecialchars(escapeString($tozihat));

//جلوگیری از XSS و SQL Injection (تب آدرس)
$address_text = htmlspecialchars(escapeString($address_text));
$country = htmlspecialchars(escapeString($country));
$ostan = htmlspecialchars(escapeString($ostan));
$shahr = htmlspecialchars(escapeString($shahr));
$codeposti = htmlspecialchars(escapeString($codeposti));

//جلوگیری از XSS و SQL Injection (تب تماس)
$telephone = htmlspecialchars(escapeString($telephone));
$mobile = htmlspecialchars(escapeString($mobile));
$fax = htmlspecialchars(escapeString($fax));
$telephone1 = htmlspecialchars(escapeString($telephone1));
$telephone2 = htmlspecialchars(escapeString($telephone2));
$telephone3 = htmlspecialchars(escapeString($telephone3));
$email = htmlspecialchars(escapeString($email));
$website = htmlspecialchars(escapeString($website));

//Query برای درج اطلاعات در جدول
$sql = "INSERT INTO persons (code_hesabdari, company, title, name, family, nickname, category, type_customer, type_supplier, type_shareholder, type_employee, credit, price_list, tax_type, tax_registration, shenase_meli, code_eghtesadi, shomare_sabt, code_shobe, tozihat, address_text, country, ostan, shahr, codeposti, telephone, mobile, fax, telephone1, telephone2, telephone3, email, website) 
VALUES ('$code_hesabdari', '$company', '$title', '$name', '$family', '$nickname', '$category', '$type_customer', '$type_supplier', '$type_shareholder', '$type_employee', '$credit', '$price_list', '$tax_type', '$tax_registration', '$shenase_meli', '$code_eghtesadi', '$shomare_sabt', '$code_shobe', '$tozihat', '$address_text', '$country', '$ostan', '$shahr', '$codeposti', '$telephone', '$mobile', '$fax', '$telephone1', '$telephone2', '$telephone3', '$email', '$website')";

// اجرای Query
if (executeQuery($sql)) {
    $message = "اطلاعات فرد با موفقیت ذخیره شد.";
} else {
    $message = "خطا در ذخیره اطلاعات: " . $conn->error;
}

// بستن اتصال
closeConnection();

// انتقال به صفحه اصلی با پیام
header("Location: person.php?message=" . urlencode($message));
exit;
?>