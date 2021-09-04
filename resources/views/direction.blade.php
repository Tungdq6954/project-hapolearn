<div class="direction">
    <div class="container direction-txt">
        <span>
            <a href="{{ route('home') }}">Home</a>
            >
            <a href="{{ route('courses.index') }}">All courses</a>
            >
            @if (isset($courseId))
                <a href="{{ route('courses.detail', $courseId) }}">Course detail</a>
            @endif
            @if (isset($lessonId))
                >
                <a href="{{ route('lessons.detail', ['courseId' => $courseId, 'lessonId' => $lessonId]) }}">Lesson detail</a>
            @endif
        </span>
    </div>
</div>
