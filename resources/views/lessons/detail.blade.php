@extends('layouts.app')

@section('content')
    @include('direction', ['courseId' => $courseId, 'lessonId' => $lessonId])
    <div class="lesson-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ $course->logo_path }}" alt="logo-course" class="logo-course">
                        </div>
                        <div class="col-12 mt-4">
                            <div class="descriptions-teacher-documents-reviews">
                                <ul class="nav nav-tabs descriptions-teacher-documents-reviews-nav-tabs" id="myTab"
                                    role="tablist">
                                    <li class="nav-item mr-lg-4 mr-md-3 mr-1">
                                        <a class="nav-link active" id="descriptions-tab" data-toggle="tab"
                                            href="#descriptions" role="tab" aria-controls="descriptions"
                                            aria-selected="true">Descriptions</a>
                                    </li>
                                    <li class="nav-item mr-lg-4 ml-lg-4 mr-md-4 ml-md-4 mr-4 ml-4">
                                        <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher"
                                            role="tab" aria-controls="teacher" aria-selected="false">Teacher</a>
                                    </li>
                                    <li class="nav-item mr-lg-4 ml-lg-4 mr-md-4 ml-md-4 mr-4 ml-4">
                                        <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents"
                                            role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                                    </li>
                                    <li class="nav-item mr-lg-4 ml-lg-4 mr-md-4 ml-md-4 mr-4 ml-4">
                                        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews"
                                            role="tab" aria-controls="Reviews" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-4 pl-2" id="lessons-teacher-reviews-contents">
                                    <div class="tab-pane fade show active" id="descriptions" role="tabpanel"
                                        aria-labelledby="lessons-tab">
                                        <div class="descriptions-lesson mb-3">
                                            <div class="lesson-tab-title mb-3">Descriptions lesson</div>
                                            <div class="lesson-tab-content">{{ $lesson->description }}</div>
                                        </div>
                                        <div class="requirements">
                                            <div class="lesson-tab-title mb-3">Requirements</div>
                                            <div class="lesson-tab-content">{{ $lesson->requirement }}</div>
                                        </div>
                                        <div class="tags-in-descriptions-tab">
                                            <span class="tags-title">Tag:</span>
                                            <div class="list-tags">
                                                @foreach ($tags as $key => $tag)
                                                    @if ($key <= 5)
                                                        <a class="tag-item"
                                                            href="{{ '/courses/search?search_form_input=&teacher=&number_of_learner=&learn_time=&number_of_lesson=&tag=' . $tag->id . '&review=' }}">
                                                            #{{ $tag->name }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                                        <div class="teacher-tab-title mb-3">
                                            Main Teachers
                                        </div>
                                        @foreach ($teachers as $teacher)
                                            @include('users._teacher', [$teacher])
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="documents" role="tabpanel"
                                        aria-labelledby="documents-tab">
                                        <div class="mt-4 mb-4 documents-tab-title">Documents</div>

                                        @foreach ($documents as $document)
                                            <div class="document-item">
                                                <span class="hidden lesson-id">{{ $lesson->id }}</span>
                                                <div class="row h-100">
                                                    <div class="col-1">
                                                        <img src="{{ asset($document->logo_path . '.png') }}" alt="doc"
                                                            class="document-img">
                                                    </div>
                                                    <div class="col-1 pl-0 pr-0">
                                                        <div class="document-description">{{ $document->type }}</div>
                                                    </div>
                                                    <div class="col-7">
                                                        <a href="{{ asset($document->file_path) }}" class="document-name"
                                                            target="_blank" data-documentId="{{ $document->id }}"
                                                            data-lessonId="{{ $lesson->id }}">
                                                            {{ $document->name }}</a>
                                                    </div>
                                                    <div class="col-1 pr-0">
                                                        <div class="float-right document-checked">
                                                            @if (!is_null($document->is_learned))
                                                                <i class="fas fa-check-circle"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="{{ asset($document->file_path) }}"
                                                            class="document-btn-preview float-md-right" target="_blank"
                                                            data-documentId="{{ $document->id }}"
                                                            data-lessonId="{{ $lesson->id }}">Preview</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                        ...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="information">
                                <div class="course">
                                    <img class="mr-2 img-information" src="{{ asset('img/course.png') }}" alt="course">
                                    <div class="sub-title">Course</div>
                                    <div class="sub-title-value">:
                                        {{ $course->title }}
                                    </div>
                                </div>
                                <div class="learners">
                                    <img class="mr-2 img-information" src="{{ asset('img/learners.png') }}"
                                        alt="learners">
                                    <div class="sub-title">Learners</div>
                                    <div class="sub-title-value" id="lesson-learners">: {{ $lesson->number_users }}</div>
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
                                                <a
                                                    href="{{ '/courses/search?search_form_input=&teacher=&number_of_learner=&learn_time=&number_of_lesson=&tag=' . $tag->id . '&review=' }}">
                                                    #{{ $tag->name }}</a>
                                            @else
                                                <a
                                                    href="{{ '/courses/search?search_form_input=&teacher=&number_of_learner=&learn_time=&number_of_lesson=&tag=' . $tag->id . '&review=' }}">
                                                    #{{ $tag->name }}</a>,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="price">
                                    <img class="mr-2 img-information" src="{{ asset('img/price.png') }}" alt="price">
                                    <div class="sub-title">Price</div>
                                    <div class="sub-title-value"><span>: {{ $course->price }}$</span></div>
                                </div>
                                <div class="progress-lesson">
                                    <div class="sub-title-progress">Progress</div>
                                    <div class="progress progress-lesson-bar">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: {{ $percentage . '%' }};" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100" id="progress-bar">
                                            {{ $percentage . '%' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="end-course">
                                    <a href="{{ route('courses.end_course', ['courseId' => $courseId]) }}"
                                        class="button-end-course">
                                        Leave course
                                    </a>
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
                                    <a href="{{ route('courses.index') }}" class="view-all-our-course">View all ours
                                        courses</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
