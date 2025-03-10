$(document).ready(function() {
    // تغییر وضعیت فیلد کد حسابداری
    $('#autoAccountingCode').change(function() {
        $('#accountingCode').prop('disabled', this.checked);
    });

    // مدیریت تب‌ها
    $('#productTabs a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    // ذخیره دسته‌بندی جدید
    $('#saveCategoryButton').on('click', function() {
        saveCategory();
    });

    // تنظیمات انتخاب دسته‌بندی
    $('#categoryModal').on('show.bs.modal', function (e) {
        // باز کردن پنجره انتخاب دسته‌بندی
    });

    $('#categoryModal').on('hidden.bs.modal', function (e) {
        // بستن پنجره انتخاب دسته‌بندی
    });

    $('ul.dx-treeview-node-container').on('click', 'li.dx-treeview-node', function () {
        var categoryId = $(this).data('item-id');
        $('#selectedCategoryId').val(categoryId);
        $('#categoryModal').modal('hide');
    });

    $('dx-button[aria-label="تایید"]').on('click', function () {
        var selectedCategoryId = $('#selectedCategoryId').val();
        if (selectedCategoryId) {
            $('#categoryModal').modal('hide');
        } else {
            alert('لطفاً یک دسته‌بندی انتخاب کنید.');
        }
    });

    $('dx-button[aria-label="انصراف"]').on('click', function () {
        $('#categoryModal').modal('hide');
    });
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#productImagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    $('#productImagePreview').attr('src', '/uploads/default-image/default-person.png.png');
    $('#productImage').val(''); // پاک کردن مقدار فیلد فایل
}

function saveCategory() {
    var categoryName = $('#categoryName').val();
    $.ajax({
        url: '../categories/save_category.php', // آدرس فایل PHP برای ذخیره دسته‌بندی
        type: 'POST',
        data: { name: categoryName },
        success: function(response) {
            if (response.success) {
                alert(response.message); // نمایش پیام موفقیت
                $('#categoryModal').modal('hide'); // بستن modal
                location.reload(); // رفرش صفحه
            } else {
                alert('خطا: ' + response.message); // نمایش پیام خطا
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('خطا در ذخیره دسته‌بندی: ' + error);
        }
    });
}

// تنظیمات اولیه و متغیرهای جهانی
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    setupSidebarNavigation();
    setupContentHeight();
}

function setupSidebarNavigation() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if(sidebarToggle && sidebar) {
        // مدیریت کلیک روی دکمه منو
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // بستن منو با کلیک خارج از آن در حالت موبایل
        document.addEventListener('click', (e) => {
            if(window.innerWidth <= 768 && 
               !e.target.closest('.sidebar') && 
               !e.target.closest('#sidebar-toggle')) {
                sidebar.classList.remove('active');
            }
        });
    }
}

function setupContentHeight() {
    function adjustHeight() {
        const navbar = document.querySelector('.navbar');
        const mainContent = document.querySelector('.main-content');
        
        if(navbar && mainContent) {
            const navbarHeight = navbar.offsetHeight;
            mainContent.style.minHeight = `calc(100vh - ${navbarHeight}px)`;
        }
    }

    // تنظیم اولیه ارتفاع
    adjustHeight();
    
    // تنظیم مجدد ارتفاع با تغییر سایز پنجره
    window.addEventListener('resize', adjustHeight);
}

// مدیریت روت‌ها و نمایش صفحات
function showPage(pageName) {
    // پنهان کردن همه صفحات
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => page.style.display = 'none');
    
    // نمایش صفحه مورد نظر
    const targetPage = document.getElementById(`page-${pageName}`);
    if(targetPage) {
        targetPage.style.display = 'block';
    }
}

// مدیریت فرم‌ها
function handleFormSubmit(event, formType) {
    event.preventDefault();
    // پیاده‌سازی منطق ثبت فرم بر اساس نوع آن
    console.log(`در حال پردازش فرم ${formType}`);
}

