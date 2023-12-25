@if ($label)
<label for="{{ $id }}" class="form-label {{$labelClass}}">{!!$label !!} </label>
@endif
<div class="@error($name) has-validation @enderror">
    <select class="custom-select form-select {{$class}} @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $id }}"
        @foreach ($attrs as $attrName => $attrVal)
            {{$attrName}} = {{$attrVal}}
        @endforeach>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        @if ($items)
            @foreach($items as $item)
                <option value="{{ $item->value }}" @if (old($name, $value) == $item->value) selected @endif @if(isset($item->name)) data-value="{{ $item->name }}" @endif>{{ $item->label() }}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
    @endif
</div>
