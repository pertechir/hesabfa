<?php
$page = '/hesabfa/dashboard/index.php';
include '../index.php';
?>

<!-- Main Content -->
<div class="flex-1 p-4">
    <h2 class="text-2xl font-bold mb-4">داشبورد</h2>
    <p>به داشبورد خوش آمدید!</p>
    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold text-lg mb-2">فروش امروز</h3>
            <p class="text-gray-700">1,500,000 تومان</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold text-lg mb-2">هزینه امروز</h3>
            <p class="text-gray-700">500,000 تومان</p>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold text-lg mb-2">سود امروز</h3>
            <p class="text-gray-700">1,000,000 تومان</p>
        </div>
    </div>
</div>