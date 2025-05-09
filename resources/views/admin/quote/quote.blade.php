<!-- resources/views/admin/quotes.blade.php -->
@extends(backpack_view('blank'))

@section('content')

    <div class="container">
     <?php 
        $xero = session('xero');
        $xerotoken = session('xero_tokens');
     
        // Check if 'invoices' key exists in $xero
        if (!isset($xero['quotes']['Quotes'])) {
            // Use JavaScript to redirect
            echo '<script>window.location.href = "' . route('xero.authenticate') . '";</script>';
            // Optionally, you can include a noscript fallback for users with JavaScript disabled
            echo '<noscript><meta http-equiv="refresh" content="0;url=' . route('xero.authenticate') . '"></noscript>';
            // Make sure to exit the script to prevent further execution
            exit;
        } else {
        // Get unique contact names and status for dropdown options
        $contactNames = collect($xero['quotes']['Quotes'])->pluck('Contact.Name')->unique();
        $statuses = collect($xero['quotes']['Quotes'])->pluck('Status')->unique();
        }
     ?>
     
    
        <h2>Quotes</h2>

        <!-- Add Create Quote button -->
        <div class="mb-3">
            <a href="{{ route('quote.create') }}" class="btn btn-success">Create Quote</a>
        </div>

        <!-- Filter form using a table -->
        <form action="{{ route('quote.showquote') }}" method="get" class="table-responsive">
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
                    <th>Quote Number</th>
                    <th>Reference</th>
                    <th>Contact Name</th>
                    <th>Issue Date</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                    <th>Action</th> <!-- New column for download -->
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($xero['quotes']['Quotes'] as $quote)
                    <!-- Filter by contact name and status -->
                    @if((request('contact_name') && stripos($quote['Contact']['Name'], request('contact_name')) === false) || (request('status') && $quote['Status'] != request('status')))
                        @continue
                    @endif

                    <tr>
                        <td>{{ $quote['QuoteNumber'] }}</td>
                        <td>
                            @if(isset($quote['Reference']))
                                {{ $quote['Reference'] }}
                            @endif
                        </td>
                        <td>{{ $quote['Contact']['Name'] }}</td>
                        <td>
                          @if(isset($quote['DateString']))
                          {{ \Carbon\Carbon::parse($quote['DateString'])->format('d M Y') }}
                           @endif
                            </td>
                        <td>
                         @if(isset($quote['ExpiryDateString']))
                         {{ \Carbon\Carbon::parse($quote['ExpiryDateString'])->format('d M Y') }}
                          @endif
                        </td>
                       
                        <td>
                            @if(isset($quote['Status']))
                                {{ $quote['Status'] }}
                            @endif
                        </td>
                        <td>
                            @if(isset($quote['Total']))
                                {{ $quote['Total'] }}
                            @endif
                        </td>
                        <!-- Add more columns as needed -->
                        <td>
                            <a href="{{ route('quote.edit', ['id' => $quote['QuoteID']]) }}" class="btn btn-primary">Edit</a>
                        </td>
                        
                        <td>
                            <a href="{{ route('xero.getquotepdf', ['token' => $xerotoken['access_token'],'quotenumber' => $quote['QuoteNumber'], 'id' => $quote['QuoteID']]) }}" class="btn btn-primary">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
