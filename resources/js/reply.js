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
          `<div class="reply">
                  <div class="item-reply-top">
                      <img class="user-avatar" src="` + response.avatar + `"
                          alt="avatar">
                      <div class="user-name">` + response.username + `</div>
                      <div class="timestamp">
                          ` + response.timestamp + `
                      </div>
                  </div>
                  <div class="item-reply-middle">
                      ` + response.content + `
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

  $('.reviews-list').on('click', '.btn-confirm-delete', function (e) {
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
        $('#confirm-delete-reply-' + replyId).modal({backdrop: false});
        $('#item-reply-' + replyId).remove();
      }
    });
  });
});