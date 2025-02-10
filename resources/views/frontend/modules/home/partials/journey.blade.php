@if(!empty($journey))
<section class="journey-section">
    <div class="container text-center">
        <h2 class="section-title text-white mb-3">{{ $journey['title'] ?? 'Begin Your Journey to Success Today' }}</h2>
        <p class="section-subtitle mb-5">{{ $journey['subtitle'] ?? "Here's the information you have been searching for" }}</p>

        @php
            // কার্ডগুলোর JSON ডাটা আলাদাভাবে একত্রিত করে অ্যারে বানানো হচ্ছে
            $cards = [];
            foreach($journey as $key => $value) {
                if(strpos($key, 'card_') === 0) { // শুধুমাত্র "card_" দিয়ে শুরু হওয়া ডাটা নেবে
                    $decodedCard = json_decode($value, true);
                    if ($decodedCard) {
                        $cards[] = $decodedCard;
                    }
                }
            }
        @endphp


        <div class="row d-flex justify-content-center">
            @if(count($cards) > 0)
                @foreach($cards as $index => $card)
                    <div class="col-md-3 p-0">
                        <div class="journey-card">
                            <div class="card-image">
                                <img src="{{ asset('storage/'. ($card['image'] ?? 'default-image.jpg')) }}"
                                     alt="{{ $card['title'] ?? 'Default Title' }}">
                                <div class="overlay pe-3">
                                    <div class="journey-card-number text-end">{{ $index + 1 }}</div>
                                    <h3 class="overlay-title text-end">{{ $card['title'] ?? '' }}</h3>
                                    <p class="overlay-text text-end">{{ $card['description'] ?? '' }}</p>
                                    <a href="{{ url($card['button_link'] ?? '#') }}"
                                       class="gradient-glow-button journey-card-btn">
                                        {{ $card['button_text'] ?? 'Get Service' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-white">No journey cards found.</p>
            @endif
        </div>
    </div>
</section>
@endif
