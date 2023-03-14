@props(['type' => 'text','name','value'=> '','label'=> false])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

<input type="{{ $type }}"
    name="{{ $name }}"
    class="form-control @error('name') is-invalid @enderror"
    value="{{old($name,$value)  }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid' => $errors->has('name'),
        'p-0' => $name == 'tags'
    ]) }}
>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
