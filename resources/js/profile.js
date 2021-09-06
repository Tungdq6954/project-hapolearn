$(function () {
  if ($("#avatar-input").length != 0) {
    var avatarInput = document.getElementById("avatar-input");

    avatarInput.onchange = evt => {
      const [file] = avatarInput.files
      if (file) {
        avatar.src = URL.createObjectURL(file)
      }
    }
  }

  $('#birthday-input').datepicker({
    dateFormat: "dd/mm/yy"
  });

  $('.calendar-icon').on('click', function () {
    $('#birthday-input').trigger('select');
  });
});
