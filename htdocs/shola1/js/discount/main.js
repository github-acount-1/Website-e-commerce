$(document).ready(function () {

    $('#createDiscount').submit(function (event) {
        event.preventDefault();

        var form = $(this);
        var formData = form.serialize();
        $.ajax(
          {
              url: 'createTable.php',
              method: 'POST' ,
              data: formData,
              success: function (data) {
                $('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data)
              }
          }
      )

    })

    $('#tableData').load('read_table.php');

})