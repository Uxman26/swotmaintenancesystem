@extends(backpack_view('blank'))

@php
    $count_users = \App\Models\User::count();
    $count_projects = \App\Models\Project::count();
@endphp

@section('content')
<?php
$xero = session('xero');
$xeroTokens = session('xero_tokens');

// Check if the refresh token exists in the database
$userId = backpack_user()->id; // Adjust as needed based on your authentication setup
$existingToken = \App\Models\XeroToken::where('user_id', $userId)->first();

if (
    !$existingToken ||
    !$existingToken->refresh_token ||
    (isset($existingToken->expired_on) && now() > $existingToken->expired_on)
) {
    // Redirect to the Xero authentication page
    echo '<script>window.location.href = "' . route('xero.authenticate') . '";</script>';
    // Optionally, you can include a noscript fallback for users with JavaScript disabled
    echo '<noscript><meta http-equiv="refresh" content="0;url=' . route('xero.authenticate') . '"></noscript>';
    // Make sure to exit the script to prevent further execution
    exit;
}
?>
 <h3 class="mb-3"> Dashboard </h3>
    <div class="row">

        <div class="col-sm-6 col-md-4">
            <a class="text-decoration-none" href="{{ backpack_url('user') }}">
                <div class="card bg-info text-white">
                    <div class="card-header">Users</div>
                    <div class="card-body">{{ $count_users }}</div>
                </div>
            </a>

        </div>


        <div class="col-sm-6 col-md-4">
            <a class="text-decoration-none" href="{{ backpack_url('project') }}">
                <div class="card bg-secondary text-dark">
                    <div class="card-header">Projects</div>
                    <div class="card-body">{{ $count_projects }}</div>
                </div>
            </a>
        </div>

    </div>
@endsection
