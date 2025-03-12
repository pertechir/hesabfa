<?php
include '../menu.php'; // شامل کردن فایل منو
include('../includes/header.php');
include('../config.php');
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "اتصال به پایگاه داده با خطا مواجه شد: " . $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست محصولات - حسابفا</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQ1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php echo getMenu(); ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">لیست محصولات</h2>
            <!-- جدول لیست محصولات -->
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">کد</th>
                        <th class="px-4 py-2">نوع کالا</th>
                        <th class="px-4 py-2">نام</th>
                        <th class="px-4 py-2">کد کالا</th>
                        <th class="px-4 py-2">بارکد</th>
                        <th class="px-4 py-2">توضیحات</th>
                        <th class="px-4 py-2">واحد اصلی</th>
                        <th class="px-4 py-2">واحد فرعی</th>
                        <th class="px-4 py-2">ضریب تبدیل</th>
                        <th class="px-4 py-2">کنترل موجودی</th>
                        <th class="px-4 py-2">نقطه سفارش</th>
                        <th class="px-4 py-2">زمان انتظار</th>
                        <th class="px-4 py-2">حداکثر موجودی</th>
                        <th class="px-4 py-2">حداقل موجودی</th>
                        <th class="px-4 py-2">قیمت فروش</th>
                        <th class="px-4 py-2">قیمت خرید</th>
                        <th class="px-4 py-2">دسته‌بندی</th>
                        <th class="px-4 py-2">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // بازیابی اطلاعات محصولات از پایگاه داده
                    $stmt = $db->query("SELECT id, type, name, product_code, barcode, description, main_unit, sub_unit, conversion_factor, inventory_control, reorder_point, lead_time, max_inventory, min_inventory, sale_price, purchase_price, category FROM products");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td class='border px-4 py-2'>{$row['id']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['type']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['name']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['product_code']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['barcode']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['description']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['main_unit']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['sub_unit']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['conversion_factor']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['inventory_control']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['reorder_point']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['lead_time']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['max_inventory']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['min_inventory']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['sale_price']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['purchase_price']}</td>";
                        echo "<td class='border px-4 py-2'>{$row['category']}</td>";
                        echo "<td class='border px-4 py-2'>";
                        echo "<a href='update_product.php?id={$row['id']}' class='btn btn-sm btn-primary'>ویرایش</a> ";
                        echo "<a href='delete_product.php?id={$row['id']}' class='btn btn-sm btn-danger'>حذف</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
    <?php include('../includes/footer.php'); ?>
</body>
</html>