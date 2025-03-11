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
    <title>افزودن محصول - حسابفا</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aifd+gY1fXU9JwOQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <div class="card bg-white p-6 shadow-md rounded-lg">
                        <div class="card-body">
                            <!-- تصویر محصول -->
                            <div class="form-group mb-4">
                                <label class="block mb-2">تصویر محصول:</label>
                                <img id="productImagePreview" src="../uploads/default-image/default-person.png" alt="تصویر پیش‌فرض محصول" class="img-thumbnail mb-2" style="max-width: 150px; height: auto; display: block;">
                                <div class="mt-2">
                                    <label for="productImage" class="btn btn-primary cursor-pointer">انتخاب</label>
                                    <input type="file" id="productImage" name="productImage" style="display:none;" onchange="previewImage(this);">
                                    <button type="button" class="btn btn-danger" onclick="removeImage()">حذف</button>
                                    <button type="button" class="btn btn-info">دوربین</button>
                                </div>
                            </div>

                            <!-- کد حسابداری -->
                            <div class="form-group mb-4">
                                <label for="accountingCode" class="block mb-2">کد حسابداری:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="accountingCode" name="accountingCode" placeholder="کد حسابداری">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" onclick="generateAccountingCode()">تولید کد حسابداری</button>
                                    </div>
                                </div>
                            </div>

                            <!-- نام کالا -->
                            <div class="form-group mb-4">
                                <label for="productName" class="block mb-2">نام کالا: <span class="text-red-500">*</span></label>
                                <input type="text" class="form-control" id="productName" name="productName" placeholder="نام کالا" required>
                            </div>

                            <!-- کد کالا -->
                            <div class="form-group mb-4">
                                <label for="productCode" class="block mb-2">کد کالا:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="productCode" name="productCode" placeholder="کد کالا">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" onclick="generateProductCode()">تولید کد کالا</button>
                                    </div>
                                </div>
                            </div>

                            <!-- بارکد -->
                            <div class="form-group mb-4">
                                <label for="barcode" class="block mb-2">بارکد:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="بارکد (با ; جدا کنید)">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary" onclick="generateBarcode()">تولید بارکد</button>
                                    </div>
                                </div>
                            </div>

                            <!-- بارکد اصلی -->
                            <div class="form-group mb-4">
                                <label for="mainBarcode" class="block mb-2">بارکد اصلی:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="mainBarcode" name="mainBarcode" placeholder="بارکد اصلی">
                                    <div class="input-group-append">
                                        <input type="checkbox" id="noBarcode" name="noBarcode" onchange="toggleBarcodeGeneration()">
                                        <label for="noBarcode" class="ml-1">محصول بارکد ندارد</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4" id="barcodeGenerationGroup" style="display:none;">
                                <button type="button" class="btn btn-secondary" onclick="generateMainBarcode()">تولید بارکد اصلی</button>
                            </div>

                            <!-- دسته‌بندی -->
                            <div class="form-group mb-4">
                                <label for="category" class="block mb-2">دسته‌بندی:</label>
                                <select id="category" name="category" class="form-control"></select>
                            </div>
                        </div>
                    </div>

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
                                <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                    <div class="form-group mb-4">
                                        <label for="salePrice" class="block mb-2">قیمت فروش:</label>
                                        <input type="number" class="form-control" id="salePrice" name="salePrice" placeholder="قیمت فروش">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="saleDescription" class="block mb-2">توضیحات فروش:</label>
                                        <textarea class="form-control" id="saleDescription" name="saleDescription" placeholder="توضیحات فروش"></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="purchasePrice" class="block mb-2">قیمت خرید:</label>
                                        <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" placeholder="قیمت خرید">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="purchaseDescription" class="block mb-2">توضیحات خرید:</label>
                                        <textarea class="form-control" id="purchaseDescription" name="purchaseDescription" placeholder="توضیحات خرید"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-info" id="showPriceList">لیست قیمت</button>
                                </div>

                                <!-- تب عمومی (General Tab) -->
                                <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="form-group mb-4">
                                        <label for="mainUnit" class="block mb-2">واحد اصلی:</label>
                                        <select class="form-control" id="mainUnit" name="mainUnit">
                                            <option value="number">عدد</option>
                                            <option value="kilogram">کیلوگرم</option>
                                            <option value="meter">متر</option>
                                            <!-- سایر واحدها -->
                                        </select>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="hasMultipleUnits" name="hasMultipleUnits">
                                        <label class="form-check-label" for="hasMultipleUnits">کالا بیش از یک واحد دارد؟</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="generalDescription" class="block mb-2">توضیحات:</label>
                                        <textarea class="form-control" id="generalDescription" name="generalDescription" placeholder="توضیحات کلی درباره محصول"></textarea>
                                    </div>
                                </div>

                                <!-- تب موجودی کالا (Inventory Tab) -->
                                <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="controlInventory" name="controlInventory">
                                        <label class="form-check-label" for="controlInventory">کنترل موجودی</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="reorderPoint" class="block mb-2">نقطه سفارش:</label>
                                        <input type="number" class="form-control" id="reorderPoint" name="reorderPoint" placeholder="حداقل تعداد موجودی">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="minimumOrder" class="block mb-2">حداقل سفارش:</label>
                                        <input type="number" class="form-control" id="minimumOrder" name="minimumOrder" placeholder="حداقل تعداد محصول در هر سفارش">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="leadTime" class="block mb-2">زمان انتظار:</label>
                                        <input type="number" class="form-control" id="leadTime" name="leadTime" placeholder="مدت زمان انتظار برای رسیدن محصول به انبار">
                                    </div>
                                </div>

                                <!-- تب مالیات (Tax Tab) -->
                                <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                                    <div class="form-group mb-4">
                                        <label for="taxRate" class="block mb-2">نرخ مالیات:</label>
                                        <input type="number" class="form-control" id="taxRate" name="taxRate" placeholder="نرخ مالیات">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="taxDescription" class="block mb-2">توضیحات مالیات:</label>
                                        <textarea class="form-control" id="taxDescription" name="taxDescription" placeholder="توضیحات مربوط به مالیات"></textarea>
                                    </div>
                                </div>
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