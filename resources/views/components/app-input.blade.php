{{-- 
Tham số đầu vào:
    id
    name
    label
    type (mặc định là text)
    value (mặc định là rỗng)
    required (nếu có thì input sẽ bắt buộc nhập)
--}}
@php
$_name = $attributes['name'] ?? '';
$_id = $attributes['id'] ?? $_name;
$_type = $attributes['type'] ?? 'text';
$_placeholder = $attributes['placeholder'] ?? '';
$_label = $attributes['label'];
$_old_value = old($_name);
$_value = $attributes['value'] ?? '';
$_value = empty($_old_value) ? $_value : $_old_value;
$_isrequired = isset($attributes['required']) ? "required" : '';
$_element = $element??'';
@endphp

<div class="mb-3">
    <label for="{{ $_id }}" class="form-label"> {{ $_label }} {{ $_element }}  </label>
    <input id="{{ $_id }}" name="{{ $_name }}" value="{{ $_value }}" type="{{ $_type }}" placeholder="{{ $_placeholder }}" {{$_isrequired}}
        class="form-control @error($_name) is-invalid @enderror">
    @error($_name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>