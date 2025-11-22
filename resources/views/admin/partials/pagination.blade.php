@if(isset($paginator) && $paginator->total() > 0)
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing {{ $paginator->firstItem() ?? 0 }} to {{ $paginator->lastItem() ?? 0 }} of {{ $paginator->total() }} results
        </div>
        @if($paginator->hasPages())
            <div class="pagination-links">
                {{ $paginator->links() }}
            </div>
        @endif
    </div>
@endif

<style>
    .pagination-wrapper {
        margin-top: 30px;
        padding: 20px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .pagination-info {
        color: #6b7280;
        font-size: 14px;
    }
    
    .pagination-links {
        display: flex;
        gap: 5px;
    }
    
    .pagination-links nav {
        display: flex;
        gap: 5px;
    }
    
    .pagination-links nav > div {
        display: flex;
        gap: 5px;
    }
    
    .pagination-links a,
    .pagination-links span {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        text-decoration: none;
        color: #374151;
        font-size: 14px;
        transition: all 0.2s;
        background: white;
    }
    
    .pagination-links a:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
    }
    
    .pagination-links span[aria-current="page"] {
        background: #667eea;
        color: white;
        border-color: #667eea;
        font-weight: 600;
    }
    
    .pagination-links span:not([aria-current="page"]) {
        color: #9ca3af;
        cursor: not-allowed;
    }
    
    @media (max-width: 768px) {
        .pagination-wrapper {
            flex-direction: column;
            align-items: stretch;
            padding: 15px 0;
        }
        
        .pagination-info {
            text-align: center;
            margin-bottom: 10px;
            font-size: 12px;
        }
        
        .pagination-links {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .pagination-links a,
        .pagination-links span {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 480px) {
        .pagination-wrapper {
            padding: 12px 0;
        }
        
        .pagination-info {
            font-size: 11px;
            margin-bottom: 12px;
        }
        
        .pagination-links {
            width: 100%;
            justify-content: center;
        }
        
        .pagination-links a,
        .pagination-links span {
            padding: 8px 10px;
            font-size: 12px;
            min-width: 40px;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    }
</style>

