<div class="form-group{{$errors->has($field)?' has-error':''}}">
    {{ $slot }}
    @include('form._help_block',['field' => $field])
</div>