<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-users"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-chalkboard-teacher"></i> Roles</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('package') }}"><i class="nav-icon la la-gift"></i> Packages</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('project') }}"><i class="nav-icon la la-file"></i> Projects</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('maintenance-history') }}"><i class="nav-icon la la-archive"></i> Maintenance histories</a></li>
<li class="nav-item"><a class="nav-link" href="{{  backpack_url('quote')}}"><i class="nav-icon las la-file-invoice"></i> Quotes</a></li>

<!--<li class="nav-item"><a class="nav-link" href="{{ route('invoice.showinvoice') }}"><i class="nav-icon las la-file-invoice-dollar"></i> Invoices</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('reports.showreports') }}"><i class="nav-icon las la-poll"></i> Reports</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('item') }}"><i class="nav-icon la la-question"></i> Items</a></li> -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('contacts') }}"><i class="nav-icon las la-address-book"></i>Manage Contacts</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('xeroitem') }}"><i class="nav-icon las la-tag"></i>Manage Items</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('xerotoken') }}"><i class="nav-icon la la-question"></i> Xerotokens</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('invoice') }}"><i class="nav-icon la la-file-invoice"></i> Invoices</a></li>