$(document).ready(function () {
  // fullname live update logic with keyup() function
  $("#firstname, #lastname").keyup(function () {
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var fullname = firstname + " " + lastname;
    // final fullname string display
    $("#fullname").val(fullname);
  });
});
