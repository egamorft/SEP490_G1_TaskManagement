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
                                    {{ Auth::user()->id == $acc->id ? 'selected' : '' }}>{{ $acc->fullname }} (You)</option>
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
                                <option value="{{ $acc->id }}">{{ $acc->fullname }}</option>
                            @empty
                                <option value="" selected disabled>No data available</option>
                            @endforelse
                        </select>
                        <span id="error-modalAddSupervisor" style="color: red; display: none"></span>
                    </div>
                    <!-- Limit Selected Options -->
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="select2-limited">Project Member</label>
                        <select name="modalAddMembers[]" class="max-length form-select" id="select2-limited" multiple>
                            @forelse ($students as $acc)
                                <option value="{{ $acc->id }}">{{ $acc->fullname }} - {{ $acc->email }}</option>
                            @empty
                                <option value="" selected disabled>No data available</option>
                            @endforelse
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
                        <label class="form-label" for="modalAddDesc">Description</label>
                        <textarea id="modalAddDesc" name="modalAddDesc" class="form-control" value=""
                            placeholder="Enter project description"></textarea>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
