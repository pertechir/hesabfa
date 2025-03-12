<div class="card bg-white p-6 shadow-md rounded-lg">
    <div class="card-body">
        <!-- تصویر محصول -->
        <div class="form-group mb-4">
            <label class="block mb-2">تصویر محصول:</label>
            <img id="productImagePreview" src="/hesabfa/uploads/default-image/default-person.png" alt="تصویر پیش‌فرض محصول" class="img-thumbnail mb-2" style="max-width: 150px; height: auto; display: block;">
            <div class="mt-2">
                <label for="productImage" class="btn btn-primary cursor-pointer">انتخاب</label>
                <input type="file" id="productImage" name="productImage" style="display:none;" onchange="previewImage(this);">
                <button type="button" class="btn btn-danger" onclick="removeImage()">حذف</button>
                <button type="button" class="btn btn-info">دوربین</button>
            </div>
        </div>
        <!-- دکمه فعال/غیرفعال -->
        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" id="isActive" name="isActive">
            <label class="form-check-label" for="isActive">فعال / غیرفعال</label>
        </div>
          <!-- دسته‌بندی -->
          <div class="form-group mb-4">
            <label for="category" class="block mb-2">دسته‌بندی:</label>
            <select id="category" name="category" class="form-control"></select>
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

      

        
    </div>
</div>