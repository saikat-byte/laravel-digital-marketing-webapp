<!-- Stats Section -->
@if($section->status == 1)
{{-- {{ dd($section->config) }} --}}
<section class="stats-section bg-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 class="text-primary">{{ $section->config['EXPERIENCE'] }}</h3>
                    <p class="text-primary">EXPERIENCE</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 class="text-primary">{{ $section->config['PROJECTS'] }}</h3>
                    <p class="text-primary">PROJECTS</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 class="text-primary">{{ $section->config['CLIENT'] }}</h3>
                    <p class="text-primary">CLIENT</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <h3 class="text-primary">{{ $section->config['SUCCESS RATE'] }}</h3>
                    <p class="text-primary">SUCCESS RATE</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endif
