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
    
    @media (max-width: 768px) {
        .btn {
            padding: 10px 16px;
            font-size: 14px;
            min-height: 44px;
            min-width: 44px;
        }
        
        .btn-sm {
            padding: 8px 12px;
            font-size: 13px;
            min-height: 40px;
        }
    }
    
    @media (max-width: 480px) {
        .btn {
            padding: 12px 16px;
            font-size: 14px;
            width: 100%;
            justify-content: center;
        }
        
        .btn-sm {
            padding: 10px 14px;
            font-size: 13px;
            min-height: 42px;
        }
        
        .mobile-card-actions .btn {
            flex: 1;
            min-width: 0;
        }
    }
</style>
@endpush

