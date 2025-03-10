<?php
// بررسی دسترسی مستقیم به فایل
if (!defined('BASEPATH')) {
    exit('دسترسی مستقیم به فایل امکان‌پذیر نیست');
}
?>
<!-- کامپوننت انتخاب دسته‌بندی -->
<div class="category-component mb-4">
    <div class="relative">
        <div class="flex">
            <div class="relative flex-1">
                <input type="text" 
                       id="categorySearch" 
                       placeholder="جستجو در دسته‌بندی‌ها..." 
                       class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       autocomplete="off">
                <div id="categoryDropdown" 
                     class="hidden absolute z-50 w-full mt-1 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">
                </div>
            </div>
        </div>
        
        <!-- نمایش دسته‌بندی‌های انتخاب شده -->
        <div id="selectedCategoriesContainer" class="flex flex-wrap gap-2 mt-2">
            <!-- دسته‌بندی‌های انتخاب شده اینجا نمایش داده می‌شوند -->
        </div>
        
        <!-- مقادیر انتخاب شده -->
        <input type="hidden" id="categoryIds" name="category_ids" value="">
        <input type="hidden" id="mainCategoryId" name="main_category_id" value="">
    </div>
</div>