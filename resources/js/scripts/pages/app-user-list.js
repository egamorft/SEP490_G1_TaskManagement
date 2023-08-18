/*=========================================================================================
    File Name: app-user-list.js
    Description: User List page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent

==========================================================================================*/
$(function () {
  ('use strict');

  var dtUserTable = $('.user-list-table'),
    newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    select = $('.select2'),
    dtContact = $('.dt-contact')

  var assetPath = '../../../app-assets/',
    userView = 'app-user-view-account.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userView = assetPath + 'user/details/';
  }
  $('.hiddenTD').hide();
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

  // Users List datatable
  if (dtUserTable.length) {
    dtUserTable.DataTable({
      columnDefs: [
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            //Get ID
            var str = full.DT_RowId;
            var regex = /row(\d+)/;
            var match = str.match(regex);

            if (match) {
              var rowId = parseInt(match[1]);
            }

            return (
              '<div class="btn-group">' +
              '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
              feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
              '</a>' +
              '<div class="dropdown-menu dropdown-menu-end">' +
              '<a href="' +
              userView + rowId +
              '" class="dropdown-item">' +
              feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
              'Details</a>' +
              '<a href="#" class="dropdown-item edit-user-btn" data-bs-toggle="modal" data-bs-target="#edit-user-modal" data-id="' +
              rowId + '">' +
              feather.icons['edit'].toSvg({ class: 'font-small-4 me-50' }) +
              'Edit</a></div>' +
              '</div>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[0, 'asc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row mb-1"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['external-link'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [1, 2, 3, 4] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50');
            }, 50);
          }
        },
        {
          text: 'Add New User',
          className: 'add-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#add-new-user'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIdx +
                '" data-dt-column="' +
                col.columnIndex +
                '">' +
                '<td>' +
                col.title +
                ':' +
                '</td> ' +
                '<td>' +
                col.data +
                '</td>' +
                '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(3)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="UserRole">Role</label>').appendTo('.user_role');
            var select = $(
              '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
            )
              .appendTo('.user_role')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val, true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                var userText = $('<td>').html(d).contents().filter(function () {
                  return this.nodeType === 3;
                }).text().trim();
                select.append('<option value="' + userText + '" class="text-capitalize">' + userText + '</option>');
              });
          });
        // Adding status filter once table initialized
        this.api()
          .columns(4)
          .every(function () {
            var column = this;
            var label = $('<label class="form-label" for="FilterTransaction">Status</label>').appendTo('.user_status');
            var select = $(
              '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
            )
              .appendTo('.user_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                  $(d).html() +
                  '" class="text-capitalize">' +
                  $(d).html() +
                  '</option>'
                );
              });
          });
      }
    });
  }

  // Form Validation
  // if (newUserForm.length) {
  //   newUserForm.validate({
  //     errorClass: 'error',
  //     rules: {
  //       'user-fullname': {
  //         required: true
  //       },
  //       'user-email': {
  //         required: true
  //       }
  //     }
  //   });
  // }


  //Generate password
  $(document).ready(function () {
    $('#generatePassword').click(function () {
      var password = generateRandomPassword();
      $('.user-password').val(password);
    });

    function generateRandomPassword() {
      var length = 10;
      var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
      var password = "";

      for (var i = 0; i < length; i++) {
        var randomChar = charset.charAt(Math.floor(Math.random() * charset.length));
        password += randomChar;
      }

      if (!/[A-Z]/.test(password) || !/[!@#$%^&*()_+~`|}{[\]:;?><,./-=]/.test(password)) {
        password = generateRandomPassword(); // Regenerate password if it doesn't meet the criteria
      }

      return password;
    }
  });


  //Add user form submission
  $(document).ready(function () {
    newUserForm.on('hidden.bs.modal', function () {
      // Clear the input fields when the modal is closed
      form.attr('action', action);
      $('input', $(this)).val('');
      $('.error').text('').hide();
    });
    newUserForm.submit(function (event) {
      event.preventDefault(); // Prevent the default form submission

      var form = $(this);
      var url = form.attr('action');
      var method = form.attr('method');
      var data = form.serialize();

      $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        beforeSend: function () {
          $('#spinnerBtn').show();
          $('#submitBtn').hide();
          $('#resetBtn').hide();
        },
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
          setTimeout(function () {
            $('#spinnerBtn').hide();
            $('#submitBtn').show();
            $('#resetBtn').show();
            if (response.status === 422) {
              var errors = response.responseJSON.errors;
              for (var field in errors) {
                var errorContainer = $('#' + field + "ErrorAdd");
                errorContainer.addClass('text-danger');
                errorContainer.text(errors[field][0]);
                errorContainer.show();
              }
            }
          }, 500);
        }
      });
    });
  });

  //Pass id attr from button to form
  $(document).ready(function () {
    var form = $('#edit-user-form');
    var action = form.attr('action');
    var csrfToken = form.find('input[name="_token"]').val();

    $('#edit-user-modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var id = button.data('id'); // Get the id from the button's data-id attribute

      // Update the action URL of the form with the id parameter
      form.attr('action', action.replace(':id', id));
      $('input[name="_token"]').val(csrfToken);
    });

    // Event listener for when the modal is hidden
    $('#edit-user-modal').on('hidden.bs.modal', function () {
      // Clear the input fields when the modal is closed
      form.attr('action', action);
      $('input', $(this)).val('');
      $('.error').text('').hide();

      // Refresh the CSRF token
      $('input[name="_token"]').val(csrfToken);
    });
  });

  //Edit user form submission
  $(document).ready(function () {
    //Get data
    $('.edit-user-btn').click(function () {
      var button = $(this);
      var modal = $(button.data('bs-target')); // Get the target modal
      var id = button.data('id'); // Get the ID from data attribute
      // Make an AJAX request to fetch the data
      $.ajax({
        url: '/admin/get-specific-user', // Replace with your server route
        method: 'GET',
        data: {
          id: id
        },
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            var data = response.data;
            modal.find('#user-fullname').val(data.name);
            modal.find('#user-email').val(data.email);
            modal.find('#user-address').val(data.address);

            // Set the selected option based on data.is_admin using Select2
            modal.find('#user-role').val(data.is_admin).trigger('change');
          }
        },
        error: function () {
          console.log("err get user");
        }
      });
    });

    //Save data
    $('#edit-user-form').submit(function (event) {
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
                field + "ErrorEdit");
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
  });
});
