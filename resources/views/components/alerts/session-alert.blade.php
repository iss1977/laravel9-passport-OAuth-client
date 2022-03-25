@if (count($alerts))  {{-- Create the div only if there are elements in the array --}}
    <div>
        @foreach ($alerts as $alertType => $alerMessage)
            <div class="alert alert-{{$alertType}} alert-dismissible fade show" role="alert">
                {{ $alerMessage }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    </div>
@endif
