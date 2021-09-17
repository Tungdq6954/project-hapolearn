function isFloat(n) {
  return n === +n && n !== (n | 0);
}

$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".pick-rate > label").on('click', function () {
    var starClickNumber = $(this).attr('data-star');

    for (let i = 1; i <= 5; i++) {
      let starId = '#star-label-' + i;
      $(starId).css('color', '#d8d8d8');
    }

    for (let i = 1; i <= starClickNumber; i++) {
      let starId = '#star-label-' + i;
      $(starId).css('color', '#ffd567');
    }
  });

  $('#send-review').on('click', function (e) {
    e.preventDefault();
    if ($('#nav-link-login-register').length > 0) {
      $("#login-register").modal("show");
      $("#login-nav-tab").trigger("click");
    }

    if ($("input[name='rate']:checked").val() == null) {
      $('.vote-alert').removeClass('vote-alert-hide');
    } else {
      $.ajax({
        type: "post",
        url: "/reviews/store",
        data: {
          'courseId': $('#review-course-id').val(),
          'userId': $('#review-user-id').val(),
          'rate': $("input[name='rate']:checked").val(),
          'write_comment': $('#write-comment').val(),
          'lessonId': $('#review-lesson-id').val()
        },
        dataType: "json",
        success: function (response) {
          console.log(response);

          var starsInComment = '';
          for (let i = 1; i <= response.rate; i++) {
            starsInComment += `<i class="fas fa-star mr-1 ml-1"></i>`;
          }

          $('.reviews-list').append(
            `<div class="item-reivew">
                <div class="item-reivew-top">
                    <img class="user-avatar" src="`+ response.avatar + `" alt="avatar">
                    <div class="user-name">` + response.username + `</div>
                    <div class="rating">` + starsInComment + `</div>
                  <div class="timestamp"> ` + response.timestamp + ` </div>
                  <div class="dropdown comment-option-dropdown">
                      <button class="comment-option-dropdown-button" type="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item btn-edit-review" data-review-id="` + response.reviewId + `"
                              href="#">Edit</a>
                          <a class="dropdown-item btn-remove-review" data-toggle="modal"
                              data-target="#confirm-delete-review-`+response.reviewId+`" href="#">Remove</a>
                      </div>
                  </div>
                </div>
              <div class="item-review-middle">
              ` + response.content + `
              </div>
              <div class="item-review-bottom">
                        <button class="btn-reply" type="button" data-toggle="collapse"
                            data-target="#review-` + response.reviewId + `" aria-expanded="false"
                            aria-controls="collapseExample">
                            Reply
                        </button>
                        <div class="collapse mt-4" id="review-` + response.reviewId + `">
                            <div class="card card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="write-comment" class="title-box-comment">Reply</label>
                                        <textarea class="form-control write-reply" name="write_reply" rows="5"
                                            required></textarea>
                                    </div>

                                    <input type="hidden" name="userId" class="user-id"
                                        value="` + response.user_id + `">
                                    <input type="hidden" name="reviewId" class="review-id"
                                        value="` + response.reviewId + `">

                                    <div class="float-right d-flex">
                                        <div id="btn-close-reply" class="btn-close-reply">Close</div>
                                        <button type="submit" class="btn-send-reply ml-2">Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>`
          );
          $('.vote-alert').addClass('vote-alert-hide');
          $('#write-comment').val('');
          $('.pick-rate > input').prop('checked', false);
          $('.pick-rate > label').css('color', '#d8d8d8');

          $('.number-of-review').html(response.numberReviews + ' reviews');
          $('.rating-overview-score').html(response.rating_overview_score);
          $('.total-review-count').html(response.numberReviews + ' ratings');

          if (isFloat(response.rating_overview_score)) {
            var starsInRatingOverView = '';

            for (let i = 0; i < parseInt(response.rating_overview_score); i++) {
              starsInRatingOverView += `<i class="fas fa-star"></i>`;
            }

            starsInRatingOverView += '<i class="fas fa-star-half-alt"></i>';

            for (let i = 0; i < 4 - parseInt(response.rating_overview_score); i++) {
              starsInRatingOverView += `<i class="far fa-star"></i>`;
            }
          } else {
            var starsInRatingOverView = '';

            for (let i = 0; i < response.rating_overview_score; i++) {
              starsInRatingOverView += `<i class="fas fa-star"></i>`;
            }

            for (let i = 0; i < 5 - response.rating_overview_score; i++) {
              starsInRatingOverView += `<i class="far fa-star"></i>`;
            }
          }

          $('.rating-overview-stars').html(starsInRatingOverView);

          $('.rating-detail').html(
            `<li class="rating-detail-list">
                  <div class="rating-title">5 stars</div>
                  <div class="star-rating-bar">
                      <div class="progress custom-progress">
                          <div class="progress-bar custom-progress-bar"
                              style="width:` + response.five_stars_rate_percent + `%" role="progressbar"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <span class="detail-rating-number">`+ response.five_stars_rate + ` </span>
              </li>
              <li class="rating-detail-list">
                  <div class="rating-title">4 stars</div>
                  <div class="star-rating-bar">
                      <div class="progress custom-progress">
                          <div class="progress-bar custom-progress-bar"
                              style="width: ` + response.four_stars_rate_percent + `% }}" role="progressbar"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <span class="detail-rating-number">` + response.four_stars_rate + `</span>
              </li>
              <li class="rating-detail-list">
                  <div class="rating-title">3 stars</div>
                  <div class="star-rating-bar">
                      <div class="progress custom-progress">
                          <div class="progress-bar custom-progress-bar"
                              style="width: ` + response.three_stars_rate_percent + `%" role="progressbar"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <span class="detail-rating-number">` + response.three_stars_rate + `</span>
              </li>
              <li class="rating-detail-list">
                  <div class="rating-title">2 stars</div>
                  <div class="star-rating-bar">
                      <div class="progress custom-progress">
                          <div class="progress-bar custom-progress-bar"
                              style="width: ` + response.two_stars_rate_percent + `%" role="progressbar"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <span class="detail-rating-number">` + response.two_stars_rate + `</span>
              </li>
              <li class="rating-detail-list">
                  <div class="rating-title">1 star</div>
                  <div class="star-rating-bar">
                      <div class="progress custom-progress">
                          <div class="progress-bar custom-progress-bar"
                              style="width: ` + response.one_star_rate_percent + `% }}" role="progressbar"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </div>
                  <span class="detail-rating-number">`+ response.one_star_rate + `</span>
              </li>`
          );
        }
      });
    }
  });

  $('.reviews-list').on('click', '.btn-edit-review', function (event) {
    event.preventDefault();
    var reviewId = $(this).data('review-id');
    $('#review-content-box-' + reviewId).addClass('hidden');
    $('#edit-review-card-' + reviewId).removeClass('hidden');
    $('#btn-reply-' + reviewId).addClass('hidden');
    $('#review-' + reviewId).removeClass('show');
    $('#btn-reply-' + reviewId).addClass('collapsed');
    $('#write-reply-' + reviewId).val('');
  });

  $('.reviews-list').on('click', '.btn-close-review-edit', function (event) {
    event.preventDefault();
    var reviewId = $(this).data('review-id');
    var reviewContent = $('#review-content-' + reviewId).text();
    $('#review-content-box-' + reviewId).removeClass('hidden');
    $('#edit-review-card-' + reviewId).addClass('hidden');
    $('#btn-reply-' + reviewId).removeClass('hidden');
    $('#edit-comment-' + reviewId).val(reviewContent);
  });

  $('.reviews-list').on('click', '.btn-send-review-edit', function (e) {
    e.preventDefault();

    var reviewId = $(this).data('review-id');

    $.ajax({
      type: "post",
      url: "/reviews/edit",
      data: {
        'edit_comment': $('#edit-comment-' + reviewId).val(),
        'reviewId': reviewId,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (!response.is_same) {
          $('#review-content-' + reviewId).html(response.review_edit);
          $('#edited-alert-' + reviewId).removeClass('hidden');
          $('#edit-comment-' + reviewId).val(response.review_edit);
        }
        $('#review-content-box-' + reviewId).removeClass('hidden');
        $('#edit-review-card-' + reviewId).addClass('hidden');
        $('#btn-reply-' + reviewId).removeClass('hidden');
      }
    });
  });

  $('.reviews-list').on('click', '.btn-confirm-delete', function(e) {
    var reviewId = $(this).data('review-id');

    $.ajax({
      type: "post",
      url: "/reviews/delete",
      data: {
        'reviewId': reviewId,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $('#confirm-delete-review-' + reviewId).modal('hide');
        $('#item-review-' + reviewId).remove();
      }
    });
  });
});