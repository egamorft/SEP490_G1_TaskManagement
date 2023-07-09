<!-- Kanban starts -->
<section class="app-kanban-wrapper">
    <div class="row">
        <div class="col-12">
            <form class="add-new-board">
                <label class="add-new-btn mb-2" for="add-new-board-input">
                    <i class="align-middle" data-feather="plus"></i>
                    <span class="align-middle">Add new</span>
                </label>
                <input type="text" class="form-control add-new-board-input mb-50" placeholder="Add Board Title"
                    id="add-new-board-input" required />
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
    <!-- Kanban Sidebar starts -->
    <div class="modal update-item-sidebar fade" id="addNewProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-3 pt-50">
                    <div class="mb-2 kanban-detail-header">
                        <div class="mb-1 kanban-detail-title">Code màn chức năng view BE</div>
						<div class="mb-1 kanban-detail-status">
							Trong danh sách <span><u>Đang làm</u></span>
						</div>
					</div>

					<div class="mb-2 kanban-detail-progress">
						<div class="mb-1">
							<div class="">

							</div>
						</div>
					</div>
                    <form id="addProjectForm" class="row gy-1 pt-75" action="{{ route('add.project') }}" method="POST">
                        @csrf
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalAddProjectName">Project Name</label>
                            <input type="text" id="modalAddProjectName" name="modalAddProjectName"
                                class="form-control" placeholder="Project Name" value=""
                                data-msg="Please enter your project name" />
                            <span id="error-modalAddProjectName" style="color: red; display: none"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="select2-modalAddPM">Project Manager</label>
                            <select disabled name="modalAddPM" class="select2 form-select" id="select2-modalAddPM">
                            </select>
                            <span id="error-modalAddPM" style="color: red; display: none"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="select2-modalAddSupervisor">Project Supervisor</label>
                            <select name="modalAddSupervisor" class="select2 form-select"
                                id="select2-modalAddSupervisor">
                            </select>
                            <span id="error-modalAddSupervisor" style="color: red; display: none"></span>
                        </div>
                        <!-- Limit Selected Options -->
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="select2-limited">Project Member</label>
                            <select name="modalAddMembers[]" class="max-length form-select" id="select2-limited"
                                multiple>
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
                            <button style="display: none" id="spinnerBtnProject"
                                class="btn btn-outline-primary waves-effect" type="button" disabled="">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
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

    <!-- Kanban Sidebar ends -->
</section>
<!-- Kanban ends -->
