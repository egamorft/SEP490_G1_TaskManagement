/*=========================================================================================
    File Name: app-user-view-security.js
    Description: User View security page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';
  var formChangePassword = $('#formChangePassword');

  if (formChangePassword.length) {
    formChangePassword.validate({
      rules: {
        oldPassword: {
          required: true,
          minlength: 8,
          // equalTo: '#newPassword'
        },
        newPassword: {
          required: true,
          minlength: 8
        }
      },
      messages: {
        newPassword: {
          required: 'Enter new password',
          minlength: 'Enter at least 8 characters'
        },
        oldPassword: {
          required: 'Enter old password',
          minlength: 'Enter at least 8 characters'
          // equalTo: 'The password and its confirm are not the same'
        }
      }
    });
  }
});
