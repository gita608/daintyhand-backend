{{-- Reusable Table Styles --}}
@push('styles')
<style>
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 20px;
    }
    
    table {
        width: 100%;
        background: white;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        min-width: 600px;
    }
    
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    
    th {
        background: #f8f9fa;
        font-weight: 600;
        white-space: nowrap;
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
    
    /* Mobile Card View for Tables */
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
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .mobile-card-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        
        .mobile-card-row:last-child {
            border-bottom: none;
        }
        
        .mobile-card-label {
            font-weight: 600;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
            min-width: 100px;
        }
        
        .mobile-card-value {
            color: #111827;
            text-align: right;
            flex: 1;
        }
        
        .mobile-card-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f3f4f6;
            flex-wrap: wrap;
        }
        
        .mobile-card-actions .btn {
            flex: 1;
            min-width: 80px;
            text-align: center;
        }
    }
    
    @media (max-width: 480px) {
        th, td {
            padding: 10px 8px;
            font-size: 13px;
        }
        
        .mobile-card {
            padding: 12px;
        }
        
        .mobile-card-label {
            font-size: 11px;
            min-width: 80px;
        }
    }
</style>
@endpush

