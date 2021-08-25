$(function () {
  $('#join-course').on('click', function (e) {
    if ($('#nav-link-login-register').length > 0) {
      e.preventDefault();
      $("#login-register").modal("show");
      $("#login-nav-tab").trigger("click");
    }
  });
});
