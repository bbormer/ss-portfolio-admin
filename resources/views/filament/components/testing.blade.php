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


{{-- {!! $image->temporaryUrl() !!} --}}
{{-- <img src="{{ $image->temporaryUrl() }}"> --}}
<div x-data class="flex flex-row flex-wrap justify-around items-start max-w-screen-lg  mx-auto mt-12">
  <figure class="mx-auto">
    <img src="{{ $image->temporaryUrl() }}" />
  </figure>
    <div class="flex items-center justify-items-center text-center">
    {{-- <div class="hero-content text-center text-neutral-content"> --}}
      <div class="max-w-xl font-[300] text-xl font-ja">
        <h1 class="my-5 leading-[3.75rem] text-4xl font-xl text-gray-500 dark:text-gray-400">
          {!! $data['title-ja'] != '' ? $data['title-ja'] : 'title missing' !!}
        </h1>
        <div class="mb-10 text-xl text-gray-700 dark:text-gray-400">
          {!! $data['details-ja'] ? $data['details-ja'] : 'details missing' !!}
        </div>
        <div class="mt-5 text-left text-xl text-gray-700 dark:text-gray-400">{!! $data['desc-ja'] !!}</div>
        @if($data['availability'] == 0)
          <p class="text-xl font-bold mt-10 !text-red-600 ">SOLD</p>
        @endif
        <div class="mb-10"> </div>
      </div>
    </div>
    
{{ is_string($image) }}
