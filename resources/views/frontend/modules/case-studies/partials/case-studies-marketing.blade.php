<!-- Marketing section Start -->
<section class="container-fluid">
    <div class="row">
        <!-- Left 4 columns (Gradient + Logos) -->
        <div class="col-lg-4 gradient-col text-white text-end d-flex flex-column p-4">
            <div class="left-side">
                @if($section->multi_image && is_array($section->multi_image))
                @foreach($section->multi_image as $image)
                <div class="mb-4 logo-item text-start">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $section->heading }}">
                    <hr class="white-separator">
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Right 8 columns (Heading, Text, Image, Buttons) -->
        <div class="col-lg-8 content-col p-4">
            <!-- Heading Triangle icon -->
            <div class="right-side">
                <div class="d-flex align-items-center mb-3">
                    <div class="triangle-icon me-2"></div>
                    <h2 class="mb-0" style="color: #144a9b;">
                        {{ $section->heading }}
                    </h2>
                </div>

                <!-- Paragraph 1 -->
                <p>
                    {{ $section->paragraph }}
                </p>

                <!-- Image -->
                <div class="text-center my-3">
                    <img src="{{ asset('storage/' . $section->image) }}" alt="Digital Marketing" class="img-fluid content-image">
                </div>

                <!-- Paragraph 2 -->
                <p>
                    {{ $section->sub_heading }}
                </p>

                <!-- Buttons -->
                <div class="mt-4">
                    <a class="gradient-glow-button gradient-btn me-2 text-uppercase">
                        {{ $section->button_1_text }}
                    </a>
                    <a class="gradient-glow-button gradient-btn text-uppercase">
                        {{ $section->button_2_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Marketing section End -->
