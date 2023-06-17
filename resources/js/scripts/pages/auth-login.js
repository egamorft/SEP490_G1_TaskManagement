/*=========================================================================================
  File Name: auth-login.js
  Description: Auth login js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var pageLoginForm = $('.auth-login-form');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageLoginForm.length) {
    pageLoginForm.validate({
      /*
      * ? To enable validation onkeyup
      onkeyup: function (element) {
        $(element).valid();
      },*/
      /*
      * ? To enable validation on focusout
      onfocusout: function (element) {
        $(element).valid();
      }, */
      rules: {
        'login-email': {
          required: true,
          email: true
        },
        'login-password': {
          required: true
        }
      }
    });
  }

  if (typeSuccess.length) {
    toastr['success'](typeSuccess.text(), 'Success!', {
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      progressBar: true,
      closeButton: true,
      tapToDismiss: false,
      rtl: isRtl
    });
  }
  if (typeError.length) {
    toastr['error'](typeError.text(), 'Error!', {
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      progressBar: true,
      closeButton: true,
      tapToDismiss: false,
      rtl: isRtl
    });
  }
});
