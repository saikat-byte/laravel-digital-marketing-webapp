@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Add New Holiday</h3>
    <form action="{{ route('admin.holidays.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="holiday_date">Holiday Date:</label>
            <input type="date" name="holiday_date" id="holiday_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description (Optional):</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="e.g., Christmas">
        </div>
        <button type="submit" class="btn btn-success">Add Holiday</button>
    </form>
</div>
@endsection
