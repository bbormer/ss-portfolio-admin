<div>
    @foreach($galleries as $gallery)
        <p class="mb-4">
            {{ $gallery->getAttribute('title-ja') }}
        </p>
        <p class="mb-4">
            {!! $gallery->getAttribute('details-ja') !!}<br>
        </p>
        <p class="mb-4">
            {!! $gallery->getAttribute('desc-ja') !!}<br>
        </p>
        <img src="{{ asset('storage/' . $gallery->getAttribute('image')) }}"

    @endforeach
</div>
