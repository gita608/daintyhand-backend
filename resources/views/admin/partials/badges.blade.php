{{-- Reusable Badge Styles --}}
@push('styles')
<style>
    .badge {
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    
    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }
    
    .badge-processing {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .badge-completed {
        background: #d1fae5;
        color: #065f46;
    }
    
    .badge-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .badge-paid {
        background: #d1fae5;
        color: #065f46;
    }
    
    .badge-unpaid {
        background: #fef3c7;
        color: #92400e;
    }
    
    .badge-unread {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .badge-admin {
        background: #d4edda;
        color: #155724;
    }
    
    .badge-in_progress {
        background: #cfe2ff;
        color: #084298;
    }
</style>
@endpush

