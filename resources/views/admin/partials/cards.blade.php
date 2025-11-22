{{-- Reusable Card Styles --}}
@push('styles')
<style>
    .card {
        background: var(--bg-surface);
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 20px;
        border: 1px solid var(--border-color);
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }
    
    .card-header h2 {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-main);
        margin: 0;
    }
    
    .form-card {
        background: var(--bg-surface);
        padding: 25px;
        border-radius: 10px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 20px;
        border: 1px solid var(--border-color);
    }
    
    @media (max-width: 768px) {
        .card {
            padding: 18px;
            margin-bottom: 12px;
            border-radius: 10px;
        }
        
        .form-card {
            padding: 18px;
            margin-bottom: 12px;
            border-radius: 10px;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 12px;
        }
        
        .card-header h2 {
            font-size: 18px;
            line-height: 1.4;
        }
        
        .card-header a {
            font-size: 14px;
            padding: 8px 14px;
            min-height: 40px;
        }
    }
    
    @media (max-width: 480px) {
        .card {
            padding: 14px;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        
        .form-card {
            padding: 14px;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        
        .card-header {
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 10px;
        }
        
        .card-header h2 {
            font-size: 16px;
        }
        
        .card-header a {
            width: 100%;
            text-align: center;
            padding: 10px;
            min-height: 44px;
        }
    }
</style>
@endpush

