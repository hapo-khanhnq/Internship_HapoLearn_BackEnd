@extends('admin.index')
@section('content')
<h1 class="mt-4">Course: {{ $lesson->course->name }}</h1>
<hr>
<h2 class="m-4 px-2">Edit Lesson</h2>
<form action="{{ route('admin.lessons.update', $lesson->id) }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="row mx-3">
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Lesson name..." name="name" value="{{ old('name', $lesson->name) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Time:</label>
                <input type="number" class="form-control @error('learn_time') is-invalid @enderror" placeholder="Lesson learn time (min)..." name="learn_time" value="{{ old('learn_time', $lesson->learn_time) }}">
                @error('learn_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="course_id" value="{{ $lesson->course->id }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Lesson description..." value="">{{ old('description', $lesson->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Requirement:</label>
                <textarea class="form-control @error('requirement') is-invalid @enderror" name="requirement" rows="5" placeholder="Lesson requirement..." value="">{{ old('requirement', $lesson->requirement) }}</textarea>
                @error('requirement')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4 pb-4">
        <a href="{{ route('admin.courses.show', $lesson->course->id) }}" type="button" class="btn btn-danger">Return</a>
        <button type="submit" class="btn btn-primary px-4 mx-4">Edit</button>
    </div>
</form>
@endsection
