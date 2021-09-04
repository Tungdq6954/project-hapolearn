@extends('layouts.app')

@section('content')

    <div class="all-courses">
        <!-- toolbar -->
        <div class="container toolbar">
            <form method="get" action="{{ route('courses.search') }}" class="search-form">
                <div class="d-flex">
                    <a class="filter-button" id="filter-button" data-toggle="collapse" href="#filter-collapse"
                        role="button">
                        <img src=" {{ asset('img/filter.png') }}" alt="filter" class="filter-img">
                        <span class="filter-txt">Filter</span>
                    </a>

                    <input type="text" name="search_form_input" id="search-form-input" placeholder="Search..."
                        class="search-form-input" @if (isset($keyword)) value="{{ $keyword }}" @endif>
                    <div class="search-form-img"><i class="fas fa-search"></i></div>

                    <button type="submit" class="search-button">Tìm kiếm</button>
                </div>

                <div class="collapse mt-3 filter-collapse" id="filter-collapse">
                    <div class="filter-collapse-body">
                        <div class="row p-0 font-weight-bold text-secondary">
                            <div class="col-lg-1 p-lg-0 filter-subtitle">Lọc theo</div>

                            <div class="col-lg-2 col-md-4 p-lg-0 newest-oldest-radio" id="newest-oldest-radio">
                                <input type="radio" id="radio-newest" name="newest_oldest"
                                    value="config('constants.options.newest')"
                                    {{ request('newest_oldest') == "config('constants.options.newest')" ? 'checked' : '' }}>
                                <label for="radio-newest">Mới nhất</label>

                                <input type="radio" id="radio-oldest" name="newest_oldest"
                                    value="config('constants.options.oldest')"
                                    {{ request('newest_oldest') == "config('constants.options.oldest')" ? 'checked' : '' }}>
                                <label for="radio-oldest" class="float-lg-right">Cũ nhất</label>
                            </div>

                            <div class="col-lg-2 col-md-4 pr-lg-0 form-group">
                                <select class="form-control select-teacher" id="select-teacher" name="teacher"
                                    style="width: 100%">
                                    <option value="">Teacher</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if ($teacher->id == request('teacher')) selected @endif>{{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-4 pr-lg-0 form-group">
                                <select class="form-control select-number-of-learner" id="select-number-of-learner"
                                    name="number_of_learner" style="width: 100%">
                                    <option value="">Số người học</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('number_of_learner') == config('constants.options.asc')) selected @endif>Tăng
                                        dần</option>
                                    <option value="{{ config('constants.options.desc') }}" @if (request('number_of_learner') == config('constants.options.desc')) selected @endif>Giảm
                                        dần</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-6 pr-lg-0 form-group">
                                <select class="form-control select-learn-time" id="select-learn-time" name="learn_time"
                                    style="width: 100%">
                                    <option value="">Thời gian học</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('learn_time') == config('constants.options.asc')) selected @endif>Tăng
                                        dần</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('learn_time') == config('constants.options.desc')) selected @endif>Giảm
                                        dần</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-6 pr-lg-0 form-group">
                                <select class="form-control select-number-of-lesson" id="select-number-of-lesson"
                                    name="number_of_lesson" style="width: 100%">
                                    <option value="">Số bài học</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('number_of_lesson') == config('constants.options.asc')) selected @endif>Tăng
                                        dần</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('number_of_lesson') == config('constants.options.desc')) selected @endif>Giảm
                                        dần</option>
                                </select>
                            </div>
                        </div>

                        <div class="font-weight-bold text-secondary row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-2 col-md-6 pl-lg-0 form-group">
                                <select class="form-control select-tag" id="select-tag" name="tag" style="width: 100%">
                                    <option value="">Tags</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" @if ($tag->id == request('tag')) selected @endif>{{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 pl-lg-0 form-group">
                                <select class="form-control select-review" id="select-review" name="review"
                                    style="width: 100%">
                                    <option value="">Review</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('review') == config('constants.options.asc')) selected @endif>Tăng
                                        dần</option>
                                    <option value="{{ config('constants.options.asc') }}" @if (request('review') == config('constants.options.desc')) selected @endif>Giảm
                                        dần</option>
                                </select>
                            </div>
                            <div class="col-lg-2 pl-lg-0">
                                <div class="reset-filter" id="reset-filter">reset</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- list course -->
        <div class="container list-courses">
            <div class="row m-0">
                @foreach ($courses as $course)
                    @include('courses._course', $course)
                @endforeach
            </div>
        </div>

        <!-- pagging -->
        <div class="container mt-5 pagination-custom d-flex justify-content-end">
            {{ $courses->appends($_GET)->links('pagination') }}
        </div>
    </div>

@endsection
