<?php
// product/add_product.php

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

// دریافت لیست دسته‌بندی‌ها از پایگاه داده
$query = "SELECT * FROM categories";
$stmt = $db->query($query);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div id="sidebar">
    <h1>فهرست</h1>
    <ul>
        <li><a href="#">صفحه اصلی</a></li>
        <li><a href="#">افزودن محصول</a></li>
    </ul>
</div>

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
                            <img id="productImagePreview" src="uploads/default-image/default person.png" alt="تصویر پیش‌فرض محصول" class="img-thumbnail" style="max-width: 150px; height: 150px;">
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
                                <input type="text" class="form-control" id="accountingCode" name="accountingCode" placeholder="کد حسابداری" disabled>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <input type="checkbox" id="autoAccountingCode" name="autoAccountingCode" checked>
                                        <label class="ml-1" for="autoAccountingCode">خودکار</label>
                                    </div>
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
                            <input type="text" class="form-control" id="productCode" name="productCode" placeholder="کد کالا">
                        </div>

                        <!-- بارکد -->
                        <div class="form-group">
                            <label for="barcode">بارکد:</label>
                            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="بارکد (با ; جدا کنید)">
                        </div>

                        <!-- دسته‌بندی -->
                        <div class="form-group">
                            <label for="category">دسته‌بندی:</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">انتخاب دسته‌بندی</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#categoryModal">ایجاد دسته‌بندی جدید</button>
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

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="categoryModalLabel">افزودن دسته‌بندی جدید</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addCategoryForm">
          <div class="form-group">
            <label for="categoryName">نام دسته‌بندی:</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
        <button type="button" class="btn btn-primary" onclick="saveCategory()">ذخیره</button>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script>
    $(document).ready(function() {
        // تغییر وضعیت فیلد کد حسابداری
        $('#autoAccountingCode').change(function() {
            $('#accountingCode').prop('disabled', this.checked);
        });

        // مدیریت تب‌ها
        $('#productTabs a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#productImagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        $('#productImagePreview').attr('src', 'uploads/default-image/default person.png');
        $('#productImage').val(''); // پاک کردن مقدار فیلد فایل
    }

    function saveCategory() {
      var categoryName = $('#categoryName').val();
      $.ajax({
        url: 'save_category.php', // آدرس فایل PHP برای ذخیره دسته‌بندی
        type: 'POST',
        data: { categoryName: categoryName },
        success: function(response) {
          alert(response); // نمایش پیام
          $('#categoryModal').modal('hide'); // بستن modal
          location.reload(); // رفرش صفحه
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('خطا در ذخیره دسته‌بندی: ' + error);
        }
      });
    }
</script>

<style>
    /* استایل‌های اختصاصی */
    .img-thumbnail {
        border: 1px solid #ddd;
        padding: 5px;
    }
    .mt-2 {
        margin-top: 0.5rem;
    }
    .ml-1 {
        margin-left: 0.25rem;
    }
    .text-danger {
        color: red;
    }
    /* استایل برای دکمه‌های تب */
    .nav-tabs .nav-link {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem 0.25rem 0 0;
    }

    .nav-tabs .nav-link.active {
        background-color: #fff;
        color: #495057;
        border-bottom-color: transparent;
    }

    /* استایل برای فرم‌ها */
    .form-control {
        border-radius: 0.25rem;
    }

    /* استایل برای دکمه‌ها */
    .btn {
        border-radius: 0.25rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .btn-link {
        color: #007bff;
    }

    .btn-link:hover {
        color: #0056b3;
    }
</style>

<?php
// includes/footer.php را در اینجا قرار دهید
include('../includes/footer.php');
?>