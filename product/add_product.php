<?php
include '../menu.php'; // شامل کردن فایل منو
?>
<?php

// includes/header.php را در اینجا قرار دهید
include('../includes/header.php');

// اتصال به پایگاه داده (اطلاعات اتصال را در config.php تعریف کنید)
include('../config.php');
try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "اتصال به پایگاه داده با خطا مواجه شد: " . $e->getMessage();
    exit;
}

?>

<div class="main-content">
    <h2>افزودن محصول جدید</h2>
    <form action="save_product.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- بخش اصلی (Main Section) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- تصویر محصول -->
                        <div class="form-group">
                            <label>تصویر محصول:</label>
                            <img id="productImagePreview" src="../uploads/default-image/default-person.png" alt="تصویر پیش‌فرض محصول" class="img-thumbnail" style="max-width: 150px; height: auto; display: block;">
                            <div class="mt-2">
                                <label for="productImage" class="btn btn-primary">انتخاب</label>
                                <input type="file" id="productImage" name="productImage" style="display:none;" onchange="previewImage(this);">
                                <button type="button" class="btn btn-danger" onclick="removeImage()">حذف</button>
                                <button type="button" class="btn btn-info">دوربین</button>
                            </div>
                        </div>

                        <!-- کد حسابداری -->
                        <div class="form-group">
                            <label for="accountingCode">کد حسابداری:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="accountingCode" name="accountingCode" placeholder="کد حسابداری">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="generateAccountingCode()">تولید کد حسابداری</button>
                                </div>
                            </div>
                        </div>

                        <!-- نام کالا -->
                        <div class="form-group">
                            <label for="productName">نام کالا: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="نام کالا" required>
                        </div>

                        <!-- کد کالا -->
                        <div class="form-group">
                            <label for="productCode">کد کالا:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="productCode" name="productCode" placeholder="کد کالا">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="generateProductCode()">تولید کد کالا</button>
                                </div>
                            </div>
                        </div>

                        <!-- بارکد -->
                        <div class="form-group">
                            <label for="barcode">بارکد:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="بارکد (با ; جدا کنید)">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" onclick="generateBarcode()">تولید بارکد</button>
                                </div>
                            </div>
                        </div>

                        <!-- بارکد اصلی -->
                        <div class="form-group">
                            <label for="mainBarcode">بارکد اصلی:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="mainBarcode" name="mainBarcode" placeholder="بارکد اصلی">
                                <div class="input-group-append">
                                    <input type="checkbox" id="noBarcode" name="noBarcode" onchange="toggleBarcodeGeneration()">
                                    <label for="noBarcode" class="ml-1">محصول بارکد ندارد</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="barcodeGenerationGroup" style="display:none;">
                            <button type="button" class="btn btn-secondary" onclick="generateMainBarcode()">تولید بارکد اصلی</button>
                        </div>

                        <!-- دسته‌بندی -->
                        <div class="form-group">
                            <label for="category">دسته‌بندی:</label>
                            <select id="category" name="category" class="form-control"></select>
                        </div>

                    </div>
                </div>
            </div>
                        <!-- بخش تب‌ها (Tabs Section) -->
                        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
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
                        <div class="tab-content mt-3" id="productTabsContent">
                            <!-- تب فروش (Sales Tab) -->
                            <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                <div class="form-group">
                                    <label for="salePrice">قیمت فروش:</label>
                                    <input type="number" class="form-control" id="salePrice" name="salePrice" placeholder="قیمت فروش">
                                </div>
                                <div class="form-group">
                                    <label for="saleDescription">توضیحات فروش:</label>
                                    <textarea class="form-control" id="saleDescription" name="saleDescription" placeholder="توضیحات فروش"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="purchasePrice">قیمت خرید:</label>
                                    <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" placeholder="قیمت خرید">
                                </div>
                                <div class="form-group">
                                    <label for="purchaseDescription">توضیحات خرید:</label>
                                    <textarea class="form-control" id="purchaseDescription" name="purchaseDescription" placeholder="توضیحات خرید"></textarea>
                                </div>
                            </div>

                            <!-- تب عمومی (General Tab) -->
                            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="form-group">
                                    <label for="mainUnit">واحد اصلی:</label>
                                    <select class="form-control" id="mainUnit" name="mainUnit">
                                        <option value="number">عدد</option>
                                        <option value="kilogram">کیلوگرم</option>
                                        <option value="meter">متر</option>
                                        <!-- سایر واحدها -->
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="hasMultipleUnits" name="hasMultipleUnits">
                                    <label class="form-check-label" for="hasMultipleUnits">کالا بیش از یک واحد دارد؟</label>
                                </div>
                                <div class="form-group">
                                    <label for="generalDescription">توضیحات:</label>
                                    <textarea class="form-control" id="generalDescription" name="generalDescription" placeholder="توضیحات کلی درباره محصول"></textarea>
                                </div>
                            </div>

                            <!-- تب موجودی کالا (Inventory Tab) -->
                            <div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="controlInventory" name="controlInventory">
                                    <label class="form-check-label" for="controlInventory">کنترل موجودی</label>
                                </div>
                                <div class="form-group">
                                    <label for="reorderPoint">نقطه سفارش:</label>
                                    <input type="number" class="form-control" id="reorderPoint" name="reorderPoint" placeholder="حداقل تعداد موجودی">
                                </div>
                                <div class="form-group">
                                    <label for="minimumOrder">حداقل سفارش:</label>
                                    <input type="number" class="form-control" id="minimumOrder" name="minimumOrder" placeholder="حداقل تعداد محصول در هر سفارش">
                                </div>
                                <div class="form-group">
                                    <label for="leadTime">زمان انتظار:</label>
                                    <input type="number" class="form-control" id="leadTime" name="leadTime" placeholder="مدت زمان انتظار برای رسیدن محصول به انبار">
                                </div>
                            </div>

                            <!-- تب مالیات (Tax Tab) -->
                            <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                                <div class="form-group">
                                    <label for="taxRate">نرخ مالیات:</label>
                                    <input type="number" class="form-control" id="taxRate" name="taxRate" placeholder="نرخ مالیات">
                                </div>
                                <div class="form-group">
                                    <label for="taxDescription">توضیحات مالیات:</label>
                                    <textarea class="form-control" id="taxDescription" name="taxDescription" placeholder="توضیحات مربوط به مالیات"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">ذخیره</button>
    </form>
