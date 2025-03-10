<?php
$page = '/hesabfa/person/view_person.php';
include '../index.php';
include '../database.php';

$id = $_GET['id'];
$sql = "SELECT * FROM persons WHERE id = " . $id;
$result = executeQuery($sql);
$person = $result->fetch_assoc();

if (!$person) {
    header("Location: person.php?message=" . urlencode("فرد مورد نظر یافت نشد."));
    exit;
}
?>

<div class="flex-1 p-4">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">اطلاعات کامل فرد</h2>
            <div class="flex space-x-2">
                <a href="edit_person.php?id=<?php echo $person['id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    <i class="fas fa-edit ml-1"></i>
                    ویرایش
                </a>
                <a href="person.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-arrow-right ml-1"></i>
                    بازگشت
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- اطلاعات اصلی -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">اطلاعات اصلی</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">کد حسابداری:</span>
                        <span><?php echo htmlspecialchars($person['code_hesabdari']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">نام و نام خانوادگی:</span>
                        <span><?php echo htmlspecialchars($person['name'] . ' ' . $person['family']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">شرکت:</span>
                        <span><?php echo htmlspecialchars($person['company']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">عنوان:</span>
                        <span><?php echo htmlspecialchars($person['title']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">نام مستعار:</span>
                        <span><?php echo htmlspecialchars($person['nickname']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">دسته‌بندی:</span>
                        <span><?php echo htmlspecialchars($person['category']); ?></span>
                    </div>
                </div>
            </div>

            <!-- اطلاعات نوع و اعتبار -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">نوع و اعتبار</h3>
                <div class="space-y-3">
                    <div class="flex flex-wrap gap-2">
                        <?php if ($person['type_customer']): ?>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded">مشتری</span>
                        <?php endif; ?>
                        <?php if ($person['type_supplier']): ?>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded">تامین کننده</span>
                        <?php endif; ?>
                        <?php if ($person['type_shareholder']): ?>
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded">سهامدار</span>
                        <?php endif; ?>
                        <?php if ($person['type_employee']): ?>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded">کارمند</span>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-between mt-4">
                        <span class="font-medium">اعتبار مالی:</span>
                        <span><?php echo number_format($person['credit']); ?> ریال</span>
                    </div>
                </div>
            </div>

            <!-- اطلاعات تماس -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">اطلاعات تماس</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">تلفن ثابت:</span>
                        <span><?php echo htmlspecialchars($person['telephone']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">تلفن همراه:</span>
                        <span><?php echo htmlspecialchars($person['mobile']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">فکس:</span>
                        <span><?php echo htmlspecialchars($person['fax']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">ایمیل:</span>
                        <span><?php echo htmlspecialchars($person['email']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">وب‌سایت:</span>
                        <span><?php echo htmlspecialchars($person['website']); ?></span>
                    </div>
                </div>
            </div>

            <!-- اطلاعات آدرس -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">اطلاعات آدرس</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">کشور:</span>
                        <span><?php echo htmlspecialchars($person['country']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">استان:</span>
                        <span><?php echo htmlspecialchars($person['ostan']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">شهر:</span>
                        <span><?php echo htmlspecialchars($person['shahr']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">کد پستی:</span>
                        <span><?php echo htmlspecialchars($person['codeposti']); ?></span>
                    </div>
                    <div class="mt-3">
                        <span class="font-medium">آدرس کامل:</span>
                        <p class="mt-1 text-gray-600"><?php echo nl2br(htmlspecialchars($person['address_text'])); ?></p>
                    </div>
                </div>
            </div>

            <!-- اطلاعات تکمیلی -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">اطلاعات تکمیلی</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">تاریخ تولد:</span>
                        <span><?php echo $person['birth_date'] ? date("Y/m/d", strtotime($person['birth_date'])) : '-'; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">تاریخ ازدواج:</span>
                        <span><?php echo $person['marriage_date'] ? date("Y/m/d", strtotime($person['marriage_date'])) : '-'; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">تاریخ عضویت:</span>
                        <span><?php echo $person['membership_date'] ? date("Y/m/d", strtotime($person['membership_date'])) : '-'; ?></span>
                    </div>
                </div>
            </div>

            <!-- اطلاعات مالیاتی -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">اطلاعات مالیاتی و قانونی</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">شناسه ملی:</span>
                        <span><?php echo htmlspecialchars($person['shenase_meli']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">کد اقتصادی:</span>
                        <span><?php echo htmlspecialchars($person['code_eghtesadi']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">شماره ثبت:</span>
                        <span><?php echo htmlspecialchars($person['shomare_sabt']); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">کد شعبه:</span>
                        <span><?php echo htmlspecialchars($person['code_shobe']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- توضیحات -->
        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 border-b pb-2">توضیحات</h3>
            <p class="text-gray-600 whitespace-pre-line"><?php echo nl2br(htmlspecialchars($person['tozihat'])); ?></p>
        </div>
        
        <!-- دکمه‌های پایین صفحه -->
        <div class="mt-6 flex justify-end space-x-2">
            <a href="edit_person.php?id=<?php echo $person['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                <i class="fas fa-edit ml-1"></i>
                ویرایش اطلاعات
            </a>
            <a href="person.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-right ml-1"></i>
                بازگشت به لیست
            </a>
        </div>
    </div>
</div>

<style>
.space-y-3 > :not([hidden]) ~ :not([hidden]) {
    margin-top: 0.75rem;
}
</style>