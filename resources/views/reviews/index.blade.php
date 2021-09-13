<div class="reviews">
    <div class="number-of-review">
        {{ count($reviews) }} reviews
    </div>
    <div class="row">
        <div class="col-4 pr-0">
            <div class="rating-overview">
                <div class="rating-overview-score">{{ $course->rating_overview_score }}</div>

                <div class="rating-overview-stars">
                    @if (is_float($course->rating_overview_score))
                        @for ($i = 0; $i < (int) $course->rating_overview_score; $i++)
                            <i class="fas fa-star"></i>
                        @endfor

                        <i class="fas fa-star-half-alt"></i>

                        @for ($i = 0; $i < 4 - (int) $course->rating_overview_score; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    @else
                        @for ($i = 0; $i < $course->rating_overview_score; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $course->rating_overview_score; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    @endif
                </div>
                <div class="total-review-count">
                    {{ count($reviews) }} ratings
                </div>
            </div>
        </div>
        <div class="col-8">
            <ul class="rating-detail">
                <li class="rating-detail-list">
                    <div class="rating-title">5 stars</div>
                    <div class="star-rating-bar">
                        <div class="progress custom-progress">
                            <div class="progress-bar custom-progress-bar"
                                style="width: {{ $course->five_stars_rate_percent . '%' }}" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <span class="detail-rating-number">{{ $course->five_stars_rate }}</span>
                </li>
                <li class="rating-detail-list">
                    <div class="rating-title">4 stars</div>
                    <div class="star-rating-bar">
                        <div class="progress custom-progress">
                            <div class="progress-bar custom-progress-bar"
                                style="width: {{ $course->four_stars_rate_percent . '%' }}" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <span class="detail-rating-number">{{ $course->four_stars_rate }}</span>
                </li>
                <li class="rating-detail-list">
                    <div class="rating-title">3 stars</div>
                    <div class="star-rating-bar">
                        <div class="progress custom-progress">
                            <div class="progress-bar custom-progress-bar"
                                style="width: {{ $course->three_stars_rate_percent . '%' }}" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <span class="detail-rating-number">{{ $course->three_stars_rate }}</span>
                </li>
                <li class="rating-detail-list">
                    <div class="rating-title">2 stars</div>
                    <div class="star-rating-bar">
                        <div class="progress custom-progress">
                            <div class="progress-bar custom-progress-bar"
                                style="width: {{ $course->two_stars_rate_percent . '%' }}" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <span class="detail-rating-number">{{ $course->two_stars_rate }}</span>
                </li>
                <li class="rating-detail-list">
                    <div class="rating-title">1 star</div>
                    <div class="star-rating-bar">
                        <div class="progress custom-progress">
                            <div class="progress-bar custom-progress-bar"
                                style="width: {{ $course->one_star_rate_percent . '%' }}" role="progressbar"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <span class="detail-rating-number">{{ $course->one_star_rate }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="mod-reviews">
        <div>
            <div class="show-all-reivews">Show all reviews <i class="fas fa-sort-down"></i></div>
        </div>
        <div class="reviews-list">
            @foreach ($reviews as $review)
                <div class="item-reivew">
                    <div class="item-reivew-top">
                        <img class="user-avatar" src="{{ asset($review->user->avatar) }}" alt="avatar">
                        <div class="user-name">{{ $review->user->name }}</div>
                        <div class="rating">
                            @for ($i = 1; $i <= $review->rate; $i++)
                                <i class="fas fa-star mr-1 ml-1"></i>
                            @endfor
                        </div>
                        <div class="timestamp">
                            {{ $review->comment_time }}
                        </div>
                    </div>
                    <div class="item-review-middle">
                        {{ $review->content }}
                    </div>
                    <div class="item-review-bottom">
                        <button class="btn-reply" type="button" data-toggle="collapse"
                            data-target="{{ '#review-' . $review->id }}" aria-expanded="false"
                            aria-controls="collapseExample">
                            Reply
                        </button>
                        <div class="collapse mt-4" id="{{ 'review-' . $review->id }}">
                            <div class="card card-body">
                                <form method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label for="write-comment" class="title-box-comment">Reply</label>
                                        <textarea class="form-control write-reply" name="write_reply" rows="5"
                                            required></textarea>
                                    </div>

                                    <input type="hidden" name="userId" class="user-id"
                                        value="{{ Auth::id() }}">
                                    <input type="hidden" name="reviewId" class="review-id"
                                        value="{{ $review->id }}">

                                    <div class="float-right d-flex">
                                        <div id="btn-close-reply" class="btn-close-reply">Close</div>
                                        <button type="submit" class="btn-send-reply ml-2">Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="replies-list">
                        @if (count($review->replies) > 0)
                            @foreach ($review->replies as $reply)
                                <div class="reply">
                                    <div class="item-reply-top">
                                        <img class="user-avatar" src="{{ asset($reply->user->avatar) }}"
                                            alt="avatar">
                                        <div class="user-name">{{ $reply->user->name }}</div>
                                        <div class="timestamp">
                                            {{ $reply->reply_time }}
                                        </div>
                                    </div>
                                    <div class="item-reply-middle">
                                        {{ $reply->content }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="leave-a-review-div">
        <div class="leave-a-review-txt">Leave a Review</div>
        <form action="" method="post" class="pb-5">
            @csrf

            <div class="form-group">
                <label for="write-comment" class="title-box-comment">Message</label>
                <textarea class="form-control" name="write_comment" id="write-comment" class="write-comment" rows="5"
                    required></textarea>
            </div>

            <div class="d-flex">
                <span class="vote-txt">Vote</span>
                <div class="pick-rate ml-3 mr-3">
                    <input type="radio" name="rate" id="star-1" class="hidden" value="1" required>
                    <label for="star-1" id="star-label-1" data-star="1"><i class="fas fa-star mr-1 ml-1"></i></label>
                    <input type="radio" name="rate" id="star-2" class="hidden" value="2">
                    <label for="star-2" id="star-label-2" data-star="2"><i class="fas fa-star mr-1 ml-1"></i></label>
                    <input type="radio" name="rate" id="star-3" class="hidden" value="3">
                    <label for="star-3" id="star-label-3" data-star="3"><i class="fas fa-star mr-1 ml-1"></i></label>
                    <input type="radio" name="rate" id="star-4" class="hidden" value="4">
                    <label for="star-4" id="star-label-4" data-star="4"><i class="fas fa-star mr-1 ml-1"></i></label>
                    <input type="radio" name="rate" id="star-5" class="hidden" value="5">
                    <label for="star-5" id="star-label-5" data-star="5"><i class="fas fa-star mr-1 ml-1"></i></label>
                </div>

                <span class="stars-txt">(stars)</span>
            </div>
            <div class="vote-alert vote-alert-hide">You have to vote</div>
            <input type="hidden" name="courseId" id="review-course-id" value="{{ $courseId }}">
            <input type="hidden" name="lessonId" id="review-lesson-id">
            <input type="hidden" name="userId" id="review-user-id" value="{{ Auth::id() }}">

            <button type="submit" id="send-review" class="btn-send">Send</button>
        </form>
    </div>
</div>
