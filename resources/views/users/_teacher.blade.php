<div class="teacher">
    <div class="row">
        <div class="col-2 pr-0">
            <img src="{{ $teacher->avatar }}" class="img-teacher" alt="img-teacher">
        </div>
        <div class="col-9">
            <div class="d-flex h-100 flex-column justify-content-center">
                <div class="teacher-name">{{ $teacher->name }}</div>
                <div class="teacher-experience">Second Year Teacher</div>
                <div class="teacher-contact">
                    <a href="#" class="mr-1 icon-google"></a>
                    <a href="#" class="mr-1 ml-1 icon-facebook"></a>
                    <a href="#" class="ml-1 icon-slack"></a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="teacher-info">{{ $teacher->aboutMe }}</div>
        </div>
    </div>
</div>
