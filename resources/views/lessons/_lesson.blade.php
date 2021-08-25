<div class="list-of-lesson-item">
    <div class="row h-100">
        @if (Auth::guest())
            <div class="col-lg-12">
                <a href="#" class="lesson-title">{{ $key + 1 }}. {{ $lesson->title }}</a>
            </div>

        @elseif (!Auth::guest() && isset($isJoinedCourse) && $isJoinedCourse)
            <div class="col-lg-8">
                <a href="#" class="lesson-title">{{ $key + 1 }}. {{ $lesson->title }}</a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="float-lg-right button-learn-lesson">Learn</a>
            </div>
        @else
            <div class="col-lg-8">
                <a href="#" class="lesson-title">{{ $key + 1 }}. {{ $lesson->title }}</a>
            </div>
        @endguest
    </div>
</div>
