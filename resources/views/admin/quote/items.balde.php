<!-- resources/views/admin/quote/items.blade.php -->
<div>
    <!-- Add your HTML structure for the item part here -->
    <!-- Example: -->
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" name="item_name[]" class="form-control">
    </div>

    <div class="form-group">
        <label for="item_quantity">Quantity</label>
        <input type="number" name="item_quantity[]" class="form-control">
    </div>

    <div class="form-group">
        <label for="item_price">Price</label>
        <input type="text" name="item_price[]" class="form-control">
    </div>
    <!-- Repeat this structure for each item -->
</div>
