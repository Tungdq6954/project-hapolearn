$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.document-name, .document-btn-preview').on('click', function (e) {
    e.preventDefault();
    console.log($(this).attr('data-documentId'));
    console.log($(this).attr('data-lessonId'));

    var documentId = $(this).attr('data-documentId');
    var lessonId = $(this).attr('data-lessonId');
    var thisItem = $(this);

    $.ajax({
      type: "post",
      url: "/documents/learn",
      data: {
        'documentId': documentId,
        'lessonId': lessonId
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $('#progress-bar').html(response.percentage + '%');
        $('#progress-bar').css('width', response.percentage + '%');
        thisItem.parent().parent().find('.document-checked').html('<i class="fas fa-check-circle"></i>');
        $('#lesson-learners').html(': ' + response.updateLearners)
      }
    });
  });
});
