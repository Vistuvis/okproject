$(document).ready(function () {
    $("form").submit(function (event) {
      var formData = {
        name: $("#petName").val(),
        email: $("#petloc").val(),
      };
  
      $.ajax({
        type: "POST",
        url: "newpet.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
      });
  
      event.preventDefault();
    });
  });