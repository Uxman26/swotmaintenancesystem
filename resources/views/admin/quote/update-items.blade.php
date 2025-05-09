<!-- resources/views/admin/quote/items.blade.php -->
<div id="items-container">
    <?php 
        $xero = session('xero');
        
        $Id = request()->route('id');
        
        // Fetch quote data from the database
        $quote = \App\Models\Quote::find($Id);
        
        $quoteId = $quote->quote_id;
        
        if (!$quoteId) {
            $items = \App\Models\Item::where('quote_id', $Id)->get();
        } else {
            // Fetch items data from the database using quote_id
            $items = \App\Models\Item::where('quote_id', $quoteId)->get();
        }
    ?>

    @foreach($items as $item)
        <div class="item-row">
            <table class="table table-bordered" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width: 20%;">
                            <div class="form-group">
                                <label for="item_name">Item Name</label>
                                <select name="item_name[]" class="form-control item-name-select">
                                    <option value="">Select an item</option>
                                   @foreach($xero['items'] as $xeroItem)
                                        <option value="{{ $xeroItem['ItemID'] }}" {{ $item->item_id == $xeroItem['ItemID'] ? 'selected' : '' }}>
                                            {{ $xeroItem['Name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="item_id[]" class="form-control" value="{{ $item->item_id }}">
                                <input type="hidden" name="name[]" class="form-control" value="{{ $item->item_name }}">
                            </div>
                        </td>

                        <td style="width: 15%;">
                            <div class="form-group">
                                <label for="item_description">Description</label>
                                <input type="text" name="item_description[]" class="form-control" value="{{ $item->description }}">
                            </div>
                        </td>

                        <td style="width: 12%;">
                            <div class="form-group">
                                <label for="item_quantity">Qty.</label>
                                <input type="number" name="item_quantity[]" class="form-control" value="{{ $item->quantity }}">
                            </div>
                        </td>

                        <td style="width: 15%;">
                            <div class="form-group">
                                <label for="item_price">Price</label>
                                <input type="text" name="item_price[]" class="form-control" value="{{ $item->unit_amount }}">
                            </div>
                        </td>

                        <td style="width: 10%;">
                            <div class="form-group">
                                <label for="item_discount">Discount</label>
                                <input type="text" name="item_discount[]" class="form-control" value="{{ $item->discount }}">
                            </div>
                        </td>

                        <td style="width: 15%;">
                            <div class="form-group">
                                <label for="item_account">Account</label>
                                <input type="text" name="item_account[]" class="form-control" value="{{ $item->account_code }}">
                            </div>
                        </td>

                        <td style="width: 15%;">
                            <div class="form-group">
                                <label for="item_amount">Amount</label>
                                <input type="text" name="item_amount[]" class="form-control" value="{{ $item->lineamount }}">
                            </div>
                        </td>

                        <td style="width: 5%;">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger remove-item" data-item-id="{{ $item->id }}">X</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<button type="button" class="btn btn-success" id="add-item">Add Item</button>

<div class="subtotal-total-container">
    <div class="form-group">
        <label for="subtotal">New Subtotal</label>
        <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="total">New Total</label>
        <input type="text" name="total" id="total" class="form-control" readonly>
    </div>
</div>

<script>
    var container = document.getElementById('items-container');
    var template = document.querySelector('.item-row');

    container.addEventListener('input', function (event) {
        if (
            event.target.name === 'item_quantity[]' ||
            event.target.name === 'item_price[]' ||
            event.target.name === 'item_discount[]'
        ) {
            updateAmount(event.target.closest('.item-row'));
            updateSubtotalAndTotal();
        }
    });

    function updateAmount(row) {
        var quantity = parseFloat(row.querySelector('input[name="item_quantity[]"]').value) || 0;
        var price = parseFloat(row.querySelector('input[name="item_price[]"]').value) || 0;
        var discountPercentage = parseFloat(row.querySelector('input[name="item_discount[]"]').value) || 0;

        // Calculate the discount amount based on the percentage
        var discountAmount = (price * quantity * discountPercentage) / 100;
        var amount = quantity * price - discountAmount;

        row.querySelector('input[name="item_amount[]"]').value = amount.toFixed(2);
    }

    container.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            var itemId = event.target.getAttribute('data-item-id');
            removeItem(itemId, event.target.closest('.item-row'));
            updateSubtotalAndTotal();
        }
    });

    document.getElementById('add-item').addEventListener('click', function () {
        var clone = template.cloneNode(true);
        container.appendChild(clone);
        copyDefaultValuesToRow(clone);

        clone.querySelector('.item-name-select').addEventListener('change', function () {
            var selectedItem = <?php echo json_encode($xero['items']); ?>;
            var selectedItemDetails = selectedItem.find(item => item.ItemID === clone.querySelector('.item-name-select').value);
            fillItemDetails(clone, selectedItemDetails);
            updateSubtotalAndTotal();
        });
    });

    function fillItemDetails(row, itemDetails) {
        // Check if the selected item is the default option
        if (itemDetails && itemDetails.ItemID) {
            row.querySelector('input[name="item_description[]"]').value = itemDetails.Description;
            row.querySelector('input[name="name[]"]').value = itemDetails.Name;
            row.querySelector('input[name="item_id[]"]').value = itemDetails.ItemID;
            row.querySelector('input[name="item_quantity[]"]').value = 1;
            row.querySelector('input[name="item_price[]"]').value = itemDetails.SalesDetails.UnitPrice;
            row.querySelector('input[name="item_account[]"]').value = itemDetails.PurchaseDetails.AccountCode;
            updateAmount(row);
        } else {
            // If it's the default option, clear the values in other columns
            row.querySelector('input[name="item_description[]"]').value = '';
            row.querySelector('input[name="name[]"]').value = '';
            row.querySelector('input[name="item_id[]"]').value = '';
            row.querySelector('input[name="item_quantity[]"]').value = '';
            row.querySelector('input[name="item_price[]"]').value = '';
            row.querySelector('input[name="item_account[]"]').value = '';
            row.querySelector('input[name="item_amount[]"]').value = '';
        }
    }

    function copyDefaultValuesToRow(row) {
        var defaultRow = container.querySelector('.item-row');
        var defaultInputs = defaultRow.querySelectorAll('input[type="text"], input[type="number"]');
        var newInputs = row.querySelectorAll('input[type="text"], input[type="number"]');

        defaultInputs.forEach(function (defaultInput, index) {
            newInputs[index].value = defaultInput.value;
        });
    }

    function updateSubtotalAndTotal() {
        var rows = container.querySelectorAll('.item-row');
        var subtotal = 0;

        rows.forEach(function (row) {
            subtotal += parseFloat(row.querySelector('input[name="item_amount[]"]').value) || 0;
        });

        document.getElementById('subtotal').value = subtotal.toFixed(2);

        // You can add additional logic for taxes or discounts here if needed

        document.getElementById('total').value = subtotal.toFixed(2);
    }

    function removeItem(itemId, row) {
        fetch('/admin/quote/delete-item/' + itemId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    container.removeChild(row);
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
