{{-- Reusable Button Styles --}}
@push('styles')
<style>
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        transition: all 0.3s;
        font-weight: 500;
    }
    
    .btn-primary {
        background: #667eea;
        color: white;
    }
    
    .btn-primary:hover {
        background: #5568d3;
    }
    
    .btn-edit {
        background: #667eea;
        color: white;
    }
    
    .btn-edit:hover {
        background: #5568d3;
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }
    
    .btn-delete:hover {
        background: #c82333;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
</style>
@endpush

