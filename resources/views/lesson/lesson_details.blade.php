@extends('layouts.app')

@section('content')
<section class="lesson-details-section">
    <div class="container-fluid py-3 path-to-course-details">
        <span><a @if (Auth::check()) href="{{ route('home') }}" @else href="/" @endif>Home</a>&nbsp; > &nbsp;<a href="{{ route('courses') }}">All Courses</a>&nbsp; > &nbsp;<a href="{{ route('course.details', $lesson->course->id) }}">Course detail</a>&nbsp; > &nbsp;<a href="">Lesson detail</a></span></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="my-4 bg-secondary course-image">
                    @if ($lesson->course->image_path)
                    <img class="course-img" src="{{ asset('storage/courses/' . $lesson->course->image_path) }}" alt="course_image" onerror="this.src='{{ asset("images/default_course_img.png") }}'">
                    @else
                    <img class="course-img" src="{{ asset('images/default_course_img.png') }}" alt="default_course_image">
                    @endif
                </div>
                <div class="pb-5 px-3 course-infor">
                    <ul class="nav nav-tabs course-tab" id="courseTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active px-0" id="descriptions-tab" data-toggle="tab" href="#descriptions" role="tab" aria-controls="descriptions" aria-selected="true">Descriptions</a>
                        <li class="nav-item">
                            <a class="nav-link px-0" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">Teacher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-0" id="program-tab" data-toggle="tab" href="#program" role="tab" aria-controls="program" aria-selected="false">Program</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-0" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="courseTabContent">
                        <div class="container tab-pane fade show active px-2" id="descriptions" role="tabpanel" aria-labelledby="descriptions-tab">
                            <div class="pt-3 teacher-title">
                                Descriptions lesson
                            </div>
                            <div class="pt-2 teacher-description">{{ $lesson->description }}</div>
                            <div class="pt-3 teacher-title">
                                Requirements
                            </div>
                            <div class="pt-2 teacher-description">{{ $lesson->requirement }}</div>
                        </div>
                        <div class="container tab-pane fade px-2" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                            <div class="pt-3 teacher-title">
                                Main Teacher
                            </div>
                            @foreach ($lesson->teachers as $teacher)
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
                        <div class="container tab-pane fade px-2" id="program" role="tabpanel" aria-labelledby="program-tab">
                            <div class="teacher-title pt-3 pb-4">
                                Program
                            </div>
                            @foreach ($documents as $document)
                            <div class="row program-of-lesson py-3">
                                <div class="program-type col-2 d-flex align-items-center">
                                    @if (isset($document->type))
                                        @if ($document->type == "Lesson")
                                            <img src="{{ asset('images/doc_file_icon.png') }}" alt="doc_file_icon" class="iconfile-img"> {{ $document->type }}
                                        @elseif ($document->type == "PDF")
                                            <img src="{{ asset('images/pdf_file_icon.png') }}" alt="pdf_file_icon" class="iconfile-img"> {{ $document->type }}
                                        @else
                                            <img src="{{ asset('images/video_file_icon.png') }}" alt="video_file_icon" class="iconfile-img"> {{ $document->type }}
                                        @endif
                                    @else
                                        <img src="{{ asset('images/user_avatar.png') }}" alt="default_file_icon" class="iconfile-img"> {{ $document->type }}
                                    @endif
                                </div>
                                <div class="program-name col-8 d-flex align-items-center justify-content-between">{{ $document->name }}
                                    <div class="mark-learnd" id="documentCheckLearned{{ $document->id }}">
                                        @if ($document->check_document_learned)
                                            <i class="fas fa-check-circle mr-4 text-success"></i>
                                        @else
                                            <i class="far fa-circle text-danger mr-4" data-doccumentId="{{ $document->id }}" data-url="{{ route('document.learn') }}"></i>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-2 d-flex align-items-center flex-column">
                                    <!-- @if ($document->check_document_learned)
                                        <a href="{{ route('document.details', $document->id) }}" target="_blank" class="btn bg-success learned-program-button">Review</a>
                                    @else
                                        <a href="{{ route('document.details', $document->id) }}" target="_blank" class="btn learn-program-button">Preview</a>
                                    @endif -->
                                    <a href="{{ route('document.details', $document->id) }}" target="_blank" class="btn learn-program-button">Preview</a>
                                    <a href="{{ route('document.download', $document->file_path) }}" class="btn download-program-button mt-2">Download</a>
                                </div>
                            </div>
                            @endforeach
                            <!-- <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <b>Test upload file</b>
                                <input type="hidden" name="lessonId" value="{{ $lesson->id }}">
                                <input type="text" name="name" placeholder="Program name">
                                <select name="type">
                                    <option value="" selected>Program type</option>
                                    <option value="Lesson">Lesson</option>
                                    <option value="PDF">PDF</option>
                                    <option value="Video">Video</option>
                                </select>
                                <input type="file" name="file">
                                <button type="submit">Submit</button>
                            </form> -->
                        </div>
                        <div class="container tab-pane fade px-2" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="pt-3 pb-2 px-2 reviews-title">
                                {{ $lesson->number_of_review }} Reviews
                            </div>
                            <div class="py-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="d-flex flex-column justify-content-center align-items-center rating-5star pt-2 pb-4">
                                            <div class="rating-5star-number">{{ round($lesson->average_of_rate, 1) }}</div>
                                            <div class="star mt-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $lesson->average_of_rate)
                                                    <i class="fas fa-star">&nbsp;</i>
                                                    @elseif (($i - 0.5) <= $lesson->average_of_rate)
                                                    <i class="fas fa-star-half-alt">&nbsp;</i>
                                                    @else
                                                    <i class="far fa-star">&nbsp;</i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="rating-5star-times">{{ $lesson->total_of_rate }} Ratings</div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="rating-statistic px-3 pt-2">
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">5 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <input type="text" hidden id="five-star" value="{{ $lesson->getPercentOfNumberOfRate(config('variables.rate.five_star')) }}%">
                                                    <div id="five-star-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">{{ $lesson->getNumberOfRate(config('variables.rate.five_star'))}}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">4 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <input type="text" hidden id="four-star" value="{{ $lesson->getPercentOfNumberOfRate(config('variables.rate.four_star')) }}%">
                                                    <div id="four-star-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">{{ $lesson->getNumberOfRate(config('variables.rate.four_star'))}}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">3 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <input type="text" hidden id="three-star" value="{{ $lesson->getPercentOfNumberOfRate(config('variables.rate.three_star')) }}%">
                                                    <div id="three-star-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">{{ $lesson->getNumberOfRate(config('variables.rate.three_star'))}}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">2 stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <input type="text" hidden id="two-star" value="{{ $lesson->getPercentOfNumberOfRate(config('variables.rate.two_star')) }}%">
                                                    <div id="two-star-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">{{ $lesson->getNumberOfRate(config('variables.rate.two_star'))}}</div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-1">
                                                <div class="number-rating-star">1 &nbsp;stars</div>
                                                <div class="progress w-75 progress-review">
                                                    <input type="text" hidden id="one-star" value="{{ $lesson->getPercentOfNumberOfRate(config('variables.rate.one_star')) }}%">
                                                    <div id="one-star-progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="number-stars">{{ $lesson->getNumberOfRate(config('variables.rate.one_star'))}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-container">
                                <div class="title mt-4 show-all-review" href="">
                                    Show all reviews <i class="fas fa-caret-down"></i>
                                </div>
                                <?php $indexReviewOfCurrentUser = 0?>
                                @foreach ($lesson->reviews as $review)
                                <div class="review pt-4 pb-3">
                                    <div class="user d-flex flex-row">
                                        <div class="user-avatar">
                                            @if ($review->user->avatar)
                                            <img src="{{ $review->user->avatar }}" alt="user_image" class="user-img">
                                            @else
                                            <img src="{{ asset('images/user_avatar.png') }}" alt="default_user_image" class="user-img">
                                            @endif
                                        </div>
                                        <div class="user-name ml-3">{{ $review->user->name }}</div>
                                        <div class="user-rate ml-4">
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
                                        <div class="user-review-time ml-5">
                                            {{ $review->updated_at }}
                                        </div>
                                    </div>
                                    <div class="review-content text mt-3">
                                        {{ $review->content }}
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        @if (Auth::check())
                                            @if (Auth::user()->id == $review->user->id)
                                                <button type="button" id="{{ $indexReviewOfCurrentUser }}" class="edit-review-button" data-toggle="modal" data-target="#editReviewModal{{ $review->id }}"><i class="fas fa-pen"></i></button>
                                                @include ('review.edit_review_modal', $review)
                                                <button type="button" class="ml-2 delete-review-button" data-toggle="modal" data-target="#deleleReviewModal{{ $review->id }}"><i class="fas fa-trash"></i></button>
                                                @include ('review.delete_review_modal', $review)
                                                <?php $indexReviewOfCurrentUser ++?>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="add-review-container">
                                <div class="add-review-title mt-4">Leave a Review</div>
                                <form action="{{ route('review.lesson.store') }}" method="POST">
                                    <div class="add-review-message mt-3">Message</div>
                                    @csrf
                                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                    <textarea name="review_message" id="reviewMessage" cols="30" rows="5" class="form-control mt-2 @error('review_message') is-invalid @enderror"></textarea>

                                    @error('review_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="vote-star-review d-flex align-items-center mt-3">
                                        <div class="vote">Vote</div>
                                        <div class="rating ml-3">
                                            <input class="rate" type="radio" name="rate" id="star-five" value="{{ config('variables.rate.five_star') }}">
                                            <label for="star-five" class="mb-0 mt-1">5 stars</label>
                                            <input class="rate" type="radio" name="rate" id="star-four" value="{{ config('variables.rate.four_star') }}">
                                            <label for="star-four" class="mb-0 mt-1">4 stars</label>
                                            <input class="rate" type="radio" name="rate" id="star-three" value="{{ config('variables.rate.three_star') }}">
                                            <label for="star-three" class="mb-0 mt-1">3 stars</label>
                                            <input class="rate" type="radio" name="rate" id="star-two" value="{{ config('variables.rate.two_star') }}">
                                            <label for="star-two" class="mb-0 mt-1">2 stars</label>
                                            <input class="rate" type="radio" name="rate" id="star-one" value="{{ config('variables.rate.one_star') }}">
                                            <label for="star-one" class="mb-0 mt-1">1 stars</label>
                                        </div>
                                        <div class="stars-text ml-3">(stars)</div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                    @if (Auth::check())
                                        <button type="submit" class="send-review">Send</button>
                                    @else
                                        <a data-target="#loginModal" data-toggle="modal" class="send-review btn">Send</a>
                                    @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="course-statistic p-3 my-4">
                    <div class="pt-3 pb-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/course_icon.png') }}" alt="course_icon" class="icon-img"> Course
                        </div>
                        <div class="statistic-data">
                            : {{ $lesson->course->name }}
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/learner_icon.png') }}" alt="learner_icon" class="icon-img">  Learners
                        </div>
                        <div class="statistic-data">
                            : {{ $lesson->course->number_of_student }}
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/time_icon.png') }}" alt="time_icon" class="icon-img"> Time
                        </div>
                        <div class="statistic-data">
                            : @if ($lesson->course->learn_time < 60) {{ $lesson->course->learn_time }} min @else {{ (int)($lesson->course->learn_time / 60) }} h {{ $lesson->course->learn_time % 60 }} min @endif
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/tag_icon.png') }}" alt="tag_icon" class="icon-img"> Tags
                        </div>
                        <div class="statistic-data tags-form">
                            <form action="{{ route('courses.search') }}" method="get">
                                @foreach ($lesson->course->tags as $tag)
                                <input type="submit" name="tag" hidden id="tagSearch{{ $tag->id }}" value="{{ $tag->id }}">
                                @if ($loop->first)
                                <label for="tagSearch{{ $tag->id }}" class="tag m-0">:&nbsp;#{{ $tag->name }},</label>
                                @elseif ($loop->last)
                                <label for="tagSearch{{ $tag->id }}" class="tag m-0">&nbsp;#{{ $tag->name }}</label>
                                @else
                                <label for="tagSearch{{ $tag->id }}" class="tag m-0">&nbsp;#{{ $tag->name }},</label>
                                @endif
                                @endforeach
                            </form>
                        </div>
                    </div>
                    <div class="py-4 d-flex statistic">
                        <div class="statistic-category">
                            <img src="{{ asset('images/price_icon.png') }}" alt="price_icon" class="icon-img"> Price
                        </div>
                        <div class="statistic-data">
                            : {{ ($lesson->course->price > 0) ? $lesson->course->price.' $'  : 'Free' }}
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center pt-4 pb-2 statistic">
                        <form action="{{ route('course.leave') }}" method="post">
                            @csrf

                            <input type="hidden" name="course_id" value="{{ $lesson->course->id }}">
                            <button type="submit" class="view-all-course-button">End course</button>
                        </form>
                    </div>
                </div>
                <div class="other-courses mt-4 mb-5">
                    <div class="other-course-title py-3">Other Courses</div>
                    <div class="other-courses-list">
                        @foreach ($lesson->course->other_courses as $key => $otherCourse )
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
