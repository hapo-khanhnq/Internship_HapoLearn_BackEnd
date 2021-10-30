@extends('admin.index')
@section('content')
<h2 class="m-3">Course List</h2>
<a href="{{ route('admin.courses.create') }}" class="btn btn-primary m-3"><i class="fas fa-plus-circle"></i>&nbsp; Add new course</a>
<div class="p-3">
    <table class="table table-striped table-bordered table-hover" id="courseDataTable">
        <thead>
            <tr class="text-center">
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr class="text-center">
                <td><a href="{{ route('admin.courses.show', $course->id) }}">{{ $course->name }}</a></td>
                <td>
                    @if ($course->image_path)
                    <img src="{{ asset('storage/courses/' . $course->image_path) }}" alt="course_image" width="120px" onerror="this.src='{{ asset("images/default_course_img.png") }}'">
                    @else
                    <img src="{{ asset('images/default_course_img.png') }}" alt="default_course_image" width="120px">
                    @endif
                </td>
                <td>{{ $course->description }}</td>
                <td>{{ ($course->price > 0) ? $course->price.' $'  : 'Free' }}</td>
                <td>
                    @if (count($course->tags) > 0)
                        @foreach ($course->tags as $tag)
                            <p>#{{ $tag->name }}&nbsp;</p>
                        @endforeach
                    @else
                        <i>None</i>
                    @endif
                </td>
                <td class="d-flex">
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary mx-2"><i class="far fa-edit"></i></a>
                    <button type="submit" class="btn btn-danger mx-2" id="deleteCourse" data-toggle="modal" data-target="#exampleModal" data-user="{{ $adminUser->id }}" data-course="{{ $course->id }}" data-url="{{ route('admin.courses.destroy', $course->id) }}"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('admin.course.modal_delete_course')
</div>
@endsection
