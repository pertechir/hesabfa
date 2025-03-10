<?php
include '../index.php';
include '../database.php';

if (!isset($_GET['id'])) {
    header('Location: list_categories.php');
    exit;
}

$id = intval($_GET['id']);
$category = executeQuery("SELECT * FROM categories WHERE id = $id")->fetch_assoc();

if (!$category) {
    header('Location: list_categories.php');
    exit;
}
?>

<div class="flex-1 p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">ویرایش دسته‌بندی</h2>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form id="categoryForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="code">
                        کد دسته‌بندی
                    </label>
                    <input type="text" id="code" name="code" 
                           value="<?php echo htmlspecialchars($category['code']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="کد دسته‌بندی را وارد کنید">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        نام دسته‌بندی <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" required
                           value="<?php echo htmlspecialchars($category['name']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="نام دسته‌بندی را وارد کنید">
                </div>

                <div class="mb-4 col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        تصویر دسته‌بندی
                    </label>
                    <div class="flex items-center">
                        <div class="relative">
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="hidden" onchange="showPreview(this)">
                            <button type="button" onclick="document.getElementById('image').click()"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fas fa-upload ml-2"></i>
                                انتخاب تصویر
                            </button>
                        </div>
                        <div id="imagePreview" class="mr-4 <?php echo empty($category['image']) ? 'hidden' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($category['image']); ?>" 
                                 alt="پیش‌نمایش تصویر" class="w-24 h-24 object-cover rounded">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_id">
                        دسته‌بندی والد
                    </label>
                    <select id="parent_id" name="parent_id" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">بدون والد</option>
                        <?php
                        $categories = executeQuery("SELECT id, name FROM categories WHERE id != $id ORDER BY name ASC");
                        while ($cat = $categories->fetch_assoc()) {
                            $selected = $cat['id'] == $category['parent_id'] ? 'selected' : '';
                            echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . htmlspecialchars($cat['name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        وضعیت
                    </label>
                    <select id="status" name="status" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="1" <?php echo $category['status'] ? 'selected' : ''; ?>>فعال</option>
                        <option value="0" <?php echo !$category['status'] ? 'selected' : ''; ?>>غیرفعال</option>
                    </select>
                </div>

                <div class="mb-4 col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        توضیحات
                    </label>
                    <textarea id="description" name="description" rows="3"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              placeholder="توضیحات دسته‌بندی را وارد کنید"><?php echo htmlspecialchars($category['description']); ?></textarea>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" onclick="history.back()" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">
                    انصراف
                </button>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    بروز رسانی
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('#imagePreview img').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('categoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('update_category.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('دسته‌بندی با موفقیت بروز رسانی شد');
            window.location.href = 'list_categories.php';
        } else {
            alert(data.message || 'خطا در بروز رسانی دسته‌بندی');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('خطا در ارتباط با سرور');
    });
});
</script>