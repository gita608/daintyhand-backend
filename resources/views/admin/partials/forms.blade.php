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
        color: #333;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #667eea;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    .info-row {
        margin-bottom: 15px;
    }
    
    .info-row strong {
        display: inline-block;
        width: 150px;
        color: #333;
    }
</style>
@endpush

