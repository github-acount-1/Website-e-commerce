$(document).ready(function () {

    $('#createCoupon').submit(function (event) {
        event.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        $.ajax(
          {
              url: 'createTable.php',
              method: 'POST' ,
              data: formData,
              success: function () {
                $('#ajax_msg').css("display", "block").delay(3000).slideUp(300)
              }
          }
      )

    }) 

})