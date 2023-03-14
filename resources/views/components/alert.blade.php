@if (session($type))
    <div class="alert alert-{{ $color}}">
        {{ session($type) }}
    </div>
@endif
