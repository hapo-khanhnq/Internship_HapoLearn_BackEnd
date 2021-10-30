@extends('admin.index')
@section('content')
<h2 class="m-3">User List</h2>
<a href="{{ route('admin.users.create') }}" class="btn btn-primary m-3"><i class="fas fa-plus-circle"></i>&nbsp; Add new course</a>
<div class="p-3">
    <table class="table table-striped table-bordered table-hover" id="userDataTable">
        <thead>
            <tr class="text-center">
                <th>Course</th>
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
            @foreach ($courses as $course)
                @foreach ($course->getUsersOfCourseOfOneAdmin($adminUser->id) as $user)
                <tr class="text-center">
                    <td>{{ $course->name }}</td>
                    <td>{{ $user->name }}</td>
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
                    <td>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
