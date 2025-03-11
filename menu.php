<?php
function getMenu() {
    return '
    <div class="w-64 bg-gray-800 text-white" id="sidebar">
        <div class="p-4">
            <h1 class="text-2xl font-bold">حسابفا</h1>
        </div>
        <nav>
            <ul class="p-4">
                <li class="mb-2 menu-item">
                    <a href="/hesabfa/dashboard/index.php"><i class="fas fa-tachometer-alt ml-2"></i> داشبورد</a>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-users ml-2"></i> اشخاص</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/person/add_person.php"><i class="fas fa-plus ml-2"></i> شخص جدید</a></li>
                        <li><a href="/hesabfa/person/person.php"><i class="fas fa-list ml-2"></i> اشخاص</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-box-open ml-2"></i> کالاها و خدمات</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/product/add_product/index.php"><i class="fas fa-plus ml-2"></i> محصول جدید</a></li>
                        <li><a href="/hesabfa/product/list_products.php"><i class="fas fa-list ml-2"></i> لیست محصولات</a></li>
                        <li><a href="/hesabfa/services/list_services.php"><i class="fas fa-list ml-2"></i> لیست خدمات</a></li>
                        <li><a href="/hesabfa/product/update_price_list.php"><i class="fas fa-sync ml-2"></i> به‌روزرسانی لیست قیمت محصولات</a></li>
                        <li><a href="/hesabfa/services/update_price_list.php"><i class="fas fa-sync ml-2"></i> به‌روزرسانی لیست قیمت خدمات</a></li>
                        <li><a href="/hesabfa/product/print_barcode.php"><i class="fas fa-barcode ml-2"></i> چاپ بارکد</a></li>
                        <li><a href="/hesabfa/product/print_batch_barcode.php"><i class="fas fa-barcode ml-2"></i> چاپ بارکد تعدادی</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-university ml-2"></i> بانکداری</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/banking/banks.php"><i class="fas fa-piggy-bank ml-2"></i> بانک‌ها</a></li>
                        <li><a href="/hesabfa/banking/cash_registers.php"><i class="fas fa-cash-register ml-2"></i> صندوق‌ها</a></li>
                        <li><a href="/hesabfa/banking/petty_cashes.php"><i class="fas fa-wallet ml-2"></i> تنخواه‌گردان‌ها</a></li>
                        <li><a href="/hesabfa/banking/transfer.php"><i class="fas fa-exchange-alt ml-2"></i> انتقال</a></li>
                        <li><a href="/hesabfa/banking/transfer_list.php"><i class="fas fa-list ml-2"></i> لیست انتقال‌ها</a></li>
                        <li><a href="/hesabfa/banking/received_checks.php"><i class="fas fa-check ml-2"></i> لیست چک‌های دریافتی</a></li>
                        <li><a href="/hesabfa/banking/paid_checks.php"><i class="fas fa-check ml-2"></i> لیست چک‌های پرداختی</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-money-bill ml-2"></i> فروش و درآمد</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/sales_income/add_sale.php"><i class="fas fa-plus ml-2"></i> فروش جدید</a></li>
                        <li><a href="/hesabfa/sales_income/quick_invoice.php"><i class="fas fa-bolt ml-2"></i> فاکتور سریع</a></li>
                        <li><a href="/hesabfa/sales_income/return_sale.php"><i class="fas fa-undo ml-2"></i> برگشت از فروش</a></li>
                        <li><a href="/hesabfa/sales_income/sale_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای فروش</a></li>
                        <li><a href="/hesabfa/sales_income/return_sale_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از فروش</a></li>
                        <li><a href="/hesabfa/sales_income/income.php"><i class="fas fa-money-bill-alt ml-2"></i> درآمد</a></li>
                        <li><a href="/hesabfa/sales_income/income_list.php"><i class="fas fa-list ml-2"></i> لیست درآمدها</a></li>
                        <li><a href="/hesabfa/sales_income/installment_contract.php"><i class="fas fa-file-contract ml-2"></i> قرارداد فروش اقساطی</a></li>
                        <li><a href="/hesabfa/sales_income/installment_list.php"><i class="fas fa-list ml-2"></i> لیست فروش اقساطی</a></li>
                        <li><a href="/hesabfa/sales_income/discounted_items.php"><i class="fas fa-percent ml-2"></i> اقلام تخفیف‌دار</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-shopping-cart ml-2"></i> خرید و هزینه</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/purchase_expense/add_purchase.php"><i class="fas fa-plus ml-2"></i> خرید جدید</a></li>
                        <li><a href="/hesabfa/purchase_expense/return_purchase.php"><i class="fas fa-undo ml-2"></i> برگشت از خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/purchase_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/return_purchase_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/expense.php"><i class="fas fa-money-bill-alt ml-2"></i> هزینه</a></li>
                        <li><a href="/hesabfa/purchase_expense/expense_list.php"><i class="fas fa-list ml-2"></i> لیست هزینه‌ها</a></li>
                        <li><a href="/hesabfa/purchase_expense/waste.php"><i class="fas fa-trash-alt ml-2"></i> ضایعات</a></li>
                        <li><a href="/hesabfa/purchase_expense/waste_list.php"><i class="fas fa-list ml-2"></i> لیست ضایعات</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-warehouse ml-2"></i> انبارداری</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/warehouse/warehouses.php"><i class="fas fa-boxes ml-2"></i> انبارها</a></li>
                        <li><a href="/hesabfa/warehouse/add_transfer.php"><i class="fas fa-truck-loading ml-2"></i> حواله جدید</a></li>
                        <li><a href="/hesabfa/warehouse/warehouse_documents.php"><i class="fas fa-file-alt ml-2"></i> رسید و حواله‌های انبار</a></li>
                        <li><a href="/hesabfa/warehouse/product_inventory.php"><i class="fas fa-box ml-2"></i> موجودی کالا</a></li>
                        <li><a href="/hesabfa/warehouse/all_warehouses_inventory.php"><i class="fas fa-boxes ml-2"></i> موجودی تمامی انبارها</a></li>
                        <li><a href="/hesabfa/warehouse/stocktaking.php"><i class="fas fa-clipboard-check ml-2"></i> انبارگردانی</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-calculator ml-2"></i> حسابداری</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/accounting/add_document.php"><i class="fas fa-plus ml-2"></i> سند جدید</a></li>
                        <li><a href="/hesabfa/accounting/documents_list.php"><i class="fas fa-list ml-2"></i> لیست اسناد</a></li>
                        <li><a href="/hesabfa/accounting/opening_balance.php"><i class="fas fa-balance-scale ml-2"></i> تراز افتتاحیه</a></li>
                        <li><a href="/hesabfa/accounting/close_fiscal_year.php"><i class="fas fa-times-circle ml-2"></i> بستن سال مالی</a></li>
                        <li><a href="/hesabfa/accounting/accounts_table.php"><i class="fas fa-table ml-2"></i> جدول حساب‌ها</a></li>
                        <li><a href="/hesabfa/accounting/consolidate_documents.php"><i class="fas fa-compress-arrows-alt ml-2"></i> تجمیع اسناد</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="#"><i class="fas fa-ellipsis-h ml-2"></i> سایر</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/other/archive.php"><i class="fas fa-archive ml-2"></i> آرشیو</a></li>
                        <li><a href="/hesabfa/other/sms_panel.php"><i class="fas fa-sms ml-2"></i> پنل پیامک</a></li>
                        <li><a href="/hesabfa/other/inquiry.php"><i class="fas fa-search ml-2"></i> استعلام</a></li>
                        <li><a href="/hesabfa/other/receive_other.php"><i class="fas fa-hand-holding-usd ml-2"></i> دریافت سایر</a></li>
                        <li><a href="/hesabfa/other/receive_list.php"><i class="fas fa-list ml-2"></i> لیست دریافت‌ها</a></li>
                        <li><a href="/hesabfa/other/pay_other.php"><i class="fas fa-hand-holding-usd ml-2"></i> پرداخت سایر</a></li>
                        <li><a href="/hesabfa/other/pay_list.php"><i class="fas fa-list ml-2"></i> لیست پرداخت‌ها</a></li>
                        <li><a href="/hesabfa/other/exchange_document.php"><i class="fas fa-exchange-alt ml-2"></i> سند تسعیر ارز</a></li>
                        <li><a href="/hesabfa/other/personal_balance_document.php"><i class="fas fa-balance-scale ml-2"></i> سند توازن اشخاص</a></li>
                        <li><a href="/hesabfa/other/product_balance_document.php"><i class="fas fa-balance-scale ml-2"></i> سند توازن کالاها</a></li>
                        <li><a href="/hesabfa/other/salary_document.php"><i class="fas fa-money-bill-wave ml-2"></i> سند حقوق</a></li>
                    </ul>
                </li>
                <li class="mb-2 menu-item">
                    <a href="/hesabfa/reports/index.php"><i class="fas fa-chart-bar ml-2"></i> گزارش‌ها</a>
                </li>
                <li class="mb-2 menu-item">
                    <a href="/hesabfa/settings/index.php"><i class="fas fa-cog ml-2"></i> تنظیمات</a>
                </li>
            </ul>
        </nav>
    </div>';
}
?>