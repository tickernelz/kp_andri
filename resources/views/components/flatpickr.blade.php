<div class="form-group">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <div class="input-group {{ $form }}">
        <input class="form-control flatpickr {{ $classes }} @error($name) is-invalid @enderror"
               value="{{ old($name) ?? $value }}" name="{{ $name }}" placeholder="Masukkan {{ $label }}..."
               id="{{ $name }}"
               type="text">
        <span class="input-group-text">
        <i class="fa fa-calendar"></i>
    </span>
    </div>
    @error($name)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
