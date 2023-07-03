/*=========================================================================================
    File Name: navs.js
    Description: Navigation available in Bootstrap share general markup and styles, from
                the base .nav class to the active and disabled states. Swap modifier
                classes to switch between each style.
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  // add height to navigation in left tabs according to content area height
  var heightLeft = $('.nav-left + .tab-content').height();

  $('ul.nav-left').height(heightLeft);

  // add height to navigation in right tabs according to content area height
  var heightRight = $('.nav-right + .tab-content').height();

  $('ul.nav-right').height(heightRight);
})(window, document, jQuery);

$(document).ready(function () {
  var isRtl = $('html').attr('data-textdirection') === 'rtl',
    typeSuccess = $('#success-alert:hidden'),
    typeError = $('#error-alert:hidden');
  //Handle invitation through email
  $('#modalInviteForm').submit(function (event) {
    event.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var method = form.attr('method');
    var _token = form.serialize();
    $.ajax({
      url: url,
      method: method,
      data: _token,
      dataType: 'json',
      beforeSend: function () {
        $('#spinnerBtnInvite').show();
        $('#submitBtnInvite').hide();
      },
      success: function (response) {
        // handle success
        if (response.success) {
          location.reload();
        }
      },
      error: function (response) {
        setTimeout(function () {
          $('#spinnerBtnInvite').hide();
          $('#submitBtnInvite').show();
          if (response.status == 422) {
            $('#submitBtnInvite').addClass(' mb-2');
            var errors = response.responseJSON.errors;
            for (var key in errors) {
              $('#' + key).addClass(' is-invalid');
              $('#error-' + key).show();
              $('#error-' + key).text(errors[key][0])
            }
          } else if (response.status == 400) {
            $('#submitBtnInvite').addClass(' mb-2');
            $('#error-modalInviteEmail').addClass(' is-invalid');
            $('#error-modalInviteEmail').show();
            $('#error-modalInviteEmail').text(response.responseJSON.message);
          }
        }, 300);
      }
    });
  });

  //Handle checkbox in permission role editor
  $('.permission-role-editor').change(function () {
    var csrfToken = $('input[name="csrf-token"]').val();
    var roleId = $(this).attr('id').split('_')[0];
    var permissionId = $(this).attr('id').split('_')[1];
    var isChecked = $(this).prop('checked');

    var currentUrl = window.location.href;
    var projectName = currentUrl.split('/').pop();

    var section = $('#section-block');
    // Make AJAX request to update project_role_permission table
    $.ajax({
      url: '/project/update-permission',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken  // Include the CSRF token in the headers
      },
      data: {
        projectName: projectName,
        roleId: roleId,
        permissionId: permissionId,
        isChecked: isChecked
      },
      beforeSend: function () {
        section.block({
          message:
            '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p><div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
          timeout: 2000,
          css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
          },
          overlayCSS: {
            opacity: 0.5
          }
        });
      },
      success: function (response) {
        // Handle success response
        setTimeout(function () {
          toastr['success'](response.message, 'Success!', {
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            progressBar: true,
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }, 2000);
      },
      error: function (response) {
        // Handle error response
        setTimeout(function () {
          toastr['error'](response.message, 'Error!', {
            showMethod: 'slideDown',
            hideMethod: 'slideUp',
            progressBar: true,
            closeButton: true,
            tapToDismiss: false,
            rtl: isRtl
          });
        }, 2000);
      }
    });
  });
});
