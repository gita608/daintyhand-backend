@push('styles')
<style>
    .filters-container {
        background: var(--bg-surface);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }
    
    .filters-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .filters-header h3 {
        margin: 0;
        font-size: 16px;
        color: var(--text-main);
        font-weight: 600;
    }
    
    .filters-toggle {
        background: var(--bg-body);
        border: 1px solid var(--border-color);
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        color: var(--text-main);
        transition: all 0.2s;
    }
    
    .filters-toggle:hover {
        background: var(--border-color);
    }
    
    .filters-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }
    
    .filters-form.hidden {
        display: none;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 0; /* Prevent grid overflow */
    }
    
    .filter-group label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .filter-group input,
    .filter-group select {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 14px;
        color: var(--text-main);
        background: var(--bg-surface);
        transition: border-color 0.2s;
        width: 100%;
        box-sizing: border-box;
    }
    
    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }
    
    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: end;
    }
    
    .btn-filter {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .btn-filter-apply {
        background: var(--primary);
        color: white;
    }
    
    .btn-filter-apply:hover {
        background: var(--primary-hover);
    }
    
    .btn-filter-reset {
        background: var(--bg-body);
        color: var(--text-main);
        border: 1px solid var(--border-color);
    }
    
    .btn-filter-reset:hover {
        background: var(--border-color);
    }
    
    @media (max-width: 768px) {
        .filters-container {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        
        .filters-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .filters-header h3 {
            font-size: 14px;
        }
        
        .filters-toggle {
            padding: 6px 10px;
            font-size: 12px;
        }
        
        .filters-form {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .filter-group label {
            font-size: 11px;
        }
        
        .filter-group input,
        .filter-group select {
            padding: 10px;
            font-size: 16px; /* Prevents zoom on iOS */
            width: 100%;
        }
        
        .filter-actions {
            width: 100%;
            flex-direction: column;
            gap: 8px;
        }
        
        .btn-filter {
            width: 100%;
            padding: 10px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 480px) {
        .filters-container {
            padding: 14px;
            margin-bottom: 12px;
        }
        
        .filters-header {
            margin-bottom: 10px;
        }
        
        .filters-header h3 {
            font-size: 14px;
        }
        
        .filters-toggle {
            padding: 8px 12px;
            font-size: 12px;
            min-height: 40px;
        }
        
        .filters-form {
            gap: 14px;
        }
        
        .filter-group {
            margin-bottom: 0;
        }
        
        .filter-group label {
            font-size: 11px;
            margin-bottom: 8px;
        }
        
        .filter-group input,
        .filter-group select {
            padding: 12px;
            font-size: 16px;
            min-height: 48px;
        }
        
        .filter-actions {
            margin-top: 8px;
        }
        
        .btn-filter {
            padding: 12px 16px;
            font-size: 14px;
            min-height: 48px;
        }
    }
</style>
@endpush

<div class="filters-container">
    <div class="filters-header">
        <h3>🔍 Filters</h3>
        <button type="button" class="filters-toggle" onclick="toggleFilters()">
            <span id="filters-toggle-text">Hide Filters</span>
        </button>
    </div>
    
    <form method="GET" action="{{ request()->url() }}" class="filters-form" id="filters-form">
        @if(isset($filterFields))
            @foreach($filterFields as $field)
                @if($field['type'] === 'text' || $field['type'] === 'search')
                    <div class="filter-group">
                        <label for="filter_{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <input 
                            type="{{ $field['type'] }}" 
                            id="filter_{{ $field['name'] }}" 
                            name="{{ $field['name'] }}" 
                            value="{{ request($field['name']) }}" 
                            placeholder="{{ $field['placeholder'] ?? '' }}"
                        >
                    </div>
                @elseif($field['type'] === 'select')
                    <div class="filter-group">
                        <label for="filter_{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <select id="filter_{{ $field['name'] }}" name="{{ $field['name'] }}">
                            @if(isset($field['options']))
                                @foreach($field['options'] as $value => $label)
                                    <option value="{{ $value }}" {{ request($field['name']) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                @elseif($field['type'] === 'date')
                    <div class="filter-group">
                        <label for="filter_{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <input 
                            type="date" 
                            id="filter_{{ $field['name'] }}" 
                            name="{{ $field['name'] }}" 
                            value="{{ request($field['name']) }}"
                        >
                    </div>
                @endif
            @endforeach
        @endif
        
        <!-- Preserve per_page if set -->
        @if(request('per_page'))
            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
        @endif
        
        <div class="filter-actions">
            <button type="submit" class="btn-filter btn-filter-apply">Apply Filters</button>
            <a href="{{ request()->url() }}" class="btn-filter btn-filter-reset" style="text-decoration: none; text-align: center;">Reset</a>
        </div>
    </form>
</div>

<script>
    function toggleFilters() {
        const form = document.getElementById('filters-form');
        const toggleText = document.getElementById('filters-toggle-text');
        
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            toggleText.textContent = 'Hide Filters';
        } else {
            form.classList.add('hidden');
            toggleText.textContent = 'Show Filters';
        }
    }
    
    // Check if any filters are applied, if not, hide by default
    @if(!request()->hasAny(['search', 'status', 'payment_status', 'is_read', 'stock_status', 'category', 'date_from', 'date_to']))
        document.addEventListener('DOMContentLoaded', function() {
            toggleFilters();
        });
    @endif
</script>

