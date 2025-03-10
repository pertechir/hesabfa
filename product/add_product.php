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
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#categoryModal">انتخاب دسته‌بندی</button>
                            <input type="hidden" id="selectedCategoryId" name="category">
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
        <h5 class="modal-title" id="categoryModalLabel">انتخاب دسته‌بندی</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="dx-overlay-wrapper dx-dropdowneditor-overlay dx-popup-wrapper" data-bind="dxControlsDescendantBindings: true">
          <div class="dx-overlay-content dx-rtl dx-popup-normal dx-resizable" tabindex="-1">
            <div class="dx-popup-content" id="dx-category-popup-content">
              <dx-validator _ngcontent-c55=""></dx-validator>
              <app-category-fragment _ngcontent-c55="" _nghost-c57="">
                <dx-tree-view _ngcontent-c57="" class="category-tree dx-treeview-with-search dx-widget dx-rtl dx-collection dx-treeview" datastructure="plain" displayexpr="name" keyexpr="id" parentidexpr="parentId" style="width: auto; height: 250px;">
                  <div class="dx-treeview-search dx-show-invalid-badge dx-textbox dx-texteditor dx-editor-outlined dx-searchbox dx-show-clear-button dx-texteditor-empty dx-widget dx-rtl">
                    <div class="dx-texteditor-container">
                      <div class="dx-texteditor-input-container">
                        <div class="dx-icon dx-icon-search"></div>
                        <input autocomplete="off" aria-label="جستجو" class="dx-texteditor-input" type="text" spellcheck="false" tabindex="0" role="textbox" dir="ltr">
                        <div data-dx_placeholder="جستجو" class="dx-placeholder"></div>
                      </div>
                      <div class="dx-texteditor-buttons-container">
                        <span class="dx-clear-button-area">
                          <span class="dx-icon dx-icon-clear"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="dx-scrollable dx-rtl dx-visibility-change-handler dx-scrollable-vertical dx-scrollable-simulated">
                    <div class="dx-scrollable-wrapper">
                      <div class="dx-scrollable-container">
                        <div class="dx-scrollable-content" tabindex="0" role="tree">
                          <ul class="dx-treeview-node-container dx-treeview-node-container-opened" role="group">
                            <?php foreach ($categories as $category): ?>
                              <li class="dx-treeview-node dx-treeview-item-without-checkbox" data-item-id="<?php echo $category['id']; ?>" role="treeitem" aria-label="<?php echo $category['name']; ?>" aria-expanded="true" aria-level="1" aria-selected="false">
                                <div class="dx-item dx-treeview-item">
                                  <div class="dx-template-wrapper dx-item-content dx-treeview-item-content">
                                    <span><?php echo $category['name']; ?></span>
                                  </div>
                                </div>
                                <div class="dx-treeview-toggle-item-visibility dx-treeview-toggle-item-visibility-opened"></div>
                                <?php if (!empty($category['children'])): ?>
                                  <ul class="dx-treeview-node-container dx-treeview-node-container-opened" role="group">
                                    <?php foreach ($category['children'] as $child): ?>
                                      <li class="dx-treeview-node dx-treeview-item-without-checkbox dx-treeview-node-is-leaf" data-item-id="<?php echo $child['id']; ?>" role="treeitem" aria-label="<?php echo $child['name']; ?>" aria-expanded="true" aria-level="2" aria-selected="false">
                                        <div class="dx-item dx-treeview-item">
                                          <div class="dx-template-wrapper dx-item-content dx-treeview-item-content">
                                            <span class="child-1"><?php echo $child['name']; ?></span>
                                          </div>
                                        </div>
                                      </li>
                                    <?php endforeach; ?>
                                  </ul>
                                <?php endif; ?>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </dx-tree-view>
                <dx-popup _ngcontent-c57="" height="auto" class="dx-overlay dx-popup dx-widget dx-state-invisible dx-visibility-change-handler">
                  <div class="dx-overlay-content dx-rtl dx-popup-normal" aria-hidden="true" tabindex="0">
                    <div class="dx-popup-content"></div>
                  </div>
                </dx-popup>
              </app-category-fragment>
              <div class="row mt-2">
                <div class="col-6">
                  <dx-button _ngcontent-c55="" type="success" width="100%" class="dx-button dx-button-success dx-button-mode-contained dx-widget dx-rtl dx-button-has-text" aria-label="تایید" tabindex="0" role="button">
                    <div class="dx-button-content">
                      <span class="dx-button-text">تایید</span>
                    </div>
                  </dx-button>
                </div>
                <div class="col-6">
                  <dx-button _ngcontent-c55="" type="normal" width="100%" class="dx-button dx-button-normal dx-button-mode-contained dx-widget dx-rtl dx-button-has-text" aria-label="انصراف" tabindex="0" role="button">
                    <div class="dx-button-content">
                      <span class="dx-button-text">انصراف</span>
                    </div>
                  </dx-button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/style.css"> <!-- اضافه کردن لینک به فایل style.css -->
<script src="../assets/js/main.js"></script> <!-- اضافه کردن لینک به فایل main.js -->
<?php
// includes/footer.php را در اینجا قرار دهید
include('../includes/footer.php');
?>