@extends('admin.layouts.master')

@section('title', 'Update Pdf File')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Add Pdf file</h3>

    <h1>Show or Update PDF</h1>

    @if ($pdfExists)
    <p>Current PDF file:</p>

    <!-- Embed show pdf -->
    <iframe src="{{ $pdfPath }}" width="100%" height="500px">
        PDF preview not supported on your browser
    </iframe>

    <!-- Download link -->
    <a href="{{ $pdfPath }}" download>Download current PDF</a>
    @else
    <p>No PDF file found.</p>
    @endif

    <hr>

    <form action="{{ route('admin.edit.updatePdf') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="add_pdf" class="form-label">Client Name</label>
            <input type="file" name="pdf" accept="application/pdf" class="form-control" value="{{ old('pdf') }}">
            @error('pdf')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary text-uppercase">Update pdf</button>
    </form>
</div>
@endsection


@push('custom-js')
<script>
    @include('admin.partials.sweet-alert')

</script>
@endpush
