  
@extends('admin.index')
@section('content')
<h2 class="m-4 px-2">Add Lesson To Course: {{ $course->name }}</h2>
<form action="{{ route('admin.lessons.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row mx-3">
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Lesson name..." name="name" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Time:</label>
                <input type="number" class="form-control @error('learn_time') is-invalid @enderror" placeholder="Lesson learn time (min)..." name="learn_time" value="{{ old('learn_time') }}">
                @error('learn_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="course_id" value="{{ $course->id }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Lesson description..." value="">{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Requirement:</label>
                <textarea class="form-control @error('requirement') is-invalid @enderror" name="requirement" rows="5" placeholder="Lesson requirement..." value="">{{ old('requirement') }}</textarea>
                @error('requirement')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4 pb-4">
        <a href="{{ route('admin.courses.show', $course->id) }}" type="button" class="btn btn-danger">Return</a>
        <button type="submit" class="btn btn-primary px-4 mx-4">Add</button>
    </div>
</form>
@endsection
