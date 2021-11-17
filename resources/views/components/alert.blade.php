<div class="mb-3 alert alert-{{ $position }} alert-{{ $type }} alert-dismissible fade show" role="alert">
    @if(isset($message))
        <span> {{ $message }}</span>
    @endif
    {{ $slot }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
