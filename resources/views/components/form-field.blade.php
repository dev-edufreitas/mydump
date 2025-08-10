@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false, 'rows' => null])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    @if($type === 'textarea')
        <textarea 
            id="{{ $name }}" 
            name="{{ $name }}" 
            class="form-input form-textarea"
            @if($rows) rows="{{ $rows }}" @endif
            @if($required) required @endif
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            id="{{ $name }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}"
            class="form-input"
            @if($required) required @endif
            {{ $attributes }}
        />
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
