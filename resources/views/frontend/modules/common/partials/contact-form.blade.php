@if($section->status == 1)
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('lead.submit') }}" method="POST" class="text-center" >
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control custom-input" name="name" id="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control custom-input" name="email" id="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control custom-input" name="phone" id="phone" placeholder="+91 Phone Number">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control custom-input" name="service" id="service" placeholder="Service">
            </div>
            <button type="submit" class="gradient-glow-button w-100 mt-2">
                START YOUR PROJECT
            </button>
        </form>
@endif
