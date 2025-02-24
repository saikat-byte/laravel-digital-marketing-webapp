@if($section->status == 1)
<!-- Card queue review section start -->
<section class="card-queue-section" id="cardQueueSection">
    <div class="card-container d-flex justify-content-center align-items-center" id="cardContainer">
        @foreach ($reviews as $review)
        <div class="card-item">
            <img src="{{ asset($review->client_image ?? 'assets/image/reviews/default.jpg') }}" alt="{{ $review->client_name }}" class="client-img">
            <h4 class="client-name">{{ $review->client_name }}</h4>
            <p class="client-comment">"{{ $review->client_comment }}"</p>
            <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)
                    <span>⭐</span>
                @else
                    <span>☆</span>
                @endif
            @endfor
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Card queue review section end -->
@endif
