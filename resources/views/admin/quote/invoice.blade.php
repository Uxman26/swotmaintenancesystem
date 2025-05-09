<!-- resources/views/admin/invoice.blade.php -->
@extends(backpack_view('blank'))

@section('content')

    <div class="container">
    
<?php
$xero = session('xero');
$xerotoken = session('xero_tokens');

// Check if 'invoices' key exists in $xero
if (!isset($xero['invoices']['Invoices'])) {
    // Use JavaScript to redirect
    echo '<script>window.location.href = "' . route('xero.authenticate') . '";</script>';
    // Optionally, you can include a noscript fallback for users with JavaScript disabled
    echo '<noscript><meta http-equiv="refresh" content="0;url=' . route('xero.authenticate') . '"></noscript>';
    // Make sure to exit the script to prevent further execution
    exit;
} else {
    // Get unique contact names and status for dropdown options
    $contactNames = collect($xero['invoices']['Invoices'])->pluck('Contact.Name')->unique();
    $statuses = collect($xero['invoices']['Invoices'])->pluck('Status')->unique();
}
?>


    
        <h2>Invoices</h2>

        <!-- Add Create Invoice button -->
        <div class="mb-3">
            <a href="{{ route('invoice.create') }}" class="btn btn-success">Create Invoice</a>
        </div>

        <!-- Filter form using a table -->
        <form action="{{ route('invoice.showinvoice') }}" method="get" class="table-responsive">
            <table >
                <tr style="width:30%;">
                    <td>
                        <i class="las la-filter"></i>
                        
                        <select name="contact_name" id="contact_name" class="form-select">
                            <option value="">All Contacts</option>
                            @foreach($contactNames as $contactName)
                                <option value="{{ $contactName }}" {{ request('contact_name') == $contactName ? 'selected' : '' }}>{{ $contactName }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        
                        <select name="status" id="status" class="form-select">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </td>
                </tr>
            </table>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Reference</th>
                    <th>To</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Action</th> <!-- New column for download -->
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($xero['invoices']['Invoices'] as $invoice)
                    <!-- Filter by contact name and status -->
                    @if((request('contact_name') && stripos($invoice['Contact']['Name'], request('contact_name')) === false) || (request('status') && $invoice['Status'] != request('status')))
                        @continue
                    @endif

                    <tr>
                        <td>{{ $invoice['InvoiceNumber'] }}</td>
                        <td>
                            @if(isset($invoice['Reference']))
                                {{ $invoice['Reference'] }}
                            @endif
                        </td>
                        <td>{{ $invoice['Contact']['Name'] }}</td>
                        <td>
                          @if(isset($invoice['DateString']))
                          {{ \Carbon\Carbon::parse($invoice['DateString'])->format('d M Y') }}
                           @endif
                            </td>
                        <td>
                         @if(isset($invoice['DueDateString']))
                         {{ \Carbon\Carbon::parse($invoice['DueDateString'])->format('d M Y') }}
                          @endif
                        </td>
                        
                        <td>
                            @if(isset($invoice['AmountPaid']))
                                {{ $invoice['AmountPaid'] }}
                            @endif
                        </td>
                         
                        <td>
                            @if(isset($invoice['AmountDue']))
                                {{ $invoice['AmountDue'] }}
                            @endif
                        </td>
                        
                        <td>
                            @if(isset($invoice['Status']))
                                {{ $invoice['Status'] }}
                            @endif
                        </td>
                        
                        <td>
                            <a href="{{ route('invoice.editinvoice', ['id' => $invoice['InvoiceID']]) }}" class="btn btn-primary">Edit</a>
                        </td>

                        <td>
                            <a href="{{ route('xero.getpdf', ['token' => $xerotoken['access_token'], 'invoicenumber' => $invoice['InvoiceNumber'], 'id' => $invoice['InvoiceID']]) }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
