<div class="col-sm-6">
    <div class="course-item">
        <div class="row course-infor">
            <div class="col-3 pr-0">
                <div class="course-image">
                    @if ($course->image_path)
                    <img class="course-img" src="{{ $course->image_path }}" alt="course_image">
                    @else
                    <img class="course-img" src="{{ asset('images/default_course_img.png') }}" alt="default_course_image">
                    @endif
                </div>
            </div>
            <div class="col-9">
                <div class="course-title">
                    {{ $course->name }}
                </div>
                <div class="course-description">
                    {{ $course->description }}
                </div>
                <div class="d-flex justify-content-between">
                    <div class="star mt-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $course->average_of_rate)
                            <i class="fas fa-star">&nbsp;</i>
                            @elseif (($i - 0.5) <= $course->average_of_rate)
                            <i class="fas fa-star-half-alt">&nbsp;</i>
                            @else
                            <i class="far fa-star">&nbsp;</i>
                            @endif
                        @endfor
                    </div>
                    <a href="{{ route('course.details', $course->id) }}" class="show-course-details-button">More</a>
                </div>
            </div>
        </div>
        <div class="row course-statistic text-center">
            <div class="col-4 pb-3">
                <p class="m-0">Learners</p>
                <b>{{ $course->number_of_student }}</b>
            </div>
            <div class="col-4 pb-3">
                <p class="m-0">Lessons</p>
                <b>{{ $course->number_of_lesson }}</b>
            </div>
            <div class="col-4 pb-3">
                <p class="m-0">Time</p>
                @if ($course->learn_time < 60)
                    <b>{{ $course->learn_time }} min</b>
                @else
                    <b>{{ (int)($course->learn_time / 60) }} h {{ $course->learn_time % 60 }} min</b>
                @endif
            </div>
        </div>
    </div>
</div>