// توابع کمکی برای فرمت‌کردن اعداد و تاریخ
function formatNumber(number) {
    return new Intl.NumberFormat('fa-IR').format(number);
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('fa-IR');
}

// تابع تولید کد حسابداری
function generateCode() {
    try {
        // تولید یک عدد 6 رقمی تصادفی با پیشوند سال
        let prefix = new Date().getFullYear().toString().substr(-2);
        let random = Math.floor(Math.random() * 9000) + 1000;
        let code = prefix + random.toString();
        
        let codeInput = document.getElementById("code_hesabdari");
        if (!codeInput) {
            console.error("فیلد کد حسابداری پیدا نشد");
            return;
        }

        // اعمال کد جدید با افکت بصری
        codeInput.value = code;
        codeInput.classList.add('highlight');
        
        setTimeout(() => {
            codeInput.classList.remove('highlight');
        }, 1000);

        console.log('کد جدید تولید شد:', code);

    } catch (error) {
        console.error('خطا در تولید کد:', error);
    }
}

// عملکرد مربوط به انتخاب دسته‌بندی در صفحه افزودن محصول
function setupCategorySelector() {
    const categoryButton = document.getElementById('categoryButton');
    const categoryModal = document.getElementById('categoryModal');

    if (categoryButton && categoryModal) {
        categoryButton.addEventListener('click', () => {
            // کد لازم برای باز کردن پنجره دسته‌بندی
            categoryModal.style.display = 'block';
        });

        // بستن پنجره با کلیک خارج از آن
        window.addEventListener('click', (event) => {
            if (event.target == categoryModal) {
                categoryModal.style.display = 'none';
            }
        });
    }
}
$(document).ready(function() {
    // تغییر وضعیت فیلد کد حسابداری
    $('#autoAccountingCode').change(function() {
        $('#accountingCode').prop('disabled', this.checked);
    });

    // مدیریت تب‌ها
    $('#productTabs a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    // ذخیره دسته‌بندی جدید
    $('#saveCategoryButton').on('click', function() {
        saveCategory();
    });

    // تنظیمات انتخاب دسته‌بندی
    $('#categoryModal').on('show.bs.modal', function (e) {
        // باز کردن پنجره انتخاب دسته‌بندی
    });

    $('#categoryModal').on('hidden.bs.modal', function (e) {
        // بستن پنجره انتخاب دسته‌بندی
    });

    $('ul.dx-treeview-node-container').on('click', 'li.dx-treeview-node', function () {
        var categoryId = $(this).data('item-id');
        $('#selectedCategoryId').val(categoryId);
        $('#categoryModal').modal('hide');
    });

    $('dx-button[aria-label="تایید"]').on('click', function () {
        var selectedCategoryId = $('#selectedCategoryId').val();
        if (selectedCategoryId) {
            $('#categoryModal').modal('hide');
        } else {
            alert('لطفاً یک دسته‌بندی انتخاب کنید.');
        }
    });

    $('dx-button[aria-label="انصراف"]').on('click', function () {
        $('#categoryModal').modal('hide');
    });
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#productImagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    $('#productImagePreview').attr('src', 'uploads/default-image/default person.png');
    $('#productImage').val(''); // پاک کردن مقدار فیلد فایل
}

function saveCategory() {
    var categoryName = $('#categoryName').val();
    $.ajax({
        url: '../categories/save_category.php', // آدرس فایل PHP برای ذخیره دسته‌بندی
        type: 'POST',
        data: { name: categoryName },
        success: function(response) {
            if (response.success) {
                alert(response.message); // نمایش پیام موفقیت
                $('#categoryModal').modal('hide'); // بستن modal
                location.reload(); // رفرش صفحه
            } else {
                alert('خطا: ' + response.message); // نمایش پیام خطا
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('خطا در ذخیره دسته‌بندی: ' + error);
        }
    });
}

// فراخوانی تابع
setupCategorySelector();