@php
    $data = $this->form->getRawState();
    // dd($data['image']);
    $image = $data['image'];
    if($image == null) {
      echo "no image set";
    } else {
      $image = $image[array_key_first($image)];
    }
@endphp

TESTING!!!<br>
{{-- {!! $image->temporaryUrl() !!} --}}
{{-- <img src="{{ $image->temporaryUrl() }}"> --}}
{{ is_string($image) }}
<hr>
{!! $data['desc-ja'] !!}
{!! $data['desc-en'] !!}