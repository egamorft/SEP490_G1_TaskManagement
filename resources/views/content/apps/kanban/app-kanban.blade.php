@extends('layouts/contentLayoutMaster')

@section('title', 'Kanban')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/jkanban/jkanban.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-kanban.css')) }}">
@endsection

@section('content')
<!-- Kanban starts -->
<section class="app-kanban-wrapper">
  <div class="row">
    <div class="col-12">
      <form class="add-new-board">
        <label class="add-new-btn mb-2" for="add-new-board-input">
          <i class="align-middle" data-feather="plus"></i>
          <span class="align-middle">Add new</span>
        </label>
        <input
          type="text"
          class="form-control add-new-board-input mb-50"
          placeholder="Add Board Title"
          id="add-new-board-input"
          required
        />
        <div class="mb-1 add-new-board-input">
          <button class="btn btn-primary btn-sm me-75">Add</button>
          <button type="button" class="btn btn-outline-secondary btn-sm cancel-add-new">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Kanban content starts -->
  <div class="kanban-wrapper"></div>
  <!-- Kanban content ends -->
</section>
<!-- Kanban ends -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/jkanban/jkanban.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/app-kanban.js')) }}"></script>
@endsection
