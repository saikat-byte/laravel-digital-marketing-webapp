@php
$contactFormDetails = $contactFormRight['config'] ?? [];
@endphp
<div class="col-lg-6 right-col d-flex flex-column justify-content-center">
    <!-- Heading & Sub Heading -->
    <h2 class="fw-bold mb-3">{{ $contactFormRight->heading }}</h2>
    <h5 class="mb-3">{{ $contactFormRight->sub_heading }}</h5>

    <!-- Paragraph -->
    <p class="">
        {{ $contactFormRight->paragraph }}
    </p>

    <!-- Three Part Section with Divider Lines -->
    <div class="three-part row mt-4">
        @foreach($contactFormDetails as $key => $value)
        <div class="col-3 text-start">
            <div class="part-title text-uppercase">{{ $key }}</div>
            <div class="part-subtitle fw-bold">{{ $value }}</div>
        </div>
        @if(!$loop->last)
        <div class="col-1 d-flex align-items-center">
            <div class="divider"></div>
        </div>
        @endif
        @endforeach
    </div>
</div>
