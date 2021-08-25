$(function () {
  $('#join-course').on('click', function (e) {
    if ($('#nav-link-login-register').length > 0) {
      e.preventDefault();
      $("#login-register").modal("show");
      $("#login-nav-tab").trigger("click");
    }
  });

  /**
   * reload page when click button back from detail_lesson page
   */
  var perfEntries = performance.getEntriesByType("navigation");

  if (perfEntries[0].type === "back_forward") {
    location.reload(true);
  }
});
