$(function () {
  ('use strict');
  var addPermissionForm = $('#addPermissionForm');

  // jQuery Validation
  // --------------------------------------------------------------------
  // if (addPermissionForm.length) {
  //   addPermissionForm.validate({
  //     rules: {
  //       modalPermissionName: {
  //         required: true
  //       }
  //     }
  //   });
  // }

  // reset form on modal hidden
  $('.modal').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
  });

  //Add permission form submission
  addPermissionForm.submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Serialize the form data
    var formData = $(this).serialize();

    // Submit the form data using AJAX
    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: formData,
      success: function (response) {
        // Handle the success response
        if (response.success) {
          // Form submission was successful
          // Reset the form or perform any other actions
          location.reload();
        }
        // Optionally, perform any additional actions or display a success message
      },
      error: function (response) {
        // Handle the error response
        if (response.status === 422) {
          var errors = response.responseJSON.errors;
          // Display the validation errors next to the form fields

          // Hide the error messages
          $('.error').text('').hide();
          for (var field in errors) {
            var errorContainer = $('#' + field + "ErrorAddPer");
            var errorInput = $('.' + field);
            errorInput.addClass(' is-invalid');
            errorContainer.addClass('text-danger');
            errorContainer.text(errors[field][0]);
            errorContainer.show();
          }
        }
      }
    });
  });

});
