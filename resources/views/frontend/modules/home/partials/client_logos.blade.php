@if(!empty($client_logos['logos']))
<section class="client-logo-section bg-white">
    <div class="container">
        <div class="client-logo-slider">
            @foreach(json_decode($client_logos['logos'], true) as $logo)
            <div class="logo-item">
                <img src="{{ asset('storage/'. $logo) }}" alt="Client Logo" class="img-fluid">
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
