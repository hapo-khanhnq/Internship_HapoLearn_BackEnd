  
@extends('admin.index')
@section('content')
<h2 class="m-4 px-2">Add Course</h2>
<form action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="row mx-3">
        <div class="col-6">
            <div class="form-group">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Course name..." name="name" value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Image:</label>
                <input type="file" class="w-50 pt-1 form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Price:</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" placeholder="Course price (USD)..." name="price" value="{{ old('price') }}">
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
                        <option value="{{ $tag->id }}">#{{ $tag->name }}</option>
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
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="8" placeholder="Course description..." value="">{{ old('description') }}</textarea>
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
        <button type="submit" class="btn btn-primary px-4 mx-4">Add</button>
    </div>
</form>
@endsection
