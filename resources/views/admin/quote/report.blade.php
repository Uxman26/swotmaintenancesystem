<!-- resources/views/admin/invoice.blade.php -->
@extends(backpack_view('blank'))

@section('content')

    <div class="container">
        <?php $xero = session('xero');
        $xerotoken = session('xero_tokens');
        
        ?>
    
        <h2>Get Contacts Report</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Receivable Balance</th>
                    
                    <th>Status</th>
                    <th>Action</th> <!-- New column for action -->
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($xero['contacts'] as $contact)
                    <tr>
                        <td>{{ $contact['Name'] }}</td>
                      
                        <td>{{ $contact['FirstName'] }}</td>
                        
                        <td>{{ $contact['LastName'] }}</td>
                        
                        <td>{{ $contact['EmailAddress'] }}</td>
                        
                        <td>{{ $contact['Balances']['AccountsReceivable']['Outstanding'] }}</td>
                   
                        <td>{{ $contact['ContactStatus'] }}</td>
                    
                        
                      <td>
                            <a href="{{ route('xero.getreport', ['token' => $xerotoken['access_token'], 'id' => $contact['ContactID']]) }}" class="btn btn-primary">Get Report</a>
                         </td>
                        

                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
