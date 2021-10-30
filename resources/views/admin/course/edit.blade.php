  
@extends('admin.index')
@section('content')
<h2 class="m-4 px-2">Edit Course</h2>
<form action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <div class="row mx-3">
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Course name..." name="name" value="{{ old('name', $course->name) }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Image:</label>
                <img src="{{ asset('storage/courses/' . $course->image_path) }}" alt="course_image" width="120px">
                <input type="file" class="w-50 pt-1 form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Price:</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Course price (USD)..." name="price" value="{{ old('price', $course->price) }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Tags:</label>
                <select class="form-control @error('tags') is-invalid @enderror js-tag-list" multiple="multiple" name="tag[]">
                    @foreach ($tags as $tag)
                        @if ($tag->isTagOfCourse($course->id))
                            <option value="{{ $tag->id }}" selected>#{{ $tag->name }}</option>
                        @else
                            <option value="{{ $tag->id }}">#{{ $tag->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('tags')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="8" placeholder="Course description..." value="">{{ old('description', $course->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-4 pb-4">
        <a href="{{ route('admin.courses.index') }}" type="button" class="btn btn-danger">Return</a>
        <button type="submit" class="btn btn-primary px-4 mx-4">Edit</button>
    </div>
</form>
@endsection
