{{-- Reusable Button Styles --}}
@push('styles')
<style>
    .btn {
        padding: 10px 20px;
        border: 1px solid transparent;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.01em;
        box-shadow: var(--shadow-sm);
    }
    
    .btn:active {
        transform: scale(0.98);
    }
    
    /* Primary Button */
    .btn-primary {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
    }
    
    .btn-primary:hover {
        background: var(--primary-hover);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.15);
        transform: translateY(-1px);
    }
    
    /* Edit Button (Secondary) */
    .btn-edit {
        background: white;
        color: var(--text-main);
        border-color: var(--border-color);
        box-shadow: var(--shadow-sm);
    }
    
    .btn-edit:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: var(--primary);
    }
    
    .dark .btn-edit {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-main);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .dark .btn-edit:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.2);
    }
    
    /* Delete Button (Danger) */
    .btn-delete {
        background: #fef2f2;
        color: var(--danger);
        border: 1px solid #fecaca;
    }
    
    .btn-delete:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #b91c1c;
    }
    
    .dark .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        border-color: rgba(239, 68, 68, 0.2);
    }
    
    .dark .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
        color: #fecaca;
    }
    
    /* Small Button */
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 8px;
    }
    
    @media (max-width: 768px) {
        .btn {
            width: 100%;
            padding: 12px;
        }
        
        .btn-sm {
            padding: 8px 12px;
            width: auto;
        }
    }
</style>
@endpush

