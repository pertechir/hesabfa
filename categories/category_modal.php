<!-- مدال انتخاب دسته‌بندی -->
<div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-3/4 max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">مدیریت دسته‌بندی‌ها</h3>
            <button onclick="closeCategoryModal()" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="flex space-x-4 mb-4">
            <button onclick="showAddCategoryForm()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus ml-2"></i>
                دسته‌بندی جدید
            </button>
            <div id="categorySearch-wrapper" class="relative w-full">
                <div class="flex flex-col">
                    <div class="flex items-center p-2 border rounded">
                        <input type="text" 
                               id="categorySearch" 
                               class="w-full outline-none" 
                               placeholder="جستجو در دسته‌بندی‌ها...">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <div id="categoryDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto top-full">
                        <!-- لیست دسته‌بندی‌ها اینجا نمایش داده می‌شود -->
                    </div>
                </div>
                <div id="selectedCategoriesContainer" class="flex flex-wrap gap-2 mt-2">
                    <!-- دسته‌بندی‌های انتخاب شده اینجا نمایش داده می‌شوند -->
                </div>
                <input type="hidden" id="categoryIds" name="category_ids" value="">
            </div>
        </div>

        <div class="flex">
            <!-- لیست دسته‌بندی‌ها -->
            <div class="w-2/3 ml-4">
                <div id="categoriesList" class="border rounded p-4 max-h-96 overflow-y-auto"></div>
            </div>

            <!-- دسته‌بندی‌های انتخاب شده -->
            <div class="w-1/3">
                <h4 class="font-bold mb-2">دسته‌بندی‌های انتخاب شده</h4>
                <div id="selectedCategories" class="border rounded p-4 min-h-[200px]"></div>
                <div class="mt-4">
                    <button onclick="saveSelectedCategories()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                        تایید و بستن
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- فرم افزودن/ویرایش دسته‌بندی -->
<div id="categoryForm" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96">
        <div class="flex justify-between items-center mb-4">
            <h3 id="categoryFormTitle" class="text-xl font-bold">افزودن دسته‌بندی جدید</h3>
            <button onclick="closeCategoryForm()" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="addEditCategoryForm" class="space-y-4">
            <input type="hidden" id="categoryId" name="id">
            
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryCode">
                    کد
                </label>
                <div class="flex">
                    <input type="text" 
                           id="categoryCode" 
                           name="code" 
                           class="flex-1 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2"
                           required>
                    <button type="button" 
                            onclick="generateCategoryCode()" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryName">
                    نام دسته‌بندی
                </label>
                <input type="text" 
                       id="categoryName" 
                       name="name" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryParent">
                    دسته‌بندی والد
                </label>
                <select id="categoryParent" 
                        name="parent_id" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">بدون والد</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryDescription">
                    توضیحات
                </label>
                <textarea id="categoryDescription" 
                          name="description" 
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          rows="3"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" 
                        onclick="closeCategoryForm()" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    انصراف
                </button>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    ذخیره
                </button>
            </div>
        </form>
    </div>
</div>