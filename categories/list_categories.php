<?php
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
?>

<div class="flex-1 p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">لیست دسته‌بندی‌ها</h2>
        <a href="add_category.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus ml-1"></i>
            افزودن دسته‌بندی جدید
        </a>
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

    <!-- جدول -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">کد</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام دسته‌بندی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">دسته‌بندی والد</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">توضیحات</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="view_category.php?id=<?php echo $row['id']; ?>" 
                                   class="text-blue-600 hover:text-blue-900 hover:underline">
                                    <?php echo htmlspecialchars($row['id']); ?>
                                </a>
                            </td>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="edit_category.php?id=<?php echo $row['id']; ?>" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteCategory(<?php echo $row['id']; ?>)" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
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

<script>
function deleteCategory(id) {
    if (confirm('آیا از حذف این دسته‌بندی اطمینان دارید؟')) {
        fetch('delete_category.php?id=' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('دسته‌بندی با موفقیت حذف شد');
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