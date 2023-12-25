@if ($label)
    <label for="{{ $id }}" class="form-label">{!! $label !!}</label>
@endif
@if ($type == 'text')
    <input type="text" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
        @foreach ($attrs as $attrName => $attrVal)
        {{ $attrName }} = {{ $attrVal }} @endforeach />
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
@elseif ($type == 'date')
    <input type="text" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
        class="datepicker form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
        autocomplete="off" @foreach ($attrs as $attrName => $attrVal) {{ $attrName }} = {{ $attrVal }} @endforeach  />
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
@elseif ($type == 'radio')
    <div class="">
        @foreach ($items as $item)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="{{ $name }}"
                    id="{{ $item->name . $loop->index }}" value="{{ $item->value }}"
                    @if ($value == $item->value) checked @endif @if(isset($item->name)) data-value="{{ $item->name }}" @endif
                    @foreach ($attrs as $attrName => $attrVal) {{ $attrName }} = {{ $attrVal }} @endforeach >
                <label class="form-check-label" for="{{ $item->name . $loop->index }}">{{ $item->label() }}</label>
            </div>
        @endforeach
    </div>
@elseif ($type == 'number')
    <input type="number" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, $value) }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
        @foreach ($attrs as $attrName => $attrVal)
        {{ $attrName }} = {{ $attrVal }} @endforeach />
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
@endif
