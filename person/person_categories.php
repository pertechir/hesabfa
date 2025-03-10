<?php
$page = '/hesabfa/person/person_categories.php';
include '../index.php';
include '../database.php';

// جستجو
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if ($search) {
    $where = " WHERE c1.name LIKE '%" . mysqli_real_escape_string($connection, $search) . "%'";
}

// دریافت لیست دسته‌بندی‌ها با نام والد
$sql = "SELECT c1.*, 
        (SELECT name FROM categories WHERE id = c1.parent_id) as parent_name 
        FROM categories c1" . $where . "
        ORDER BY c1.name ASC";
$result = executeQuery($sql);

// دریافت لیست برای select
$categoriesForSelect = executeQuery("SELECT id, name FROM categories ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دسته‌بندی اشخاص</title>
</head>
<body class="bg-gray-100">
    <div class="flex-1 p-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">دسته‌بندی اشخاص</h2>
            <button onclick="showAddModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus ml-1"></i>
                افزودن دسته‌بندی جدید
            </button>
        </div>

        <!-- جستجو -->
        <div class="mb-6">
            <form class="flex items-center" method="GET">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           class="w-full px-4 py-2 rounded-r border focus:outline-none focus:border-blue-500"
                           placeholder="جستجو در دسته‌بندی‌ها...">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-l">
                    جستجو
                </button>
            </form>
        </div>

        <!-- جدول دسته‌بندی‌ها -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">کد</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">نام دسته‌بندی</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">دسته‌بندی والد</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">توضیحات</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['code']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['parent_name'] ?? '---'); ?></td>
                                <td class="px-6 py-4"><?php echo htmlspecialchars($row['description']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($row['status']): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            فعال
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            غیرفعال
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-left">
                                    <button onclick="showEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" 
                                            class="text-blue-600 hover:text-blue-900 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteCategory(<?php echo $row['id']; ?>)" 
                                            class="text-red-600 hover:text-red-900 mx-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                هیچ دسته‌بندی یافت نشد
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- مودال افزودن/ویرایش -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-medium" id="modalTitle">افزودن دسته‌بندی جدید</h3>
                </div>
                <form id="categoryForm" class="p-6">
                    <input type="hidden" id="categoryId" name="id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="code">کد</label>
                        <input type="text" id="code" name="code" 
                               class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="name">نام دسته‌بندی</label>
                        <input type="text" id="name" name="name" required
                               class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="parent_id">دسته‌بندی والد</label>
                        <select id="parent_id" name="parent_id" 
                                class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="">بدون والد</option>
                            <?php
                            $categoriesForSelect->data_seek(0);
                            while ($category = $categoriesForSelect->fetch_assoc()): 
                            ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="description">توضیحات</label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full p-2 border rounded focus:outline-none focus:border-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="status">وضعیت</label>
                        <select id="status" name="status" 
                                class="w-full p-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="hideModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            انصراف
                        </button>
                        <button type="button" onclick="saveCategory()"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            ذخیره
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function showAddModal() {
        document.getElementById('modalTitle').textContent = 'افزودن دسته‌بندی جدید';
        document.getElementById('categoryForm').reset();
        document.getElementById('categoryId').value = '';
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }

    function showEditModal(category) {
        document.getElementById('modalTitle').textContent = 'ویرایش دسته‌بندی';
        document.getElementById('categoryId').value = category.id;
        document.getElementById('code').value = category.code || '';
        document.getElementById('name').value = category.name || '';
        document.getElementById('parent_id').value = category.parent_id || '';
        document.getElementById('description').value = category.description || '';
        document.getElementById('status').value = category.status;
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function saveCategory() {
        const form = document.getElementById('categoryForm');
        const formData = new FormData(form);

        fetch('save_category.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                hideModal();
                window.location.reload();
            } else {
                alert(data.message || 'خطا در ذخیره‌سازی');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در ارتباط با سرور');
        });
    }

    function deleteCategory(id) {
        if (confirm('آیا از حذف این دسته‌بندی اطمینان دارید؟')) {
            fetch('delete_category.php?id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert(data.message || 'خطا در حذف دسته‌بندی');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('خطا در ارتباط با سرور');
                });
        }
    }
    </script>
</body>
</html>