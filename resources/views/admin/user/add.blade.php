@extends('admin.index')
@section('content')
<section class="admin-add-user-course px-3">
    <h2 class="my-4">Add User</h2>
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="email" class="form-group-title">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if (session()->has('message'))
                <strong class="message-for-email">{{ session()->get('message') }}</strong>
            @endif
            @if (session()->has('message'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                </span>
            @endif
        </div>
        @php
            $url = url()->previous();
            $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
        @endphp
        @if($route == 'admin.courses.show' || isset($course))
            <div class="form-group">
                <label for="course" class="text-danger">Course: {{$course->name}}</label>
                <input type="hidden" class="form-control" name="course" id="course" value="{{ $course->id }}">
            </div>
            <div class="d-flex justify-content-end mt-4 pb-4">
                <a href="{{ route('admin.courses.show', $course->id) }}" type="button" class="btn btn-danger px-3">Return</a>
                <button type="submit" class="btn btn-primary px-4 mx-4">Add</button>
            </div>
        @elseif($courses)
            <div class="form-group">
                <label for="course">Course:</label>
                <select class="form-control select2-menu @error('course') is-invalid @enderror" name="course" id="course">
                    <option value="">Courses</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}" @if (request('course')==$course->id) selected @endif>{{ $course->name }}</option>
                    @endforeach
                </select>

                @error('course')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-end mt-4 pb-4">
                <a href="{{ route('admin.users.index') }}" type="button" class="btn btn-danger px-3">Return</a>
                <button type="submit" class="btn btn-primary px-4 mx-4">Add</button>
            </div>
        @endif
    </form>
</section>
@endsection
