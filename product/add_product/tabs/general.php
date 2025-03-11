<div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="form-group mb-4">
        <label for="mainUnit" class="block mb-2">واحد اصلی:</label>
        <select class="form-control" id="mainUnit" name="mainUnit">
            <option value="number">عدد</option>
            <option value="kilogram">کیلوگرم</option>
            <option value="meter">متر</option>
            <!-- سایر واحدها -->
        </select>
    </div>
    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="hasMultipleUnits" name="hasMultipleUnits">
        <label class="form-check-label" for="hasMultipleUnits">کالا بیش از یک واحد دارد؟</label>
    </div>
    <div id="multipleUnitsFields" style="display:none;">
        <div class="form-group mb-4">
            <label for="subUnit" class="block mb-2">واحد فرعی:</label>
            <input type="text" class="form-control" id="subUnit" name="subUnit" maxlength="30">
        </div>
        <div class="form-group mb-4">
            <label for="conversionFactor" class="block mb-2">ضریب تبدیل:</label>
            <input type="number" class="form-control" id="conversionFactor" name="conversionFactor" value="1" min="0.0001" step="0.0001">
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="generalDescription" class="block mb-2">توضیحات:</label>
        <textarea class="form-control" id="generalDescription" name="generalDescription" placeholder="توضیحات کلی درباره محصول"></textarea>
    </div>
</div>