@if($section->status == 1)
    <!-- Three Part Section with Divider Lines -->


<section class="contact-section">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <!-- Left Column (Form) -->
            @include('frontend.modules.common.partials.contact-form')

            <!-- Right Column (Heading, Sub-heading & Text + Three Part) -->
            @include('frontend.modules.common.partials.contact-form-right')

        </div>
    </div>
</section>
@endif
