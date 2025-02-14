@if($section->status == 1)
    <!-- Three Part Section with Divider Lines -->


<section class="contact-section">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <!-- Left Column (Form) -->
            <div class="col-lg-4 mb-5 mb-lg-0 left-col d-flex flex-column justify-content-center">
                <div class="text-top mb-4">
                    <h3 class="text-uppercase text-center">{{ $contactForm->heading }} <br>{{ $contactForm->sub_heading }}</h3>
                </div>

                <!-- Form Wrapper with Gradient Border -->
                <div class="form-wrapper p-4">
                    <h5 class="mb-3 text-uppercase">{{ $contactForm->paragraph }}</h5>
                    @include('frontend.modules.common.partials.contact-form')
                </div>
            </div>


            <!-- Right Column (Heading, Sub-heading & Text + Three Part) -->
            @include('frontend.modules.common.partials.contact-form-right')

        </div>
    </div>
</section>
@endif
