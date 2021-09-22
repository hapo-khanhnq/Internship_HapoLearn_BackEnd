@extends('layouts.app')

@section('content')
@include('partials.alerts')
<section class="banner-section">
    <div class="banner">
        <div class="banner-content">
            <div class="banner-slogan">
                <span class="top-slogan">Learn Anytime, Anywhere</span>
                <br>
                <span class="bottom-slogan">at HapoLearn <img src="images/owl_logo.png" alt="Owl-Logo"> !</span>
            </div>
            <p>Interactive lessons, "on-the-go"<br> practice, peer support.</p>
            <a href="{{ route('courses') }}" class="button">Start Learning Now!</a>
        </div>  
    </div>      
</section>

<div class="space-between-banner-courses"></div>

<section class="main-courses-section">
    <div class="container p-0 courses-container">
        <div class="row">
            @foreach ($mainCourses as $course)
            <div class="col-sm-4 pb-2 col-course">
                <div class="card">
                    <div class="card-image">
                        @if ($course->image_path)
                            <img class="card-img-top" src="{{ $course->image_path }}" alt="course_image">
                        @else
                            <img class="card-img-top" src="{{ asset('images/default_course_img.png') }}" alt="default_course_image">
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-title">{{ $course->name }}</p>
                        <p class="card-text">{{ $course->description }}</p>
                        <a href="{{ route('course.details', $course->id) }}" class="card-button">Take This Course</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="other-courses-section">
    <span class="other-courses-title">Other courses</span>
    <div class="container p-0 courses-container">
        <div class="row">
            @foreach ($otherCourses as $course)
                <div class="col-sm-4 pb-2 col-course">
                    <div class="card">
                        <div class="card-image">
                            @if ($course->image_path)
                                <img class="card-img-top" src="{{ $course->image_path }}" alt="course_image">
                            @else
                                <img class="card-img-top" src="{{ asset('images/default_course_img.png') }}" alt="default_course_image">
                            @endif
                        </div>
                        <div class="card-body">
                            <p class="card-title">{{ $course->name }}</p>
                            <p class="card-text">{{ $course->description }}</p>
                            <a href="{{ route('course.details', $course->id) }}" class="card-button">Take This Course</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('courses') }}" class="view-all-courses">View All Our Courses <img src="images/view_all_courses.png" alt="view-all-courses"></a>
</section>

<section class="whyhapo-section">
    <div class="whyhapo-container container-fluid p-0">
        <div class="img-laptop">
            <img src="images/laptop.png" alt="laptop">
        </div>
        <div class="row">
            <div class="col-sm-6 col-left">
                <p>Why HapoLearn?</p>
                <ul>
                    <li><i class="fas fa-check-circle"></i>Interactive lessons, "on-the-go" practice, peer support.</li>
                    <li><i class="fas fa-check-circle"></i>Interactive lessons, "on-the-go" practice, peer support.</li>
                    <li><i class="fas fa-check-circle"></i>Interactive lessons, "on-the-go" practice, peer support.</li>
                    <li><i class="fas fa-check-circle"></i>Interactive lessons, "on-the-go" practice, peer support.</li>
                    <li><i class="fas fa-check-circle"></i>Interactive lessons, "on-the-go" practice, peer support.</li>
                </ul>
            </div>
            <div class="col-sm-6 col-right">
                <div class="img-laptop-tabet">
                    <img src="images/laptop_tabet.png" alt="laptop-tabet">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feedback-section">
    <span class="feedback-section-title">Feedback</span>
    <p>What other students turned professionals have to say about us after learning with us and reaching their goals</p>
    <div class="feedbacks slider">
        @foreach ($reviews as $review)
        <div class="feedback-detail">
            <div class="feedback-content">
                <div class="vertical-line"></div>
                <p>“{{ $review->content }}”</p>
            </div>
            <div class="feedback-user">
                <div class="user-avatar">
                @if ($review->user->avatar)
                <img src="{{ $review->user->avatar }}" alt="user_image">
                @else
                <img src="{{ asset('images/user_avatar.png') }}" alt="default_user_image">
                @endif
                </div>
                <div class="user-infor">
                    <span class="user-name">{{ $review->user->name }}</span><br>
                    <span class="user-course">{{ $review->location->name }}</span><br>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rate)
                        <i class="fas fa-star">&nbsp;</i>
                        @elseif (($i - 0.5) <= $review->rate)
                        <i class="fas fa-star-half-alt">&nbsp;</i>
                        @else
                        <i class="far fa-star">&nbsp;</i>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="become-member-section">
    <div class="container-fluid p-0 become-member-container">
        <p class="become-member-text">Become a member of our<br>growing community!</p>
        <a href="{{ route('courses') }}" class="become-member-button">Start Learning Now!</a>
    </div>
</section>

<section class="statistic-section">
    <span class="statistic-title">Statistic</span>
    <div class="container-xl statistic-container">
        <div class="row">
            <div class="col-sm-4">
                <p class="col-top">Courses</p><p class="col-bottom">{{ $numberOfCourses }}</p>
            </div>
            <div class="col-sm-4">
                <p class="col-top">Lessons</p><p class="col-bottom">{{ $numberOfLessons }}</p>
            </div>
            <div class="col-sm-4">
                <p class="col-top">Learners</p><p class="col-bottom">{{ $numberOfLearners }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
