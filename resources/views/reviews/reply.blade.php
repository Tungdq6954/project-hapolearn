<div class="reply" id="{{ 'item-reply-' . $reply->id }}">
    <div class="item-reply-top">
        <img class="user-avatar" src="{{ asset($reply->user->avatar) }}" alt="avatar">
        <div class="user-name">{{ $reply->user->name }}</div>
        <div class="timestamp">
            {{ $reply->reply_time }}
        </div>
        @if ($reply->user_id == Auth::id())
            <div class="dropdown reply-option-dropdown">
                <button class="reply-option-dropdown-button" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item btn-edit-reply" data-reply-id="{{ $reply->id }}" href="#">Edit</a>
                    <a class="dropdown-item btn-remove-reply" data-toggle="modal"
                        data-target="{{ '#confirm-delete-reply-' . $reply->id }}" href="#">Remove</a>
                </div>
            </div>
        @endif
    </div>
    <div class="item-reply-middle">
        <div id="{{ 'reply-content-box-' . $reply->id }}">
            <span class="reply-content" id="{{ 'reply-content-' . $reply->id }}">{{ $reply->content }}</span>
            <span class="edited-alert @if ($reply->edit != config('constants.is_edited')) hidden @endif"
                id="{{ 'edited-alert-' . $reply->id }}">(edited)</span>
        </div>
        <div class="card card-body edit-reply-card hidden" id="{{ 'edit-reply-card-' . $reply->id }}">
            <form method="post">
                @csrf

                <div class="form-group">
                    <label for="edit-reply" class="title-box-reply">Edit reply</label>
                    <textarea class="form-control edit-reply" id="{{ 'edit-reply-' . $reply->id }}" name="edit_reply"
                        rows="5" required>{{ $reply->content }}</textarea>
                </div>
                <div class="float-right d-flex">
                    <div class="btn-close-reply-edit" data-reply-id="{{ $reply->id }}">Close</div>
                    <button type="submit" class="ml-2 btn-send-reply-edit" data-reply-id="{{ $reply->id }}"
                        data-user-id="{{ $reply->user_id }}" data-review-id="{{ $review->id }}">Edit</button>
                </div>
            </form>
        </div>
    </div>

    @include('components.confirm', ['reply' => $reply, 'action' => 'delete reply'])
</div>
