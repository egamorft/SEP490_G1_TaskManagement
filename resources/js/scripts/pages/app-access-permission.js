/**
 * App user list
 */

$(function () {
  'use strict';

  var dataTablePermissions = $('.datatables-permissions'),
    assetPath = '../../../app-assets/',
    dt_permission,
    userList = 'app-user-list.html';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    userList = assetPath + 'app/user/list';
  }

  // Permission Role datatable
  if (dataTablePermissions.length) {
    dt_permission = dataTablePermissions.DataTable({
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

            if (rowId > 5) {
              return (
                '<button class="btn btn-sm btn-icon edit-permission-btn" data-bs-toggle="modal" data-bs-target="#editPermissionModal" data-id="' + rowId + '">' +
                feather.icons['edit'].toSvg({ class: 'font-medium-2 text-body' }) +
                '</i></button>' +
                '<button class="btn btn-sm btn-icon edit-permission-btn" data-bs-toggle="modal" data-bs-target="#deletePermissionModal" data-id="' + rowId + '">' +
                feather.icons['trash'].toSvg({ class: 'font-medium-2 text-body' }) +
                '</button>'
              );
            } else {
              return (
                '<button data-bs-toggle="tooltip" data-bs-placement="top" title="This permission is system default" class="btn btn-sm btn-icon">' +
                feather.icons['info'].toSvg({ class: 'font-medium-2 text-body' }) +
                '</i></button>');
            }
          }
        }
      ],
      order: [[0, 'asc']],
      dom:
        '<"d-flex justify-content-between align-items-center header-actions text-nowrap mx-1 row mt-75"' +
        '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
        '<"col-sm-12 col-lg-8"<"dt-action-buttons d-flex align-items-center justify-content-lg-end justify-content-center flex-md-nowrap flex-wrap"<"me-1"f><"user_role mt-50 width-200 me-1">B>>' +
        '><"text-nowrap" t>' +
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
          text: 'Add Permission',
          className: 'add-new btn btn-primary mt-50',
          attr: {
            'data-bs-toggle': 'modal',
            'data-bs-target': '#addPermissionModal'
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
              return 'Details of Permission';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                col.rowIndex +
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

            return data ? $('<table class="table"/><tbody />').append(data) : false;
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
            var select = $(
              '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
            )
              .appendTo('.user_role')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? val : '', true, false).draw();
              });
            var uniqueTexts = []; // Array to store unique text values

            $('span.roleNames').each(function () {
              var userText = $(this).text().trim();

              // Check if the text value already exists in the array
              if (uniqueTexts.indexOf(userText) === -1) {
                uniqueTexts.push(userText); // Add the unique text value to the array
                select.append('<option value="' + userText + '" class="text-capitalize">' + userText + '</option>');
              }
            });
          });
      }
    });
  }

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  const deleteRoles = document.querySelectorAll('.delete-role');

  if (deleteRoles) {
    deleteRoles.forEach((deleteRole) => {
      deleteRole.onclick = function () {
        const roleId = this.getAttribute('data-id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert the role!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Delete Role!',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.isConfirmed) {
            // Perform the delete operation or make an AJAX request to delete the role
            deleteRoleById(roleId);
          } else {

            Swal.fire({
              title: 'Cancelled',
              text: 'Cancelled Suspension :)',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      };
    });
  }

  function deleteRoleById(roleId) {
    var csrfToken = $('#csrfToken').val();
    // Perform the necessary actions to delete the role (e.g., make an AJAX request)
    $.ajax({
      url: '/admin/destroy-role-permission/' + roleId,
      type: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      beforeSend: function () {
        // setting a timeout
        let timerInterval
        Swal.fire({
          title: 'Auto close alert!',
          html: 'I will close in <b></b> milliseconds.',
          timer: 1000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
          }
        })
      },
      success: function (response) {
        // Handle the success response
        Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'This role has been deleted.',
          showConfirmButton: false,
        });
        setTimeout(function () {
          location.reload();
        }, 1200);
        // Refresh the page or update the UI as needed
      },
      error: function (xhr, status, error) {
        // Handle the error response
        Swal.fire(
          'Opps?',
          'Something went wrong',
          'question'
        )
        // Display an error message or perform any necessary actions
      }
    });
  }
});
