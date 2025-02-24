@extends('admin.layouts.master')

@section('content')
<div class="page-inner">
    <h3 class="fw-bold mb-3">Edit Holiday</h3>
    <form action="{{ route('admin.holidays.update', $holiday->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="holiday_date">Holiday Date:</label>
            <input type="date" name="holiday_date" id="holiday_date" class="form-control" value="{{ old('holiday_date', $holiday->holiday_date) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description (Optional):</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $holiday->description) }}" placeholder="e.g., New Year">
        </div>
        <button type="submit" class="btn btn-primary">Update Holiday</button>
    </form>
</div>
@endsection
