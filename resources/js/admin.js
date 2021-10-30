$(function () {
  // $('.fa-arrow-left').click(function () {
  //     $(this).toggleClass('fa-arrow-right');
  // });

  // $('#lessonDataTable').DataTable();
  $('table.display').DataTable();

  $('#userDataTable').DataTable();

  $('#courseDataTable').DataTable();

  $('.select2-menu').select2();

  $('#deleteUserCourse').click(function () {
    $('#courseID').val($(this).data('course'));
    $("form").attr('action', $(this).attr('data-url'));
  });

  $('#deleteCourse').click(function () {
    $('#userID').val($(this).data('user'));
    $("form").attr('action', $(this).attr('data-url'));
  });

  $('#deleteDocument').click(function () {
    $('#userID').val($(this).data('user'));
    $("form").attr('action', $(this).attr('data-url'));
  });

  $('#deleteLesson').click(function () {
    $('#userID').val($(this).data('user'));
    $("form").attr('action', $(this).attr('data-url'));
  });

  if ($("#uploadDocumentFile").hasClass("is-invalid") || $("#uploadDocumentType").hasClass("is-invalid") || $("#uploadDocumentName").hasClass("is-invalid")) {
    $("#uploadDocumentButton").trigger("click");
  }

  $(".js-tag-list").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  });
});
