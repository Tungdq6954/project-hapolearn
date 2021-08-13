@extends('layouts.app')

@section('content')
<div id="body" class="container-fluid p-0 position-relative body">
    <div class="hapo-learn-banner">
        <div class="background-hapo-learn-banner"></div>
        <div class="container d-flex flex-column justify-content-center content-of-hapo-learn-banner">
            <div class="pl-lg-4">
                <span class="d-block hapo-learn-title">Learn Anytime, Anywhere</span>
                <span class="d-block hapo-learn-subtitle">at HapoLearn <img class="hapo-logo" src="{{ asset('img/hapo_logo.png') }}" alt="hapo_logo"> !</span>
                <span class="d-block hapo-learn-content">Interactive lessons, "on-the-go" <br> practice, peer
                    support.</span>
                <a href="#" class="d-block mt-2 button-hapo-learn-banner">
                    Start Learning Now!
                </a>
            </div>
        </div>
        <div class="background-linear-gradient"></div>
    </div>

    <!-- messenger -->
    <img class="logo-messenger" alt="logo-messenger" src="{{ asset('img/messenger.png') }}"></img>
    <div class="chatbox chatbox-appear">
        <div class="close-button"><i class="fas fa-times"></i></div>
        <div class="hapolearn-txt-in-chatbox">HapoLearn</div>
        <div class="message-from-hapolearn">
            <div class="hapo-logo-in-message"></div>
            <div class="hapo-text-message">HapoLearn xin chào bạn. <br>
                Bạn có cần chúng tôi hỗ trợ gì không? </div>
        </div>
        <a href="#" class="button-messenger"><i class="fab fa-facebook-messenger custom-icon-facebook-messenger mr-2"></i> Đăng nhập vào
            Messenger</a>
        <div class="chat-with-hapolearn-in-messenger-txt">Chat với HapoLearn trong Messenger</div>
    </div>

    <div class="container main-courses">
        <div class="row mb-0 mr-0 ml-0 custom-card-row">
            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/rectangle_7.png') }}" class="card-img-top img-frontend-course" alt="fontend">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">HTML/CSS/js Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and
                            CSS before
                            entering New Media. I had coded quite a bit, but never touched anything in regards
                            to web development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/laravel_1_logo_black_and_white_1.png') }}" class="card-img-top img-laravel-course" alt="laravel">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">Laravel Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and
                            CSS before
                            entering New Media. I had coded quite a bit, but never touched anything in regards
                            to web development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/rectangle_15.png') }}" class="card-img-top img-php-course" alt="php">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">PHP Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and
                            CSS before
                            entering New Media. I had coded quite a bit, but never touched anything in regards
                            to web development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="img-laptop-ipad-iphone-coffee"></div>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column align-items-center p-0 feedback">
        <div class="feedback-titile">Feedback</div>
        <div class="feedback-content">What other students turned professionals have to say about us after
            learning with us and reaching their goals</div>
        <div class="mt-lg-4 mt-md-2 feedback-slide">
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Hoang Anh Nguyen</div>
                        <div class="customer-languge">PHP</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Tuan Tran Hoang</div>
                        <div class="customer-languge">Python</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Hoang Anh Nguyen</div>
                        <div class="customer-languge">PHP</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid become-a-member">
        <div class="become-a-member-tilte">Become a member of our
            growing community!</div>
        <a href="#" class="become-a-member-button">Start Learning Now!</a>
    </div>

    <div class="container-fluid statistic p-0">
        <div class="statistic-title">Statistic</div>
        <div class="row w-100 m-0 mt-4">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Courses</span>
                <span class="statistic-number">1,586</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex  flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Lessons</span>
                <span class="statistic-number">2,689</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex  flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Learners</span>
                <span class="statistic-number">16,882</span>
            </div>
        </div>
    </div>

    <div class="container other-courses">
        <div class="d-flex justify-content-center">
            <div class="heading-other-courses">Other courses</div>
        </div>
        <div class="row mb-0 mr-0 ml-0 custom-card-row">
            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/css_course.png') }}" class="card-img-top css-course" alt="css">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">CSS Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and CSS before entering
                            New Media. I had coded quite a bit, but never touched anything in regards to web
                            development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/rails_course.png') }}" class="card-img-top rails-course" alt="laravel">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">Ruby on rails Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and CSS before entering
                            New Media. I had coded quite a bit, but never touched anything in regards to web
                            development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-4 p-sm-0 d-flex justify-content-center">
                <div class="card custom-card-style">
                    <img src="{{ asset('img/java_1.png') }}" class="card-img-top java-course" alt="php">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-center title-course">Java Tutorial</div>
                        <div class="content-course">I knew hardly anything about HTML, JS, and CSS before entering
                            New Media. I had coded quite a bit, but never touched anything in regards to web
                            development.</div>
                        <a href="#" class="ml-auto mr-auto button-course">Take This Course</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a class="view-all-courses" href="#">
                View All Our Courses <img class="right-arrow" src="{{ asset('img/right_arrow.png') }}" alt="right_arrow">
            </a>
        </div>
    </div>

    <div class="p-0 why-hapolearn">
        <div class="img-laptop"></div>
        <div class="row m-0 d-flex align-items-center w-100 h-100">
            <div class="col-sm-6 d-flex flex-column align-items-end">
                <div class="title-why-hapolearn">Why HapoLearn?</div>
                <div class="reasons-for-why-hapolearn">
                    <span class="each-reason"><i class="fas fa-check-circle mr-2"></i> Interactive lessons,
                        "on-the-go"
                        practice, peer support.</span>
                    <span class="each-reason"><i class="fas fa-check-circle mr-2"></i> Interactive lessons,
                        "on-the-go"
                        practice, peer support.</span>
                    <span class="each-reason"><i class="fas fa-check-circle mr-2"></i> Interactive lessons,
                        "on-the-go"
                        practice, peer support.</span>
                    <span class="each-reason"><i class="fas fa-check-circle mr-2"></i> Interactive lessons,
                        "on-the-go"
                        practice, peer support.</span>
                    <span class="each-reason"><i class="fas fa-check-circle mr-2"></i> Interactive lessons,
                        "on-the-go"
                        practice, peer support.</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="img-laptop-ipad-iphone-coffee"></div>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column align-items-center p-0 feedback">
        <div class="feedback-titile">Feedback</div>
        <div class="feedback-content">What other students turned professionals have to say about us after
            learning with us and reaching their goals</div>
        <div class="mt-lg-4 mt-md-2 feedback-slide">
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Hoang Anh Nguyen</div>
                        <div class="customer-languge">PHP</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Tuan Tran Hoang</div>
                        <div class="customer-languge">Python</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-sm-3 comment-div">
                <div class="comment">
                    <p class="comment-text">
                        “A wonderful course on how to start. Eddie beautifully conveys all
                        essentials of a becoming a good Angular developer. Very glad to have taken this course.
                        Thank you Eddie Bryan.”
                    </p>
                </div>
                <div class="bottom-arrow"></div>
                <div class="mt-3 customer">
                    <div class="customer-avatar"></div>
                    <div class="ml-3">
                        <div class="customer-name">Hoang Anh Nguyen</div>
                        <div class="customer-languge">PHP</div>
                        <div class="customer-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid become-a-member">
        <div class="become-a-member-tilte">Become a member of our
            growing community!</div>
        <a href="#" class="become-a-member-button">Start Learning Now!</a>
    </div>

    <div class="container-fluid statistic p-0">
        <div class="statistic-title">Statistic</div>
        <div class="row w-100 m-0 mt-4">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Courses</span>
                <span class="statistic-number">1,586</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex  flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Lessons</span>
                <span class="statistic-number">2,689</span>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex  flex-column justify-content-center align-items-center">
                <span class="statistic-subtitle">Learners</span>
                <span class="statistic-number">16,882</span>
            </div>
        </div>
    </div>
</div>
@endsection
