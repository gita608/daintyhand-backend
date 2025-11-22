{{-- Reusable Form Styles --}}
@push('styles')
<style>
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: var(--text-main);
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
        background: var(--bg-surface);
        color: var(--text-main);
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .info-row {
        margin-bottom: 15px;
        color: var(--text-main);
    }
    
    .info-row strong {
        display: inline-block;
        width: 150px;
        color: var(--text-main);
    }
    
    .form-group input[type="file"] {
        padding: 12px;
        border: 2px dashed var(--border-color);
        background: var(--bg-body);
        cursor: pointer;
    }
    
    .form-group input[type="file"]:focus {
        border-color: var(--primary);
        background: var(--bg-surface);
    }
    
    @media (max-width: 768px) {
        .form-group {
            margin-bottom: 16px;
        }
        
        .form-group label {
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 12px;
            font-size: 16px; /* Prevents zoom on iOS */
            min-height: 44px;
            border-width: 2px;
        }
        
        .form-group input[type="file"] {
            padding: 16px;
            min-height: 60px;
        }
        
        .form-group textarea {
            min-height: 120px;
        }
        
        .info-row strong {
            width: 120px;
            font-size: 14px;
        }
        
        .info-row {
            margin-bottom: 14px;
            font-size: 14px;
            line-height: 1.6;
        }
    }
    
    @media (max-width: 480px) {
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-group label {
            font-size: 13px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 14px;
            font-size: 16px;
            min-height: 48px;
        }
        
        .form-group input[type="file"] {
            padding: 18px;
            min-height: 64px;
        }
        
        .form-group textarea {
            min-height: 140px;
        }
        
        .info-row {
            margin-bottom: 16px;
        }
        
        .info-row strong {
            width: 100%;
            font-size: 13px;
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        
        .info-row {
            font-size: 14px;
        }
    }
</style>
@endpush

