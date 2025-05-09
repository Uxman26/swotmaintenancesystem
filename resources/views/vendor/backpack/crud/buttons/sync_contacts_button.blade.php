{{-- <a href="{{ url('admin/contacts/sync') }}" 
   class="btn btn-primary" 
   style="margin-left: 10px;"
   onclick="return confirm('Sync contacts between app and Xero?')">
    🔄 Sync
</a> --}}


<!-- Sync from Maintenance System to Xero -->
<a href="{{ url('admin/contacts/sync-from-app') }}" 
   class="btn btn-primary" 
   style="margin-left: 10px;"
   onclick="return confirm('Sync contacts from the Maintenance System to Xero?')">
    🔄 Sync from App to Xero
</a>

<!-- Sync from Xero to Maintenance System -->
<a href="{{ url('admin/contacts/sync-from-xero') }}" 
   class="btn btn-primary" 
   style="margin-left: 10px;"
   onclick="return confirm('Sync contacts from Xero to the Maintenance System?')">
    🔄 Sync from Xero to App
</a>
