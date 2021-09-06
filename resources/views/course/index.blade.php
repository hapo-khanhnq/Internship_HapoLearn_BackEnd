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
                            <input type="radio" hidden id="latest" name="filter_status" value="{{ config('variables.filter_status.latest') }}" checked>
                            <label for="latest" class="filter-status d-flex d-flex align-items-center justify-content-center">Latest</label>
                        </div>
                        <div class="form-group mx-1">
                            <input type="radio" hidden id="oldest" name="filter_status" value="{{ config('variables.filter_status.oldest') }}" @if (request('filter_status') == config('variables.filter_status.oldest')) checked @endif>
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
                                <option value="asc"  @if (request('number_of_learner') == config('variables.order_by.asc')) selected @endif>Ascending</option>
                                <option value="desc" @if (request('number_of_learner') == config('variables.order_by.desc')) selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="learn_time" id="time" class="filter-select-menu">
                                <option value="" selected>Learn time</option>
                                <option value="asc" @if (request('learn_time') == config('variables.order_by.asc')) selected @endif>Ascending</option>
                                <option value="desc" @if (request('learn_time') == config('variables.order_by.desc')) selected @endif>Decrease</option>
                            </select>
                        </div>
                        <div class="form-group mx-1">
                            <select name="number_of_lesson" id="lesson" class="filter-select-menu">
                                <option value="" selected>Number Of Lesson</option>
                                <option value="asc" @if (request('number_of_lesson') == config('variables.order_by.asc')) selected @endif>Ascending</option>
                                <option value="desc" @if (request('number_of_lesson') == config('variables.order_by.desc')) selected @endif>Decrease</option>
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
                                <option value="asc" @if (request('rating') == config('variables.order_y.asc')) selected @endif>Ascending</option>
                                <option value="desc" @if (request('rating') == config('variables.order_by.desc')) selected @endif>Decrease</option>
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
            @include('course._course', $course)
            @endforeach
        </div>
        {{ $courses->appends($_GET)->links('user.pagination') }}
    </div>
</section>
@endsection
