
@if($section->status == 1)

<section class="download-section text-center text-white py-5">
    <div class="container-fluid position-relative py-5">
        <!-- Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">{{ $section->heading }}</h1>
                <p class="lead mb-4">{{ $section->sub_heading }}</p>
                <!-- Input Group -->
                <form action="">
                    <div class="input-group">

                        <input type="email" class="form-control rounded-start" placeholder="ENTER YOUR EMAIL" aria-label="Email">
                        <button class="btn btn-gradient" type="button">DOWNLOAD <span class="dropdown-toggle"></span></button>
                    </div>
                </form>
            </div>

            <div class="col-lg-4">
                <!-- Magazine Image -->
                <img src="{{ asset('storage/' . $section->image) }}" alt="Magazine" class="magazine-image">
            </div>
        </div>
    </div>
</section>

@endif
