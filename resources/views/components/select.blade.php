<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<select id="{{ $name }}" name="{{ $name }}" class="selectpicker form-control {{ $classes }} @error($name) is-invalid @enderror" data-style="py-0">
    {{ $slot }}
</select>
