<div class="col-lg-4 mb-5 mb-lg-0 left-col d-flex flex-column justify-content-center">
    <div class="text-top mb-4">
        <h3 class="text-uppercase text-center">{{ $contactForm->heading }} <br>{{ $contactForm->sub_heading }}</h3>
    </div>

    <!-- Form Wrapper with Gradient Border -->
    <div class="form-wrapper p-4">
        <h5 class="mb-3 text-uppercase">{{ $contactForm->paragraph }}</h5>
        <!-- Contact Form -->
        <form class="text-center">
            <div class="mb-3">
                <input type="text" class="form-control custom-input" placeholder="Name">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control custom-input" placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control custom-input" placeholder="+91 Phone Number">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control custom-input" placeholder="Service">
            </div>
            <button type="submit" class="gradient-glow-button w-100 mt-2">
                START YOUR PROJECT
            </button>
        </form>
    </div>
</div>
