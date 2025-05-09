<!-- sync_to_xero_button.blade.php -->
<a href="{{ url('admin/contacts/sync-to-xero/' . $entry->id) }}" 
    class="btn" 
    onclick="return confirm('Sync this contact with Xero?')">
     🔄 Sync with Xero
 </a>
 