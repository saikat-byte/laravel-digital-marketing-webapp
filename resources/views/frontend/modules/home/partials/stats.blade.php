@php
    $stats = $section['settings']['stats'] ?? [];
@endphp

@if(!empty($stats))
    <section class="stats-section bg-white">
        <div class="container">
            <div class="row text-center">
                @foreach($stats as $stat)
                    <div class="col-md-3">
                        <div class="stat-card">
                            <h3 class="text-primary">{{ $stat['value'] ?? 'N/A' }}</h3>
                            <p class="text-primary">{{ $stat['label'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
