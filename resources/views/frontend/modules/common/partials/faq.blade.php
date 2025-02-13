@if($section->status == 1)

<div class="faq-section container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h3 class="text-center mb-4">{{ $section->heading }}</h3>
            <div class="accordion">
                <!-- FAQ Item 1 -->
                <div class="accordion">
                    @foreach($section->config as $question => $answer)
                        <div class="accordion-item">
                            <div class="accordion-header" id="faq{{ $loop->iteration }}">
                                <button class="accordion-toggle" type="button">
                                    {{ $question }}
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </div>
                            <div class="accordion-content">
                                <p>{{ $answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endif
