@extends('layouts.email.master')

@section('subject-title')
Maintenance Hour Deduction Notification
@endsection

@section('content')
<p>
    Hi, <b>{{ $name }}</b>!
</p>

<p>
    Your maintenance hour of the project <b>{{ $project_name }}</b> only remain <b>{{ $maintenance_hour }}</b>

    @if( !empty($maintenance_remark))
    due to <b>{{ $maintenance_remark }}</b>
    @endif

    on <b>{{ \Carbon\Carbon::parse($maintenance_created_at)->format('d-m-Y') }}</b>

    <br /><br /><br />
    Thank You
</p>

<p>
</p>
@endsection