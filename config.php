<?php
ob_start(); // شروع output buffering
session_start();

// تنظیمات پایه
define('BASE_PATH', '/hesabfa');
define('SITE_TITLE', 'حسابفا - برنامه حسابداری');

// اطلاعات اتصال به پایگاه داده
$db_host = "localhost";
$db_name = "hesabfa";
$db_user = "root";
$db_pass = "";

// تنظیمات دیتابیس و سایر تنظیمات را اینجا قرار دهید
?>