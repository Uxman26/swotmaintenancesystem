<!-- sync_all_button.blade.php -->
<a href="{{ route('admin.invoices.sync_all') }}" 
   class="btn btn-primary" 
   onclick="return confirm('Sync all invoices between App and Xero?')">
    🔄 Sync All Invoices
</a>
