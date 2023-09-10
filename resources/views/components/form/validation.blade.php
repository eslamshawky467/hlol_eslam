@props(['name'=>'hlol'])
@if ($errors->has($name))
    <span class="text-danger">{{ $errors->first($name) }}</span>
@endif
