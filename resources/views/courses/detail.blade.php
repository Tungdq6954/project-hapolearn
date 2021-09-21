@extends('layouts.app')

@section('content')
    @include('direction', [$courseId])
    <div class="course-detail">
        <div class="container">
            <div class="row p-0">
                <div class="col-8">
                    <img src="{{ $course->logo_path }}" alt="logo-course" class="logo-course">
                </div>
                <div class="col-4">
                    <div class="descriptions-course">
                        <div class="title-of-descriptions-course">Descriptions course</div>
                        <div class="content-of-descriptions-course">{{ $course->description }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row p-0 mt-5">
                <div class="col-md-8">
                    <div class="lessons-teacher-reviews">
                        <ul class="nav nav-tabs lessons-teacher-reviews-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item mr-lg-4 mr-md-3 mr-1">
                                <a class="nav-link active" id="lessons-tab" data-toggle="tab" href="#lessons" role="tab"
                                    aria-controls="Lessons" aria-selected="true">Lessons</a>
                            </li>
                            <li class="nav-item mr-lg-4 ml-lg-4 mr-md-4 ml-md-4 mr-4 ml-4">
                                <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab"
                                    aria-controls="teacher" aria-selected="false">Teacher</a>
                            </li>
                            <li class="nav-item mr-lg-4 ml-lg-4 mr-md-4 ml-md-4 mr-4 ml-4">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                                    aria-controls="Reviews" aria-selected="false">Reviews</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="lessons-teacher-reviews-contents">
                            <div class="tab-pane fade pl-2 show active" id="lessons" role="tabpanel"
                                aria-labelledby="lessons-tab">
                                <div class="lessons-toolbar mb-4">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-12">
                                            <form method="get" action="{{ route('courses.search_lesson', $courseId) }}"
                                                class="search-form">
                                                @csrf
                                                <div class="d-flex">
                                                    <input type="text" name="search_form_input" id="search-form-input"
                                                        placeholder="Search..." class="search-form-input"
                                                        @if (isset($keyword)) value="{{ $keyword }}" @endif>
                                                    <div class="search-form-img"><i class="fas fa-search"></i></div>

                                                    <button type="submit" class="search-button">Tìm kiếm</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-lg-1 col-md-12"></div>

                                        <div class="col-lg-4 col-md-12 mt-lg-0 mt-md-3">
                                            @if (isset($isJoinedCourse) && $isJoinedCourse)
                                                <div class="joined-course" id="joined-course">Joined</div>
                                            @else
                                                <form method="get"
                                                    action="{{ route('courses.join_course', [$courseId]) }}">
                                                    @csrf
                                                    <button type="submit" class="join-course" id="join-course">Join
                                                        course</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="list-of-lessons">
                                    @foreach ($lessons as $key => $lesson)
                                        @include('lessons._lesson', [$key, $lesson, $courseId])
                                    @endforeach
                                </div>

                                <div class="container mt-5 pagination-custom d-flex justify-content-end">
                                    {{ $lessons->appends($_GET)->links('pagination') }}
                                </div>
                            </div>
                            <div class="tab-pane fade pl-2" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                                <div class="teacher-tab-title mb-3">
                                    Main Teachers
                                </div>
                                @foreach ($teachers as $teacher)
                                    @include('users._teacher', [$teacher])
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                @include('reviews.index')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="row p-0">
                        <div class="col-12">
                            <div class="information">
                                <div class="learners">
                                    <img class="mr-2 img-information" src="{{ asset('img/learners.png') }}"
                                        alt="learners">
                                    <div class="sub-title">Learners</div>
                                    <div class="sub-title-value">: {{ $course->number_user }}</div>
                                </div>
                                <div class="lessons">
                                    <img class="mr-2 img-information" src="{{ asset('img/lessons.png') }}" alt="lessons">
                                    <div class="sub-title">Lessons</div>
                                    <div class="sub-title-value">: {{ $course->number_lesson }} lesson</div>
                                </div>
                                <div class="times">
                                    <img class="mr-2 img-information" src="{{ asset('img/times.png') }}" alt="times">
                                    <div class="sub-title">Times</div>
                                    <div class="sub-title-value">: {{ $course->learn_time }} hours</div>
                                </div>
                                <div class="tags">
                                    <img class="mr-2 img-information" src="{{ asset('img/tags.png') }}" alt="tags">
                                    <div class="sub-title">Tags</div>
                                    <div class="sub-title-value-tags">:
                                        @foreach ($tags as $key => $tag)
                                            @if ($key == count($tags) - 1)
                                                <a href="#"> #{{ $tag->name }}</a>
                                            @else
                                                <a href="#"> #{{ $tag->name }}</a>,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="price">
                                    <img class="mr-2 img-information" src="{{ asset('img/price.png') }}" alt="price">
                                    <div class="sub-title">Price</div>
                                    <div class="sub-title-value"><span>: {{ $course->price }}$</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="other-course-suggest">
                                <div class="other-course-title">Other Courses</div>
                                <div class="list-other-course-suggest">
                                    @foreach ($otherCourses as $key => $otherCourse)
                                        <a href="{{ route('courses.detail', ['courseId' => $otherCourse->id]) }}"
                                            class="a-course">
                                            {{ $key + 1 }}. {{ $otherCourse->title }}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('courses.index') }}" class="view-all-our-course">
                                        View all ours courses
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
