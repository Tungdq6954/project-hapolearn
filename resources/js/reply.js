$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $(document).on('click', '.btn-close-reply', function () {
    let reviewId = $(this).data('review-id');
    $('#review-' + reviewId).removeClass('show');
    $('#btn-reply-' + reviewId).addClass('collapsed');
    $('#write-reply-' + reviewId).val('');
  });

  $(document).on('click', '.btn-send-reply', function (e) {
    e.preventDefault();
    var thisButton = $(this);
    var reviewId = $(this).data('review-id');
    console.log(thisButton);

    $.ajax({
      type: "post",
      url: "/replies/store",
      data: {
        'userId': $(thisButton).data('user-id'),
        'write_reply': $('#write-reply-' + reviewId).val(),
        'reviewId': $(thisButton).data('review-id'),
      },
      dataType: "json",
      success: function (response) {
        $('#replies-list-' + reviewId).append(
          `<div class="reply" id="item-reply-` + response.replyId + `">
          <div class="item-reply-top">
              <img class="user-avatar" src="`+ response.avatar + `" alt="avatar">
              <div class="user-name">`+ response.username + `</div>
              <div class="timestamp">
                  `+ response.timestamp + `
              </div>
                  <div class="dropdown reply-option-dropdown">
                      <button class="reply-option-dropdown-button" type="button" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item btn-edit-reply" data-reply-id="`+ response.replyId + `" href="#">Edit</a>
                          <a class="dropdown-item btn-remove-reply" data-toggle="modal"
                              data-target="#confirm-delete-reply-`+ response.replyId + `" href="#">Remove</a>
                      </div>
                  </div>
          </div>
          <div class="item-reply-middle">
              <div id="reply-content-box-`+ response.replyId + `">
                  <span class="reply-content" id="reply-content-`+ response.replyId + `">` + response.content + `</span>
                  <span class="edited-alert hidden"
                      id="edited-alert-`+ response.replyId + `">(edited)</span>
              </div>
              <div class="card card-body edit-reply-card hidden" id="edit-reply-card-`+ response.replyId + `">
                  <form method="post">
                      <div class="form-group">
                          <label for="edit-reply" class="title-box-reply">Edit reply</label>
                          <textarea class="form-control edit-reply" id="edit-reply-`+ response.replyId + `" name="edit_reply"
                              rows="5" required>`+ response.content + `</textarea>
                      </div>
                      <div class="float-right d-flex">
                          <div class="btn-close-reply-edit" data-reply-id="`+ response.replyId + `">Close</div>
                          <button type="submit" class="ml-2 btn-send-reply-edit" data-reply-id="`+ response.replyId + `"
                              data-user-id="`+ response.user_id + `" data-review-id="` + reviewId + `">Edit</button>
                      </div>
                  </form>
              </div>
          </div>
      
          <div class="modal fade" id="confirm-delete-reply-`+ response.replyId + `" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            Are you sure you want to delete this reply?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-confirm" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-confirm-delete-reply"
                                id="btn-confirm-delete-`+ response.replyId + `" data-reply-id="` + response.replyId + `"
                                data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
            </div>
          </div>`
        );

        $('#review-' + reviewId).removeClass('show');
        $('#btn-reply-' + reviewId).addClass('collapsed');
        $('#write-reply-' + reviewId).val('');
      }
    });
  });



  $('.reviews-list').on('click', '.btn-edit-reply', function (event) {
    event.preventDefault();
    var replyId = $(this).data('reply-id');
    $('#reply-content-box-' + replyId).addClass('hidden');
    $('#edit-reply-card-' + replyId).removeClass('hidden');
    $('#btn-reply-' + replyId).addClass('hidden');
    $('#reply-' + replyId).removeClass('show');
    $('#btn-reply-' + replyId).addClass('collapsed');
    $('#write-reply-' + replyId).val('');
  });

  $('.reviews-list').on('click', '.btn-close-reply-edit', function (event) {
    event.preventDefault();
    var replyId = $(this).data('reply-id');
    var replyContent = $('#reply-content-' + replyId).text();
    $('#reply-content-box-' + replyId).removeClass('hidden');
    $('#edit-reply-card-' + replyId).addClass('hidden');
    $('#btn-reply-' + replyId).removeClass('hidden');
    $('#edit-reply-' + replyId).val(replyContent);
  });

  $('.reviews-list').on('click', '.btn-send-reply-edit', function (e) {
    e.preventDefault();

    var replyId = $(this).data('reply-id');

    $.ajax({
      type: "post",
      url: "/replies/edit",
      data: {
        'edit_reply_content': $('#edit-reply-' + replyId).val(),
        'replyId': replyId,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (!response.is_same) {
          $('#reply-content-' + replyId).html(response.edit_reply_content);
          $('#edited-alert-' + replyId).removeClass('hidden');
          $('#edit-reply-' + replyId).val(response.edit_reply_content);
        }
        $('#reply-content-box-' + replyId).removeClass('hidden');
        $('#edit-reply-card-' + replyId).addClass('hidden');
        $('#btn-reply-' + replyId).removeClass('hidden');
      }
    });
  });

  $('.reviews-list').on('click', '.btn-confirm-delete-reply', function (e) {
    e.preventDefault();
    var replyId = $(this).data('reply-id');

    $.ajax({
      type: "post",
      url: "/replies/delete",
      data: {
        'replyId': replyId,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $('#item-reply-' + replyId).remove();
      }
    });
  });
});