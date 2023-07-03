<!-- Sidebar -->
<div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
    <div class="sidebar-wrapper">
        <div class="card-body add-task d-flex justify-content-center">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#new-task-modal">
                Add Task
            </button>
        </div>
        <div class="pt-0 pb-0 card-body d-flex justify-content-center">
            <!-- Todo search starts -->
            <div class="app-fixed-search d-flex align-items-center">
                <div class="sidebar-toggle d-block d-lg-none ms-1">
                    <i data-feather="menu" class="font-medium-5"></i>
                </div>
                <div class="d-flex align-content-center justify-content-between w-100">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        <input type="text" class="form-control" id="todo-search" placeholder="Search task"
                            aria-label="Search..." aria-describedby="todo-search" />
                    </div>
                </div>
            </div>
            <!-- Todo search ends -->
        </div>
        <div class="card-body pb-0">
            <h5 class="section-label mb-1">
                <span class="align-middle">Filter By Role</span>
            </h5>
            <div class="list-group list-group-filters">
                <a href="#" class="list-group-item list-group-item-action active">
                    <i data-feather="eye" class="font-medium-3 me-50"></i>
                    <span class="align-middle"> Viewer</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i data-feather="target" class="font-medium-3 me-50"></i> <span class="align-middle">Creator</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i data-feather="check-circle" class="font-medium-3 me-50"></i> <span
                        class="align-middle">Assignee</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i data-feather="star" class="font-medium-3 me-50"></i> <span class="align-middle">Reviewer</span>
                </a>
            </div>
        </div>

        <div class="card-body pb-0">
            <h5 class="section-label mb-1">
                <span class="align-middle">Filter By Status</span>
            </h5>
            <div class="form-check mb-1">
                <input type="checkbox" class="form-check-input select-all" id="select-all" checked />
                <label class="form-check-label" for="select-all">View All</label>
            </div>
            <div class="calendar-events-filter">
                <div class="form-check form-check-info mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="personal" data-value="personal"
                        checked />
                    <label class="form-check-label" for="personal">Todo</label>
                </div>
                <div class="form-check form-check-primary mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="business" data-value="business"
                        checked />
                    <label class="form-check-label" for="business">Doing</label>
                </div>
                <div class="form-check form-check-warning mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="family" data-value="family"
                        checked />
                    <label class="form-check-label" for="family">Reviewing</label>
                </div>
                <div class="form-check form-check-success mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="holiday" data-value="holiday"
                        checked />
                    <label class="form-check-label" for="holiday">Done Ontime</label>
                </div>
                <div class="form-check form-check-secondary mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="etc" data-value="etc"
                        checked />
                    <label class="form-check-label" for="etc">Done Late</label>
                </div>
                <div class="form-check form-check-danger mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="holiday" data-value="holiday"
                        checked />
                    <label class="form-check-label" for="holiday">Overdue</label>
                </div>

            </div>
        </div>
    </div>
    <div class="mt-auto">
        <img src="{{ asset('images/pages/calendar-illustration.png') }}" alt="Calendar illustration"
            class="img-fluid" />
    </div>
</div>
<!-- /Sidebar -->
