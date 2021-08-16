$(function() {
  $('#select-teacher').select2();
  $('#select-number-of-learner').select2();
  $('#select-learn-time').select2();
  $('#select-number-of-lesson').select2();
  $('#select-tag').select2();
  $('#select-review').select2();

  $('#reset-filter').on('click', function() {
    $('#search-form-input').val('');
    $('#newest-oldest-radio #radio-newest').prop('checked', false);
    $('#newest-oldest-radio #radio-oldest').prop('checked', false);
    $('#select-teacher').val('');
    $('#select-number-of-learner').val('');
    $('#select-learn-time').val('');
    $('#select-number-of-lesson').val('');
    $('#select-review').val('');
    $('#select-tag').val('');

    $('#select-teacher').trigger('change');
    $('#select-number-of-learner').trigger('change');
    $('#select-learn-time').trigger('change');
    $('#select-number-of-lesson').trigger('change');
    $('#select-review').trigger('change');
    $('#select-tag').trigger('change');
  });
});
