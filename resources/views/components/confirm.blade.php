@if ($action == 'delete review')
    <div class="modal fade" id="{{ 'confirm-delete-review-' . $review->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    @elseif ($action == 'delete reply')
        <div class="modal fade" id="{{ 'confirm-delete-reply-' . $reply->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
@endif
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete review</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if ($action == 'delete review')
                Are you sure you want to delete this review?
            @elseif ($action == 'delete reply')
                Are you sure you want to delete this reply?
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-close-confirm" data-dismiss="modal">Cancel</button>

            @if ($action == 'delete review')
                <button type="button" class="btn btn-primary btn-confirm-delete-review"
                    id="{{ 'btn-confirm-delete-' . $review->id }}" data-review-id="{{ $review->id }}"
                    data-dismiss="modal">Delete</button>
            @elseif ($action == 'delete reply')
                <button type="button" class="btn btn-primary btn-confirm-delete-reply"
                    id="{{ 'btn-confirm-delete-' . $reply->id }}" data-reply-id="{{ $reply->id }}"
                    data-dismiss="modal">Delete</button>
            @endif

        </div>
    </div>
</div>
</div>
