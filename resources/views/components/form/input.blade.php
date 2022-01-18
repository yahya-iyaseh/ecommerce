    @props([
        'type' => 'text',
        'title',
        'name',
        'value',
        'required' => false,
        'label'

    ])


    <x-form.label :title="$title" :required="$required" />
    <input {{ $attributes }} type="{{ $type }}" class="form-control @error('{{ $name }}') is-invalid @enderror" placeholder="{{ $title }}" id="{{ $name }}" name="{{ $name }}" value="{{ old( $name ,$value) }}" required>
    @error($name )
      <span class="d-block invalid-feedback">{{ $message }}</span>
    @enderror
