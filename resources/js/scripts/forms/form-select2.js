/*=========================================================================================
    File Name: form-select2.js
    Description: Select2 is a jQuery-based replacement for select boxes.
    It supports searching, remote data sets, and pagination of results.
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  'use strict';
  var select = $('.select2'),
    selectIcons = $('.select2-icons'),
    maxLength = $('.max-length'),
    hideSearch = $('.hide-search'),
    selectArray = $('.select2-data-array'),
    selectAjax = $('.select2-data-ajax'),
    selectLg = $('.select2-size-lg'),
    selectSm = $('.select2-size-sm'),
    selectInModal = $('.select2InModal');

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

  // Select With Icon
  selectIcons.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      width: '100%',
      minimumResultsForSearch: Infinity,
      dropdownParent: $this.parent(),
      templateResult: iconFormat,
      templateSelection: iconFormat,
      escapeMarkup: function (es) {
        return es;
      }
    });
  });

  // Format icon
  function iconFormat(icon) {
    var originalOption = icon.element;
    if (!icon.id) {
      return icon.text;
    }

    var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + icon.text;

    return $icon;
  }

  // Limiting the number of selections
  maxLength.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    width: '100%',
    maximumSelectionLength: 4,
    dropdownParent: maxLength.parent(),
    placeholder: 'Select maximum 4 teammates'
  });

  // Hide Search Box
  hideSearch.select2({
    placeholder: 'Select an option',
    minimumResultsForSearch: Infinity
  });

  // Loading array data
  var data = [
    { id: 0, text: 'enhancement' },
    { id: 1, text: 'bug' },
    { id: 2, text: 'duplicate' },
    { id: 3, text: 'invalid' },
    { id: 4, text: 'wontfix' }
  ];

  selectArray.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    dropdownParent: selectArray.parent(),
    width: '100%',
    data: data
  });

  // Loading remote data
  selectAjax.wrap('<div class="position-relative"></div>').select2({
    dropdownAutoWidth: true,
    dropdownParent: selectAjax.parent(),
    width: '100%',
    ajax: {
      url: 'https://api.github.com/search/repositories',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: params.page * 30 < data.total_count
          }
        };
      },
      cache: true
    },
    placeholder: 'Search for a repository',
    escapeMarkup: function (markup) {
      return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
  });

  function formatRepo(repo) {
    if (repo.loading) return repo.text;

    var markup =
      "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__avatar'><img src='" +
      repo.owner.avatar_url +
      "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" +
      repo.full_name +
      '</div>';

    if (repo.description) {
      markup += "<div class='select2-result-repository__description'>" + repo.description + '</div>';
    }

    markup +=
      "<div class='select2-result-repository__statistics'>" +
      "<div class='select2-result-repository__forks'>" +
      feather.icons['share-2'].toSvg({ class: 'me-50' }) +
      repo.forks_count +
      ' Forks</div>' +
      "<div class='select2-result-repository__stargazers'>" +
      feather.icons['star'].toSvg({ class: 'me-50' }) +
      repo.stargazers_count +
      ' Stars</div>' +
      "<div class='select2-result-repository__watchers'>" +
      feather.icons['eye'].toSvg({ class: 'me-50' }) +
      repo.watchers_count +
      ' Watchers</div>' +
      '</div>' +
      '</div></div>';

    return markup;
  }

  function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
  }

  // Sizing options

  // Large
  selectLg.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      dropdownParent: $this.parent(),
      width: '100%',
      containerCssClass: 'select-lg'
    });
  });

  // Small
  selectSm.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      dropdownAutoWidth: true,
      dropdownParent: $this.parent(),
      width: '100%',
      containerCssClass: 'select-sm'
    });
  });

  $('#select2InModal').on('shown.bs.modal', function () {
    selectInModal.select2({
      placeholder: 'Select a state'
    });
  });
})(window, document, jQuery);

$(document).ready(function () {
  var $select2 = $('#select2-modalAddSupervisor');
  var $select3 = $('#select2-limited');

  // Function to disable options in the select element based on the selected values
  function disableOptions($select, selectedValues) {
    $select.find('option').each(function () {
      if (selectedValues.includes($(this).val())) {
        $(this).prop('disabled', true);
      } else {
        $(this).prop('disabled', false);
      }
    });
  }

  // Disable options in the second and third select elements based on the initially selected value in the first select element
  disableOptions($select2, [$('#select2-modalAddPM').val()]);
  disableOptions($select3, [$('#select2-modalAddPM').val(), $select2.val()]);

  // Listen for change event on the first select element
  $('#select2-modalAddPM').on('change', function () {
    var selectedValue = $(this).val();

    // Reset the disabled options in the second and third select elements
    $select2.find('option').prop('disabled', false);
    $select3.find('option').prop('disabled', false);

    // Disable options in the second and third select elements based on the selected value in the first select element
    disableOptions($select2, [selectedValue]);
    disableOptions($select3, [selectedValue, $select2.val()]);
  });

  // Listen for change event on the second select element
  $select2.on('change', function () {
    var selectedValue = $(this).val();

    // Reset the disabled options in the third select element
    $select3.find('option').prop('disabled', false);

    // Disable options in the third select element based on the selected values in the first and second select elements
    disableOptions($select3, [$('#select2-modalAddPM').val(), selectedValue]);
  });

  //Ckeditor add project
  ClassicEditor
    .create(document.querySelector('#addProjectEditor'))
    .then(editorInstance => {
      const editorContentInput = $('#editorAdd');

      editorInstance.model.document.on('change:data', () => {
        const content = editorInstance.getData().trim();
        editorContentInput.val(content); // Set the CKEditor content to the hidden input field
      });
    })
    .catch(error => {
      console.error(error);
    });

  //Ckeditor edit project settings
  ClassicEditor
  .create(document.querySelector('#settingsProjectEditor'))
  .then(editorInstance => {
    const editorContentInput = document.querySelector('#editorSettings');
    editorInstance.setData(editorContentInput.value);

    editorInstance.model.document.on('change:data', () => {
      const content = editorInstance.getData().trim();
      editorContentInput.value = content; // Set the CKEditor content to the hidden input field
    });
  })
  .catch(error => {
    console.error(error);
  });
  

  //Save data
  $('#addProjectForm').submit(function (event) {
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
        $('#spinnerBtnProject').show();
        $('#submitBtnProject').hide();
        $('#resetBtnProject').hide();
      },
      success: function (response) {
        // handle success
        if (response.success) {
          location.reload();
        }
      },
      error: function (response) {
        setTimeout(function () {
          $('#spinnerBtnProject').hide();
          $('#submitBtnProject').show();
          $('#resetBtnProject').show();
          if (response.status == 422) {
            console.log(response);
            var errors = response.responseJSON.errors;
            for (var key in errors) {
              $('#' + key).addClass(' is-invalid');
              $('#error-' + key).show();
              $('#error-' + key).text(errors[key][0])
            }
          }
        }, 500);
      }
    });
  });
});

