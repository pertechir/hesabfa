<?php
$page = '/hesabfa/person/person.php';
include '../index.php';
include '../database.php';

// دریافت لیست افراد
$sql = "SELECT * FROM persons ORDER BY id DESC";
$result = executeQuery($sql);
?>

<div class="flex-1 p-4">
    <h2 class="text-2xl font-bold mb-4">لیست افراد</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <div class="min-w-max">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm leading-normal sticky top-0">
                        <th class="py-3 px-6 text-right whitespace-nowrap">کد حسابداری</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">شرکت</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">عنوان</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">نام</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">نام خانوادگی</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">نام مستعار</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">دسته‌بندی</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">نوع</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">اعتبار مالی (ریال)</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">تلفن ثابت</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">تلفن همراه</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">فکس</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">ایمیل</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">وب‌سایت</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">آدرس</th>
                        <th class="py-3 px-6 text-right whitespace-nowrap">عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-right">
                                <a href="view_person.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-800">
                                    <?php echo htmlspecialchars($row['code_hesabdari']); ?>
                                </a>
                            </td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['company']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['title']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['name']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['family']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['nickname']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['category']); ?></td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex flex-col space-y-1">
                                    <?php
                                    if ($row['type_customer']) echo '<span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">مشتری</span>';
                                    if ($row['type_supplier']) echo '<span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs">تامین کننده</span>';
                                    if ($row['type_shareholder']) echo '<span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">سهامدار</span>';
                                    if ($row['type_employee']) echo '<span class="inline-block bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">کارمند</span>';
                                    ?>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo number_format($row['credit']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['telephone']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['mobile']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['fax']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td class="py-3 px-6 text-right whitespace-nowrap"><?php echo htmlspecialchars($row['website']); ?></td>
                            <td class="py-3 px-6 text-right max-w-xs overflow-hidden">
                                <div class="truncate" title="<?php echo htmlspecialchars($row['address_text']); ?>">
                                    <?php echo htmlspecialchars($row['address_text']); ?>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex item-center justify-end">
                                    <a href="edit_person.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-900 ml-2" title="ویرایش">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_person.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 ml-2" 
                                       onclick="return confirm('آیا از حذف این فرد اطمینان دارید؟')" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .overflow-x-auto {
        overflow-x: auto;
        max-height: calc(100vh - 200px);
    }
    .min-w-max {
        min-width: max-content;
    }
    thead tr {
        position: sticky;
        top: 0;
        background: #f1f1f1;
        z-index: 10;
    }
</style>