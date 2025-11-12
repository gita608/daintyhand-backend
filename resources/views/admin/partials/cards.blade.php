{{-- Reusable Card Styles --}}
@push('styles')
<style>
    .card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 20px;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .card-header h2 {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }
    
    .form-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .card {
            padding: 20px;
            margin-bottom: 15px;
        }
        
        .form-card {
            padding: 20px;
            margin-bottom: 15px;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .card-header h2 {
            font-size: 18px;
        }
    }
    
    @media (max-width: 480px) {
        .card {
            padding: 15px;
        }
        
        .form-card {
            padding: 15px;
        }
        
        .card-header h2 {
            font-size: 16px;
        }
    }
</style>
@endpush