</div>

<!-- اضافه کردن لینک به فایل‌های jQuery و Select2 -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- اضافه کردن لینک به فایل‌های Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css"> <!-- اضافه کردن لینک به فایل style.css -->
<script src="../assets/js/main.js"></script> <!-- اضافه کردن لینک به فایل main.js -->

<script>
$(document).ready(function() {
    $('#category').select2({
        placeholder: 'دسته‌بندی را انتخاب کنید',
        ajax: {
            url: 'fetch_categories.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data.items
                };
            },
            cache: true
        },
        minimumInputLength: 1
    });
});

function generateAccountingCode() {
    var category = $('#category').select2('data');
    if (category.length === 0) {
        alert('لطفاً ابتدا دسته‌بندی را انتخاب کنید.');
        return;
    }
    var categoryName = category[0].text;
    var accountingCodePrefix = toEnglish(categoryName.substring(0, 4));
    $('#accountingCode').val(accountingCodePrefix + '-' + Math.floor(Math.random() * 1000000));
}

function generateProductCode() {
    $('#productCode').val('PRD-' + Math.floor(Math.random() * 1000000));
}

function generateBarcode() {
    $('#barcode').val('BRCD-' + Math.floor(Math.random() * 1000000));
}

function generateMainBarcode() {
    $('#mainBarcode').val('MBRCD-' + Math.floor(Math.random() * 1000000));
}

function toggleBarcodeGeneration() {
    if ($('#noBarcode').is(':checked')) {
        $('#barcodeGenerationGroup').show();
    } else {
        $('#barcodeGenerationGroup').hide();
    }
}

function toEnglish(text) {
    var persianToEnglishMap = {
        'ا': 'a', 'ب': 'b', 'پ': 'p', 'ت': 't', 'ث': 's', 'ج': 'j', 'چ': 'ch', 'ح': 'h', 'خ': 'kh',
        'د': 'd', 'ذ': 'z', 'ر': 'r', 'ز': 'z', 'ژ': 'zh', 'س': 's', 'ش': 'sh', 'ص': 's', 'ض': 'z',
        'ط': 't', 'ظ': 'z', 'ع': 'a', 'غ': 'gh', 'ف': 'f', 'ق': 'gh', 'ک': 'k', 'گ': 'g', 'ل': 'l',
        'م': 'm', 'ن': 'n', 'و': 'v', 'ه': 'h', 'ی': 'y'
    };
    return text.split('').map(function(char) {
        return persianToEnglishMap[char] || char;
    }).join('');
}
</script>

<?php
// includes/footer.php را در اینجا قرار دهید
include('../includes/footer.php');
?>