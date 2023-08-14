<!-- Edit User Modal -->
<div class="modal fade" id="addNewProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Create new project</h1>
                </div>
                <form id="addProjectForm" class="row gy-1 pt-75" action="{{ route('add.project') }}" method="POST">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalAddProjectName">Project Name</label>
                        <input type="text" id="modalAddProjectName" name="modalAddProjectName" class="form-control"
                            placeholder="Project Name" value="" data-msg="Please enter your project name" />
                        <span id="error-modalAddProjectName" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="select2-modalAddPM">Project Manager</label>
                        <select disabled name="modalAddPM" class="select2 form-select" id="select2-modalAddPM">
                            @forelse ($students as $acc)
                                <option value="{{ $acc->id }}"
                                    {{ Auth::user()->id == $acc->id ? 'selected' : '' }}>{{ $acc->name }} (You)
                                </option>
                            @empty
                                <option value="" selected disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalAddPM" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="select2-modalAddSupervisor">Project Supervisor</label>
                        <select name="modalAddSupervisor" class="select2 form-select" id="select2-modalAddSupervisor">
                            @forelse ($supervisors as $acc)
                                <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                            @empty
                                <option value="" selected disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalAddSupervisor" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="select2-limited"></label>
                        <select name="modalAddMembers[]" class="max-length form-select" id="select2-limited" multiple>
                            @foreach ($students as $acc)
                                <option value="{{ $acc->id }}">{{ $acc->name }} - {{ $acc->email }}</option>
                            @endforeach
                        </select>
                        <span id="error-modalAddMembers" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="fp-range">Pick your project duration</label>
                        <input name="duration" type="text" id="fp-range" class="form-control flatpickr-range"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                        <span id="error-duration" style="color: red; display: none"></span>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="addProjectEditor">Description</label>                            
                        <div id="addProjectEditor"></div>
                        <input type="hidden" name="modalAddDesc" id="editorAdd" value="">
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button style="display: none" id="spinnerBtnProject"
                            class="btn btn-outline-primary waves-effect" type="button" disabled="">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="ms-25 align-middle">Loading...</span>
                        </button>
                        <button type="submit" id="submitBtnProject" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" id="resetBtnProject" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
