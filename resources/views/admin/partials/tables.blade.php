{{-- Reusable Table Styles --}}
@push('styles')
<style>
    /* Modern Table Styles */
    .table-wrapper {
        background: var(--bg-surface);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 24px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th {
        background: #f8fafc;
        padding: 12px 24px;
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid var(--border-color);
    }

    td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-size: 14px;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: #f8fafc;
    }

    /* Images in tables */
    td img {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
        background: #f1f5f9;
    }

    /* Action Buttons - Inherits from buttons.blade.php */
    
    /* Mobile Card View */
    .table-mobile-card {
        display: none;
    }

    @media (max-width: 768px) {
        .table-wrapper {
            display: none;
        }

        .table-mobile-card {
            display: block;
        }

        .mobile-card {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .mobile-card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-card-row:last-child {
            border-bottom: none;
        }

        .mobile-card-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .mobile-card-value {
            font-size: 14px;
            color: var(--text-main);
            text-align: right;
        }

        .mobile-card-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 12px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }
        
        /* Override width: 100% from buttons.blade.php for grid items */
        .mobile-card-actions .btn {
            width: auto; 
            justify-content: center;
        }
    }
    /* Dark Mode Overrides for Tables */
    .dark th {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark tr:hover td {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark td img {
        background: rgba(255, 255, 255, 0.1);
    }

    @media (max-width: 480px) {
        .mobile-card-value {
            word-break: break-word;
        }
    }
</style>
@endpush

