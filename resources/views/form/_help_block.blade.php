@if($errors->has($field))
    <span class="help-block">{{$errors->first($field)}}</span>
@endif