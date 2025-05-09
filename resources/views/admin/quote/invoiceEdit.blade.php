@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <h1>Edit Invoice</h1>

        <?php 
            use Illuminate\Support\Facades\Route;

            $invoiceId = Route::current()->parameter('id');
            $xero = session('xero');
            
            // Assuming 'Invoices' is an array of invoices
            $invoices = $xero['invoices']['Invoices'];
            
            
            // Find the invoice with matching 'InvoiceID'
            $matchingInvoice = null;
            foreach ($invoices as $invoice) {
                if (isset($invoice['InvoiceID']) && $invoice['InvoiceID'] == $invoiceId) {
                    $matchingInvoice = $invoice;
                    break;
                }
            }
        ?>

        <form action="{{ route('invoice.update', $invoiceId) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($matchingInvoice)
                <div>
                    <label for="customer">To:</label>
                    <input type="text" name="customer" value="{{ $matchingInvoice['Contact']['Name'] }}" />

                    <label for="issue-date">Issue Date:</label>
                    <input type="text" name="issue-date" value="{{ \Carbon\Carbon::parse($matchingInvoice['DateString'])->format('d M Y') }}" />
                    
                    <label for="due-date">Due Date:</label>
                    <input type="text" name="due-date" value="{{ \Carbon\Carbon::parse($matchingInvoice['DueDateString'])->format('d M Y') }}" />

                    <label for="invoice-number">Invoice Number:</label>
                    <input type="text" name="invoice-number" value="{{ $matchingInvoice['InvoiceNumber'] }}" /> 
                    
                    <label for="reference">Reference:</label>
                    <input type="text" name="reference" value="{{ $matchingInvoice['Reference'] ?? '' }}" /> 
                </div>

                <hr>

                <table class="table table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Qty.</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Account</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="items-container">
                       
                      
                            <tr class="item-row">
                                <td>
                                    <div class="form-group">
                                        <label for="item_name">Item Name</label>
                                        <select name="item_name[]" class="form-control item-name-select">
                                            @foreach ($xero['items']['Items'] as $xeroItem)
                                                <option value="{{ $xeroItem['ItemID'] }}" >{{ $xeroItem['Name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_description">Description</label>
                                        <input type="text" name="item_description[]" class="form-control" value="{{ $xeroItem['Description'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_quantity">Qty.</label>
                                        <input type="number" name="item_quantity[]" class="form-control" value="{{ $xeroItem['Quantity'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_price">Price</label>
                                        <input type="text" name="item_price[]" class="form-control" value="{{ $xeroItem['UnitAmount'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_discount">Discount</label>
                                        <input type="text" name="item_discount[]" class="form-control" value="{{ $xeroItem['Discount'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_account">Account</label>
                                        <input type="text" name="item_account[]" class="form-control" value="{{ $xeroItem['AccountCode'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label for="item_amount">Amount</label>
                                        <input type="text" name="item_amount[]" class="form-control" value="{{ $xeroItem['LineAmount'] }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger remove-item">Remove</button>
                                    </div>
                                </td>
                            </tr>
                      
                    </tbody>
                </table>

                <button type="button" class="btn btn-success" id="add-item">Add Item</button>

                <div class="subtotal-total-container">
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" id="total" class="form-control" readonly>
                    </div>
                </div>

                <script>
                    var container = document.getElementById('items-container');
                    var template = document.querySelector('.item-row');

                    // Use the correct default item values or provide default values if there are no line items
                    var defaultItem = <?php echo json_encode(!empty($matchingInvoice['LineItems']) ? $matchingInvoice['LineItems'][0] : [
                        'Description' => '',
                        'Quantity' => 1,
                        'UnitAmount' => 0,
                        'Discount' => 0,
                        'AccountCode' => '',
                    ]); ?>;
                    fillItemDetails(template, defaultItem);

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
                        var discount = parseFloat(row.querySelector('input[name="item_discount[]"]').value) || 0;

                        var amount = quantity * price - discount;
                        row.querySelector('input[name="item_amount[]"]').value = amount.toFixed(2);
                    }

                    container.addEventListener('click', function (event) {
                        if (event.target.classList.contains('remove-item')) {
                            container.removeChild(event.target.closest('.item-row'));
                            updateSubtotalAndTotal();
                        }
                    });

                    container.addEventListener('change', function (event) {
                        if (event.target.classList.contains('item-name-select')) {
                            var selectedItem = <?php echo json_encode($xero['items']['Items']); ?>;
                            var selectedItemDetails = selectedItem.find(item => item.ItemID === event.target.value);
                            fillItemDetails(event.target.closest('.item-row'), selectedItemDetails);
                            updateSubtotalAndTotal();
                        }
                    });

                    document.getElementById('add-item').addEventListener('click', function () {
                        var clone = template.cloneNode(true);
                        container.appendChild(clone);
                        copyDefaultValuesToRow(clone);

                        clone.querySelector('.item-name-select').addEventListener('change', function () {
                            var selectedItem = <?php echo json_encode($xero['items']['Items']); ?>;
                            var selectedItemDetails = selectedItem.find(item => item.ItemID === clone.querySelector('.item-name-select').value);
                            fillItemDetails(clone, selectedItemDetails);
                            updateSubtotalAndTotal();
                        });
                    });

                    function fillItemDetails(row, itemDetails) {
                        row.querySelector('input[name="item_description[]"]').value = itemDetails.Description;
                        row.querySelector('input[name="item_quantity[]"]').value = itemDetails.Quantity;
                        row.querySelector('input[name="item_price[]"]').value = itemDetails.UnitAmount;
                        row.querySelector('input[name="item_account[]"]').value = itemDetails.AccountCode;
                        updateAmount(row);
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
                </script>
            @endif
        </form>
    </div>
@endsection