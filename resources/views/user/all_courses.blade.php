@extends('layouts.app')

@section('content')
<section class="all-courses-section">
    <div class="all-courses-search container p-0 mb-3">
        <form action="{{ route('courses.search') }}" method="get">
            @csrf
            <div class="d-flex flex-row">
                <a class="filter-button" data-toggle="collapse" href="#collapseFilterMenu" role="button" aria-expanded="false" aria-controls="collapseFilterMenu"><img src="{{ asset('images/filter_icon.png') }}" alt="Filter icon" class="filter-icon">&nbsp;Filter</a>
                <div class="form-search-input">
                    <input type="text" class="search-input" name="keyword" placeholder="Search..." @if (isset($keyword)) value="{{ $keyword }}" @endif>
                    <i class="fas fa-search search-icon"></i>
                </div>
                <button type="submit" class="search-button">
                    Search
                </button>
            </div>
            <div class="collapse container mt-4" id="collapseFilterMenu">
                <div class="filter-courses row pt-3">
                    <div class="col-1">
                        <p class="filter-by mb-0 mt-1">Filter by</p>
                    </div>
                    <div class="col-11 d-flex flex-wrap">
                        <div class="form-group mx-1">
                            <input type="radio" hidden id="latest" name="filter_status" value="{{ config('variables.filterStatus.latest') }}" checked>
                            <label for="latest" class="filter-status d-flex d-flex align-items-center justify-content-center">Latest</label>
                        </div>
                        <div class="form-group mx-1">
                            <input type="radio" hidden id="oldest" name="filter_status" value="{{ config('variables.filterStatus.oldest') }}" @if (request('filter_status') == config('variables.filterStatus.oldest')) checked @endif>
                            <label for="oldest" class="filter-status d-flex d-flex align-items-center justify-content-center">Oldest</label>
                        </div>
                        <div class="form-group mx-1">
                            <select class="filter-select2-menu" name="teacher" id="teacher">
                                <option value="">Teacher</option>
                                @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @if (request('teacher') == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="number_of_learner" id="learner" class="filter-select-menu">
                                <option value="" selected>Number Of Learner</option>
                                <option value="asc"  @if (request('number_of_learner') == 'asc') selected @endif>Ascending</option>
                                <option value="desc" @if (request('number_of_learner') == 'desc') selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="learn_time" id="time" class="filter-select-menu">
                                <option value="" selected>Learn time</option>
                                <option value="asc" @if (request('learn_time') == 'asc') selected @endif>Ascending</option>
                                <option value="desc" @if (request('learn_time') == 'desc') selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="number_of_lesson" id="lesson" class="filter-select-menu">
                                <option value="" selected>Number Of Lesson</option>
                                <option value="asc" @if (request('number_of_lesson') == 'asc') selected @endif>Ascending</option>
                                <option value="desc" @if (request('number_of_lesson') == 'desc') selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select class="filter-select2-menu" name="tag" id="tag">
                                <option value="">Tags</option>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" @if (request('tag') == $tag->id) selected @endif>#{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="rating" id="review" class="filter-select-menu">
                                <option value="" selected>Review</option>
                                <option value="asc" @if (request('rating') == 'asc') selected @endif>Ascending</option>
                                <option value="desc" @if (request('rating') == 'desc') selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <label for="clearFilter" class="filter-clear d-flex d-flex align-items-center justify-content-center" id="clearFilter">Clear</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container p-0 all-courses-container">
        <div class="row">
            @foreach ($courses as $course)
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
            @endforeach
        </div>
        {{ $courses->appends($_GET)->links('user.pagination') }}
    </div>
</section>
@endsection
