<label {!! $field->attributes($field->getOption('label_attr')) !!}>{{ $field->getOption('label') }}</label>
@php
    $name = $field->getOption('multiple') ? $field->getName().'[]' : $field->getName();
@endphp
<select name="{{ $name }}" id="{{ $field->getAttribute('id') }}" {!! $field->attributes($field->getAttributes()) !!}>
    @foreach($field->getOption('choices')->format()->get() as $group => $choices)
        @if(is_array($choices))
            <optgroup label="{{ $group }}">
                @foreach($choices as $label => $choice)
                    <?php
                        $selected = $field->selected(function ($option, $value) {
                            $values = (array) $value;

                            return ! empty($values) && in_array($option, $values) ? 'selected="selected"' : '';
                        }, [$choice, $field->getRawValue()]);
                    ?>
                    <option value="{{ $choice }}" {!! $selected !!}>{{ $label }}</option>
                @endforeach
            </optgroup>
        @else
            <?php
                $selected = $field->selected(function ($option, $value) {
                    $values = (array) $value;

                    return ! empty($values) && in_array($option, $values) ? 'selected="selected"' : '';
                }, [$choices, $field->getRawValue()]);
                    ?>
            <option value="{{ $choices }}" {!! $selected !!}>{{ $group }}</option>
        @endif
    @endforeach
</select>