@props(['name', 'value' => null, 'required' => false, 'title' => null])

@if($title )
<label for="{{ $name }}">{{ $title }}</label>
@endif
<select name="{{ $name }}" id="{{ $name }}" class="form-control @error('{{ $name }}') is-invalid @enderror" @if($required) required @endif>
  <option value="">Select Country</option>

  @foreach (Symfony\Component\Intl\Countries::getNames() as $code => $country)
    <option value="{{ $code }}" @if ($code == old($name , $value)) selected @endif>{{ $country }}</option>
  @endforeach
</select>
@error($name )
  <span class="d-block invalid-feedback"><strong>{{ $message }}</strong></span>
@enderror
