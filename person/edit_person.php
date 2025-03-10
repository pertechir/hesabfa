<?php
$page = '/hesabfa/person/edit_person.php'; // تعیین صفحه فعال
include '../index.php';

// دریافت ID شخص از URL
$id = $_GET['id'];

// اتصال به پایگاه داده
include '../database.php';

// Query برای دریافت اطلاعات شخص با ID مشخص
$sql = "SELECT * FROM persons WHERE id = " . $id;
$result = executeQuery($sql);

// بررسی وجود شخص با ID مشخص
if ($result->num_rows == 0) {
    echo "شخصی با این ID یافت نشد.";
    exit;
}

// دریافت اطلاعات شخص
$row = $result->fetch_assoc();

// بستن اتصال
closeConnection();
?>

    <style>
        body {
            font-family: 'IranSans', sans-serif;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .image-upload {
            position: relative;
            max-width: 200px;
            margin: auto;
        }

        .image-upload .image-edit {
            position: absolute;
            right: 12px;
            top: 10px;
            z-index: 1;
        }

        .image-upload .image-edit input {
            display: none;
        }

        .image-upload .image-edit label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.3s ease-in-out;
        }

        .image-upload .image-edit label:hover {
            background: #f1f1f1;
            border-color: #d2d2d2;
        }

        .image-upload .image-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .image-upload .image-preview img {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-color: #F8F8F8;
            object-fit: cover;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function generateCode() {
            //در اینجا باید کد تولید شود و در input قرار بگیرد
            document.getElementById("code_hesabdari").value = Math.floor(Math.random() * 900000) + 100000;
        }

         function openCategoryPopup() {
            window.open("person_categories.php", "Category Manager", "width=800,height=600");
        }

        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }

        // نمایش تب عمومی به صورت پیش فرض
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("defaultOpen").click();
        });

         // تغییر تصویر پیش نمایش
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imagePreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function(){
            readURL(this);
        });

    </script>

        <!-- محتوای اصلی -->
        <div class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">ویرایش فرد</h2>
            <form action="update_person.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <!-- قسمت بالای صفحه -->
                <div class="flex">
                    <div class="w-3/4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="code_hesabdari">
                                    کد حسابداری:
                                </label>
                                <div class="flex">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_hesabdari" name="code_hesabdari" type="text" placeholder="کد حسابداری" value="<?php echo $row['code_hesabdari']; ?>">
                                    <button type="button" onclick="generateCode()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><i class="fas fa-magic"></i></button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="company">
                                    شرکت:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company" name="company" type="text" placeholder="شرکت" value="<?php echo $row['company']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    عنوان:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="عنوان" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    نام:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="نام" value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="family">
                                    نام خانوادگی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="family" name="family" type="text" placeholder="نام خانوادگی" value="<?php echo $row['family']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="nickname">
                                    نام مستعار:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nickname" name="nickname" type="text" placeholder="نام مستعار" value="<?php echo $row['nickname']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                    دسته‌بندی:
                                </label>
                                <div class="flex">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="category" type="text" placeholder="دسته‌بندی" value="<?php echo $row['category']; ?>">
                                    <button type="button" onclick="openCategoryPopup()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    نوع:
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_customer" value="1" <?php if($row['type_customer'] == 1) echo 'checked'; ?>>
                                    <span class="ml-2 text-gray-700">مشتری</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_supplier" value="1" <?php if($row['type_supplier'] == 1) echo 'checked'; ?>>
                                    <span class="ml-2 text-gray-700">تامین کننده</span>
                                </label>
                                 <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_shareholder" value="1" <?php if($row['type_shareholder'] == 1) echo 'checked'; ?>>
                                    <span class="ml-2 text-gray-700">سهامدار</span>
                                </label>
                                 <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_employee" value="1" <?php if($row['type_employee'] == 1) echo 'checked'; ?>>
                                    <span class="ml-2 text-gray-700">کارمند</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/4">
                        <!-- تصویر شخص -->
                        <div class="image-upload">
                            <label for="file-input">
                                <div class="image-preview">
                                    <img id="imagePreview" src="../uploads/default-image/default person.png" alt="تصویر فرد"/>
                                </div>
                            </label>
                            <div class="image-edit">
                                <input type='file' id="file-input" name="person_image" accept=".png, .jpg, .jpeg" />
                                <label for="file-input"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- تب‌ها -->
                <div class="mt-8">
                    <div class="border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            <li class="mr-2">
                                <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'general')" id="defaultOpen">
                                    <i class="fas fa-info-circle ml-2"></i>
                                    عمومی
                                </button>
                            </li>
                            <li class="mr-2">
                                <button type="button"  class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'address')">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    اطلاعات آدرس
                                </button>
                            </li>
                             <li class="mr-2">
                                  <button type="button"   class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'contact')">
                                    <i class="fas fa-phone ml-2"></i>
                                    اطلاعات تماس
                                </button>
                            </li>
                             <li class="mr-2">
                                  <button type="button"  class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'bank')">
                                    <i class="fas fa-university ml-2"></i>
                                    حساب بانکی
                                </button>
                            </li>
                            <li class="mr-2">
                                  <button type="button"   class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'other')">
                                    <i class="fas fa-ellipsis-h ml-2"></i>
                                    سایر
                                </button>
                            </li>
                        </ul>
                    </div>

                     <!-- محتوای تب ها -->
                    <div id="general" class="tab-content p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="credit">
                                    اعتبار مالی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="credit" name="credit" type="text" placeholder="اعتبار مالی" value="<?php echo $row['credit']; ?>">
                                <span>ریال</span>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price_list">
                                    لیست قیمت:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price_list" name="price_list" type="text" placeholder="لیست قیمت" value="<?php echo $row['price_list']; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tax_type">
                                    نوع مالیات:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tax_type" name="tax_type" type="text" placeholder="نوع مالیات" value="<?php echo $row['tax_type']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tax_registration">
                                    مودی مشمول ثبت نام در نظام مالیاتی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tax_registration" name="tax_registration" type="text" placeholder="مودی مشمول ثبت نام در نظام مالیاتی" value="<?php echo $row['tax_registration']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shenase_meli">
                                    شناسه ملی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shenase_meli" name="shenase_meli" type="text" placeholder="شناسه ملی" value="<?php echo $row['shenase_meli']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="code_eghtesadi">
                                    کد اقتصادی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_eghtesadi" name="code_eghtesadi" type="text" placeholder="کد اقتصادی" value="<?php echo $row['code_eghtesadi']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shomare_sabt">
                                    شماره ثبت:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shomare_sabt" name="shomare_sabt" type="text" placeholder="شماره ثبت" value="<?php echo $row['shomare_sabt']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="code_shobe">
                                    کد شعبه:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_shobe" name="code_shobe" type="text" placeholder="کد شعبه" value="<?php echo $row['code_shobe']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tozihat">
                                    توضیحات:
                                </label>
                                 <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tozihat" name="tozihat" placeholder="توضیحات"><?php echo $row['tozihat']; ?></textarea>
                            </div>
                        </div>
                    </div>

                      <!-- محتوای تب اطلاعات آدرس -->
                    <div id="address" class="tab-content p-4">
                         <div class="grid grid-cols-1 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="address_text">
                                    آدرس:
                                </label>
                                 <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address_text" name="address_text" placeholder="آدرس"><?php echo $row['address_text']; ?></textarea>
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
                                    کشور:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="country" name="country" type="text" placeholder="کشور" value="<?php echo $row['country']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="ostan">
                                    استان:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ostan" name="ostan" type="text" placeholder="استان" value="<?php echo $row['ostan']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shahr">
                                    شهر:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shahr" name="shahr" type="text" placeholder="شهر" value="<?php echo $row['shahr']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="codeposti">
                                    کدپستی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codeposti" name="codeposti" type="text" placeholder="کدپستی" value="<?php echo $row['codeposti']; ?>">
                            </div>
                         </div>
                    </div>

                      <!-- محتوای تب اطلاعات تماس -->
                    <div id="contact" class="tab-content p-4">
                         <div class="grid grid-cols-1 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                                    تلفن:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telephone" type="text" placeholder="تلفن" value="<?php echo $row['telephone']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                                    موبایل:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mobile" name="mobile" type="text" placeholder="موبایل" value="<?php echo $row['mobile']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="fax">
                                    فکس:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fax" name="fax" type="text" placeholder="فکس" value="<?php echo $row['fax']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone1">
                                    تلفن 1:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone1" name="telephone1" type="text" placeholder="تلفن 1" value="<?php echo $row['telephone1']; ?>">
                            </div>
                               <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone2">
                                    تلفن 2:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone2" name="telephone2" type="text" placeholder="تلفن 2" value="<?php echo $row['telephone2']; ?>">
                            </div>
                               <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone3">
                                    تلفن 3:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone3" name="telephone3" type="text" placeholder="تلفن 3" value="<?php echo $row['telephone3']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    ایمیل:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="ایمیل" value="<?php echo $row['email']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                                    وب سایت:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="website" name="website" type="text" placeholder="وب سایت" value="<?php echo $row['website']; ?>">
                            </div>
                         </div>
                    </div>

                     <!-- محتوای تب حساب بانکی -->
                    <div id="bank" class="tab-content p-4">
                         <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-4"><i class="fas fa-plus"></i> افزودن حساب بانکی</button>
                         <!-- در اینجا باید اطلاعات حساب بانکی به صورت داینامیک اضافه شود -->
                    </div>

                     <!-- محتوای تب سایر -->
                    <div id="other" class="tab-content p-4">
                         <div class="grid grid-cols-1 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="birth_date">
                                    تاریخ تولد:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="birth_date" name="birth_date" type="text" placeholder="تاریخ تولد" value="<?php echo $row['birth_date']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="marriage_date">
                                    تاریخ ازدواج:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="marriage_date" name="marriage_date" type="text" placeholder="تاریخ ازدواج" value="<?php echo $row['marriage_date']; ?>">
                            </div>
                             <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="membership_date">
                                    تاریخ عضویت:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="membership_date" name="membership_date" type="text" placeholder="تاریخ عضویت" value="<?php echo $row['membership_date']; ?>" readonly>
                            </div>
                         </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        ذخیره
                    </button>
                </div>
            </form>
        </div>

    </div>
     <script>
        // تغییر تصویر پیش نمایش
        fileInput.onchange = evt => {
            const [file] = fileInput.files
            if (file) {
                imagePreview.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>
</html>