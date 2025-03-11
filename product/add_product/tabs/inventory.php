<div class="tab-pane fade" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">
    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="controlInventory" name="controlInventory">
        <label class="form-check-label" for="controlInventory">کنترل موجودی</label>
    </div>
    <div class="form-group mb-4">
        <label for="reorderPoint" class="block mb-2">نقطه سفارش:</label>
        <input type="number" class="form-control" id="reorderPoint" name="reorderPoint" placeholder="حداقل تعداد موجودی">
    </div>
    <div class="form-group mb-4">
        <label for="minimumOrder" class="block mb-2">حداقل سفارش:</label>
        <input type="number" class="form-control" id="minimumOrder" name="minimumOrder" placeholder="حداقل تعداد محصول در هر سفارش">
    </div>
    <div class="form-group mb-4">
        <label for="leadTime" class="block mb-2">زمان انتظار:</label>
        <input type="number" class="form-control" id="leadTime" name="leadTime" placeholder="مدت زمان انتظار برای رسیدن محصول به انبار">
    </div>
</div>