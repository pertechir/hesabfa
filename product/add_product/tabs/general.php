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
    <div class="form-group mb-4">
        <label for="generalDescription" class="block mb-2">توضیحات:</label>
        <textarea class="form-control" id="generalDescription" name="generalDescription" placeholder="توضیحات کلی درباره محصول"></textarea>
    </div>
</div>