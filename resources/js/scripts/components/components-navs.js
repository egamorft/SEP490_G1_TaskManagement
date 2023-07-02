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
});
