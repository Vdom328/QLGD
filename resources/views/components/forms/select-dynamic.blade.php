@if ($label)
<label for="{{ $id }}" class="form-label">{!! $label !!}</label>
@endif
<div class="flex-grow-1 @error($name) has-validation @enderror">
    <select class="custom-select form-select {{$class}} @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $id }}"
        @foreach ($attrs as $attrName => $attrVal)
            {{$attrName}} = {{$attrVal}}
        @endforeach>
        @if ($isCanEmptyVal)
            <option value="">Vui lòng chọn</option>
        @endif
        @if ($items)
            @foreach($items as $key => $item)
                <option value="{{ $key }}" @if (old($name, $value) == $key) selected @endif >{{ $item }}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
    @endif
</div>
