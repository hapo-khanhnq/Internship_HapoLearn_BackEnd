@extends('admin.index')

@section('content')
<h1 class="mt-4">Course: {{ $course->name }}</h1>
<ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-lesson-tab" data-toggle="pill" href="#pills-lesson" role="tab" aria-controls="pills-lesson" aria-selected="true">Lesson List</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-user-tab" data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user" aria-selected="false">User List</a>
    </li>
</ul>
<hr>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-lesson" role="tabpanel" aria-labelledby="pills-lesson-tab">
        <h2 class="m-3">Lesson List</h2>
        <form action="{{ route('admin.lessons.create') }}" method="get">
            <input type="hidden" name="course" value="{{ $course->id }}">
            <button type="submit" class="btn btn-primary m-3"><i class="fas fa-plus-circle"></i>&nbsp; Add new lesson</button>
        </form>
        <div class="p-3">
            <table class="table table-striped table-bordered table-hover display">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Requirement</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                    <tr class="text-center">
                        <td><a href="{{ route('admin.lessons.show', $lesson->id) }}">{{ $lesson->name }}</a></td>
                        <td>{{ $lesson->description }}</td>
                        <td>{{ $lesson->requirement }}</td>
                        <td>@if ($lesson->learn_time < 60) {{ $lesson->learn_time }} min @else {{ (int)($lesson->learn_time / 60) }} h {{ $lesson->learn_time % 60 }} min @endif</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-primary mx-2"><i class="far fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger mx-2" id="deleteLesson" data-toggle="modal" data-target="#exampleModalLesson" data-user="{{ $adminUser->id }}" data-course="{{ $course->id }}" data-url="{{ route('admin.lessons.destroy', $lesson->id) }}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-user" role="tabpanel" aria-labelledby="pills-user-tab">
        <h2 class="m-3">User List</h2>
        <form action="{{ route('admin.users.create') }}" method="get">
            <input type="hidden" value="{{ $course->id }}" name="course">
            <button type="submit" class="btn btn-primary m-3"><i class="fas fa-plus-circle"></i>&nbsp; Add user to course</button>
        </form>
        <div class="p-3">
            <table class="table table-striped table-bordered table-hover display">
                <thead>
                    <tr class="text-center">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Phone</th>
                        <th>Avatar</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->users as $user)
                    <tr class="text-center">
                        @if ($user->id == Auth::user()->id)
                        <td class="text-danger">{{ $user->name.' (me)'  }}</td>
                        @else
                        <td>{{ $user->name }}</td>
                        @endif
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if ($user->avatar)
                            <img class="user-img" src="{{ asset('storage/user/' . $user->avatar) }}" alt="user_image" width="60px">
                            @else
                            <img class="user-img" src="{{ asset('images/user_avatar.png') }}" alt="default_user_image" width="60px">
                            @endif
                        </td>
                        <td>{{ $user->address }}</td>
                        <td>
                            {{ ($user->role == 1) ? 'Teacher' : 'Student'}}
                        </td>
                        @if ($user->id != Auth::user()->id)
                        <td>
                            <button type="submit" class="btn btn-primary" id="deleteUserCourse" data-toggle="modal" data-target="#exampleModal" data-user="{{ $user->id }}" data-course="{{ $course->id }}" data-url="{{ route('admin.users.destroy', $user->id) }}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                        @else
                        <td>
                            <i>None</i>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('admin.course.modal_delete')
    @include('admin.course.modal_delete_lesson')
</div>
@endsection
