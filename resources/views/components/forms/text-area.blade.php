@if ($label)
<label for="{{ $id }}" class="form-label">{!! $label !!}</label>
@endif
<div class="@error($name) has-validation @enderror">
    <textarea name="{{ $name }}" id="{{ $id }}" class="form-control {{$class}} @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
    @foreach ($attrs as $attrName => $attrVal)
        {{$attrName}} = {{$attrVal}}
    @endforeach
    >{!! old($name, $value) !!}</textarea>
    @if ($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
    @endif
</div>
