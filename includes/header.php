<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_TITLE; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/style.css">
</head>
<body class="bg-gray-100">

<div class="sidebar">
    <ul>
        <li><a href="index.php">داشبورد</a></li>
        <li><a href="person/person.php">اشخاص</a></li>
        <li><a href="product/product_list.php">محصولات</a></li>
        <!-- سایر لینک ها -->
    </ul>
</div>

<div class="content">