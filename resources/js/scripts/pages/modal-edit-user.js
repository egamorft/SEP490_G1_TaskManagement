$(function () {
  const select2 = $('.select2'),
    editUserForm = $('#editUserForm'),
    modalEditUserPhone = $('.phone-number-mask');

  // Select2 Country
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>').select2({
        dropdownParent: $this.parent()
      });
    });
  }

  // Phone Number Input Mask
  if (modalEditUserPhone.length) {
    modalEditUserPhone.each(function () {
      new Cleave($(this), {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }

  // Edit user form validation
  if (editUserForm.length) {
    editUserForm.validate({
      rules: {
        modalEditFullName: {
          required: true
        }
      },
      messages: {
        modalEditUserName: {
          required: 'Please enter your username'
        }
      }
    });
  }
  $('#editUserForm').submit(function (event) {
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
      success: function (response) {
        // handle success
        location.reload();
      },
      error: function (xhr, status, error) {
        var response = JSON.parse(xhr.responseText);
        var errors = response.errors;
        for (var key in errors) {
          $('#' + key).addClass(' is-invalid');
          $('#error-' + key).show();
          $('#error-' + key).text(errors[key][0])
        }
      }
    });
  });

  var typeSuccess = $('#success-alert:hidden'),
    typeError = $('#error-alert:hidden'),
    isRtl = $('html').attr('data-textdirection') === 'rtl';

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
