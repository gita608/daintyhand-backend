{{-- Reusable Table Styles --}}
@push('styles')
<style>
    table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    
    th {
        background: #f8f9fa;
        font-weight: 600;
    }
    
    tbody tr {
        transition: background 0.2s;
    }
    
    tbody tr:hover {
        background: #f9fafb;
    }
    
    tbody tr:last-child td {
        border-bottom: none;
    }
</style>
@endpush

