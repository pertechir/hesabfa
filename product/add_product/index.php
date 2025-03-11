<?php
include '../../menu.php'; // شامل کردن فایل منو
include('../../includes/header.php');
include('../../config.php');
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
    <title>افزودن محصول - حسابفا</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/hesabfa/assets/css/style.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php echo getMenu(); ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">افزودن محصول جدید</h2>
            <form action="save_product.php" method="post" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- بخش اصلی (Main Section) -->
                    <?php include 'main_section.php'; ?>

                    <!-- بخش تب‌ها (Tabs Section) -->
                    <div class="card bg-white p-6 shadow-md rounded-lg">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="true">فروش</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="false">عمومی</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="inventory-tab" data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-selected="false">موجودی کالا</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tax-tab" data-toggle="tab" href="#tax" role="tab" aria-controls="tax" aria-selected="false">مالیات</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="productTabsContent">
                                <!-- تب فروش (Sales Tab) -->
                                <?php include 'tabs/sales.php'; ?>

                                <!-- تب عمومی (General Tab) -->
                                <?php include 'tabs/general.php'; ?>

                                <!-- تب موجودی کالا (Inventory Tab) -->
                                <?php include 'tabs/inventory.php'; ?>

                                <!-- تب مالیات (Tax Tab) -->
                                <?php include 'tabs/tax.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-6">ذخیره</button>
            </form>
        </div>
    </div>

    <!-- پاپ‌آپ لیست قیمت -->
    <div id="priceListModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="priceListModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceListModalLabel">لیست قیمت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- محتوای لیست قیمت -->
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="priceSaleActive" name="priceSaleActive">
                        <label for="priceSaleActive" class="block mb-2">قیمت فروش (IRR):</label>
                        <input type="number" class="form-control" id="priceSale" placeholder="ریال 0">
                    </div>
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="pricePartnerActive" name="pricePartnerActive">
                        <label for="pricePartnerActive" class="block mb-2">همکار (IRR):</label>
                        <input type="number" class="form-control" id="pricePartner" placeholder="ریال 0">
                    </div>
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="priceWholesaleActive" name="priceWholesaleActive">
                        <label for="priceWholesaleActive" class="block mb-2">عمده (IRR):</label>
                        <input type="number" class="form-control" id="priceWholesale" placeholder="ریال 0">
                    </div>
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="priceDollarActive" name="priceDollarActive">
                        <label for="priceDollarActive" class="block mb-2">دلاری (USD):</label>
                        <input type="number" class="form-control" id="priceDollar" placeholder="$ 0.00">
                    </div>
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="priceStaffActive" name="priceStaffActive">
                        <label for="priceStaffActive" class="block mb-2">پرسنل (IRR):</label>
                        <input type="number" class="form-control" id="priceStaff" placeholder="ریال 0">
                    </div>
                    <div class="form-group mb-4">
                        <input type="checkbox" class="form-check-input" id="priceShopActive" name="priceShopActive">
                        <label for="priceShopActive" class="block mb-2">مغازه (IRR):</label>
                        <input type="number" class="form-control" id="priceShop" placeholder="ریال 0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-primary">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/hesabfa/assets/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="/hesabfa/assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/hesabfa/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/hesabfa/assets/css/style.css">
    <script src="/hesabfa/assets/js/main.js"></script>
    <?php include('../../includes/footer.php'); ?>
</body>
</html>