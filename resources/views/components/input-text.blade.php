<div class="form-group {{ $form }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $classes }} @error($name) is-invalid @enderror"
           id="{{ $name }}"
           aria-describedby="{{ $name }}" value="{{ old($name) ?? $value }}">
    {{ $slot }}
</div>
