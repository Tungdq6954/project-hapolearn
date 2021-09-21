<div class="list-of-lesson-item">
    <div class="row h-100">
        @if (Auth::guest())
            <div class="col-lg-12">
                <a href="#" class="lesson-title">{{ $key + 1 }}. {{ $lesson->title }}</a>
            </div>

        @elseif (!Auth::guest() && isset($isJoinedCourse) && $isJoinedCourse)
            <div class="col-md-9">
                <a href="{{ route('lessons.detail', ['courseId' => $courseId, 'lessonId' => $lesson]) }}"
                    class="lesson-title" id="lesson-title" data-lessonId="{{ $lesson->id }}">{{ $key + 1 }}.
                    {{ $lesson->title }}</a>
            </div>
            <div class="col-md-1 pr-0">
                @if ($lesson->progress == 100 && isset($lesson->progress))
                    <div class="float-right lesson-checked">
                        <i class="fas fa-check-circle"></i>
                    </div>
                @elseif ($lesson->progress > 0 && isset($lesson->progress))
                    <div class="progress mt-3">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width: {{ $lesson->progress . '%' }}" aria-valuenow="10" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                @endif
            </div>
            <div class="col-md-2">
                <a href="{{ route('lessons.detail', ['courseId' => $courseId, 'lessonId' => $lesson]) }}"
                    class="float-lg-right button-learn-lesson" id="button-learn-lesson">Learn</a>
            </div>
        @else
            <div class="col-lg-10">
                <div href="#" class="lesson-title">{{ $key + 1 }}. {{ $lesson->title }}</div>
            </div>
        @endguest
    </div>
</div>
