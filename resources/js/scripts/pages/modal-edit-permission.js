$(function () {
  ('use strict');
  var form = $('#editPermissionForm');
  var modal = $('#editPermissionModal');

  var delForm = $('#deletePermissionForm');
  var delModal = $('#deletePermissionModal');

  // jQuery Validation
  // --------------------------------------------------------------------
  // if (editPermissionForm.length) {
  //   editPermissionForm.validate({
  //     rules: {
  //       editPermissionName: {
  //         required: true
  //       }
  //     }
  //   });
  // }
  $(document).ready(function () {
    var action = form.attr('action');
    var delAction = delForm.attr('action');
    var csrfToken = form.find('input[name="_token"]').val();

    modal.on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Get the id from the button's data-id attribute

      // Update the action URL of the form with the id parameter
      form.attr('action', action.replace(':id', id));
      $('input[name="_token"]').val(csrfToken);
    });

    delModal.on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Get the id from the button's data-id attribute

      // Update the action URL of the form with the id parameter
      delForm.attr('action', delAction.replace(':id', id));
      $('input[name="_token"]').val(csrfToken);
    });


    // Event listener for when the modal is hidden
    modal.on('hidden.bs.modal', function () {
      // Clear the input fields when the modal is closed
      form.attr('action', action);
      $('input', $(this)).val('');

      // Refresh the CSRF token
      $('input[name="_token"]').val(csrfToken);
    });

    delModal.on('hidden.bs.modal', function () {
      // Clear the input fields when the modal is closed
      delForm.attr('action', action);
      $('input', $(this)).val('');

      // Refresh the CSRF token
      $('input[name="_token"]').val(csrfToken);
    });

    //Get data
    $('.edit-permission-btn').click(function () {
      var button = $(this);
      var modal = $(button.data('bs-target')); // Get the target modal
      var id = button.data('id'); // Get the ID from data attribute
      // Make an AJAX request to fetch the data
      $.ajax({
        url: '/admin/get-specific-permission', // Replace with your server route
        method: 'GET',
        data: {
          id: id
        },
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            var data = response.data;
            modal.find('#modalPermissionName').val(data.name);
            modal.find('#modalPermissionSlug').val(data.slug);
          }
        },
        error: function () {
          console.log("err get user");
        }
      });
    });

    //Save data
    form.submit(function (event) {
      event
        .preventDefault(); // Prevent the default form submission

      var form = $(this);
      var url = form.attr('action');
      var method = form.attr('method');
      var data = form.serialize();
      $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        success: function (response) {
          // Handle the success response
          if (response.success) {
            // Form submission was successful
            // Reset the form or perform any other actions
            form[0].reset();
            form.hide();
            location.reload();
          }
        },
        error: function (response) {
          // Handle the error response
          if (response.status === 422) {
            var errors = response
              .responseJSON.errors;
            // Display the validation errors next to the form fields

            // Hide the error messages
            $('.error').text('').hide();
            for (var field in errors) {
              var errorContainer = $('#' +
                field + "ErrorEditPer");
              var errorInput = $('.' +
                field);
              errorInput.addClass(' is-invalid')
              errorContainer.addClass(
                'text-danger');
              errorContainer.text(errors[
                field][0]);
              errorContainer.show();
            }
          }
        }
      });
    });

    //Delete data
    delForm.submit(function (event) {
      event
        .preventDefault(); // Prevent the default form submission

      var form = $(this);
      var url = form.attr('action');
      var method = form.attr('method');
      var data = form.serialize();
      console.log(url)
      $.ajax({
        url: url,
        type: 'DELETE',
        data: data,
        dataType: 'json',
        success: function (response) {
          // Handle the success response
          if (response.success) {
            // Form submission was successful
            // Reset the form or perform any other actions
            form[0].reset();
            form.hide();
            location.reload();
          }
        },
        error: function (response) {
          // Handle the error response
          console.log(response);
        }
      });
    });
  });
});
