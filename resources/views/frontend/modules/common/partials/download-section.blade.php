@if($section->status == 1)

<section class="download-section text-center text-white py-5">
    <div class="container-fluid position-relative py-5">
        <!-- Content -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">{{ $downloadSection->heading }}</h1>
                <p class="lead mb-4">{{ $downloadSection->sub_heading }}</p>
                <!-- Input Group -->
                <form action="{{ route('subscriber.store') }}" method="POST" id="subscribe-form">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control rounded-start" value="{{ old('email') }}" placeholder="ENTER YOUR EMAIL" aria-label="Email">
                        <button class="btn btn-gradient" type="submit">DOWNLOAD <span class="dropdown-toggle"></span></button>
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </form>
                <div id="subscribe-message"></div>
            </div>

            <div class="col-lg-4">
                <!-- Magazine Image -->
                <img src="{{ asset('storage/' . $downloadSection->image) }}" alt="Magazine" class="magazine-image">
            </div>
        </div>
    </div>
</section>

@endif
