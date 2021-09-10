@extends('layouts.app')

@section('content')
<section class="user-profile-section">
    <div class="container user-profile">
        <div class="row">
            <div class="col-3">
                <div class="avatar-user d-flex flex-column justify-content-center mt-5">
                    @if ($user->avatar)
                        <img class="user-img" src="{{ asset('storage/user/' . $user->avatar) }}" alt="user_image">
                    @else
                        <img class="user-img" src="{{ asset('images/user_avatar.png') }}" alt="default_user_image">
                    @endif
                    <a data-toggle="modal" data-target="#uploadAvatar" class="upload-avatar-button btn position-relative"><i class="fas fa-camera"></i></a>
                    @error('avatar')
                    <span class="alert alert-danger text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div id="uploadAvatar" class="modal fade upload-avatar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('user.update.avatar', $user->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Upload avatar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body p-3">
                                    <input type="file" name="avatar" id="avatar">
                                    <label for="avatar">
                                        <i class="fas fa-cloud-upload-alt icon-upload"></i>
                                    </label>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn upload-button">Upload</button>
                                    <button type="button" class="btn return-button" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="user-name-email text-center">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-email my-2">{{ $user->email }}</div>
                </div>
                <hr>
                <div class="user-information text-justify">
                    <div class="ml-3 mr-4">
                        <i class="fas fa-birthday-cake pr-3 pt-3"></i><span class="pt-3 user-infor">{{ isset($user->birthday) ? date('d-m-Y', strtotime($user->birthday)) : 'No information' }}</span>
                        <hr>
                        <i class="fas fa-phone pr-3"></i><span class="user-infor">{{ isset($user->phone) ? $user->phone : 'No information' }}</span>
                        <hr>
                        <i class="fas fa-home pr-3"></i><span class="user-infor">{{ isset($user->address) ? $user->address : 'No information' }}</span>
                        <hr>
                    </div>
                    <span class="user-about">{{ isset($user->about) ? $user->about : 'No information' }}</span>
                </div>
            </div>
            <div class="col-9">
                <div class="edit-profile container">
                    <div class="title">
                        My courses                    
                    </div>
                    <div class="row my-4 d-flex justify-content-center align-items-center">
                        @foreach ($courses as $course)
                        <div class="col-1 user_course p-0 text-center mx-3">
                            @if ($course->image_path)
                                <a href="{{ route('course.details', $course->id) }}"><img src="{{ $course->image_path }}" class="course-img mb-2" alt="course_image">{{ $course->name }}</a>
                            @else
                                <a href="{{ route('course.details', $course->id) }}"><img src="{{ asset('images/default_course_img.png') }}" class="course-img mb-2" alt="default_course_image">{{ $course->name }}</a>
                            @endif
                        </div>
                        @endforeach
                        <div class="add-course mx-3">
                            <a href="{{ route('courses') }}">
                                <div class="add-course-icon mb-2 d-flex align-items-center justify-content-center">
                                    +
                                </div>
                                Add course
                            </a>
                        </div>
                    </div>
                    <div class="title">
                        Edit profile
                    </div>
                    <form action="{{ route('user.update.information') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row edit-profile-form mt-4">
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label class="form-label">Name:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your name..." name="name" value="{{ old('name', $user->name) }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Date of birthday:</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $user->birthday) }}">

                                    @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Address:</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Your address..." name="address" value="{{ old('address', $user->address) }}">
                                    
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label class="form-label">Email:</label>
                                    <input type="text" class="form-control" placeholder="Your email..." name="email" value="{{ old('email', $user->email) }}" disabled>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Phone:</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Your phone..." name="phone" value="{{ old('phone', $user->phone) }}">
                                    
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">About me:</label>
                                    <textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="7" placeholder="About you...">{{ old('about', $user->about) }}</textarea>
                                    
                                    @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-4 pb-4">
                            <button type="submit" class="btn upload-button">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="blank-space"></div>
</section>
@endsection
