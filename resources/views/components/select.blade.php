@props([
    'label',
    'name',
    'defaultValue' => '' ,
    'options'   
])

<div>
        {{ $label }}
        <select name="{{$name}}" id="">
            
        </select>
        <input name="{{ $name }}" type="text" value="{{$errors->any() ? old($name) : $defaultValue}}">
        @error($name)
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>