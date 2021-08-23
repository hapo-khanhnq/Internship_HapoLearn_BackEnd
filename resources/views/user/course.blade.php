<div class="col-sm-6">
    <div class="course-item">
        <div class="row course-infor">
            <div class="col-3 pr-0">
                <div class="course-image">
                    @if ($course->image_path == NULL)
                        <img class="course-img" src="images/default_course_img.png" alt="default_course_image">
                    @else
                        <img class="course-img" src="{{ $course->image_path }}" alt="default_course_image">
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
                <div class="d-flex justify-content-end">
                    <a href="#" class="show-course-details-button">More</a>
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
