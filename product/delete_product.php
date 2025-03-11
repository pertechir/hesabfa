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

// کدهای مربوط به حذف محصول

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>حذف محصول - حسابفا</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aifd+gY1fXU9JwOQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php echo getMenu(); ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">حذف محصول</h2>
            <!-- فرم حذف محصول -->
            <form action="delete_product_action.php" method="post">
                <!-- آی‌دی محصول -->
                <div class="form-group mb-4">
                    <label for="productId" class="block mb-2">آی‌دی محصول:</label>
                    <input type="text" class="form-control" id="productId" name="productId" placeholder="آی‌دی محصول" required>
                </div>
                <button type="submit" class="btn btn-danger mt-6">حذف</button>
            </form>
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