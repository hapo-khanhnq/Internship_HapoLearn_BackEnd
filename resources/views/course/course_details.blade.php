@extends('layouts.app')

@section('content')
<section class="course-details-section">
    <div class="container-fluid py-3 path-to-course-details">
        <span><a @if (Auth::check()) href="{{ route('home') }}" @else href="/" @endif>Home</a>&nbsp; > &nbsp;<a href="{{ route('courses') }}">All Courses</a>&nbsp; > &nbsp;<a href="">Course-details</a></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="my-4 bg-secondary course-image">
                    @if ($detailsCourse->image_path)
                    <img class="course-img" src="{{ $detailsCourse->image_path }}" alt="course_image">
                    @else
                    <img class="course-img" src="{{ asset('images/default_course_img.png') }}" alt="default_course_image">
                    @endif
                </div>
                <div class="pb-5 px-3 course-infor">
                    <ul class="nav nav-tabs course-tab" id="courseTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active px-0" id="lessons-tab" data-toggle="tab" href="#lessons" role="tab" aria-controls="lessons" aria-selected="true">Lessons</a>
                        <li class="nav-item">
                            <a class="nav-link px-0" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Teacher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-0" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="courseTabContent">
                        <div class="container tab-pane fade show active px-2" id="lessons" role="tabpanel" aria-labelledby="lessons-tab">
                            <div class="row py-4 ml-0">
                                <div class="col-8 pl-0">
                                    <form action="{{ route('course.details.search-lessons', $detailsCourse->id) }}" method="get">
                                        <div class="d-flex flex-row">
                                            <div class="form-search-input">
                                                <input type="text" class="search-input" name="keyword" placeholder="Search..." @if (isset($keyword)) value="{{ $keyword }}" @endif>
                                                <i class="fas fa-search search-icon"></i>
                                            </div>
                                            <button type="submit" class="search-button">
                                                Search
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <button class="join-course-button">Join course</button>
                                </div>
                            </div>
                            @foreach ($lessons as $key => $lesson)
                            <div class="row py-3 pl-2 ml-0 lesson-of-course">
                                <div class="col-9 pl-0 lesson-name">
                                    {{ ++$key }}. {{ $lesson->name }}
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-center pr-2">
                                    <a href="#" class="learn-lesson-button">Learn</a>
                                </div>
                            </div>
                            @endforeach
                            <hr class="dividing-line">
                            {{ $lessons->appends($_GET)->links('user.pagination') }}
                        </div>
                        <div class="container tab-pane fade px-2" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                            <div class="pt-3 teacher-title">
                                Main Teacher
                            </div>
                            @foreach ($teachers as $teacher)
                            <div class="pt-5">
                                <div class="row ml-0">
                                    <div class="col-2 pl-0">
                                        @if ($teacher->avatar)
                                        <div class="teacher-image">
                                            <img class="teacher-img" src="{{ $teacher->avatar }}" alt="teacher_image">
                                        </div>
                                        @else
                                        <div class="teacher-image bg-secondary">
                                            <img class="teacher-img" src="{{ asset('images/user_avatar.png') }}" alt="default_teacher_image">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="teacher-name">{{ $teacher->name }}</div>
                                        <div class="teacher-experience">Second Year Teacher</div>
                                        <div class="mt-2 d-flex flex-row">
                                            <a href="#" class="mr-1 icon-google"><img src="{{ asset('images/icon_google.png') }}" alt="icon_google"></a>
                                            <a href="#" class="mr-1 ml-1 icon-facebook"><img src="{{ asset('images/icon_facebook.png') }}" alt="icon_facebook"></a>
                                            <a href="#" class="ml-1 icon-slack"><img src="{{ asset('images/icon_slack.png') }}" alt="slack-icon"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 teacher-description">
                                    {{ $teacher->about }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="container tab-pane fade px-2" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="pt-3 pb-2 px-2 reviews-title">
                                05 Reviews
                            </div>
                            <div class="py-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="d-flex flex-column justify-content-center align-items-center rating-5star pt-2 pb-4">
                                            <div class="rating-5star-number">5</div>
                                            <div class="star mt-1">
                                                <i class="fas fa-star">&nbsp;</i>
                                                <i class="fas fa-star">&nbsp;</i>
                                                <i class="fas fa-star">&nbsp;</i>
                                                <i class="fas fa-star">&nbsp;</i>
                                                <i class="fas fa-star">&nbsp;</i>
                                            </div>
                                            <div class="rating-5star-times">2 Ratings</div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="rating-statistic px-3 pt-2">
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">5 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">2</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">4 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">2</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">3 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">2</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">2 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">2</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">1 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">2</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-container">
                                <div class="title mt-4 show-all-review" href="">
                                    Show all reviews <i class="fas fa-caret-down"></i>
                                </div>
                                <div class="review pt-4 pb-3">
                                    <div class="user d-flex flex-row">
                                        <div class="user-avatar">
                                            <img src="{{ asset('images/user_avatar.png') }}" alt="" class="user-img">
                                        </div>
                                        <div class="user-name ml-3">Khanh</div>
                                        <div class="user-rate ml-4">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="user-review-time ml-5">
                                            August 4, 2020 at 1:30 pm
                                        </div>
                                    </div>
                                    <div class="review-content text mt-3">
                                        Vivamus volutpat eros pulvinar velit laoreet, sit amet egestas erat dignissim. Sed quis rutrum tellus, sit amet viverra felis. Cras sagittis sem sit amet urna feugiat rutrum. Nam nulla ipsum, venenatis malesuada felis quis, ultricies convallis neque. Pellentesque tristique
                                    </div>
                                </div>
                            </div>
                            <div class="add-review-container">
                                <div class="add-review-title mt-4">Leave a Review</div>
                                <div class="add-review-message mt-3">Message</div>
                                <textarea name="review_message" id="" cols="30" rows="5" class="form-control mt-2"></textarea>
                                <div class="vote-star-review d-flex align-items-center mt-3">
                                    <div class="vote">Vote</div>
                                    <div class="rating ml-3">
                                        <input type="radio" name="rate" id="star1" value="1"><label for="star1">1 stars</label>
                                        <input type="radio" name="rate" id="star2" value="2"><label for="star2">2 stars</label>
                                        <input type="radio" name="rate" id="star3" value="3"><label for="star3">3 stars</label>
                                        <input type="radio" name="rate" id="star4" value="4"><label for="star4">4 stars</label>
                                        <input type="radio" name="rate" id="star5" value="5"><label for="star5">5 stars</label>
                                    </div>
                                    <div class="stars-text ml-3">(stars)</div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="send-review">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="course-description p-3 my-4">
                    <div class="description-title pb-3">
                        Descriptions course
                    </div>
                    <div class="description-content mt-3">
                        {{ $detailsCourse->description }}
                    </div>
                </div>
                <div class="course-statistic p-3">
                    <div class="pt-3 pb-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/learner_icon.png') }}" alt="learner_icon" class="icon-img"> Learners
                        </div>
                        <div class="statistic-data">
                            : {{ $detailsCourse->number_of_student }}
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/lesson_icon.png') }}" alt="lesson_icon" class="icon-img"> Lessons
                        </div>
                        <div class="statistic-data">
                            : {{ $detailsCourse->number_of_lesson }} lessons
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/time_icon.png') }}" alt="time_icon" class="icon-img"> Time
                        </div>
                        <div class="statistic-data">
                            : @if ($detailsCourse->learn_time < 60) {{ $detailsCourse->learn_time }} min @else {{ (int)($detailsCourse->learn_time / 60) }} h {{ $detailsCourse->learn_time % 60 }} min @endif </div>
                        </div>
                        <div class="py-4 d-flex statistic">
                            <div class="statistic-category">
                                <img src="{{ asset('images/tag_icon.png') }}" alt="tag_icon" class="icon-img"> Tags
                            </div>
                            <div class="statistic-data d-flex">
                                :
                                <form action="{{ route('courses.search') }}" method="get">
                                    @foreach ($detailsCourse->tags as $tag)
                                    <input type="submit" name="tag" hidden id="tagSearch{{ $tag->id }}" value="{{ $tag->id }}">
                                    <label for="tagSearch{{ $tag->id }}" class="statistic-data tag m-0 d-block">&nbsp;#{{ $tag->name }}</label>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="py-4 d-flex statistic">
                            <div class="statistic-category">
                                <img src="{{ asset('images/price_icon.png') }}" alt="price_icon" class="icon-img"> Price
                            </div>
                            <div class="statistic-data">
                                : @if ($detailsCourse->price > 0)
                                {{ $detailsCourse->learn_time }} $
                                @else
                                free
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="other-courses mt-4 mb-5">
                        <div class="other-course-title py-3">Other Courses</div>
                        <div class="other-courses-list">
                            @foreach ($detailsCourse->other_courses as $key => $otherCourse )
                            <a href="{{ route('course.details', $otherCourse->id) }}" class="other-courses-element p-3 d-block">
                                {{ ++$key }}. {{ $otherCourse->name }}
                            </a>
                            @endforeach
                            <div class="d-flex align-items-center justify-content-center py-4">
                                <a href="{{ route('courses') }}" class="view-all-course-button">View all ours courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
