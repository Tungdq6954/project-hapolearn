@foreach ($reviews as $key => $review)
    @if ($key < 3)
        <div class="item-reivew" id="{{ 'item-review-' . $review->id }}">
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
                @if ($review->user_id == Auth::id())
                    <div class="dropdown comment-option-dropdown">
                        <button class="comment-option-dropdown-button" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item btn-edit-review" data-review-id="{{ $review->id }}"
                                href="#">Edit</a>
                            <a class="dropdown-item btn-remove-review" data-toggle="modal"
                                data-target="{{ '#confirm-delete-review-' . $review->id }}" href="#">Remove</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="item-review-middle">
                <div id="{{ 'review-content-box-' . $review->id }}">
                    <span class="review-content"
                        id="{{ 'review-content-' . $review->id }}">{{ $review->content }}</span>
                    <span class="edited-alert @if ($review->edit != config('constants.is_edited')) hidden @endif"
                        id="{{ 'edited-alert-' . $review->id }}">(edited)</span>
                </div>
                <div class="card card-body edit-review-card hidden" id="{{ 'edit-review-card-' . $review->id }}">
                    <form method="post">
                        @csrf

                        <div class="form-group">
                            <label for="edit-comment" class="title-box-comment">Edit comment</label>
                            <textarea class="form-control edit-comment" id="{{ 'edit-comment-' . $review->id }}"
                                name="edit_comment" rows="5" required>{{ $review->content }}</textarea>
                        </div>
                        <div class="float-right d-flex">
                            <div class="btn-close-review-edit" data-review-id="{{ $review->id }}">Close</div>
                            <button type="submit" class="ml-2 btn-send-review-edit"
                                data-review-id="{{ $review->id }}" data-user-id="{{ $review->user_id }}"
                                data-course-id="{{ $review->course_id }}">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-review-bottom">
                @if (Auth::check())
                    <button class="btn-reply" id="{{ 'btn-reply-' . $review->id }}" type="button"
                        data-toggle="collapse" data-target="{{ '#review-' . $review->id }}" aria-expanded="false"
                        aria-controls="collapseExample">
                        Reply
                    </button>
                @endif

                <div class="collapse mt-4" id="{{ 'review-' . $review->id }}">
                    <div class="card card-body">
                        <form method="post">
                            @csrf

                            <div class="form-group">
                                <label for="write-comment" class="title-box-comment">Reply</label>
                                <textarea class="form-control write-reply" id="{{ 'write-reply-' . $review->id }}"
                                    name="write_reply" rows="5" required></textarea>
                            </div>

                            <input type="hidden" name="userId" class="user-id" value="{{ Auth::id() }}">
                            <input type="hidden" name="reviewId" class="review-id" value="{{ $review->id }}">

                            <div class="float-right d-flex">
                                <div class="btn-close-reply" data-review-id="{{ $review->id }}">Close</div>
                                <button type="submit" data-user-id="{{ Auth::id() }}"
                                    data-review-id="{{ $review->id }}" class="btn-send-reply ml-2">Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="replies-list" id="{{ 'replies-list-' . $review->id }}">
                @if (count($review->replies) > 0)
                    @foreach ($review->replies as $reply)
                        @include('reviews.reply', ['reply' => $reply, 'review' => $review])
                    @endforeach
                @endif
            </div>
        </div>
        @include('components.confirm', ['review' => $review, 'action' => 'delete review'])
    @endif
@endforeach
